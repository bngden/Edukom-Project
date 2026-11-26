<?php

namespace App\Http\Requests\Web\Owner;

use App\Http\Requests\Api\V1\StorePolicyParameterVersionRequest;
use App\Http\Requests\Web\CastsFormNumbers;

class StoreParameterVersionRequest extends StorePolicyParameterVersionRequest
{
    use CastsFormNumbers;

    protected function prepareForValidation(): void
    {
        $this->castNumbers(['value']);
    }
}
