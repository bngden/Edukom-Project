<?php

use App\Enums\Role;
use App\Models\AccessDenial;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    $this->withHeaders(spaHeaders());

    Route::middleware(['api', 'auth:sanctum'])->prefix('api/v1/_test')->name('test.')->group(function () {
        Route::get('/owner-only', fn () => ['data' => 'ok'])->middleware('role:owner')->name('owner_only');
        Route::get('/owner-admin', fn () => ['data' => 'ok'])->middleware('role:owner,admin')->name('owner_admin');
        Route::post('/gate', function () {
            Gate::authorize('test-owner-ability');

            return ['data' => 'ok'];
        })->name('gate');
        Route::get('/typo', fn () => ['data' => 'ok'])->middleware('role:pemilik')->name('typo');
    });

    Gate::define('test-owner-ability', fn (User $user) => $user->role === Role::Owner);
});

function expectDenialRecorded(User $user, string $method, string $path, string $routeName): void
{
    expect(AccessDenial::query()->count())->toBe(1);

    $denial = AccessDenial::query()->firstOrFail();

    expect($denial->user_id)->toBe($user->id)
        ->and($denial->role)->toBe($user->role->value)
        ->and($denial->method)->toBe($method)
        ->and($denial->path)->toBe($path)
        ->and($denial->route_name)->toBe($routeName)
        ->and($denial->ip)->toBe('127.0.0.1')
        ->and($denial->occurred_at)->not->toBeNull();
}

it('mengizinkan owner pada route khusus owner', function () {
    actingAsRole(Role::Owner);

    $this->getJson('/api/v1/_test/owner-only')->assertOk()->assertExactJson(['data' => 'ok']);

    expect(AccessDenial::query()->count())->toBe(0);
});

it('menolak role selain owner pada route khusus owner dan mencatatnya', function (Role $role) {
    $user = actingAsRole($role);

    $this->getJson('/api/v1/_test/owner-only')
        ->assertForbidden()
        ->assertExactJson([
            'message' => 'Anda tidak memiliki akses untuk tindakan ini.',
            'code' => 'FORBIDDEN',
            'errors' => [],
        ]);

    expectDenialRecorded($user, 'GET', '/api/v1/_test/owner-only', 'test.owner_only');
})->with('all_roles_except_owner');

it('mengizinkan owner dan admin pada route owner+admin', function (Role $role) {
    actingAsRole($role);

    $this->getJson('/api/v1/_test/owner-admin')->assertOk();
})->with([Role::Owner->value => [Role::Owner], Role::Admin->value => [Role::Admin]]);

it('menolak role selain owner dan admin pada route owner+admin dan mencatatnya', function (Role $role) {
    $user = actingAsRole($role);

    $this->getJson('/api/v1/_test/owner-admin')->assertForbidden()->assertJsonPath('code', 'FORBIDDEN');

    expectDenialRecorded($user, 'GET', '/api/v1/_test/owner-admin', 'test.owner_admin');
})->with('all_roles_except_owner_admin');

it('mengembalikan 401 tanpa mencatat access denial bila belum login', function (string $path) {
    $this->getJson($path)->assertUnauthorized()->assertJsonPath('code', 'UNAUTHENTICATED');

    expect(AccessDenial::query()->count())->toBe(0);
})->with(['/api/v1/_test/owner-only', '/api/v1/_test/owner-admin']);

it('mencatat penolakan dari Gate/Policy', function (Role $role) {
    $user = actingAsRole($role);

    $this->postJson('/api/v1/_test/gate')->assertForbidden()->assertJsonPath('code', 'FORBIDDEN');

    expectDenialRecorded($user, 'POST', '/api/v1/_test/gate', 'test.gate');
})->with('all_roles_except_owner');

it('mengizinkan owner melewati Gate yang memang mengaturnya', function () {
    actingAsRole(Role::Owner);

    $this->postJson('/api/v1/_test/gate')->assertOk();
});

it('tidak memberi owner akses otomatis ke kemampuan yang tidak diatur', function () {
    $owner = User::factory()->role(Role::Owner)->create();

    expect(Gate::forUser($owner)->allows('kemampuan-yang-tidak-didefinisikan'))->toBeFalse()
        ->and(Gate::forUser($owner)->allows('record-payment'))->toBeFalse();
});

it('tidak mencatat galat bisnis 403 seperti akun nonaktif saat login', function () {
    User::factory()->role(Role::Admin)->inactive()->create([
        'email' => 'nonaktif@edukom.test',
        'password' => 'rahasia123',
    ]);

    $this->postJson('/api/v1/auth/login', ['email' => 'nonaktif@edukom.test', 'password' => 'rahasia123'])
        ->assertForbidden()
        ->assertJsonPath('code', 'ACCOUNT_INACTIVE');

    expect(AccessDenial::query()->count())->toBe(0);
});

it('menghasilkan galat server bila nama peran di middleware salah ketik', function () {
    actingAsRole(Role::Owner);

    $this->withoutExceptionHandling();

    $this->getJson('/api/v1/_test/typo');
})->throws(InvalidArgumentException::class, 'Peran "pemilik" tidak dikenal pada middleware role.');
