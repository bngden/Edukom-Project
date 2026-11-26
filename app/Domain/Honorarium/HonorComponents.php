<?php

namespace App\Domain\Honorarium;

use App\Domain\Audit\Audit;
use App\Domain\Payroll\PeriodGuard;
use App\Domain\Versioning\VersionTimeline;
use App\Enums\RateType;
use App\Exceptions\ApiException;
use App\Models\HonorComponent;
use App\Models\HonorComponentRate;
use App\Support\Format;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Aksi Owner atas komponen honorarium. Semua dalam transaksi dan tercatat di riwayat perubahan.
 */
class HonorComponents
{
    /**
     * Komponen tambahan (selalu tarif flat) beserta versi tarif pertamanya.
     *
     * @param  array{name: string, description?: string|null, basis: string, amount: int, effective_from: string, reason?: string|null}  $data
     */
    public static function create(array $data): HonorComponent
    {
        return DB::transaction(function () use ($data) {
            $component = HonorComponent::query()->create([
                'code' => self::uniqueCode($data['name']),
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'basis' => $data['basis'],
                'rate_type' => RateType::Flat,
                'is_system' => false,
                'sort_order' => (int) HonorComponent::query()->max('sort_order') + 1,
            ]);

            Audit::record('honor_component.created', $component, null, $component->only(['code', 'name', 'description', 'basis', 'rate_type']), $data['reason'] ?? null);

            self::addRate($component, $data['amount'], $data['effective_from'], $data['reason'] ?? null);

            return $component;
        });
    }

    /**
     * Nama, deskripsi, dan urutan saja; dasar perhitungan dan jenis tarif tetap.
     *
     * @param  array{name?: string, description?: string|null, sort_order?: int}  $data
     */
    public static function updateInfo(HonorComponent $component, array $data): HonorComponent
    {
        return DB::transaction(function () use ($component, $data) {
            $before = $component->only(array_keys($data));
            $component->update($data);

            Audit::record('honor_component.updated', $component, $before, $component->only(array_keys($data)));

            return $component;
        });
    }

    public static function addRate(HonorComponent $component, int $amount, string $effectiveFrom, ?string $reason = null): HonorComponentRate
    {
        if ($component->rate_type !== RateType::Flat) {
            $message = 'Uang transportasi memakai tingkatan jarak, bukan nominal tetap. Ubah lewat pengaturan tingkatan jarak.';

            throw ApiException::validation($message, ['amount' => [$message]]);
        }

        $rate = (new HonorComponentRate([
            'honor_component_id' => $component->id,
            'amount' => $amount,
            'effective_from' => $effectiveFrom,
        ]))->setRelation('component', $component);

        if (! $component->isActiveOn($rate->effective_from)) {
            throw ApiException::conflict('Komponen nonaktif sejak '.Format::date($component->deactivated_from).'.');
        }

        return VersionTimeline::add($rate, $reason);
    }

    public static function deactivate(HonorComponent $component, string $from, string $reason): void
    {
        DB::transaction(function () use ($component, $from, $reason) {
            $component = $component->newQuery()->lockForUpdate()->findOrFail($component->id);

            if ($component->deactivated_from !== null) {
                throw ApiException::conflict('Komponen sudah dinonaktifkan sejak '.Format::date($component->deactivated_from).'.');
            }

            PeriodGuard::assertNotLocked(Carbon::parse($from), 'deactivated_from');

            $component->forceFill([
                'deactivated_from' => $from,
                'deactivation_reason' => $reason,
                'deactivated_by' => Auth::id(),
            ])->save();

            Audit::record('honor_component.deactivated', $component, ['deactivated_from' => null], ['deactivated_from' => $from], $reason);
        });
    }

    public static function cancelDeactivation(HonorComponent $component, string $reason): void
    {
        DB::transaction(function () use ($component, $reason) {
            $component = $component->newQuery()->lockForUpdate()->findOrFail($component->id);

            $conflict = match (true) {
                $component->deactivated_from === null => 'Komponen tidak dijadwalkan nonaktif.',
                ! $component->deactivated_from->isFuture() => 'Komponen yang sudah nonaktif tidak dapat diaktifkan kembali.',
                default => null,
            };

            if ($conflict !== null) {
                throw ApiException::conflict($conflict);
            }

            $from = $component->deactivated_from->toDateString();
            $component->forceFill(['deactivated_from' => null, 'deactivation_reason' => null, 'deactivated_by' => null])->save();

            Audit::record('honor_component.deactivation_cancelled', $component, ['deactivated_from' => $from], ['deactivated_from' => null], $reason);
        });
    }

    private static function uniqueCode(string $name): string
    {
        $base = Str::slug($name, '_') ?: 'komponen';
        $code = $base;

        for ($i = 2; HonorComponent::query()->where('code', $code)->exists(); $i++) {
            $code = "{$base}_{$i}";
        }

        return $code;
    }
}
