<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tabel pemakai tiruan untuk menguji registry reference_usage (T1.4).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_reason_usages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reason_id')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_reason_usages');
    }
};
