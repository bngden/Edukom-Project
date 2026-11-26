<?php

namespace App\Domain\Policy;

use App\Models\PolicyParameterVersion;
use Carbon\CarbonInterface;

/**
 * Membaca nilai parameter yang berlaku pada tanggal tertentu. Pakai lewat app(PolicyParameters::class);
 * di-cache per request (binding scoped), jadi selalu sesuai isi DB.
 */
class PolicyParameters
{
    /** @var array<string, mixed> */
    private array $cache = [];

    public function get(string $key, ?CarbonInterface $date = null): mixed
    {
        return $this->getOrNull($key, $date) ?? throw new ParameterNotConfigured($key, ParameterCatalog::get($key)['label']);
    }

    public function getOrNull(string $key, ?CarbonInterface $date = null): mixed
    {
        ParameterCatalog::get($key);
        $date ??= today();

        $cacheKey = $key.'@'.$date->toDateString();

        // array_key_exists: nilai null (Belum Dikonfigurasi) juga di-cache.
        if (! array_key_exists($cacheKey, $this->cache)) {
            $this->cache[$cacheKey] = PolicyParameterVersion::query()
                ->whereRelation('parameter', 'key', $key)
                ->activeOn($date)
                ->first(['value'])
                ?->value;
        }

        return $this->cache[$cacheKey];
    }

    public function isConfigured(string $key, ?CarbonInterface $date = null): bool
    {
        return $this->getOrNull($key, $date) !== null;
    }
}
