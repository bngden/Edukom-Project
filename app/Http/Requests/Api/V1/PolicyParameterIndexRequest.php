<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\ParameterGroup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PolicyParameterIndexRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'group' => ['nullable', Rule::enum(ParameterGroup::class)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return ['group' => 'grup'];
    }
}
