<?php

use App\Models\LeaveRejectionReason;

return [

    /*
    | Penguncian akun setelah login gagal berturut-turut (T0.1, SEC-02).
    */
    'auth' => [
        'max_failed_attempts' => 5,
        'lock_minutes' => 15,
        'login_rate_per_minute' => 10,
    ],

    /*
    | Tanggal mulai berlaku versi awal parameter kebijakan (PolicyParameterSeeder, T1.1).
    */
    'policy_base_date' => env('EDUKOM_POLICY_BASE_DATE', '2026-01-01'),

    /*
    | Tabel yang memakai data referensi: [Model::class => [[tabel, kolom FK], ...]] (T1.4).
    | Dipakai TracksUsage::isUsed() agar data yang sudah dipakai tidak dapat dihapus.
    | Modul pemakai mendaftarkan tabelnya di sini (misalnya izin di T2.5).
    */
    'reference_usage' => [
        LeaveRejectionReason::class => [],
    ],

    /*
    | Sumber berkas yang dibersihkan sesuai masa simpan (T1.5): [jenis => [Model::class, kolom_tanggal, kolom_berkas]].
    | Jenis dari RetentionCatalog. Berkas dihapus dari disk bawaan dan kolomnya dikosongkan; barisnya tetap ada.
    | audit_log ditangani khusus (AuditPurger). Modul presensi, izin, serah terima, dan slip mendaftarkan sumbernya di sini.
    */
    'retention_targets' => [],

    /*
    | Password akun bawaan untuk DatabaseSeeder (hanya APP_ENV=local).
    */
    'seed' => [
        'owner_password' => env('SEED_OWNER_PASSWORD'),
        'admin_password' => env('SEED_ADMIN_PASSWORD'),
    ],

];
