<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->after('email');
            $table->boolean('is_active')->default(true)->after('role');
            $table->unsignedSmallInteger('failed_login_attempts')->default(0)->after('password');
            $table->dateTime('locked_until', 6)->nullable()->after('failed_login_attempts');
            $table->dateTime('last_login_at', 6)->nullable()->after('locked_until');

            // Daftar/penyaringan pengguna per peran dan status (T0.2 dan seterusnya).
            $table->index(['role', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role', 'is_active']);
            $table->dropColumn(['role', 'is_active', 'failed_login_attempts', 'locked_until', 'last_login_at']);
        });
    }
};
