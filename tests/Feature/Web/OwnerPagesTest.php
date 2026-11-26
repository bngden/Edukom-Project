<?php

use App\Domain\Audit\Audit;
use App\Domain\Notification\Notifier;
use App\Enums\Role;
use App\Models\HonorComponent;
use App\Notifications\EdukomNotification;
use Database\Seeders\HonorComponentSeeder;
use Database\Seeders\PolicyParameterSeeder;

beforeEach(function () {
    (new PolicyParameterSeeder)->run();
    (new HonorComponentSeeder)->run();
});

dataset('owner_pages', ['/owner', '/owner/pengaturan/riwayat']);

it('owner membuka halaman Owner dengan sidebar sesuai urutan referensi', function (string $url) {
    actingAsRole(Role::Owner);

    $this->get($url)
        ->assertOk()
        ->assertSeeInOrder(['Utama', 'Beranda', 'Persetujuan', 'Honorarium', 'Pemantauan', 'Pembelajaran', 'Kebijakan', 'Komponen Honor', 'Pengaturan', 'Riwayat Perubahan'])
        ->assertSee('aria-current="page"', false);
})->with('owner_pages');

it('peran lain tidak dapat membuka halaman Owner', function (Role $role, string $url) {
    actingAsRole($role);

    $this->get($url)->assertForbidden();
})->with('all_roles_except_owner')->with('owner_pages');

it('tamu diarahkan ke halaman masuk', function (string $url) {
    $this->get($url)->assertRedirect('/login');
})->with('owner_pages');

it('owner yang membuka /beranda diarahkan ke Beranda Owner, peran lain tetap', function () {
    actingAsRole(Role::Owner);
    $this->get('/beranda')->assertRedirect('/owner');

    actingAsRole(Role::Admin);
    $this->get('/beranda')->assertOk();
});

it('Beranda menampilkan parameter yang belum dikonfigurasi dan ringkasan kebijakan', function () {
    actingAsRole(Role::Owner);

    $this->get('/owner')
        ->assertSee('Perlu dikonfigurasi')
        ->assertSee('Jam layanan Admin')
        ->assertSee('Perubahan terjadwal')
        ->assertSee('Belum pernah dijalankan.');
});

it('Riwayat Perubahan menyaring per objek dan menampilkan label bahasa Indonesia', function () {
    actingAsRole(Role::Owner);
    $component = HonorComponent::query()->where('code', 'attendance')->firstOrFail();
    Audit::record('honor_component.updated', $component, ['description' => null], ['description' => 'Per sesi']);

    $this->get('/owner/pengaturan/riwayat?subject_type=honor_component&subject_id='.$component->id)
        ->assertOk()
        ->assertSee('Mengubah komponen')
        ->assertSee('Menetapkan tarif')
        ->assertSee('Uang Kehadiran')
        ->assertDontSee('Menetapkan nilai');

    $this->get('/owner/pengaturan/riwayat?date_from=2026-12-02&date_to=2026-12-01')->assertSessionHasErrors('date_to');
});

it('notifikasi ditandai dibaca lalu membuka tautan internalnya; milik user lain 404', function () {
    $owner = actingAsRole(Role::Owner);
    Notifier::send($owner, new EdukomNotification(event: 'contoh', title: 'Contoh', message: 'Isi', actionUrl: '/owner/pengaturan/riwayat'));
    Notifier::send($owner, new EdukomNotification(event: 'contoh', title: 'Luar', message: 'Isi', actionUrl: 'https://contoh.test'));
    [$internal, $external] = [$owner->notifications()->where('data->title', 'Contoh')->value('id'), $owner->notifications()->where('data->title', 'Luar')->value('id')];

    $this->get('/owner')->assertSee('Contoh')->assertSee('2 belum dibaca');
    $this->post("/notifikasi/{$internal}/baca")->assertRedirect('/owner/pengaturan/riwayat');
    $this->from('/owner')->post("/notifikasi/{$external}/baca")->assertRedirect('/owner');
    expect($owner->unreadNotifications()->count())->toBe(0);

    actingAsRole(Role::Admin);
    $this->post("/notifikasi/{$internal}/baca")->assertNotFound();
});

it('tandai semua notifikasi dibaca', function () {
    $owner = actingAsRole(Role::Owner);
    Notifier::send($owner, new EdukomNotification(event: 'contoh', title: 'A', message: 'Isi'));

    $this->from('/owner')->post('/notifikasi/baca-semua')->assertRedirect('/owner');
    expect($owner->unreadNotifications()->count())->toBe(0);
});
