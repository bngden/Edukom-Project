<?php

use App\Enums\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->withHeaders(spaHeaders());
    $this->user = User::factory()->role(Role::Admin)->create(['password' => 'rahasia123']);
});

function fakeSession(int $userId): string
{
    $id = str()->random(40);

    DB::table('sessions')->insert([
        'id' => $id,
        'user_id' => $userId,
        'ip_address' => '10.0.0.1',
        'user_agent' => 'Perangkat lain',
        'payload' => base64_encode(serialize([])),
        'last_activity' => now()->getTimestamp(),
    ]);

    return $id;
}

it('GET /auth/me tanpa login mengembalikan 401 berformat standar', function () {
    $this->getJson('/api/v1/auth/me')
        ->assertUnauthorized()
        ->assertExactJson([
            'message' => 'Anda belum login atau sesi telah berakhir.',
            'code' => 'UNAUTHENTICATED',
            'errors' => [],
        ]);
});

it('GET /auth/me mengembalikan user yang sedang login', function () {
    $this->actingAs($this->user, 'web')
        ->getJson('/api/v1/auth/me')
        ->assertOk()
        ->assertJsonPath('data.id', $this->user->id)
        ->assertJsonPath('data.role', 'admin')
        ->assertJsonPath('data.role_label', 'Admin');
});

it('logout mengakhiri sesi', function () {
    $this->actingAs($this->user, 'web')
        ->postJson('/api/v1/auth/logout')
        ->assertNoContent();

    $this->assertGuest('web');
});

it('logout tanpa login mengembalikan 401', function () {
    $this->postJson('/api/v1/auth/logout')->assertUnauthorized();
});

it('ganti password berhasil dan memutus sesi lain milik user', function () {
    $otherDeviceA = fakeSession($this->user->id);
    $otherDeviceB = fakeSession($this->user->id);
    $someoneElse = fakeSession(User::factory()->create()->id);

    $this->actingAs($this->user, 'web')
        ->putJson('/api/v1/auth/password', [
            'current_password' => 'rahasia123',
            'password' => 'rahasiaBaru456',
            'password_confirmation' => 'rahasiaBaru456',
        ])
        ->assertNoContent();

    expect(Hash::check('rahasiaBaru456', $this->user->fresh()->password))->toBeTrue()
        ->and(DB::table('sessions')->whereIn('id', [$otherDeviceA, $otherDeviceB])->exists())->toBeFalse()
        ->and(DB::table('sessions')->where('id', $someoneElse)->exists())->toBeTrue();

    // Sesi yang dipakai untuk mengganti password tetap login.
    $this->assertAuthenticatedAs($this->user, 'web');
});

it('menolak password baru kurang dari 8 karakter dengan pesan Indonesia', function () {
    $this->actingAs($this->user, 'web')
        ->putJson('/api/v1/auth/password', [
            'current_password' => 'rahasia123',
            'password' => 'pendek',
            'password_confirmation' => 'pendek',
        ])
        ->assertUnprocessable()
        ->assertJsonPath('code', 'VALIDATION_ERROR')
        ->assertJsonPath('errors.password.0', 'Kata sandi baru harus berisi minimal 8 karakter.');

    expect(Hash::check('rahasia123', $this->user->fresh()->password))->toBeTrue();
});

it('menolak bila password saat ini salah', function () {
    $this->actingAs($this->user, 'web')
        ->putJson('/api/v1/auth/password', [
            'current_password' => 'bukan-ini',
            'password' => 'rahasiaBaru456',
            'password_confirmation' => 'rahasiaBaru456',
        ])
        ->assertUnprocessable()
        ->assertJsonPath('errors.current_password.0', 'Kata sandi saat ini salah.');
});
