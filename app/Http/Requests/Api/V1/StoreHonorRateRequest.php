<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreHonorRateRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return HonorRateRules::rules();
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return HonorRateRules::attributes();
    }
}
