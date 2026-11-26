<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveRejectionReasonRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = LeaveRejectionReasonRules::rules();
        $rules['sort_order'] = ['sometimes', ...$rules['sort_order']];

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return LeaveRejectionReasonRules::attributes();
    }
}
