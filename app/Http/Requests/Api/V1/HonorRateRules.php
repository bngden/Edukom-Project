<?php

namespace App\Http\Requests\Api\V1;

/**
 * Aturan bersama nominal tarif + tanggal berlaku (dipakai StoreHonorComponentRequest dan StoreHonorRateRequest).
 */
class HonorRateRules
{
    /**
     * @return array<string, list<string>>
     */
    public static function rules(): array
    {
        return [
            'amount' => ['required', 'integer:strict', 'min:0', 'max:100000000'],
            'effective_from' => ['required', 'date_format:Y-m-d'],
            'reason' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function attributes(): array
    {
        return ['amount' => 'nominal', 'effective_from' => 'tanggal berlaku', 'reason' => 'alasan'];
    }
}
