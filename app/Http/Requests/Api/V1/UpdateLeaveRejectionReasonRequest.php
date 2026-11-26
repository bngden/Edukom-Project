<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveRejectionReasonRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = array_map(
            fn (array $rule) => ['sometimes', ...$rule],
            LeaveRejectionReasonRules::rules($this->route('leaveRejectionReason')?->id),
        );

        return [...$rules, 'is_active' => ['prohibited']];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return ['is_active.prohibited' => 'Status diubah lewat aksi nonaktifkan/aktifkan.'];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return LeaveRejectionReasonRules::attributes();
    }
}
