<?php

use App\Domain\Honorarium\HonorComponents;
use App\Domain\Notification\Notifier;
use App\Domain\Reference\LeaveRejectionReasons;
use App\Domain\Retention\RetentionPurger;
use App\Enums\PayrollPeriodStatus;
use App\Enums\Role;
use App\Models\HonorComponent;
use App\Models\PayrollPeriod;
use App\Models\PolicyParameterVersion;
use App\Models\TransportTierSet;
use App\Models\User;
use App\Notifications\EdukomNotification;
use Database\Seeders\DemoSeeder;
use Database\Seeders\HonorComponentSeeder;
use Database\Seeders\PolicyParameterSeeder;

beforeEach(function () {
    $this->travelTo('2026-11-25 10:00:00');
    $this->withHeaders(spaHeaders());
    (new PolicyParameterSeeder)->run();
    (new HonorComponentSeeder)->run();
});

it('meringkas data Beranda tahap 1 tanpa blok modul yang belum aktif', function () {
    $owner = actingAsRole(Role::Owner);
    $attendance = HonorComponent::query()->where('code', 'attendance')->firstOrFail();

    $this->postJson('/api/v1/policy-parameters/late_tolerance_minutes/versions', ['value' => 20, 'effective_from' => '2026-12-01'])->assertCreated();
    $this->postJson('/api/v1/policy-parameters/retention_audit_log_months/versions', ['value' => 12, 'effective_from' => '2026-12-01'])->assertCreated();
    HonorComponents::addRate($attendance, 12000, '2026-12-01');
    HonorComponents::deactivate(HonorComponents::create(['name' => 'Uang Makan', 'basis' => 'per_school_visit', 'amount' => 1, 'effective_from' => '2026-11-01']), '2026-11-20', 'Tidak dipakai');
    LeaveRejectionReasons::create(['name' => 'Bukti tidak memadai']);
    LeaveRejectionReasons::deactivate(LeaveRejectionReasons::create(['name' => 'Alasan lama']));
    Notifier::send($owner, new EdukomNotification(event: 'contoh', title: 'Contoh', message: 'Isi'));
    RetentionPurger::run(dryRun: true);
    $run = RetentionPurger::run();

    $data = $this->getJson('/api/v1/owner/overview')->assertOk()->json('data');

    expect(array_keys($data))->toBe(['needs_configuration', 'scheduled_changes', 'honor_components', 'leave_rejection_reasons', 'unread_notifications', 'last_retention_run'])
        ->and(collect($data['needs_configuration'])->pluck('key'))->toContain('admin_service_hours')
        ->and($data['needs_configuration'][0])->toHaveKeys(['key', 'label', 'group', 'group_label'])
        ->and($data['scheduled_changes'])->toBe(['policy_parameters' => 1, 'honor_rates' => 1, 'transport_tiers' => 0, 'retention' => 1])
        ->and($data['honor_components'])->toBe(['active' => 4, 'inactive' => 1])
        ->and($data['leave_rejection_reasons'])->toBe(['active' => 1, 'inactive' => 1])
        ->and($data['unread_notifications'])->toBe(2)
        ->and($data['last_retention_run']['id'])->toBe($run->id)
        ->and($data['last_retention_run']['dry_run'])->toBeFalse();
});

it('hanya owner yang boleh membuka ringkasan Beranda', function (Role $role) {
    actingAsRole($role);

    $this->getJson('/api/v1/owner/overview')->assertForbidden();
})->with('all_roles_except_owner');

it('DemoSeeder mengisi data demo di local, idempoten, dan ditolak di environment lain', function () {
    actingAsRole(Role::Owner);
    auth()->forgetGuards();

    expect(fn () => (new DemoSeeder)->run())->toThrow(RuntimeException::class);

    app()->detectEnvironment(fn () => 'local');
    (new DemoSeeder)->run();
    (new DemoSeeder)->run();

    $meal = HonorComponent::query()->where('name', 'Uang Makan (demo)')->sole();
    expect($meal->isActiveOn(today()))->toBeFalse()
        ->and(PolicyParameterVersion::query()->where('effective_from', '2026-12-01')->count())->toBe(3)
        ->and(TransportTierSet::query()->count())->toBe(2)
        ->and(PayrollPeriod::query()->where(['year' => 2026, 'month' => 10])->sole()->status)->toBe(PayrollPeriodStatus::Closed)
        ->and(User::query()->where('role', 'owner')->first()->unreadNotifications()->count())->toBe(3);
});
