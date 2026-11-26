<?php

namespace App\Http\Requests\Api\V1;

use App\Support\Format;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreTransportTierSetRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'tiers' => ['required', 'array', 'list', 'min:1', 'max:20'],
            'tiers.*' => ['required', 'array:max_km,amount'],
            'tiers.*.max_km' => ['present', 'nullable', 'numeric', 'gt:0', 'max:99999.9', 'regex:/^\d+(\.\d)?$/'],
            'tiers.*.amount' => ['required', 'integer:strict', 'min:0', 'max:100000000'],
            'effective_from' => ['required', 'date_format:Y-m-d'],
            'reason' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'tiers' => 'tingkatan jarak',
            'tiers.*.max_km' => 'batas jarak tingkatan ke-:position',
            'tiers.*.amount' => 'nominal tingkatan ke-:position',
            'effective_from' => 'tanggal berlaku',
            'reason' => 'alasan',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return ['tiers.*.max_km.regex' => ':Attribute maksimal 1 angka di belakang koma.'];
    }

    /**
     * Batas jarak naik ketat; hanya tingkatan terakhir tanpa batas atas.
     *
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [function (Validator $validator) {
            $tiers = $this->input('tiers');

            if ($validator->errors()->isNotEmpty() || ! is_array($tiers)) {
                return;
            }

            $last = count($tiers) - 1;
            $previous = null;

            foreach ($tiers as $i => $tier) {
                $max = $tier['max_km'];
                $n = $i + 1;

                $error = match (true) {
                    $i === $last && $max !== null => 'Tingkatan terakhir harus tanpa batas atas (di atas '.Format::km($max).' km).',
                    $i !== $last && $max === null => "Hanya tingkatan terakhir yang boleh tanpa batas atas; isi batas jarak tingkatan ke-{$n}.",
                    $max !== null && $previous !== null && bccomp((string) $max, (string) $previous, 1) <= 0 => "Batas jarak tingkatan ke-{$n} harus lebih besar dari ".Format::km($previous).' km.',
                    default => null,
                };

                if ($error !== null) {
                    $validator->errors()->add("tiers.{$i}.max_km", $error);

                    return;
                }

                $previous = $max;
            }
        }];
    }
}
