<?php

namespace App\Http\Requests\Web\Owner;

use App\Http\Requests\Api\V1\CancelVersionRequest;

class CancelVersionFormRequest extends CancelVersionRequest
{
    protected $errorBag = 'cancel';
}
