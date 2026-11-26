<?php

namespace App\Http\Requests\Web\Owner;

use App\Http\Requests\Api\V1\StoreTransportTierSetRequest;
use App\Http\Requests\Web\CastsFormNumbers;

class StoreTierSetRequest extends StoreTransportTierSetRequest
{
    protected $errorBag = 'tiers';

    use CastsFormNumbers;

    /**
     * Batas jarak boleh diketik dengan koma (10,5); nominal dari form berupa teks angka.
     */
    protected function prepareForValidation(): void
    {
        $this->castNumbers(['tiers']);

        if (is_array($tiers = $this->input('tiers'))) {
            $this->merge(['tiers' => array_map(
                fn ($tier) => is_array($tier) && is_string($tier['max_km'] ?? null) ? ['max_km' => str_replace(',', '.', $tier['max_km'])] + $tier : $tier,
                $tiers,
            )]);
        }
    }
}
