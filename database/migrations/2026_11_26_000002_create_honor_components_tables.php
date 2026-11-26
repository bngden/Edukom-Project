<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('honor_components', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique();
            // Collation *_ci: unique tidak membedakan huruf besar/kecil.
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('basis', 30);
            $table->string('rate_type', 20);
            $table->boolean('is_system')->default(false);
            $table->unsignedSmallInteger('sort_order');
            $table->date('deactivated_from')->nullable();
            $table->text('deactivation_reason')->nullable();
            $table->foreignId('deactivated_by')->nullable()->constrained('users');
            $table->timestamps();
        });

        Schema::create('honor_component_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('honor_component_id')->constrained();
            $table->unsignedBigInteger('amount');
            $table->effectiveDating();
            $table->timestamps();

            $table->index(['honor_component_id', 'effective_from'], 'honor_component_rates_series_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('honor_component_rates');
        Schema::dropIfExists('honor_components');
    }
};
