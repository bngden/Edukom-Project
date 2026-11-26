<?php

namespace App\Http\Requests\Web\Owner;

use App\Http\Requests\Api\V1\UpdateLeaveRejectionReasonRequest;

class UpdateReasonRequest extends UpdateLeaveRejectionReasonRequest
{
    protected $errorBag = 'edit';
}
