<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Validation\Rule;

/**
 * Aturan bersama tambah/ubah alasan penolakan.
 */
class LeaveRejectionReasonRules
{
    /**
     * @return array<string, list<mixed>>
     */
    public static function rules(?int $ignoreId = null): array
    {
        return [
            // Collation *_ci: unique tidak membedakan huruf besar/kecil.
            'name' => ['required', 'string', 'min:3', 'max:150', Rule::unique('leave_rejection_reasons', 'name')->ignore($ignoreId)],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['integer:strict', 'between:1,1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function attributes(): array
    {
        return ['name' => 'nama alasan', 'description' => 'deskripsi', 'sort_order' => 'urutan'];
    }
}
