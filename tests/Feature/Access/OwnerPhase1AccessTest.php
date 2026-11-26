<?php

use App\Domain\Reference\LeaveRejectionReasons;
use App\Enums\Role;
use App\Models\HonorComponent;
use App\Models\PolicyParameter;
use Database\Seeders\HonorComponentSeeder;
use Database\Seeders\PolicyParameterSeeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
| Matriks akses semua endpoint Fase 0–1. Kolom ketiga = siapa yang boleh:
|   public       → tamu dan semua peran
|   all          → semua peran login (tamu 401)
|   owner,admin  → daftar peran (lainnya 403, tamu 401)
| "Boleh" berarti status bukan 401/403 (bisa 200, 404, 409, atau 422 karena payload kosong).
*/
const OWNER_PHASE1_MATRIX = [
    ['GET', 'health', 'public'],
    ['POST', 'auth/login', 'public'],
    ['GET', 'auth/me', 'all'],
    ['PUT', 'auth/password', 'all'],
    ['POST', 'auth/logout', 'all'],
    ['GET', 'notifications', 'all'],
    ['GET', 'notifications/unread-count', 'all'],
    ['POST', 'notifications/read-all', 'all'],
    ['POST', 'notifications/{id}/read', 'all'],
    ['GET', 'audit-logs', 'owner,admin'],
    ['GET', 'owner/overview', 'owner'],
    ['GET', 'policy-parameters', 'owner,admin'],
    ['GET', 'policy-parameters/{policyParameter:key}', 'owner,admin'],
    ['POST', 'policy-parameters/{policyParameter:key}/versions', 'owner'],
    ['POST', 'policy-parameters/{policyParameter:key}/versions/{version}/cancel', 'owner'],
    ['GET', 'honor-components', 'owner,admin'],
    ['GET', 'honor-components/{honorComponent}', 'owner,admin'],
    ['POST', 'honor-components', 'owner'],
    ['PATCH', 'honor-components/{honorComponent}', 'owner'],
    ['POST', 'honor-components/{honorComponent}/rates', 'owner'],
    ['POST', 'honor-components/{honorComponent}/rates/{rate}/cancel', 'owner'],
    ['GET', 'honor-components/{honorComponent}/tier-sets', 'owner,admin'],
    ['POST', 'honor-components/{honorComponent}/tier-sets', 'owner'],
    ['POST', 'honor-components/{honorComponent}/tier-sets/{tierSet}/cancel', 'owner'],
    ['POST', 'honor-components/{honorComponent}/deactivate', 'owner'],
    ['POST', 'honor-components/{honorComponent}/cancel-deactivation', 'owner'],
    ['GET', 'leave-rejection-reasons', 'owner,admin'],
    ['POST', 'leave-rejection-reasons', 'owner'],
    ['PUT', 'leave-rejection-reasons/order', 'owner'],
    ['PATCH', 'leave-rejection-reasons/{leaveRejectionReason}', 'owner'],
    ['POST', 'leave-rejection-reasons/{leaveRejectionReason}/deactivate', 'owner'],
    ['POST', 'leave-rejection-reasons/{leaveRejectionReason}/activate', 'owner'],
    ['DELETE', 'leave-rejection-reasons/{leaveRejectionReason}', 'owner'],
    ['GET', 'retention', 'owner'],
    ['GET', 'retention-runs', 'owner'],
    ['POST', 'retention-runs/dry-run', 'owner'],
];

dataset('owner_phase1_matrix', fn () => collect(OWNER_PHASE1_MATRIX)
    ->mapWithKeys(fn (array $row) => ["{$row[0]} /{$row[1]} → {$row[2]}" => $row])
    ->all());

function resolveMatrixUri(string $pattern): string
{
    // Rute tarif memakai komponen bertarif flat; selain itu komponen transport (punya set tingkatan).
    $component = HonorComponent::query()->where('code', str_contains($pattern, '{rate}') ? 'attendance' : HonorComponent::TRANSPORT)->firstOrFail();
    $parameter = PolicyParameter::query()->where('key', 'late_tolerance_minutes')->firstOrFail();

    return '/api/v1/'.strtr($pattern, [
        '{policyParameter:key}' => $parameter->key,
        '{version}' => (string) $parameter->versions()->value('id'),
        '{honorComponent}' => (string) $component->id,
        '{rate}' => (string) $component->rates()->value('id'),
        '{tierSet}' => (string) $component->tierSets()->value('id'),
        '{leaveRejectionReason}' => str_contains($pattern, '{leaveRejectionReason}')
            ? (string) LeaveRejectionReasons::create(['name' => 'Alasan uji akses'])->id
            : '',
        '{id}' => (string) Str::uuid(),
    ]);
}

beforeEach(function () {
    $this->withHeaders(spaHeaders());
    (new PolicyParameterSeeder)->run();
    (new HonorComponentSeeder)->run();
});

it('menerapkan matriks akses', function (string $method, string $pattern, string $allowed) {
    $uri = resolveMatrixUri($pattern);
    $allowedRoles = match ($allowed) {
        'public', 'all' => Role::cases(),
        default => array_map(fn (string $r) => Role::from($r), explode(',', $allowed)),
    };

    $guest = $this->json($method, $uri)->status();
    $allowed === 'public'
        ? expect($guest)->not->toBeIn([401, 403], "tamu seharusnya boleh: {$method} {$uri} → {$guest}")
        : expect($guest)->toBe(401, "tamu seharusnya 401: {$method} {$uri} → {$guest}");

    // Owner terakhir: aksinya bisa mengubah/menghapus data uji.
    $roles = [...array_filter(Role::cases(), fn (Role $r) => $r !== Role::Owner), Role::Owner];

    foreach ($roles as $role) {
        actingAsRole($role);
        $status = $this->json($method, $uri)->status();

        if (in_array($role, $allowedRoles, true)) {
            expect($status)->not->toBeIn([401, 403], "{$role->value} seharusnya boleh: {$method} {$uri} → {$status}");
        } else {
            expect($status)->toBe(403, "{$role->value} seharusnya 403: {$method} {$uri} → {$status}");
        }
    }
})->with('owner_phase1_matrix');

it('setiap rute api/v1 tercantum di matriks akses', function () {
    $matrix = collect(OWNER_PHASE1_MATRIX)->map(fn (array $row) => "{$row[0]} {$row[1]}")->all();

    $routes = collect(Route::getRoutes()->getRoutes())
        ->filter(fn ($route) => str_starts_with($route->uri(), 'api/v1/'))
        ->flatMap(fn ($route) => collect($route->methods())
            ->reject(fn (string $m) => $m === 'HEAD')
            ->map(fn (string $m) => $m.' '.Str::after($route->uri(), 'api/v1/')))
        ->sort()
        ->values();

    expect($routes->diff($matrix)->values()->all())->toBe([], 'Rute baru belum dimasukkan ke OWNER_PHASE1_MATRIX');
});
