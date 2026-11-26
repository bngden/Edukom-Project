<?php

namespace App\Domain\Retention;

use App\Domain\Policy\PolicyParameters;
use App\Models\PolicyParameter;
use App\Models\PolicyParameterVersion;
use Carbon\CarbonInterface;

/**
 * Jenis data yang punya masa simpan (OW-15). Nilainya parameter kebijakan berversi (grup Masa Simpan).
 */
class RetentionCatalog
{
    public const AUDIT_LOG = 'audit_log';

    private const TYPES = [
        'attendance_evidence' => ['label' => 'Bukti presensi', 'parameter' => 'retention_attendance_evidence_months'],
        'leave_attachment' => ['label' => 'Lampiran izin', 'parameter' => 'retention_leave_attachment_months'],
        'handover_photo' => ['label' => 'Foto serah terima & kendala', 'parameter' => 'retention_handover_photo_months'],
        'honorarium_slip' => ['label' => 'Slip honorarium', 'parameter' => 'retention_honorarium_slip_months'],
        self::AUDIT_LOG => ['label' => 'Riwayat perubahan', 'parameter' => 'retention_audit_log_months'],
    ];

    /**
     * @return array<string, array{label: string, parameter: string}>
     */
    public static function all(): array
    {
        return self::TYPES;
    }

    /**
     * Per jenis: parameter, versi berlaku, dan versi terjadwal pada $date (dipakai API dan halaman Masa Simpan).
     *
     * @return list<array{type: string, label: string, parameter: PolicyParameter|null, current: PolicyParameterVersion|null, scheduled: PolicyParameterVersion|null}>
     */
    public static function summary(CarbonInterface $date): array
    {
        $parameters = PolicyParameter::query()
            ->whereIn('key', array_column(self::TYPES, 'parameter'))
            ->with(['versions' => fn ($q) => $q->openOn($date)])
            ->get()
            ->keyBy('key');

        return collect(self::TYPES)->map(function (array $entry, string $type) use ($parameters, $date) {
            $parameter = $parameters->get($entry['parameter']);
            [$current, $scheduled] = PolicyParameterVersion::currentAndScheduled($parameter?->versions ?? [], $date);

            return ['type' => $type, 'label' => $entry['label'], 'parameter' => $parameter, 'current' => $current, 'scheduled' => $scheduled];
        })->values()->all();
    }

    public static function monthsOn(string $type, CarbonInterface $date): ?int
    {
        return app(PolicyParameters::class)->getOrNull(self::TYPES[$type]['parameter'], $date);
    }
}
