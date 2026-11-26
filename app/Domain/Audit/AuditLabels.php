<?php

namespace App\Domain\Audit;

use Illuminate\Support\Str;

/**
 * Label bahasa Indonesia untuk kode aksi dan jenis objek riwayat perubahan. Kode tak dikenal ditampilkan apa adanya.
 */
class AuditLabels
{
    private const ACTIONS = [
        'policy_parameter.version_created' => 'Menetapkan nilai',
        'policy_parameter.version_cancelled' => 'Membatalkan nilai terjadwal',
        'honor_component.created' => 'Menambah komponen',
        'honor_component.updated' => 'Mengubah komponen',
        'honor_component.deactivated' => 'Menonaktifkan komponen',
        'honor_component.deactivation_cancelled' => 'Membatalkan penonaktifan',
        'honor_component.version_created' => 'Menetapkan tarif',
        'honor_component.version_cancelled' => 'Membatalkan tarif terjadwal',
        'transport_tier_set.version_created' => 'Menetapkan tingkatan jarak',
        'transport_tier_set.version_cancelled' => 'Membatalkan tingkatan jarak terjadwal',
        'leave_rejection_reason.created' => 'Menambah alasan',
        'leave_rejection_reason.updated' => 'Mengubah alasan',
        'leave_rejection_reason.reordered' => 'Mengubah urutan alasan',
        'leave_rejection_reason.deactivated' => 'Menonaktifkan alasan',
        'leave_rejection_reason.activated' => 'Mengaktifkan alasan',
        'leave_rejection_reason.deleted' => 'Menghapus alasan',
        'retention.purged' => 'Membersihkan data lama',
        'audit.purged' => 'Menghapus riwayat lama',
        'access.denied' => 'Akses ditolak',
        'auth.account_locked' => 'Akun terkunci',
    ];

    public const SUBJECT_TYPES = [
        'policy_parameter' => 'Parameter kebijakan',
        'honor_component' => 'Komponen honor',
        'leave_rejection_reason' => 'Alasan penolakan',
        'retention_run' => 'Pembersihan data',
        'payroll_period' => 'Periode penggajian',
    ];

    private const FIELDS = [
        'value' => 'Nilai', 'amount' => 'Nominal', 'name' => 'Nama', 'description' => 'Deskripsi',
        'effective_from' => 'Berlaku mulai', 'tiers' => 'Tingkatan', 'sort_order' => 'Urutan', 'is_active' => 'Aktif',
        'deactivated_from' => 'Nonaktif mulai', 'cancelled_at' => 'Dibatalkan', 'basis' => 'Dasar perhitungan',
        'counts' => 'Jumlah', 'status' => 'Status', 'ids' => 'Urutan',
    ];

    public static function action(string $code): string
    {
        return self::ACTIONS[$code] ?? $code;
    }

    public static function subjectType(?string $type): ?string
    {
        return $type === null ? null : (self::SUBJECT_TYPES[$type] ?? Str::of(class_basename($type))->snake(' ')->ucfirst()->toString());
    }

    public static function field(string $key): string
    {
        return self::FIELDS[$key] ?? Str::of($key)->replace('_', ' ')->ucfirst()->toString();
    }

    public static function value(mixed $value): string
    {
        return match (true) {
            $value === null => '—',
            is_bool($value) => $value ? 'Ya' : 'Tidak',
            is_array($value) => json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            default => (string) $value,
        };
    }
}
