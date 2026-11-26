<?php

namespace App\Models;

use App\Enums\ParameterGroup;
use App\Enums\ParameterType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Metadata parameter (dari ParameterCatalog). Nilainya ada di PolicyParameterVersion.
 */
class PolicyParameter extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'group' => ParameterGroup::class,
            'value_type' => ParameterType::class,
        ];
    }

    public function versions(): HasMany
    {
        return $this->hasMany(PolicyParameterVersion::class)->chaperone('parameter');
    }
}
