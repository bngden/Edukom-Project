<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transport_tier_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('honor_component_id')->constrained();
            $table->effectiveDating();
            $table->timestamps();

            $table->index(['honor_component_id', 'effective_from'], 'transport_tier_sets_series_index');
        });

        Schema::create('transport_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transport_tier_set_id')->constrained();
            $table->unsignedTinyInteger('position');
            $table->decimal('min_km_exclusive', 6, 1);
            $table->decimal('max_km_inclusive', 6, 1)->nullable();
            $table->unsignedBigInteger('amount');
            $table->timestamps();

            $table->unique(['transport_tier_set_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_tiers');
        Schema::dropIfExists('transport_tier_sets');
    }
};
