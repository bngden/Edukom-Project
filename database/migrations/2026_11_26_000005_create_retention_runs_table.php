<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('retention_runs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('started_at', 6)->index();
            $table->dateTime('finished_at', 6)->nullable();
            $table->boolean('dry_run');
            $table->foreignId('triggered_by')->nullable()->constrained('users');
            $table->string('status', 10);
            $table->json('summary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('retention_runs');
    }
};
