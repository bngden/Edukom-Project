<?php

namespace App\Http\Requests\Web\Owner;

use App\Http\Requests\Api\V1\StoreHonorRateRequest;
use App\Http\Requests\Web\CastsFormNumbers;

class StoreRateRequest extends StoreHonorRateRequest
{
    use CastsFormNumbers;

    protected $errorBag = 'rate';

    protected function prepareForValidation(): void
    {
        $this->castNumbers(['amount']);
    }
}
