<?php

namespace App\Providers;

use App\Domain\Policy\PolicyParameters;
use App\Models\HonorComponent;
use App\Models\HonorComponentRate;
use App\Models\LeaveRejectionReason;
use App\Models\PayrollPeriod;
use App\Models\PolicyParameter;
use App\Models\PolicyParameterVersion;
use App\Models\RetentionRun;
use App\Models\TransportTierSet;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Cache nilai parameter hanya selama satu request/job.
        $this->app->scoped(PolicyParameters::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', fn (Request $request) => Limit::perMinute(
            (int) config('edukom.auth.login_rate_per_minute'),
        )->by('login|'.$request->ip()));

        // Alias subject_type riwayat perubahan agar mudah difilter. Tidak di-enforce; User sengaja tidak dipetakan
        // karena dipakai sebagai notifiable_type/tokenable_type pada data yang sudah ada.
        Relation::morphMap([
            'policy_parameter' => PolicyParameter::class,
            'policy_parameter_version' => PolicyParameterVersion::class,
            'honor_component' => HonorComponent::class,
            'honor_component_rate' => HonorComponentRate::class,
            'transport_tier_set' => TransportTierSet::class,
            'leave_rejection_reason' => LeaveRejectionReason::class,
            'retention_run' => RetentionRun::class,
            'payroll_period' => PayrollPeriod::class,
        ]);

        // Kolom standar tabel versi (lihat App\Domain\Versioning\HasEffectiveDating).
        // Tabel pemakai wajib menambah indeks (kolom deret, effective_from) sendiri.
        Blueprint::macro('effectiveDating', function () {
            /** @var Blueprint $this */
            $this->date('effective_from');
            $this->date('effective_to')->nullable();
            $this->text('reason')->nullable();
            $this->foreignId('created_by')->nullable()->constrained('users');
            $this->dateTime('cancelled_at', 6)->nullable();
            $this->foreignId('cancelled_by')->nullable()->constrained('users');
            $this->text('cancel_reason')->nullable();
        });
    }
}
