<?php

use App\Domain\Audit\Audit;
use App\Enums\Role;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

function auditSample(): AuditLog
{
    return Audit::record('test.created', ['type' => 'test', 'id' => 1, 'label' => 'Contoh'], null, ['a' => 1]);
}

it('menyimpan hanya atribut yang berubah, pelaku, alasan, dan menyamarkan field sensitif', function () {
    $admin = actingAsRole(Role::Admin);
    $subject = User::factory()->role(Role::Tentor)->create(['name' => 'Budi']);

    $log = Audit::record(
        'user.updated',
        $subject,
        ['name' => 'Budi', 'phone' => '0811', 'password' => 'lama', 'meta' => ['api_token' => 'x']],
        ['name' => 'Budi', 'phone' => '0812', 'password' => 'baru', 'meta' => ['api_token' => 'y']],
        'Salah ketik nomor',
    )->fresh();

    expect($log->actor_type)->toBe('user')
        ->and($log->actor_id)->toBe($admin->id)
        ->and($log->actor_role)->toBe('admin')
        ->and($log->subject_type)->toBe($subject->getMorphClass())
        ->and($log->subject_id)->toBe((string) $subject->id)
        ->and($log->subject_label)->toBe('Budi')
        ->and($log->before)->toBe(['phone' => '0811', 'password' => '***', 'meta' => ['api_token' => '***']])
        ->and($log->after)->toBe(['phone' => '0812', 'password' => '***', 'meta' => ['api_token' => '***']])
        ->and($log->reason)->toBe('Salah ketik nomor');
});

it('mencatat pelaku Sistem bila tidak ada user login', function () {
    $log = auditSample()->fresh();

    expect($log->actor_type)->toBe('system')
        ->and($log->actor_id)->toBeNull()
        ->and($log->actor_role)->toBeNull();
});

it('menolak update dan delete lewat Eloquent', function () {
    $log = auditSample();

    expect(fn () => $log->update(['action' => 'x']))->toThrow(LogicException::class)
        ->and(fn () => $log->delete())->toThrow(LogicException::class);
});

it('menolak update dan delete lewat query builder dengan trigger', function () {
    auditSample();

    expect(fn () => DB::table('audit_logs')->update(['action' => 'x']))->toThrow(QueryException::class, 'append-only')
        ->and(fn () => DB::table('audit_logs')->delete())->toThrow(QueryException::class, 'append-only')
        ->and(AuditLog::query()->where('action', 'test.created')->count())->toBe(1);
});

it('membatalkan catatan audit bila transaksi pemanggil rollback', function () {
    try {
        DB::transaction(function () {
            auditSample();
            throw new RuntimeException('gagal');
        });
    } catch (RuntimeException) {
    }

    expect(AuditLog::query()->count())->toBe(0);
});

it('purge menghapus riwayat lama, mencatat audit.purged, lalu penghapusan kembali ditolak', function () {
    $this->travelTo('2025-06-01 10:00:00');
    auditSample();
    $this->travelBack();
    $recent = auditSample();

    $this->artisan('edukom:purge-audit', ['--before' => '2026-01-01'])
        ->expectsOutput('1 catatan riwayat dihapus.')
        ->assertSuccessful();

    $purged = AuditLog::query()->where('action', 'audit.purged')->firstOrFail();

    expect(AuditLog::query()->pluck('id')->all())->toEqualCanonicalizing([$recent->id, $purged->id])
        ->and($purged->actor_type)->toBe('system')
        ->and($purged->after)->toBe(['before' => '2026-01-01', 'deleted' => 1])
        ->and(fn () => DB::table('audit_logs')->delete())->toThrow(QueryException::class, 'append-only');
});

it('purge menolak tanpa tanggal yang valid', function () {
    $this->artisan('edukom:purge-audit')->assertFailed();
    $this->artisan('edukom:purge-audit', ['--before' => '01-01-2026'])->assertFailed();
});

it('mencatat auth.account_locked saat akun terkunci', function () {
    config(['edukom.auth.max_failed_attempts' => 2]);
    $user = User::factory()->role(Role::Admin)->create(['email' => 'admin@edukom.test', 'password' => 'rahasia123']);

    foreach ([422, 423] as $status) {
        $this->withHeaders(spaHeaders())
            ->postJson('/api/v1/auth/login', ['email' => 'admin@edukom.test', 'password' => 'salah'])
            ->assertStatus($status);
    }

    $log = AuditLog::query()->where('action', 'auth.account_locked')->sole();

    expect($log->subject_id)->toBe((string) $user->id)
        ->and($log->actor_type)->toBe('system')
        ->and($log->after['failed_login_attempts'])->toBe(2);
});
