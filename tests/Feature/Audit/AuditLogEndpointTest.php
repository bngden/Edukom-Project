<?php

use App\Domain\Audit\Audit;
use App\Enums\Role;
use App\Models\AuditLog;

beforeEach(fn () => $this->withHeaders(spaHeaders()));

it('mengizinkan owner dan admin melihat riwayat terbaru dulu', function (Role $role) {
    $this->travelTo('2026-11-01 08:00:00');
    Audit::record('policy.created', ['type' => 'policy', 'id' => 1, 'label' => 'Lama'], null, ['v' => 1]);
    $this->travelTo('2026-11-02 08:00:00');
    Audit::record('policy.updated', ['type' => 'policy', 'id' => 1, 'label' => 'Baru'], ['v' => 1], ['v' => 2], 'Revisi');
    $this->travelBack();

    actingAsRole($role);

    $this->getJson('/api/v1/audit-logs')
        ->assertOk()
        ->assertJsonPath('meta.per_page', 25)
        ->assertJsonPath('meta.total', 2)
        ->assertJsonPath('data.0.action', 'policy.updated')
        ->assertJsonPath('data.0.actor', ['type' => 'system', 'id' => null, 'name' => 'Sistem', 'role' => null])
        ->assertJsonPath('data.0.subject', ['type' => 'policy', 'id' => '1', 'label' => 'Baru'])
        ->assertJsonPath('data.0.before', ['v' => 1])
        ->assertJsonPath('data.0.after', ['v' => 2])
        ->assertJsonPath('data.0.reason', 'Revisi')
        ->assertJsonPath('data.1.action', 'policy.created');
})->with('owner_admin');

it('menyaring berdasarkan aksi, subjek, pelaku, dan rentang tanggal', function () {
    $owner = actingAsRole(Role::Owner);

    $this->travelTo('2026-11-01 23:59:00');
    Audit::record('policy.created', ['type' => 'policy', 'id' => 1], null, ['v' => 1]);
    $this->travelTo('2026-11-02 00:01:00');
    Audit::record('policy.updated', ['type' => 'policy', 'id' => 2], ['v' => 1], ['v' => 2]);
    $this->travelBack();

    $ids = fn (array $query) => collect($this->getJson('/api/v1/audit-logs?'.http_build_query($query))->assertOk()->json('data'))
        ->pluck('action')->all();

    expect($ids(['action' => 'policy.created']))->toBe(['policy.created'])
        ->and($ids(['subject_type' => 'policy', 'subject_id' => '2']))->toBe(['policy.updated'])
        ->and($ids(['actor_id' => $owner->id]))->toHaveCount(2)
        ->and($ids(['date_from' => '2026-11-02']))->toBe(['policy.updated'])
        ->and($ids(['date_to' => '2026-11-01']))->toBe(['policy.created']);
});

it('memvalidasi penyaring', function () {
    actingAsRole(Role::Owner);

    $this->getJson('/api/v1/audit-logs?date_from=2026-11-02&date_to=2026-11-01&actor_id=abc')
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['date_to', 'actor_id']);
});

it('menolak role lain dan mencatat access.denied', function (Role $role) {
    $user = actingAsRole($role);

    $this->getJson('/api/v1/audit-logs')->assertForbidden()->assertJsonPath('code', 'FORBIDDEN');

    $log = AuditLog::query()->where('action', 'access.denied')->sole();

    expect($log->actor_id)->toBe($user->id)
        ->and($log->actor_role)->toBe($role->value)
        ->and($log->subject_type)->toBe('route')
        ->and($log->subject_id)->toBe('api.v1.audit-logs.index')
        ->and($log->subject_label)->toBe('GET /api/v1/audit-logs');
})->with('all_roles_except_owner_admin');

it('mengembalikan 401 bila belum login', function () {
    $this->getJson('/api/v1/audit-logs')->assertUnauthorized();

    expect(AuditLog::query()->count())->toBe(0);
});
