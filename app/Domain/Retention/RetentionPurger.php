<?php

namespace App\Domain\Retention;

use App\Domain\Audit\Audit;
use App\Domain\Audit\AuditPurger;
use App\Domain\Notification\Notifier;
use App\Domain\Notification\Recipients;
use App\Models\RetentionRun;
use App\Notifications\EdukomNotification;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

/**
 * Membersihkan data yang melewati masa simpan. Berkas dihapus dan kolomnya dikosongkan, baris data tetap ada
 * (dasar honorarium dan laporan tidak pernah dihapus). Riwayat perubahan dihapus barisnya lewat AuditPurger.
 */
class RetentionPurger
{
    public static function run(bool $dryRun = false): RetentionRun
    {
        $today = today();
        $run = RetentionRun::query()->create([
            'started_at' => now(),
            'dry_run' => $dryRun,
            'triggered_by' => Auth::id(),
            'status' => RetentionRun::RUNNING,
        ]);

        $summary = [];

        foreach (RetentionCatalog::all() as $type => $entry) {
            $summary[] = ['type' => $type, 'label' => $entry['label'], ...self::purgeType($type, $today, $dryRun)];
        }

        $failed = count(array_filter($summary, fn (array $s) => $s['status'] === 'failed'));
        $run->update([
            'finished_at' => now(),
            'summary' => $summary,
            'status' => match (true) {
                $failed === 0 => RetentionRun::SUCCESS,
                $failed === count($summary) => RetentionRun::FAILED,
                default => RetentionRun::PARTIAL,
            },
        ]);

        if (! $dryRun) {
            self::report($run);
        }

        return $run;
    }

    /**
     * @return array{months: int|null, cutoff: string|null, count: int, status: string, message: string|null}
     */
    private static function purgeType(string $type, CarbonInterface $today, bool $dryRun): array
    {
        $months = RetentionCatalog::monthsOn($type, $today);

        if ($months === null) {
            return ['months' => null, 'cutoff' => null, 'count' => 0, 'status' => 'skipped', 'message' => 'Masa simpan belum dikonfigurasi.'];
        }

        $cutoff = $today->copy()->subMonthsNoOverflow($months);
        $result = ['months' => $months, 'cutoff' => $cutoff->toDateString()];
        $target = config("edukom.retention_targets.{$type}");

        if ($type !== RetentionCatalog::AUDIT_LOG && $target === null) {
            return [...$result, 'count' => 0, 'status' => 'skipped', 'message' => 'Belum ada modul yang menyimpan data ini.'];
        }

        try {
            $count = match (true) {
                $type === RetentionCatalog::AUDIT_LOG => $dryRun ? AuditPurger::countBefore($cutoff) : AuditPurger::purgeBefore($cutoff),
                default => self::purgeFiles($target, $cutoff, $dryRun),
            };

            return [...$result, 'count' => $count, 'status' => 'success', 'message' => null];
        } catch (Throwable $e) {
            Log::error('Pembersihan masa simpan gagal', ['type' => $type, 'exception' => $e]);

            return [...$result, 'count' => 0, 'status' => 'failed', 'message' => 'Pembersihan gagal; lihat log aplikasi.'];
        }
    }

    /**
     * @param  array{0: class-string<Model>, 1: string, 2: string}  $target
     */
    private static function purgeFiles(array $target, CarbonInterface $cutoff, bool $dryRun): int
    {
        [$model, $dateColumn, $fileColumn] = $target;
        $query = $model::query()->where($dateColumn, '<', $cutoff)->whereNotNull($fileColumn);

        if ($dryRun) {
            return $query->count();
        }

        $disk = Storage::disk();
        $count = 0;

        $query->select([(new $model)->getKeyName(), $fileColumn])->chunkById(200, function ($rows) use ($disk, $fileColumn, &$count) {
            $disk->delete($rows->pluck($fileColumn)->all());
            $rows->first()->newQuery()->whereKey($rows->modelKeys())->update([$fileColumn => null]);
            $count += $rows->count();
        });

        return $count;
    }

    private static function report(RetentionRun $run): void
    {
        $counts = collect($run->summary)->mapWithKeys(fn (array $s) => [$s['type'] => $s['count']])->all();
        $text = collect($run->summary)->where('count', '>', 0)->map(fn (array $s) => "{$s['label']} {$s['count']}")->implode(', ');
        $message = ($text === '' ? 'Tidak ada data yang melewati masa simpan.' : "Data dibersihkan: {$text}.")
            .($run->status === RetentionRun::SUCCESS ? '' : ' Sebagian jenis data gagal dibersihkan.');

        Audit::record('retention.purged', [
            'type' => $run->getMorphClass(),
            'id' => $run->id,
            'label' => 'Pembersihan masa simpan',
        ], null, ['counts' => $counts, 'status' => $run->status]);

        Notifier::send(Recipients::owners(), new EdukomNotification(
            event: 'retention.purged',
            title: 'Pembersihan data selesai',
            message: $message,
            subjectType: 'retention_run',
            subjectId: $run->id,
            actionUrl: '/owner/kebijakan/masa-simpan',
        ));
    }
}
