<?php

use App\Enums\AnimalAmbulencePriorityEnum;
use App\Enums\AnimalAmbulenceStatusEnum;
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
        Schema::create('animal_ambulances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('priority')->default(AnimalAmbulencePriorityEnum::LOW->value);
            $table->string('status')->default(AnimalAmbulenceStatusEnum::OPEN->value);
            $table->string('evidence_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_ambulances');
    }
};
