<?php

namespace App\Console\Commands;

use App\Domain\Retention\RetentionPurger;
use App\Models\RetentionRun;
use Illuminate\Console\Command;

class PurgeRetention extends Command
{
    protected $signature = 'edukom:purge-retention {--dry-run : Hanya menghitung, tidak menghapus}';

    protected $description = 'Membersihkan berkas dan riwayat perubahan yang melewati masa simpan';

    public function handle(): int
    {
        $run = RetentionPurger::run((bool) $this->option('dry-run'));

        $this->table(
            ['Jenis', 'Masa simpan', 'Sebelum', 'Jumlah', 'Status', 'Keterangan'],
            collect($run->summary)->map(fn (array $s) => [
                $s['label'], $s['months'] ? "{$s['months']} bulan" : '-', $s['cutoff'] ?? '-', $s['count'], $s['status'], $s['message'] ?? '',
            ])->all(),
        );

        $this->info(($run->dry_run ? 'Uji (tanpa menghapus) ' : 'Pembersihan ').'selesai: '.$run->statusLabel().'.');

        return $run->status === RetentionRun::FAILED ? self::FAILURE : self::SUCCESS;
    }
}
