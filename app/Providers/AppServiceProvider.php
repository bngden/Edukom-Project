<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', fn (Request $request) => Limit::perMinute(
            (int) config('edukom.auth.login_rate_per_minute'),
        )->by('login|'.$request->ip()));

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
