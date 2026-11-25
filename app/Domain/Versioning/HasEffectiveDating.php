<?php

namespace App\Domain\Versioning;

use App\Enums\VersionStatus;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

/**
 * Model versi dengan tanggal berlaku. Tabel memakai $table->effectiveDating().
 * Tambah/batalkan versi hanya lewat VersionTimeline.
 *
 * @property CarbonImmutable $effective_from
 * @property CarbonImmutable|null $effective_to
 * @property CarbonImmutable|null $cancelled_at
 */
trait HasEffectiveDating
{
    /**
     * Versi-versi sejenis (satu deret), misalnya semua versi untuk satu kode parameter.
     */
    abstract public function versionSeries(): Builder;

    public function initializeHasEffectiveDating(): void
    {
        $this->mergeCasts([
            'effective_from' => 'immutable_date',
            'effective_to' => 'immutable_date',
            'cancelled_at' => 'immutable_datetime',
        ]);
    }

    #[Scope]
    protected function activeOn(Builder $query, CarbonInterface $date): void
    {
        $query->whereNull('cancelled_at')
            ->where('effective_from', '<=', $date->toDateString())
            ->where(fn (Builder $q) => $q->whereNull('effective_to')->orWhere('effective_to', '>=', $date->toDateString()));
    }

    public function versionStatus(): VersionStatus
    {
        $today = today();

        return match (true) {
            $this->cancelled_at !== null => VersionStatus::Cancelled,
            $this->effective_from->gt($today) => VersionStatus::Scheduled,
            $this->effective_to?->lt($today) => VersionStatus::Ended,
            default => VersionStatus::Active,
        };
    }
}
