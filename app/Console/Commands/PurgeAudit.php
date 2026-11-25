<?php

namespace App\Console\Commands;

use App\Domain\Audit\Audit;
use App\Models\AuditLog;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PurgeAudit extends Command
{
    protected $signature = 'edukom:purge-audit {--before= : Hapus riwayat sebelum tanggal ini (YYYY-MM-DD)}';

    protected $description = 'Menghapus riwayat perubahan yang melewati masa simpan';

    public function handle(): int
    {
        $validator = Validator::make(['before' => $this->option('before')], [
            'before' => ['required', 'date_format:Y-m-d'],
        ], [], ['before' => '--before']);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());

            return self::FAILURE;
        }

        $before = Carbon::parse($validator->validated()['before']);
        $deleted = 0;

        DB::statement('SET @edukom_audit_purge = 1');

        try {
            // Bulk delete tidak memicu event model, jadi penjaga `deleting` di AuditLog tidak terpanggil.
            do {
                $batch = AuditLog::query()->where('occurred_at', '<', $before)->limit(1000)->delete();
                $deleted += $batch;
            } while ($batch === 1000);
        } finally {
            DB::statement('SET @edukom_audit_purge = NULL');
        }

        Audit::record('audit.purged', [
            'type' => 'audit_log',
            'label' => 'Riwayat sebelum '.$before->toDateString(),
        ], null, ['before' => $before->toDateString(), 'deleted' => $deleted]);

        $this->info("{$deleted} catatan riwayat dihapus.");

        return self::SUCCESS;
    }
}
