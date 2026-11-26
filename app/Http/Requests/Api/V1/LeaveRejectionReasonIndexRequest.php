<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRejectionReasonIndexRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'in:active,inactive,all'],
            'search' => ['sometimes', 'nullable', 'string', 'max:150'],
        ];
    }
}
