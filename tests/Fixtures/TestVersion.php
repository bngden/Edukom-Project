<?php

namespace Tests\Fixtures;

use App\Domain\Versioning\HasEffectiveDating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TestVersion extends Model
{
    use HasEffectiveDating;

    protected $guarded = ['id'];

    public function versionSeries(): Builder
    {
        return static::query()->where('series', $this->series);
    }
}
