<?php

use App\Enums\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('membuat akun dengan kata sandi interaktif', function () {
    $this->artisan('edukom:create-user', ['role' => 'owner', 'email' => 'Bos@Edukom.test', 'name' => 'Bos Edukom'])
        ->expectsQuestion('Kata sandi (minimal 8 karakter)', 'rahasia123')
        ->expectsQuestion('Ulangi kata sandi', 'rahasia123')
        ->assertSuccessful();

    $user = User::query()->where('email', 'bos@edukom.test')->first();

    expect($user)->not->toBeNull()
        ->and($user->role)->toBe(Role::Owner)
        ->and($user->is_active)->toBeTrue()
        ->and(Hash::check('rahasia123', $user->password))->toBeTrue();
});

it('menolak peran yang tidak dikenal', function () {
    $this->artisan('edukom:create-user', ['role' => 'keuangan', 'email' => 'x@edukom.test', 'name' => 'X'])
        ->assertFailed();

    expect(User::query()->where('email', 'x@edukom.test')->exists())->toBeFalse();
});

it('menolak kata sandi kurang dari 8 karakter', function () {
    $this->artisan('edukom:create-user', ['role' => 'admin', 'email' => 'a@edukom.test', 'name' => 'A'])
        ->expectsQuestion('Kata sandi (minimal 8 karakter)', 'pendek')
        ->expectsQuestion('Ulangi kata sandi', 'pendek')
        ->expectsOutputToContain('minimal 8 karakter')
        ->assertFailed();
});
