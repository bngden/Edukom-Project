<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Hanya dimuat saat test (lihat tests/TestCase.php).
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_versions', function (Blueprint $table) {
            $table->id();
            $table->string('series', 50);
            $table->unsignedBigInteger('value');
            $table->effectiveDating();
            $table->timestamps();

            $table->index(['series', 'effective_from']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_versions');
    }
};
