<?php

namespace App\Http\Requests\Web\Owner;

use App\Http\Requests\Api\V1\StoreLeaveRejectionReasonRequest;

class StoreReasonRequest extends StoreLeaveRejectionReasonRequest
{
    protected $errorBag = 'create';
}
