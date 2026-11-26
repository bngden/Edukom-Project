<?php

use App\Domain\Reference\LeaveRejectionReasons;
use App\Enums\Role;
use App\Models\AuditLog;
use App\Models\LeaveRejectionReason;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->withHeaders(spaHeaders());
    config(['edukom.reference_usage' => [LeaveRejectionReason::class => [['test_reason_usages', 'reason_id']]]]);
});

function makeReason(string $name, bool $active = true): LeaveRejectionReason
{
    $reason = LeaveRejectionReasons::create(['name' => $name]);

    if (! $active) {
        LeaveRejectionReasons::deactivate($reason);
    }

    return $reason->refresh();
}

function auditActions(): array
{
    return AuditLog::query()->where('action', 'like', 'leave_rejection_reason.%')->pluck('action')->all();
}

it('owner menambah, mengubah, menonaktifkan, mengaktifkan, dan menghapus alasan dengan audit', function () {
    $owner = actingAsRole(Role::Owner);

    $id = $this->postJson('/api/v1/leave-rejection-reasons', ['name' => '  Bukti tidak memadai ', 'description' => 'Surat dokter tidak terbaca'])
        ->assertCreated()
        ->assertJsonPath('data.name', 'Bukti tidak memadai')
        ->assertJsonPath('data.sort_order', 1)
        ->assertJsonPath('data.is_active', true)
        ->assertJsonPath('data.usage_count', 0)
        ->assertJsonPath('data.can_delete', true)
        ->json('data.id');

    $this->patchJson("/api/v1/leave-rejection-reasons/{$id}", ['name' => 'Bukti kurang'])
        ->assertOk()
        ->assertJsonPath('data.name', 'Bukti kurang');

    $this->postJson("/api/v1/leave-rejection-reasons/{$id}/deactivate")->assertNoContent();
    $this->postJson("/api/v1/leave-rejection-reasons/{$id}/deactivate")->assertConflict();
    expect(LeaveRejectionReason::find($id)->deactivated_at)->not->toBeNull();

    $this->postJson("/api/v1/leave-rejection-reasons/{$id}/activate")->assertNoContent();
    $this->postJson("/api/v1/leave-rejection-reasons/{$id}/activate")->assertConflict();

    $this->deleteJson("/api/v1/leave-rejection-reasons/{$id}")->assertNoContent();
    expect(LeaveRejectionReason::find($id))->toBeNull();

    expect(auditActions())->toEqualCanonicalizing([
        'leave_rejection_reason.created', 'leave_rejection_reason.updated', 'leave_rejection_reason.deactivated',
        'leave_rejection_reason.activated', 'leave_rejection_reason.deleted',
    ]);

    $updated = AuditLog::query()->where('action', 'leave_rejection_reason.updated')->sole();
    expect($updated->actor_id)->toBe($owner->id)
        ->and($updated->subject_label)->toBe('Bukti kurang')
        ->and($updated->before)->toBe(['name' => 'Bukti tidak memadai'])
        ->and($updated->after)->toBe(['name' => 'Bukti kurang'])
        ->and(AuditLog::query()->where('action', 'leave_rejection_reason.deleted')->sole()->subject_label)->toBe('Bukti kurang');
});

it('menolak nama tidak valid', function (array $payload) {
    actingAsRole(Role::Owner);
    makeReason('Bukti tidak memadai');

    $this->postJson('/api/v1/leave-rejection-reasons', $payload)->assertUnprocessable()->assertJsonValidationErrors(['name']);
})->with([
    'duplikat beda huruf' => [['name' => 'BUKTI TIDAK MEMADAI']],
    'kurang dari 3 karakter' => [['name' => 'ab']],
    'lebih dari 150 karakter' => [['name' => str_repeat('a', 151)]],
    'kosong' => [['name' => '']],
]);

it('mengubah nama ke nama alasan lain ditolak, ke nama sendiri beda huruf boleh', function () {
    actingAsRole(Role::Owner);
    $a = makeReason('Bukti tidak memadai');
    makeReason('Melewati batas waktu pengajuan');

    $this->patchJson("/api/v1/leave-rejection-reasons/{$a->id}", ['name' => 'melewati batas waktu pengajuan'])
        ->assertUnprocessable()->assertJsonValidationErrors(['name']);
    $this->patchJson("/api/v1/leave-rejection-reasons/{$a->id}", ['name' => 'BUKTI TIDAK MEMADAI'])->assertOk();
    $this->patchJson("/api/v1/leave-rejection-reasons/{$a->id}", ['is_active' => false])
        ->assertUnprocessable()->assertJsonValidationErrors(['is_active']);
});

