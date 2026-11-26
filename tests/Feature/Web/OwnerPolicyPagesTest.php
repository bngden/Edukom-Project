<?php

use App\Domain\Honorarium\HonorRates;
use App\Domain\Reference\LeaveRejectionReasons;
use App\Enums\Role;
use App\Models\HonorComponent;
use App\Models\LeaveRejectionReason;
use App\Models\PayrollPeriod;
use App\Models\PolicyParameterVersion;
use App\Models\RetentionRun;
use Database\Seeders\HonorComponentSeeder;
use Database\Seeders\PolicyParameterSeeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->travelTo('2026-11-25 10:00:00');
    (new PolicyParameterSeeder)->run();
    (new HonorComponentSeeder)->run();
});

function webComponent(string $code): HonorComponent
{
    return HonorComponent::query()->where('code', $code)->firstOrFail();
}

dataset('policy_pages', [
    '/owner/kebijakan/parameter',
    '/owner/kebijakan/parameter/admin_service_hours',
    '/owner/kebijakan/komponen-honor',
    '/owner/kebijakan/komponen-honor/{transport}',
    '/owner/kebijakan/alasan-penolakan',
    '/owner/kebijakan/masa-simpan',
]);

it('owner membuka halaman kebijakan; peran lain 403', function (string $url) {
    $url = str_replace('{transport}', (string) webComponent('transport')->id, $url);
    actingAsRole(Role::Owner);
    $this->get($url)->assertOk();

    actingAsRole(Role::Admin);
    $this->get($url)->assertForbidden();
})->with('policy_pages');

it('menyimpan nilai parameter dari form (angka sebagai teks) dan menolak tanggal di periode tertutup', function () {
    actingAsRole(Role::Owner);

    $this->from('/owner/kebijakan/parameter/admin_service_hours')
        ->post('/owner/kebijakan/parameter/admin_service_hours/versi', [
            'value' => ['days' => ['1', '2', '3', '4', '5'], 'start' => '08:00', 'end' => '16:00'],
            'effective_from' => '2026-12-01',
        ])
        ->assertRedirect('/owner/kebijakan/parameter/admin_service_hours')
        ->assertSessionHas('status');

    expect(PolicyParameterVersion::query()->whereRelation('parameter', 'key', 'admin_service_hours')->sole()->value)
        ->toBe(['days' => [1, 2, 3, 4, 5], 'start' => '08:00', 'end' => '16:00']);

    $this->get('/owner/kebijakan/parameter/admin_service_hours')->assertSee('Senin–Jumat 08.00–16.00');

    PayrollPeriod::factory()->month(2027, 1)->closed()->create();
    $this->from('/owner/kebijakan/parameter/late_tolerance_minutes')
        ->post('/owner/kebijakan/parameter/late_tolerance_minutes/versi', ['value' => '20', 'effective_from' => '2027-01-10'])
        ->assertRedirect('/owner/kebijakan/parameter/late_tolerance_minutes')
        ->assertSessionHasErrors('effective_from');
});

it('menambah komponen, mengubah besaran, dan galat bisnis masuk ke form yang tepat', function () {
    actingAsRole(Role::Owner);

    $this->post('/owner/kebijakan/komponen-honor', [
        '_bag' => 'create', 'name' => 'Uang Makan', 'basis' => 'per_school_visit', 'amount' => '15000', 'effective_from' => '2026-12-01',
    ])->assertRedirect('/owner/kebijakan/komponen-honor/'.webComponent('uang_makan')->id);

    $attendance = webComponent('attendance');
    $url = "/owner/kebijakan/komponen-honor/{$attendance->id}";
    $this->from($url)->post("{$url}/besaran", ['_bag' => 'rate', 'amount' => '12000', 'effective_from' => '2026-12-01'])->assertRedirect($url);
    $this->from($url)->post("{$url}/besaran", ['_bag' => 'rate', 'amount' => '13000', 'effective_from' => '2026-11-30'])
        ->assertSessionHasErrorsIn('rate', 'effective_from');
    $this->from($url)->post("{$url}/besaran", ['_bag' => 'rate', 'amount' => 'abc', 'effective_from' => '2027-01-01'])
        ->assertSessionHasErrorsIn('rate', 'amount');

    expect(HonorRates::flatAmountFor('attendance', Carbon::parse('2026-12-01')))->toBe(12000);
});

it('menyimpan tingkatan jarak dari editor (koma desimal, baris terakhir tanpa batas)', function () {
    actingAsRole(Role::Owner);
    $url = '/owner/kebijakan/komponen-honor/'.webComponent('transport')->id;

    $this->from($url)->post("{$url}/tingkatan", [
        '_bag' => 'tiers',
        'tiers' => [['max_km' => '7,5', 'amount' => '9000'], ['max_km' => '', 'amount' => '14000']],
        'effective_from' => '2026-12-01',
    ])->assertRedirect($url)->assertSessionHasNoErrors();

    expect(HonorRates::transportAmountFor(7.5, Carbon::parse('2026-12-01')))->toBe(9000)
        ->and(HonorRates::transportAmountFor(7.6, Carbon::parse('2026-12-01')))->toBe(14000);

    $this->from($url)->post("{$url}/tingkatan", [
        '_bag' => 'tiers',
        'tiers' => [['max_km' => '10', 'amount' => '1'], ['max_km' => '5', 'amount' => '2'], ['max_km' => '', 'amount' => '3']],
        'effective_from' => '2027-01-01',
    ])->assertSessionHasErrorsIn('tiers', 'tiers.1.max_km');
});

