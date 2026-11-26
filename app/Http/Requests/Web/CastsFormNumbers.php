<?php

namespace App\Http\Requests\Web;

/**
 * Form HTML mengirim angka sebagai teks, sedangkan aturan API memakai integer:strict.
 * Ubah teks berisi digit saja menjadi int pada field yang disebut (termasuk isi array bersarang).
 */
trait CastsFormNumbers
{
    /**
     * @param  list<string>  $fields
     */
    protected function castNumbers(array $fields): void
    {
        $cast = function (mixed $value) use (&$cast): mixed {
            return match (true) {
                is_array($value) => array_map($cast, $value),
                is_string($value) && preg_match('/^\d{1,15}$/', $value) === 1 => (int) $value,
                default => $value,
            };
        };

        $this->merge(collect($fields)
            ->filter(fn (string $field) => $this->has($field))
            ->mapWithKeys(fn (string $field) => [$field => $cast($this->input($field))])
            ->all());
    }
}
