<?php

namespace App\Http\Requests\Web\Owner;

use App\Http\Requests\Api\V1\StoreHonorComponentRequest;
use App\Http\Requests\Web\CastsFormNumbers;

class StoreComponentRequest extends StoreHonorComponentRequest
{
    use CastsFormNumbers;

    protected $errorBag = 'create';

    protected function prepareForValidation(): void
    {
        $this->castNumbers(['amount']);
    }
}
