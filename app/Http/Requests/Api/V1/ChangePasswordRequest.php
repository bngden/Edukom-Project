<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', 'confirmed', 'max:255', Password::min(8)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'current_password' => 'kata sandi saat ini',
            'password' => 'kata sandi baru',
        ];
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function bodyParameters(): array
    {
        return [
            'current_password' => ['description' => 'Kata sandi yang sedang dipakai.', 'example' => 'rahasia123'],
            'password' => ['description' => 'Kata sandi baru, minimal 8 karakter.', 'example' => 'rahasiaBaru456'],
            'password_confirmation' => ['description' => 'Ulangi kata sandi baru.', 'example' => 'rahasiaBaru456'],
        ];
    }
}
