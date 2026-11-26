<?php

namespace App\Http\Requests\Web\Owner;

use App\Http\Requests\Api\V1\DeactivateHonorComponentRequest;

class DeactivateComponentRequest extends DeactivateHonorComponentRequest
{
    protected $errorBag = 'deactivate';
}
