<?php

namespace Database\Seeders;

use App\Domain\Policy\ParameterCatalog;
use App\Domain\Versioning\VersionTimeline;
use App\Models\PolicyParameter;
use App\Models\PolicyParameterVersion;
use Illuminate\Database\Seeder;

/**
 * Menyinkronkan katalog parameter (idempoten) dan membuat versi awal untuk parameter yang punya nilai bawaan.
 * Berjalan di semua environment.
 */
class PolicyParameterSeeder extends Seeder
{
    /**
     * @param  list<string>|null  $only  khusus test: hanya key tertentu
     */
    public function run(?array $only = null): void
    {
        $order = 0;

        foreach (ParameterCatalog::all() as $key => $entry) {
            $order++;

            if ($only !== null && ! in_array($key, $only, true)) {
                continue;
            }

            $parameter = PolicyParameter::query()->updateOrCreate(['key' => $key], [
                'group' => $entry['group'],
                'label' => $entry['label'],
                'description' => $entry['description'] ?? null,
                'value_type' => $entry['type'],
                'unit' => $entry['unit'] ?? null,
                'sort_order' => $order,
            ]);

            if ($entry['default'] === null || $parameter->versions()->exists()) {
                continue;
            }

            $version = new PolicyParameterVersion([
                'policy_parameter_id' => $parameter->id,
                'value' => $entry['default'],
                'effective_from' => config('edukom.policy_base_date'),
            ]);

            VersionTimeline::add($version->setRelation('parameter', $parameter), 'Nilai awal');
        }
    }
}
