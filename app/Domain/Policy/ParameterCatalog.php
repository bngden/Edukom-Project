<?php

namespace App\Domain\Policy;

use App\Enums\ParameterGroup as G;
use App\Enums\ParameterType as T;
use InvalidArgumentException;

/**
 * Katalog parameter kebijakan. Key tetap di kode karena dipakai logika program; Owner hanya membuat versi nilai.
 * Disinkronkan ke tabel policy_parameters oleh PolicyParameterSeeder. default null = "Belum Dikonfigurasi".
 */
class ParameterCatalog
{
    /** Batas atas bawaan untuk tipe integer per unit. */
    private const MAX_BY_UNIT = [
        'menit' => 1440, 'jam' => 720, 'hari' => 365, 'hari kerja' => 60, 'meter' => 5000,
        'persen' => 1000, 'baris' => 1_000_000, 'bulan' => 120,
    ];

    /**
     * @var array<string, array{group: G, label: string, type: T, unit?: string, default: mixed, max?: int, description?: string}>
     */
    private const ENTRIES = [
        'session_duration_minutes' => ['group' => G::Learning, 'label' => 'Durasi satu sesi', 'type' => T::Integer, 'unit' => 'menit', 'default' => 70, 'max' => 600],
        'lesson_plan_deadline' => ['group' => G::Learning, 'label' => 'Tenggat materi rencana', 'type' => T::RelativeDeadline, 'default' => ['days_before' => 1, 'time' => '23:59']],
        'meeting_report_deadline_hours' => ['group' => G::Learning, 'label' => 'Tenggat laporan Pertemuan', 'type' => T::Integer, 'unit' => 'jam', 'default' => 48],
        'inter_school_gap_warning_minutes' => ['group' => G::Learning, 'label' => 'Peringatan jeda antarsekolah', 'type' => T::Integer, 'unit' => 'menit', 'default' => 30],

        'checkin_open_minutes_before_start' => ['group' => G::Attendance, 'label' => 'Presensi masuk dibuka sebelum jam mulai', 'type' => T::Integer, 'unit' => 'menit', 'default' => 15],
        'checkout_open_minutes_before_end' => ['group' => G::Attendance, 'label' => 'Presensi pulang dibuka sebelum jam selesai', 'type' => T::Integer, 'unit' => 'menit', 'default' => 15],
        'late_tolerance_minutes' => ['group' => G::Attendance, 'label' => 'Toleransi keterlambatan', 'type' => T::Integer, 'unit' => 'menit', 'default' => 30],
        'max_location_accuracy_meters' => ['group' => G::Attendance, 'label' => 'Ketelitian lokasi maksimal', 'type' => T::Integer, 'unit' => 'meter', 'default' => 50],
        // Hanya nilai awal untuk sekolah BARU; mengubahnya tidak mengubah radius sekolah yang sudah ada (OW-02.4).
        'default_school_radius_meters' => ['group' => G::Attendance, 'label' => 'Batas area awal sekolah baru', 'type' => T::Integer, 'unit' => 'meter', 'default' => 150,
            'description' => 'Dipakai sebagai nilai awal sekolah baru. Batas area sekolah yang sudah ada tidak berubah.'],
        'checkout_reminder_time' => ['group' => G::Attendance, 'label' => 'Pengingat presensi pulang (selain jam selesai sesi)', 'type' => T::Time, 'default' => '20:00'],
        'absent_marking_time' => ['group' => G::Attendance, 'label' => 'Waktu penandaan Tidak Hadir', 'type' => T::Time, 'default' => '23:59'],

        'planned_leave_deadline' => ['group' => G::Leave, 'label' => 'Batas izin terencana', 'type' => T::RelativeDeadline, 'default' => ['days_before' => 3, 'time' => '23:59']],
        'substitute_response_hours' => ['group' => G::Leave, 'label' => 'Batas respons calon pengganti', 'type' => T::ByLeaveType, 'default' => ['planned' => 24, 'urgent' => 1]],
        'admin_leave_decision_minutes' => ['group' => G::Leave, 'label' => 'Batas keputusan Admin sebelum jam mulai', 'type' => T::Integer, 'unit' => 'menit', 'default' => 120],
        'escalation_deadline' => ['group' => G::Leave, 'label' => 'Batas eskalasi', 'type' => T::Escalation, 'default' => ['planned' => ['days_before' => 1, 'time' => '23:59'], 'urgent_hours_before' => 3]],
        'retroactive_leave_correction_days' => ['group' => G::Leave, 'label' => 'Batas koreksi penggantian setelah sesi', 'type' => T::Integer, 'unit' => 'hari', 'default' => 3],
        'admin_service_hours' => ['group' => G::Leave, 'label' => 'Jam layanan Admin', 'type' => T::ServiceHours, 'default' => null],
        'leave_frequency_threshold' => ['group' => G::Leave, 'label' => 'Ambang frekuensi izin per periode', 'type' => T::Integer, 'default' => null, 'max' => 100],

        'attendance_correction_deadline_days' => ['group' => G::Payroll, 'label' => 'Batas pengajuan koreksi presensi', 'type' => T::Integer, 'unit' => 'hari', 'default' => 60],
        'correction_reupload_limit' => ['group' => G::Payroll, 'label' => 'Batas unggah ulang koreksi', 'type' => T::ReuploadLimit, 'default' => ['max_times' => 3, 'within_days' => 3]],
        'clarification_reminder_days_before_cutoff' => ['group' => G::Payroll, 'label' => 'Pengingat Perlu Klarifikasi', 'type' => T::Integer, 'unit' => 'hari', 'default' => 3, 'max' => 31],
        'payroll_cutoff_time' => ['group' => G::Payroll, 'label' => 'Jam cut-off (hari terakhir bulan)', 'type' => T::Time, 'default' => '23:59'],
        'unusual_honorarium_threshold_percent' => ['group' => G::Payroll, 'label' => 'Ambang honorarium tidak lazim', 'type' => T::Integer, 'unit' => 'persen', 'default' => 30],
        'owner_approval_reminder_days' => ['group' => G::Payroll, 'label' => 'Pengingat keputusan Owner', 'type' => T::Integer, 'unit' => 'hari', 'default' => 2, 'max' => 31],
        'objection_deadline_days' => ['group' => G::Payroll, 'label' => 'Batas sanggahan setelah slip terbit', 'type' => T::Integer, 'unit' => 'hari', 'default' => 14],
        'objection_admin_response_workdays' => ['group' => G::Payroll, 'label' => 'Tanggapan Admin atas sanggahan', 'type' => T::Integer, 'unit' => 'hari kerja', 'default' => 3],

        'readiness_warning_window_days' => ['group' => G::Operational, 'label' => 'Jendela peringatan kesiapan perangkat', 'type' => T::Integer, 'unit' => 'hari', 'default' => null],
        'export_row_limit' => ['group' => G::Operational, 'label' => 'Batas ekspor langsung', 'type' => T::Integer, 'unit' => 'baris', 'default' => null],
        'procurement_reminder_workdays' => ['group' => G::Operational, 'label' => 'Pengingat keputusan pengadaan', 'type' => T::Integer, 'unit' => 'hari kerja', 'default' => 3],
        'damage_report_verification_workdays' => ['group' => G::Operational, 'label' => 'Batas verifikasi laporan kendala', 'type' => T::Integer, 'unit' => 'hari kerja', 'default' => 2],
        'evidence_file_rule' => ['group' => G::Operational, 'label' => 'Aturan berkas bukti', 'type' => T::FileRule, 'default' => ['extensions' => ['jpg', 'png', 'pdf'], 'max_size_mb' => 5, 'max_files' => 5]],

        // Masa simpan per jenis data (OW-15); dibaca RetentionCatalog.
        'retention_attendance_evidence_months' => ['group' => G::Retention, 'label' => 'Masa simpan bukti presensi', 'type' => T::Integer, 'unit' => 'bulan', 'default' => 6],
        'retention_leave_attachment_months' => ['group' => G::Retention, 'label' => 'Masa simpan lampiran izin', 'type' => T::Integer, 'unit' => 'bulan', 'default' => 6],
        'retention_handover_photo_months' => ['group' => G::Retention, 'label' => 'Masa simpan foto serah terima & kendala', 'type' => T::Integer, 'unit' => 'bulan', 'default' => 6],
        'retention_honorarium_slip_months' => ['group' => G::Retention, 'label' => 'Masa simpan slip honorarium', 'type' => T::Integer, 'unit' => 'bulan', 'default' => 6],
        'retention_audit_log_months' => ['group' => G::Retention, 'label' => 'Masa simpan riwayat perubahan', 'type' => T::Integer, 'unit' => 'bulan', 'default' => 6],
    ];

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return self::ENTRIES;
    }

    /**
     * @return array<string, mixed>
     */
    public static function get(string $key): array
    {
        return self::ENTRIES[$key] ?? throw new InvalidArgumentException("Parameter kebijakan \"{$key}\" tidak ada di katalog.");
    }

    /**
     * @return array<string, list<string>>
     */
    public static function rules(string $key): array
    {
        $entry = self::get($key);

        return $entry['type']->rules(1, $entry['max'] ?? self::MAX_BY_UNIT[$entry['unit'] ?? ''] ?? 1000);
    }

    public static function display(string $key, mixed $value): string
    {
        $entry = self::get($key);

        return $entry['type']->display($value, $entry['unit'] ?? null);
    }
}
