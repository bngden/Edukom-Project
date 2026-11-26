<?php

namespace App\Domain\Owner;

use App\Domain\Retention\RetentionCatalog;
use App\Models\HonorComponent;
use App\Models\HonorComponentRate;
use App\Models\LeaveRejectionReason;
use App\Models\PolicyParameter;
use App\Models\PolicyParameterVersion;
use App\Models\RetentionRun;
use App\Models\TransportTierSet;
use App\Models\User;
use Carbon\CarbonInterface;

/**
 * Data Beranda Owner tahap 1: hanya blok yang datanya sudah ada. Blok modul yang belum aktif tidak dikirim.
 */
class OwnerOverview
{
    /**
     * @return array<string, mixed>
     */
    public static function for(User $owner, CarbonInterface $today): array
    {
        $retentionKeys = array_column(RetentionCatalog::all(), 'parameter');
        $date = $today->toDateString();

        $parameters = PolicyParameterVersion::query()->scheduledAfter($today)
            ->join('policy_parameters', 'policy_parameters.id', '=', 'policy_parameter_versions.policy_parameter_id')
            ->toBase()
            ->selectRaw('count(*) as total')
            ->selectRaw('coalesce(sum(policy_parameters.`key` in ('.implode(',', array_fill(0, count($retentionKeys), '?')).')), 0) as retention', $retentionKeys)
            ->first();
        $components = HonorComponent::query()->toBase()
            ->selectRaw('count(*) as total, coalesce(sum(deactivated_from is null or deactivated_from > ?), 0) as active', [$date])
            ->first();
        $reasons = LeaveRejectionReason::query()->toBase()
            ->selectRaw('count(*) as total, coalesce(sum(is_active), 0) as active')
            ->first();

        return [
            'needs_configuration' => PolicyParameter::query()
                ->whereDoesntHave('versions', fn ($q) => $q->activeOn($today))
                ->orderBy('sort_order')
                ->get(['key', 'label', 'group'])
                ->map(fn (PolicyParameter $p) => ['key' => $p->key, 'label' => $p->label, 'group' => $p->group->value, 'group_label' => $p->group->label()]),
            'scheduled_changes' => [
                'policy_parameters' => (int) $parameters->total - (int) $parameters->retention,
                'honor_rates' => HonorComponentRate::query()->scheduledAfter($today)->count(),
                'transport_tiers' => TransportTierSet::query()->scheduledAfter($today)->count(),
                'retention' => (int) $parameters->retention,
            ],
            'honor_components' => ['active' => (int) $components->active, 'inactive' => $components->total - $components->active],
            'leave_rejection_reasons' => ['active' => (int) $reasons->active, 'inactive' => $reasons->total - $reasons->active],
            'unread_notifications' => $owner->unreadNotifications()->count(),
            'last_retention_run' => RetentionRun::lastReal(),
        ];
    }
}
