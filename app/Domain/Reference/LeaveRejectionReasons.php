<?php

namespace App\Domain\Reference;

use App\Domain\Audit\Audit;
use App\Exceptions\ApiException;
use App\Models\LeaveRejectionReason;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Aksi Owner atas daftar alasan penolakan izin. Semua dalam transaksi dan tercatat di riwayat perubahan.
 */
class LeaveRejectionReasons
{
    private const AUDITED = ['name', 'description', 'sort_order', 'is_active'];

    /**
     * @param  array{name: string, description?: string|null, sort_order?: int}  $data
     */
    public static function create(array $data): LeaveRejectionReason
    {
        return DB::transaction(function () use ($data) {
            $reason = LeaveRejectionReason::query()->forceCreate([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'sort_order' => $data['sort_order'] ?? (int) LeaveRejectionReason::query()->max('sort_order') + 1,
                'is_active' => true,
            ]);

            Audit::record('leave_rejection_reason.created', $reason, null, $reason->only(self::AUDITED));

            return $reason;
        });
    }

    /**
     * @param  array{name?: string, description?: string|null, sort_order?: int}  $data
     */
    public static function update(LeaveRejectionReason $reason, array $data): LeaveRejectionReason
    {
        return DB::transaction(function () use ($reason, $data) {
            $before = $reason->only(array_keys($data));
            $reason->update($data);

            Audit::record('leave_rejection_reason.updated', $reason, $before, $reason->only(array_keys($data)));

            return $reason;
        });
    }

    /**
     * Daftar untuk Owner/Admin: saring status (active|inactive|all) dan nama, urut sort_order. Daftar kecil, tanpa paginasi.
     *
     * @return Collection<int, LeaveRejectionReason> dengan atribut usage_count
     */
    public static function listing(string $status = 'all', ?string $search = null): Collection
    {
        $reasons = LeaveRejectionReason::query()
            ->when($status !== 'all', fn ($q) => $q->where('is_active', $status === 'active'))
            ->when(filled($search), fn ($q) => $q->where('name', 'like', '%'.addcslashes($search, '%_\\').'%'))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $usage = ReferenceUsage::countsFor(LeaveRejectionReason::class, $reasons->modelKeys());

        return $reasons->each(fn (LeaveRejectionReason $r) => $r->usage_count = $usage[$r->id]);
    }

    /**
     * @param  list<int>  $ids  semua id alasan dalam urutan baru
     */
    public static function reorder(array $ids): void
    {
        DB::transaction(function () use ($ids) {
            $current = self::lockedOrder();

            if (count($ids) !== count($current) || array_diff($current, $ids) !== []) {
                $message = 'Urutan harus memuat semua alasan tepat satu kali.';

                throw ApiException::validation($message, ['ids' => [$message]]);
            }

            self::saveOrder($current, array_values($ids));
        });
    }

    /**
     * Geser satu posisi ke atas (-1) atau ke bawah (+1); di ujung daftar tidak berubah.
     */
    public static function move(LeaveRejectionReason $reason, int $direction): void
    {
        DB::transaction(function () use ($reason, $direction) {
            $current = self::lockedOrder();
            $from = array_search($reason->id, $current, true);
            $to = $from === false ? null : $from + $direction;

            if ($to === null || ! isset($current[$to])) {
                return;
            }

            $ids = $current;
            [$ids[$from], $ids[$to]] = [$ids[$to], $ids[$from]];
            self::saveOrder($current, $ids);
        });
    }

    public static function deactivate(LeaveRejectionReason $reason): void
    {
        self::setActive($reason, false);
    }

    public static function activate(LeaveRejectionReason $reason): void
    {
        self::setActive($reason, true);
    }

    public static function delete(LeaveRejectionReason $reason): void
    {
        DB::transaction(function () use ($reason) {
            $reason = $reason->newQuery()->lockForUpdate()->findOrFail($reason->id);

            if ($reason->isUsed()) {
                throw ApiException::conflict('Alasan sudah pernah dipakai, hanya dapat dinonaktifkan.', [], 'REFERENCE_IN_USE');
            }

            Audit::record('leave_rejection_reason.deleted', $reason, $reason->only(self::AUDITED), null);
            $reason->delete();
        });
    }

    /**
     * @return list<int>
     */
    private static function lockedOrder(): array
    {
        return LeaveRejectionReason::query()->lockForUpdate()->orderBy('sort_order')->orderBy('id')->pluck('id')->all();
    }

    /**
     * Satu UPDATE untuk semua baris, lalu satu catatan riwayat.
     *
     * @param  list<int>  $before
     * @param  list<int>  $ids
     */
    private static function saveOrder(array $before, array $ids): void
    {
        $cases = implode(' ', array_fill(0, count($ids), 'WHEN ? THEN ?'));
        $in = implode(',', array_fill(0, count($ids), '?'));

        DB::update(
            "UPDATE leave_rejection_reasons SET sort_order = CASE id {$cases} END, updated_at = ? WHERE id IN ({$in})",
            [...collect($ids)->flatMap(fn (int $id, int $i) => [$id, $i + 1]), now(), ...$ids],
        );

        Audit::record(
            'leave_rejection_reason.reordered',
            ['type' => (new LeaveRejectionReason)->getMorphClass(), 'label' => 'Daftar alasan penolakan'],
            ['ids' => $before],
            ['ids' => $ids],
        );
    }

    private static function setActive(LeaveRejectionReason $reason, bool $active): void
    {
        DB::transaction(function () use ($reason, $active) {
            $reason = $reason->newQuery()->lockForUpdate()->findOrFail($reason->id);

            if ($reason->is_active === $active) {
                throw ApiException::conflict($active ? 'Alasan sudah aktif.' : 'Alasan sudah nonaktif.');
            }

            $reason->forceFill(['is_active' => $active, 'deactivated_at' => $active ? null : now()])->save();

            Audit::record(
                'leave_rejection_reason.'.($active ? 'activated' : 'deactivated'),
                $reason,
                ['is_active' => ! $active],
                ['is_active' => $active],
            );
        });
    }
}
