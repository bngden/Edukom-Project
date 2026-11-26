<?php

namespace App\Http\Requests\Api\V1;

use App\Domain\Policy\ParameterCatalog;
use Illuminate\Foundation\Http\FormRequest;

class StorePolicyParameterVersionRequest extends FormRequest
{
    /**
     * Aturan `value` mengikuti tipe parameter di ParameterCatalog.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            ...ParameterCatalog::rules($this->route('policyParameter')->key),
            'effective_from' => ['required', 'date_format:Y-m-d'],
            'reason' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return ['value.end.after' => 'Jam selesai harus setelah jam mulai.'];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'value' => 'nilai',
            'value.days_before' => 'jumlah hari sebelum',
            'value.time' => 'jam',
            'value.planned' => 'izin terencana',
            'value.urgent' => 'izin mendesak',
            'value.planned.days_before' => 'jumlah hari sebelum (terencana)',
            'value.planned.time' => 'jam (terencana)',
            'value.urgent_hours_before' => 'jam sebelum mulai (mendesak)',
            'value.days' => 'hari',
            'value.days.*' => 'hari',
            'value.start' => 'jam mulai',
            'value.end' => 'jam selesai',
            'value.max_times' => 'jumlah unggah ulang',
            'value.within_days' => 'rentang hari',
            'value.extensions' => 'jenis berkas',
            'value.extensions.*' => 'jenis berkas',
            'value.max_size_mb' => 'ukuran maksimal',
            'value.max_files' => 'jumlah berkas',
            'effective_from' => 'tanggal berlaku',
            'reason' => 'alasan',
        ];
    }
}
