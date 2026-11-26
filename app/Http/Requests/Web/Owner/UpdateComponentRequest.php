<?php

namespace App\Http\Requests\Web\Owner;

use App\Http\Requests\Api\V1\UpdateHonorComponentRequest;

class UpdateComponentRequest extends UpdateHonorComponentRequest
{
    protected $errorBag = 'info';
}
