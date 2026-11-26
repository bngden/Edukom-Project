<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\HonorBasis;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreHonorComponentRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100', 'unique:honor_components,name'],
            'description' => ['nullable', 'string', 'max:1000'],
            'basis' => ['required', Rule::enum(HonorBasis::class)],
            ...HonorRateRules::rules(),
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return ['name' => 'nama komponen', 'description' => 'deskripsi', 'basis' => 'dasar perhitungan', ...HonorRateRules::attributes()];
    }
}
