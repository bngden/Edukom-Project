<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Sumber berkas tiruan untuk menguji pembersihan masa simpan (T1.5).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_evidence_files', function (Blueprint $table) {
            $table->id();
            $table->dateTime('captured_at');
            $table->string('file_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_evidence_files');
    }
};
