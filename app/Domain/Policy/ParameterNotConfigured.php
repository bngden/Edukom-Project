<?php

namespace App\Domain\Policy;

use RuntimeException;

class ParameterNotConfigured extends RuntimeException
{
    public function __construct(public readonly string $key, public readonly string $label)
    {
        parent::__construct("Parameter \"{$label}\" belum dikonfigurasi.");
    }
}
