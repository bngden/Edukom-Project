<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHonorComponentRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:100', Rule::unique('honor_components', 'name')->ignore($this->route('honorComponent'))],
            'description' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'sort_order' => ['sometimes', 'required', 'integer:strict', 'between:1,1000'],
            'basis' => ['prohibited'],
            'rate_type' => ['prohibited'],
            'code' => ['prohibited'],
            'is_system' => ['prohibited'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'basis.prohibited' => 'Dasar perhitungan tidak dapat diubah.',
            'rate_type.prohibited' => 'Jenis tarif tidak dapat diubah.',
            'code.prohibited' => 'Kode komponen tidak dapat diubah.',
            'is_system.prohibited' => 'Status komponen bawaan tidak dapat diubah.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return ['name' => 'nama komponen', 'description' => 'deskripsi', 'sort_order' => 'urutan'];
    }
}
