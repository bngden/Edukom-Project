<?php

use App\Enums\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    $this->withHeaders(spaHeaders());
    $this->user = User::factory()->role(Role::Owner)->create([
        'email' => 'owner@edukom.test',
        'password' => 'rahasia123',
    ]);
});

function login(string $password = 'rahasia123', string $email = 'owner@edukom.test')
{
    return test()->postJson('/api/v1/auth/login', ['email' => $email, 'password' => $password]);
}

it('login sukses mengembalikan data user dan membuat sesi', function () {
    $this->user->forceFill(['failed_login_attempts' => 3])->save();

    login()
        ->assertOk()
        ->assertExactJson(['data' => [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => 'owner@edukom.test',
            'role' => 'owner',
            'role_label' => 'Owner',
        ]]);

    $this->assertAuthenticatedAs($this->user, 'web');

    $fresh = $this->user->fresh();
    expect($fresh->failed_login_attempts)->toBe(0)
        ->and($fresh->last_login_at)->not->toBeNull();
});

it('menolak password salah dengan 422, menambah hitungan gagal, dan mencatat log security', function () {
    Log::shouldReceive('channel')->with('security')->once()->andReturnSelf();
    Log::shouldReceive('warning')->once()->withArgs(fn (string $message, array $context) => $message === 'login_failed'
        && $context['email'] === 'owner@edukom.test'
        && $context['ip'] === '127.0.0.1'
        && isset($context['time']));

    login('salah-sekali')
        ->assertUnprocessable()
        ->assertJsonPath('code', 'VALIDATION_ERROR')
        ->assertJsonPath('errors.email.0', 'Email atau kata sandi salah.');

    $this->assertGuest('web');
    expect($this->user->fresh()->failed_login_attempts)->toBe(1);
});

it('memberi pesan yang sama untuk email yang tidak terdaftar', function () {
    login('apa-saja', 'tidak.ada@edukom.test')
        ->assertUnprocessable()
        ->assertJsonPath('errors.email.0', 'Email atau kata sandi salah.');
});

it('mengunci akun 15 menit setelah 5 kali gagal berturut-turut', function () {
    foreach (range(1, 4) as $attempt) {
        login('salah')->assertUnprocessable();
    }

    login('salah')
        ->assertStatus(423)
        ->assertJsonPath('code', 'ACCOUNT_LOCKED')
        ->assertJsonPath('message', 'Akun terkunci karena terlalu banyak percobaan login gagal. Coba lagi dalam 15 menit.');

    // Password benar pun ditolak selama masa kunci.
    login()->assertStatus(423)->assertJsonPath('code', 'ACCOUNT_LOCKED');
    $this->assertGuest('web');
});

it('membuka kunci lagi setelah 15 menit', function () {
    foreach (range(1, 5) as $attempt) {
        login('salah');
    }

    $this->travel(14)->minutes();
    login()->assertStatus(423)->assertJsonPath('message', 'Akun terkunci karena terlalu banyak percobaan login gagal. Coba lagi dalam 1 menit.');

    $this->travel(1)->minutes();
    $this->travel(1)->seconds();
    login()->assertOk();

    $fresh = $this->user->fresh();
    expect($fresh->failed_login_attempts)->toBe(0)
        ->and($fresh->locked_until)->toBeNull();
});

it('menolak akun nonaktif dengan 403 ACCOUNT_INACTIVE', function () {
    $this->user->forceFill(['is_active' => false])->save();

    login()
        ->assertForbidden()
        ->assertJsonPath('code', 'ACCOUNT_INACTIVE');

    $this->assertGuest('web');
});

it('memvalidasi input login dengan pesan bahasa Indonesia', function () {
    $this->postJson('/api/v1/auth/login', [])
        ->assertUnprocessable()
        ->assertJsonPath('code', 'VALIDATION_ERROR')
        ->assertJsonPath('errors.email.0', 'Email wajib diisi.')
        ->assertJsonPath('errors.password.0', 'Kata sandi wajib diisi.');
});

it('membatasi login 10 kali per menit per IP', function () {
    foreach (range(1, 10) as $attempt) {
        login('salah', "orang{$attempt}@edukom.test");
    }

    login()
        ->assertStatus(429)
        ->assertJsonPath('code', 'TOO_MANY_REQUESTS');
});