it('menyimpan urutan baru sekaligus dengan satu audit dan menolak daftar tidak lengkap', function () {
    actingAsRole(Role::Owner);
    $a = makeReason('Alasan A');
    $b = makeReason('Alasan B');
    $c = makeReason('Alasan C', active: false);

    $this->putJson('/api/v1/leave-rejection-reasons/order', ['ids' => [$c->id, $a->id, $b->id]])->assertNoContent();

    expect(LeaveRejectionReason::query()->orderBy('sort_order')->pluck('id')->all())->toBe([$c->id, $a->id, $b->id])
        ->and(AuditLog::query()->where('action', 'leave_rejection_reason.reordered')->count())->toBe(1);

    $this->putJson('/api/v1/leave-rejection-reasons/order', ['ids' => [$a->id, $b->id]])
        ->assertUnprocessable()->assertJsonValidationErrors(['ids']);
    $this->putJson('/api/v1/leave-rejection-reasons/order', ['ids' => [$a->id, $a->id, $b->id]])
        ->assertUnprocessable();
});

it('menolak hapus alasan yang sudah dipakai (409) dan menampilkan jumlah pemakaian', function () {
    actingAsRole(Role::Owner);
    $used = makeReason('Bukti tidak memadai');
    $unused = makeReason('Bentrok jadwal calon pengganti');
    DB::table('test_reason_usages')->insert([['reason_id' => $used->id], ['reason_id' => $used->id]]);

    $this->deleteJson("/api/v1/leave-rejection-reasons/{$used->id}")
        ->assertConflict()
        ->assertJsonPath('code', 'REFERENCE_IN_USE')
        ->assertJsonPath('message', 'Alasan sudah pernah dipakai, hanya dapat dinonaktifkan.');

    $this->getJson('/api/v1/leave-rejection-reasons')
        ->assertJsonPath('data.0.usage_count', 2)
        ->assertJsonPath('data.0.can_delete', false)
        ->assertJsonPath('data.1.usage_count', 0)
        ->assertJsonPath('data.1.can_delete', true);

    expect($used->isUsed())->toBeTrue()->and($unused->isUsed())->toBeFalse()
        ->and(LeaveRejectionReason::find($used->id))->not->toBeNull();

    $this->postJson("/api/v1/leave-rejection-reasons/{$used->id}/deactivate")->assertNoContent();
});

it('owner menyaring status dan mencari nama', function () {
    actingAsRole(Role::Owner);
    makeReason('Bukti tidak memadai');
    makeReason('Bentrok jadwal calon pengganti', active: false);

    $names = fn (string $query) => collect($this->getJson('/api/v1/leave-rejection-reasons'.$query)->assertOk()->json('data'))->pluck('name')->all();

    expect($names(''))->toBe(['Bukti tidak memadai', 'Bentrok jadwal calon pengganti'])
        ->and($names('?status=active'))->toBe(['Bukti tidak memadai'])
        ->and($names('?status=inactive'))->toBe(['Bentrok jadwal calon pengganti'])
        ->and($names('?search=JADWAL'))->toBe(['Bentrok jadwal calon pengganti'])
        ->and($names('?search=%25'))->toBe([]);

    $this->getJson('/api/v1/leave-rejection-reasons?status=semua')->assertUnprocessable();
});

it('admin hanya menerima alasan aktif, meski meminta status lain', function (string $query) {
    makeReason('Bukti tidak memadai');
    makeReason('Bentrok jadwal calon pengganti', active: false);
    actingAsRole(Role::Admin);

    $this->getJson('/api/v1/leave-rejection-reasons'.$query)
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.name', 'Bukti tidak memadai');
})->with(['tanpa status' => [''], 'status=all' => ['?status=all'], 'status=inactive' => ['?status=inactive']]);

it('selain owner tidak dapat mengubah daftar', function (Role $role) {
    $reason = makeReason('Bukti tidak memadai');
    actingAsRole($role);

    $this->postJson('/api/v1/leave-rejection-reasons', ['name' => 'Alasan baru'])->assertForbidden();
    $this->patchJson("/api/v1/leave-rejection-reasons/{$reason->id}", ['name' => 'Ubah'])->assertForbidden();
    $this->putJson('/api/v1/leave-rejection-reasons/order', ['ids' => [$reason->id]])->assertForbidden();
    $this->postJson("/api/v1/leave-rejection-reasons/{$reason->id}/deactivate")->assertForbidden();
    $this->postJson("/api/v1/leave-rejection-reasons/{$reason->id}/activate")->assertForbidden();
    $this->deleteJson("/api/v1/leave-rejection-reasons/{$reason->id}")->assertForbidden();

    expect(auditActions())->toBe(['leave_rejection_reason.created']);
})->with('all_roles_except_owner');

it('tentor, kurir, dan teknisi tidak dapat melihat daftar', function (Role $role) {
    actingAsRole($role);

    $this->getJson('/api/v1/leave-rejection-reasons')->assertForbidden();
})->with('all_roles_except_owner_admin');

it('menolak akses tanpa login', function () {
    $this->getJson('/api/v1/leave-rejection-reasons')->assertUnauthorized();
    $this->postJson('/api/v1/leave-rejection-reasons', ['name' => 'Alasan baru'])->assertUnauthorized();
});
