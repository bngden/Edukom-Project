<?php

use App\Domain\Notification\Notifier;
use App\Domain\Notification\Recipients;
use App\Enums\Role;
use App\Models\User;
use App\Notifications\EdukomNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

beforeEach(fn () => $this->withHeaders(spaHeaders()));

function sampleNotification(string $title = 'Pengajuan pengadaan baru'): EdukomNotification
{
    return new EdukomNotification(
        event: 'procurement.submitted',
        title: $title,
        message: 'Admin mengajukan pengadaan 2 unit laptop.',
        subjectType: 'procurement',
        subjectId: 12,
        actionUrl: '/owner/pengadaan/12',
    );
}

it('mengirim notifikasi dan menampilkannya dengan payload yang tepat', function () {
    $owner = actingAsRole(Role::Owner);
    Notifier::send($owner, sampleNotification());

    $item = $this->getJson('/api/v1/notifications')
        ->assertOk()
        ->assertJsonPath('meta.per_page', 20)
        ->json('data.0');

    expect(array_keys($item))->toBe(['id', 'event', 'title', 'message', 'subject_type', 'subject_id', 'action_url', 'is_read', 'read_at', 'created_at'])
        ->and($item)->toMatchArray([
            'event' => 'procurement.submitted',
            'title' => 'Pengajuan pengadaan baru',
            'subject_type' => 'procurement',
            'subject_id' => 12,
            'action_url' => '/owner/pengadaan/12',
            'is_read' => false,
            'read_at' => null,
        ]);
});

it('menyaring status, menghitung belum dibaca, dan menandai satu dibaca', function () {
    $owner = actingAsRole(Role::Owner);
    Notifier::send($owner, sampleNotification('A'));
    Notifier::send($owner, sampleNotification('B'));
    $first = $owner->notifications()->where('data->title', 'A')->firstOrFail();

    $this->getJson('/api/v1/notifications/unread-count')->assertExactJson(['data' => ['count' => 2]]);

    $this->postJson("/api/v1/notifications/{$first->id}/read")->assertNoContent();

    $titles = fn (string $status) => collect($this->getJson("/api/v1/notifications?status={$status}")->assertOk()->json('data'))->pluck('title')->all();

    expect($titles('unread'))->toBe(['B'])
        ->and($titles('read'))->toBe(['A'])
        ->and($titles('all'))->toHaveCount(2);

    $this->getJson('/api/v1/notifications/unread-count')->assertJsonPath('data.count', 1);
    $this->getJson('/api/v1/notifications?status=lain')->assertUnprocessable();
});

it('menandai semua dibaca hanya untuk notifikasi milik sendiri', function () {
    $owner = actingAsRole(Role::Owner);
    $admin = User::factory()->role(Role::Admin)->create();
    Notifier::send([$owner, $admin], sampleNotification());
    Notifier::send($owner, sampleNotification());

    $this->postJson('/api/v1/notifications/read-all')->assertNoContent();

    expect($owner->unreadNotifications()->count())->toBe(0)
        ->and($admin->unreadNotifications()->count())->toBe(1);
});

it('mengembalikan 404 untuk notifikasi milik user lain', function () {
    $admin = User::factory()->role(Role::Admin)->create();
    Notifier::send($admin, sampleNotification());
    $id = $admin->notifications()->value('id');

    actingAsRole(Role::Tentor);

    $this->postJson("/api/v1/notifications/{$id}/read")->assertNotFound()->assertJsonPath('code', 'NOT_FOUND');
    expect($admin->unreadNotifications()->count())->toBe(1);
});

it('dapat diakses semua peran yang login', function (Role $role) {
    actingAsRole($role);

    $this->getJson('/api/v1/notifications')->assertOk();
})->with('all_roles');

it('menolak tamu dengan 401', function () {
    $this->getJson('/api/v1/notifications')->assertUnauthorized();
    $this->postJson('/api/v1/notifications/read-all')->assertUnauthorized();
});

it('tidak mengirim notifikasi bila transaksi pemicu rollback', function () {
    $owner = User::factory()->role(Role::Owner)->create();

    try {
        DB::transaction(function () use ($owner) {
            Notifier::send($owner, sampleNotification());
            throw new RuntimeException('gagal');
        });
    } catch (RuntimeException) {
    }

    expect($owner->notifications()->count())->toBe(0);
});

it('kegagalan notifikasi tidak menggagalkan transaksi pemicu', function () {
    $owner = User::factory()->role(Role::Owner)->create(['name' => 'Lama']);
    Notification::shouldReceive('send')->once()->andThrow(new RuntimeException('server mati'));
    Log::shouldReceive('warning')->once()->withArgs(fn (string $message, array $context) => $message === 'notification_failed'
        && $context['event'] === 'procurement.submitted');

    DB::transaction(function () use ($owner) {
        $owner->update(['name' => 'Baru']);
        Notifier::send($owner, sampleNotification());
    });

    expect($owner->fresh()->name)->toBe('Baru');
});

it('Recipients hanya mengembalikan user aktif sesuai peran', function () {
    $owner = User::factory()->role(Role::Owner)->create();
    User::factory()->role(Role::Owner)->inactive()->create();
    $admin = User::factory()->role(Role::Admin)->create();

    expect(Recipients::owners()->pluck('id')->all())->toBe([$owner->id])
        ->and(Recipients::admins()->pluck('id')->all())->toBe([$admin->id]);
});
