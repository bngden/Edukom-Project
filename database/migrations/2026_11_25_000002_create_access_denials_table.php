<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('access_denials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('role', 20)->nullable();
            $table->string('method', 10);
            $table->string('path', 2048);
            $table->string('route_name')->nullable();
            $table->string('ip', 45)->nullable();
            $table->dateTime('occurred_at', 6);

            $table->index('occurred_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('access_denials');
    }
};
