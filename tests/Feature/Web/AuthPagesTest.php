<?php

use App\Enums\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    $this->withoutVite();
    $this->owner = User::factory()->role(Role::Owner)->create([
        'name' => 'Hendra Wijaya',
        'email' => 'owner@edukom.test',
        'password' => 'rahasia123',
    ]);
});

it('mengarahkan tamu ke halaman masuk', function () {
    $this->get('/')->assertRedirect('/beranda');
    $this->get('/beranda')->assertRedirect('/login');

    $this->get('/login')
        ->assertOk()
        ->assertSee('Masuk')
        ->assertSee('name="email"', false)
        ->assertSee('name="password"', false);
});

it('masuk dengan kredensial benar lalu menuju beranda Owner', function () {
    $this->post('/login', ['email' => 'owner@edukom.test', 'password' => 'rahasia123'])
        ->assertRedirect('/beranda');

    $this->assertAuthenticatedAs($this->owner, 'web');

    $this->get('/beranda')->assertRedirect('/owner');
    $this->get('/owner')
        ->assertOk()
        ->assertSee('Hendra Wijaya')
        ->assertSee('Perlu dikonfigurasi');
});

it('menampilkan pesan bila email atau kata sandi salah', function () {
    $this->from('/login')
        ->post('/login', ['email' => 'owner@edukom.test', 'password' => 'salah'])
        ->assertRedirect('/login')
        ->assertSessionHasErrors(['auth' => 'Email atau kata sandi salah.'])
        ->assertSessionHasInput('email', 'owner@edukom.test');

    $this->assertGuest('web');
});

it('menampilkan sisa waktu kunci setelah 5 kali gagal', function () {
    foreach (range(1, 5) as $attempt) {
        $this->from('/login')->post('/login', ['email' => 'owner@edukom.test', 'password' => 'salah']);
    }

    $this->followingRedirects()
        ->from('/login')
        ->post('/login', ['email' => 'owner@edukom.test', 'password' => 'rahasia123'])
        ->assertSee('Akun terkunci karena terlalu banyak percobaan login gagal. Coba lagi dalam 15 menit.');

    $this->assertGuest('web');
});

it('menolak akun nonaktif', function () {
    $this->owner->forceFill(['is_active' => false])->save();

    $this->from('/login')
        ->post('/login', ['email' => 'owner@edukom.test', 'password' => 'rahasia123'])
        ->assertSessionHasErrors(['auth' => 'Akun Anda nonaktif. Hubungi Owner.']);
});

it('menampilkan galat validasi per kolom dalam bahasa Indonesia', function () {
    $this->followingRedirects()
        ->from('/login')
        ->post('/login', [])
        ->assertSee('Email wajib diisi.')
        ->assertSee('Kata sandi wajib diisi.');
});

it('mengarahkan pengguna yang sudah masuk menjauh dari halaman masuk', function () {
    $this->actingAs($this->owner)->get('/login')->assertRedirect('/beranda');
});

it('menampilkan pesan modul belum tersedia untuk peran selain Owner', function () {
    $admin = User::factory()->role(Role::Admin)->create();

    $this->actingAs($admin)
        ->get('/beranda')
        ->assertOk()
        ->assertSee('Modul untuk peran Admin belum tersedia');
});

it('mengganti kata sandi dan mengeluarkan perangkat lain', function () {
    DB::table('sessions')->insert([
        'id' => str()->random(40),
        'user_id' => $this->owner->id,
        'ip_address' => '10.0.0.2',
        'user_agent' => 'Perangkat lain',
        'payload' => base64_encode(serialize([])),
        'last_activity' => now()->getTimestamp(),
    ]);

    $this->actingAs($this->owner)
        ->put('/akun/kata-sandi', [
            'current_password' => 'rahasia123',
            'password' => 'rahasiaBaru456',
            'password_confirmation' => 'rahasiaBaru456',
        ])
        ->assertRedirect('/akun/kata-sandi')
        ->assertSessionHas('status');

    expect(Hash::check('rahasiaBaru456', $this->owner->fresh()->password))->toBeTrue()
        ->and(DB::table('sessions')->where('user_id', $this->owner->id)->where('user_agent', 'Perangkat lain')->exists())->toBeFalse();

    $this->assertAuthenticatedAs($this->owner, 'web');
});

it('menolak kata sandi baru kurang dari 8 karakter', function () {
    $this->actingAs($this->owner)
        ->from('/akun/kata-sandi')
        ->put('/akun/kata-sandi', [
            'current_password' => 'rahasia123',
            'password' => 'pendek',
            'password_confirmation' => 'pendek',
        ])
        ->assertSessionHasErrors(['password' => 'Kata sandi baru harus berisi minimal 8 karakter.']);
});

it('keluar lalu kembali ke halaman masuk', function () {
    $this->actingAs($this->owner)->post('/logout')->assertRedirect('/login');

    $this->assertGuest('web');
});
