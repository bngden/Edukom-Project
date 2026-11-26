<?php

namespace App\Domain\Versioning;

use App\Domain\Audit\Audit;
use App\Domain\Payroll\PeriodGuard;
use App\Exceptions\ApiException;
use App\Support\Format;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VersionTimeline
{
    /**
     * Menyimpan versi baru (belum disimpan, effective_from sudah diisi) dan menutup versi sebelumnya H-1.
     *
     * @template T of Model
     *
     * @param  T  $version  model yang memakai HasEffectiveDating
     * @return T
     */
    public static function add(Model $version, ?string $reason = null): Model
    {
        $from = $version->effective_from;

        return DB::transaction(function () use ($version, $from, $reason) {
            PeriodGuard::assertNotLocked($from);

            $previous = $version->versionSeries()
                ->whereNull('cancelled_at')
                ->orderByDesc('effective_from')
                ->lockForUpdate()
                ->first();

            if ($previous !== null && $from->lte($previous->effective_from)) {
                $message = 'Tanggal berlaku harus setelah '.Format::date($previous->effective_from)
                    .' (tanggal berlaku versi terakhir).';

                throw ApiException::conflict($message, ['effective_from' => [$message]]);
            }

            $before = $previous?->versionContent();
            $previous?->forceFill(['effective_to' => $from->subDay()])->save();

            $version->forceFill(['reason' => $reason, 'created_by' => Auth::id()])->save();

            Audit::record(self::action($version, 'version_created'), self::subject($version), $before, $version->versionContent(), $reason);

            return $version;
        });
    }

    /**
     * Membatalkan versi terakhir yang belum berlaku; versi sebelumnya kembali berlaku tanpa tanggal akhir.
     */
    public static function cancel(Model $version, string $reason): void
    {
        if (trim($reason) === '') {
            throw ApiException::validation('Alasan pembatalan wajib diisi.', ['reason' => ['Alasan pembatalan wajib diisi.']]);
        }

        DB::transaction(function () use ($version, $reason) {
            $version = $version->newQuery()->lockForUpdate()->findOrFail($version->getKey());

            // Dua versi terakhir yang belum dibatalkan: [0] harus versi ini, [1] versi sebelumnya.
            $latest = $version->versionSeries()
                ->whereNull('cancelled_at')
                ->orderByDesc('effective_from')
                ->limit(2)
                ->lockForUpdate()
                ->get();

            $conflict = match (true) {
                $version->cancelled_at !== null => 'Versi ini sudah dibatalkan.',
                ! $version->effective_from->isFuture() => 'Versi yang sudah berlaku tidak dapat dibatalkan.',
                ! $latest->first()?->is($version) => 'Hanya versi terakhir yang dapat dibatalkan.',
                default => null,
            };

            if ($conflict !== null) {
                throw ApiException::conflict($conflict);
            }

            $version->forceFill(['cancelled_at' => now(), 'cancelled_by' => Auth::id(), 'cancel_reason' => $reason])->save();

            $latest->get(1)?->forceFill(['effective_to' => null])->save();

            Audit::record(self::action($version, 'version_cancelled'), self::subject($version), ['cancelled_at' => null], [
                'cancelled_at' => $version->cancelled_at->toIso8601String(),
                'effective_from' => $version->effective_from->toDateString(),
            ], $reason);
        });
    }

    private static function action(Model $version, string $event): string
    {
        return $version->versionAuditName().'.'.$event;
    }

    /**
     * @return array{type: string, id: mixed, label: string|null}
     */
    private static function subject(Model $version): array
    {
        $subject = $version->versionSubject();

        return ['type' => $subject->getMorphClass(), 'id' => $subject->getKey(), 'label' => $version->versionLabel()];
    }
}
