<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pre_surgery_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained();
            $table->string('mucosa');
            $table->string('hydration');
            $table->boolean('adequate_fasting');
            $table->integer('fasting_time')->nullable();
            $table->tinyInteger('escore_corporal')->comment('Escore de Condição Corporal (ECC)');
            $table->integer('heart_rate');
            $table->integer('respiratory_rate');
            $table->string('abdominal_palpation');
            $table->text('abdominal_palpation_description')->nullable();
            $table->string('palpation_of_lymph_nodes');
            $table->string('palpation_of_lymph_nodes_description')->nullable();
            $table->boolean('vulvar_discharge');
            $table->boolean('foreskin_discharge');
            $table->boolean('ectopic_testicle');
            $table->text('obervations')->nullable();
            $table->text('transsurgical_intercurrences')->nullable();
            $table->text('measures_taken')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_surgery_assessments');
    }
};
