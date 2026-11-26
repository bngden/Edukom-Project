<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('policy_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();
            $table->string('group', 30)->index();
            $table->string('label');
            $table->text('description')->nullable();
            $table->string('value_type', 30);
            $table->string('unit', 20)->nullable();
            $table->unsignedSmallInteger('sort_order');
            $table->timestamps();
        });

        Schema::create('policy_parameter_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('policy_parameter_id')->constrained();
            $table->json('value');
            $table->effectiveDating();
            $table->timestamps();

            $table->index(['policy_parameter_id', 'effective_from'], 'policy_parameter_versions_series_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('policy_parameter_versions');
        Schema::dropIfExists('policy_parameters');
    }
};
