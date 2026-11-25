<?php

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
| Feature test memakai DB dari .env (db_edukom). RefreshDatabase menjalankan
| migrate:fresh sekali per proses lalu membungkus setiap test dalam transaksi.
*/
pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->in('Feature');

pest()->extend(TestCase::class)->in('Unit');

/**
 * Header permintaan SPA: Referer dari domain stateful agar Sanctum memakai sesi.
 *
 * @return array<string, string>
 */
function spaHeaders(): array
{
    return [
        'Accept' => 'application/json',
        'Referer' => 'http://localhost',
    ];
}

/**
 * Membuat user aktif dengan peran tertentu lalu login (guard web, dipakai Sanctum SPA).
 */
function actingAsRole(Role $role): User
{
    $user = User::factory()->role($role)->create();

    test()->actingAs($user, 'web');

    return $user;
}

/**
 * Semua peran selain yang diizinkan, sebagai dataset Pest: ->with(rolesExcept(Role::Owner, Role::Admin)).
 *
 * @return array<string, array{Role}>
 */
function rolesExcept(Role ...$allowed): array
{
    $roles = array_filter(Role::cases(), static fn (Role $role): bool => ! in_array($role, $allowed, true));

    return array_combine(
        array_map(static fn (Role $role): string => $role->value, $roles),
        array_map(static fn (Role $role): array => [$role], $roles),
    );
}
