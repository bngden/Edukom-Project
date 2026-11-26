<?php

namespace App\Domain\Versioning;

use App\Enums\VersionStatus;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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
            'effective_from' => 'immutable_date:Y-m-d',
            'effective_to' => 'immutable_date:Y-m-d',
            'cancelled_at' => 'immutable_datetime',
        ]);
    }

    /**
     * Awalan aksi audit, misalnya "policy_parameter" → policy_parameter.version_created.
     */
    public function versionAuditName(): string
    {
        return Str::snake(class_basename($this));
    }

    /**
     * Label subjek audit yang mudah dibaca (misalnya label parameter).
     */
    public function versionLabel(): ?string
    {
        return null;
    }

    /**
     * Subjek audit versi. Bawaan: versi itu sendiri. Model versi milik objek lain (parameter, komponen) mengembalikan
     * objek induknya agar "riwayat per objek" memuat semua perubahan versinya.
     */
    public function versionSubject(): Model
    {
        return $this;
    }

    /**
     * Isi versi untuk audit before/after, tanpa kolom pembukuan.
     *
     * @return array<string, mixed>
     */
    public function versionContent(): array
    {
        return Arr::except($this->attributesToArray(), [
            'id', 'effective_to', 'reason', 'created_by', 'cancelled_at', 'cancelled_by', 'cancel_reason', 'created_at', 'updated_at',
        ]);
    }

    #[Scope]
    protected function activeOn(Builder $query, CarbonInterface $date): void
    {
        $query->whereNull('cancelled_at')
            ->where('effective_from', '<=', $date->toDateString())
            ->where(fn (Builder $q) => $q->whereNull('effective_to')->orWhere('effective_to', '>=', $date->toDateString()));
    }

    /**
     * Versi yang belum dibatalkan dan belum berakhir pada $date (berlaku atau terjadwal), terbaru dulu.
     */
    #[Scope]
    protected function openOn(Builder $query, CarbonInterface $date): void
    {
        $query->whereNull('cancelled_at')
            ->where(fn (Builder $q) => $q->whereNull('effective_to')->orWhere('effective_to', '>=', $date->toDateString()))
            ->orderByDesc('effective_from');
    }

    /**
     * Versi yang belum dibatalkan dan baru berlaku setelah $date.
     */
    #[Scope]
    protected function scheduledAfter(Builder $query, CarbonInterface $date): void
    {
        $query->whereNull($query->qualifyColumn('cancelled_at'))->where($query->qualifyColumn('effective_from'), '>', $date->toDateString());
    }

    /**
     * Riwayat versi untuk ditampilkan: terbaru dulu, beserta pembuat dan pembatal.
     */
    #[Scope]
    protected function history(Builder $query, int $limit = 50): void
    {
        $query->with(['creator:id,name', 'canceller:id,name'])->orderByDesc('effective_from')->orderByDesc('id')->limit($limit);
    }

    /**
     * Versi berlaku dan versi terjadwal berikutnya pada $date dari koleksi versi (urutan bebas).
     *
     * @param  iterable<static>  $versions
     * @return array{0: static|null, 1: static|null}
     */
    public static function currentAndScheduled(iterable $versions, CarbonInterface $date): array
    {
        $open = collect($versions)
            ->filter(fn (self $v) => $v->cancelled_at === null && ($v->effective_to === null || $v->effective_to->gte($date)))
            ->sortByDesc(fn (self $v) => $v->effective_from->toDateString());

        return [
            $open->first(fn (self $v) => $v->effective_from->lte($date)),
            $open->first(fn (self $v) => $v->effective_from->gt($date)),
        ];
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
