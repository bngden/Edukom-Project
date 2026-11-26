<?php

namespace Database\Seeders;

use App\Domain\Honorarium\HonorComponents;
use App\Domain\Honorarium\TransportTierSets;
use App\Domain\Notification\Notifier;
use App\Domain\Notification\Recipients;
use App\Domain\Versioning\VersionTimeline;
use App\Enums\HonorBasis;
use App\Enums\PayrollPeriodStatus;
use App\Models\HonorComponent;
use App\Models\PayrollPeriod;
use App\Models\PolicyParameter;
use App\Models\PolicyParameterVersion;
use App\Notifications\EdukomNotification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

/**
 * Data demo Fase 1 untuk uji manual (hanya APP_ENV=local). Jalankan manual setelah db:seed:
 * php artisan db:seed --class=DemoSeeder. Dilewati bila komponen demo sudah ada.
 */
class DemoSeeder extends Seeder
{
    private const MARKER = 'Uang Makan (demo)';

    public function run(): void
    {
        if (! app()->environment('local')) {
            throw new RuntimeException('DemoSeeder hanya untuk APP_ENV=local.');
        }

        if (HonorComponent::query()->where('name', self::MARKER)->exists()) {
            $this->command?->info('Data demo sudah ada, dilewati.');

            return;
        }

        $this->call([PolicyParameterSeeder::class, HonorComponentSeeder::class]);

        $nextMonth = today()->addMonthNoOverflow()->startOfMonth()->toDateString();
        $thisMonth = today()->startOfMonth()->toDateString();
        $lastMonth = today()->subMonthNoOverflow();

        DB::transaction(function () use ($nextMonth, $thisMonth) {
            foreach (['session_duration_minutes' => 80, 'late_tolerance_minutes' => 20, 'retention_honorarium_slip_months' => 24] as $key => $value) {
                $parameter = PolicyParameter::query()->where('key', $key)->firstOrFail();
                VersionTimeline::add((new PolicyParameterVersion([
                    'policy_parameter_id' => $parameter->id,
                    'value' => $value,
                    'effective_from' => $nextMonth,
                ]))->setRelation('parameter', $parameter), 'Demo: perubahan terjadwal');
            }

            HonorComponents::addRate(HonorComponent::query()->where('code', 'attendance')->firstOrFail(), 12_000, $nextMonth, 'Demo: kenaikan tarif');
            TransportTierSets::add(
                HonorComponent::query()->where('code', HonorComponent::TRANSPORT)->firstOrFail(),
                [['max_km' => '5.0', 'amount' => 8_000], ['max_km' => '15.0', 'amount' => 12_000], ['max_km' => null, 'amount' => 18_000]],
                $nextMonth,
                'Demo: tingkatan baru',
            );

            $meal = HonorComponents::create([
                'name' => self::MARKER,
                'description' => 'Komponen contoh yang sudah tidak dipakai.',
                'basis' => HonorBasis::PerSchoolVisit->value,
                'amount' => 15_000,
                'effective_from' => $thisMonth,
                'reason' => 'Demo',
            ]);
            HonorComponents::deactivate($meal, today()->toDateString(), 'Demo: tidak dipakai lagi');
        });

        // Ditutup terakhir agar versi demo di atas tidak tertolak periode terkunci.
        PayrollPeriod::query()->firstOrCreate(['year' => $lastMonth->year, 'month' => $lastMonth->month], [
            'starts_on' => $lastMonth->copy()->startOfMonth()->toDateString(),
            'ends_on' => $lastMonth->copy()->endOfMonth()->toDateString(),
            'status' => PayrollPeriodStatus::Closed,
        ]);

        $notifications = [
            ['policy_parameter.version_created', 'Perubahan parameter terjadwal', 'Durasi satu sesi berubah menjadi 80 menit mulai bulan depan.', '/owner/kebijakan/parameter'],
            ['honor_component.deactivated', 'Komponen honor dinonaktifkan', self::MARKER.' tidak dipakai lagi mulai hari ini.', '/owner/kebijakan/komponen-honor'],
            ['payroll_period.closed', 'Periode penggajian ditutup', 'Periode '.$lastMonth->locale('id')->translatedFormat('F Y').' sudah ditutup.', '/owner'],
        ];

        foreach ($notifications as [$event, $title, $message, $url]) {
            Notifier::send(Recipients::owners(), new EdukomNotification(event: $event, title: $title, message: $message, actionUrl: $url));
        }

        $this->command?->info('Data demo Fase 1 dibuat.');
    }
}
