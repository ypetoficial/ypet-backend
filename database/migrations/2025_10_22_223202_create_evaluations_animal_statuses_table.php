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
        Schema::create('evaluations_animal_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status')->index();
            $table->foreignId('animal_id')->constrained('animals');
            $table->foreignId('tutor_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations_animal_statuses');
    }
};