it('menonaktifkan komponen dan membatalkan penonaktifan terjadwal', function () {
    actingAsRole(Role::Owner);
    $component = webComponent('teaching');
    $url = "/owner/kebijakan/komponen-honor/{$component->id}";

    $this->from($url)->post("{$url}/nonaktifkan", ['_bag' => 'deactivate', 'deactivated_from' => '2027-02-01'])
        ->assertSessionHasErrorsIn('deactivate', 'reason');
    $this->from($url)->post("{$url}/nonaktifkan", ['_bag' => 'deactivate', 'deactivated_from' => '2027-02-01', 'reason' => 'Tidak dipakai'])->assertRedirect($url);
    $this->get($url)->assertSee('Nonaktif mulai 1 Feb 2027');

    $this->from($url)->post("{$url}/batal-nonaktif", ['_bag' => 'cancel', 'reason' => 'Masih dipakai'])->assertRedirect($url);
    expect($component->fresh()->deactivated_from)->toBeNull();
});

it('mengelola alasan penolakan: tambah, ubah, urutkan, nonaktif/aktif, hapus', function () {
    actingAsRole(Role::Owner);
    $url = '/owner/kebijakan/alasan-penolakan';

    $this->post($url, ['_bag' => 'create', 'name' => 'Bukti tidak memadai'])->assertRedirect($url);
    $this->post($url, ['_bag' => 'create', 'name' => 'Bentrok jadwal'])->assertRedirect($url);
    $this->from($url)->post($url, ['_bag' => 'create', 'name' => 'BUKTI TIDAK MEMADAI'])->assertSessionHasErrorsIn('create', 'name');

    [$a, $b] = LeaveRejectionReason::query()->orderBy('sort_order')->get()->all();

    $this->from($url)->patch("{$url}/{$a->id}", ['_bag' => 'edit', '_edit_id' => $a->id, 'name' => 'Bukti kurang'])->assertRedirect($url);
    $this->from($url)->post("{$url}/{$b->id}/naik")->assertRedirect($url);
    expect(LeaveRejectionReason::query()->orderBy('sort_order')->pluck('id')->all())->toBe([$b->id, $a->id]);

    $this->from($url)->post("{$url}/{$a->id}/nonaktifkan")->assertRedirect($url);
    $this->get("{$url}?status=inactive")->assertSee('Bukti kurang')->assertDontSee('Bentrok jadwal');
    $this->from($url)->post("{$url}/{$a->id}/nonaktifkan")->assertSessionHasErrors('general');
    $this->from($url)->post("{$url}/{$a->id}/aktifkan")->assertRedirect($url);

    $this->from($url)->delete("{$url}/{$b->id}")->assertRedirect($url);
    expect(LeaveRejectionReason::query()->pluck('name')->all())->toBe(['Bukti kurang']);
});

it('menolak hapus alasan yang sudah dipakai dan menyembunyikan tombol urutan saat disaring', function () {
    actingAsRole(Role::Owner);
    config(['edukom.reference_usage' => [LeaveRejectionReason::class => [['test_reason_usages', 'reason_id']]]]);
    $reason = LeaveRejectionReasons::create(['name' => 'Bukti tidak memadai']);
    DB::table('test_reason_usages')->insert(['reason_id' => $reason->id]);
    $url = '/owner/kebijakan/alasan-penolakan';

    $this->get($url)->assertSee('Dipakai 1×')->assertSee('Naikkan Bukti tidak memadai');
    $this->get("{$url}?search=bukti")->assertDontSee('Naikkan Bukti tidak memadai');
    $this->from($url)->delete("{$url}/{$reason->id}")->assertSessionHasErrors('general');
    expect($reason->fresh())->not->toBeNull();
});

it('Masa Simpan menampilkan 5 jenis, menjalankan uji tanpa menghapus, dan menautkan ke halaman parameter', function () {
    actingAsRole(Role::Owner);

    $this->get('/owner/kebijakan/masa-simpan')
        ->assertSeeInOrder(['Bukti presensi', 'Lampiran izin', 'Foto serah terima', 'Slip honorarium', 'Riwayat perubahan'])
        ->assertSee('/owner/kebijakan/parameter/retention_honorarium_slip_months', false)
        ->assertSee('Belum pernah dijalankan.');

    $this->post('/owner/kebijakan/masa-simpan/uji')->assertRedirect('/owner/kebijakan/masa-simpan');
    $this->get('/owner/kebijakan/masa-simpan')->assertSee('Perkiraan bila dijalankan sekarang:');

    expect(RetentionRun::query()->sole()->dry_run)->toBeTrue();
    $this->get('/owner/kebijakan/parameter/retention_honorarium_slip_months')->assertSee('Masa Simpan Data');
});
