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
        Schema::create('adoption_visits', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('citizen_id')->references('id')->on('citizens');
            $table->foreignId('animal_id')->references('id')->on('animals');
            $table->foreignId('user_id')->references('id')->on('citizens');
            $table->date('start_date')->nullable();
            $table->date('date_end')->nullable();
            $table->string('status')->default('pending');
            $table->text('actions')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_visits');
    }
};
