<?php

namespace Database\Seeders;

use App\Domain\Reference\LeaveRejectionReasons;
use App\Models\LeaveRejectionReason;
use Illuminate\Database\Seeder;

/**
 * Contoh alasan untuk pengembangan (hanya APP_ENV=local). Daftar resmi disusun Owner.
 */
class LeaveRejectionReasonSeeder extends Seeder
{
    private const EXAMPLES = [
        'Bukti tidak memadai',
        'Melewati batas waktu pengajuan',
        'Calon pengganti tidak memenuhi syarat',
        'Bentrok jadwal calon pengganti',
    ];

    public function run(): void
    {
        foreach (self::EXAMPLES as $name) {
            if (! LeaveRejectionReason::query()->where('name', $name)->exists()) {
                LeaveRejectionReasons::create(['name' => $name]);
            }
        }
    }
}
