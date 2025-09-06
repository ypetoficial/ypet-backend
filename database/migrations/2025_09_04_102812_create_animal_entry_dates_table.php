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
        Schema::create('animal_entry_datas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');
            $table->string('registration_number')->nullable()->unique()->index();
            $table->string('microchip_number')->nullable()->unique()->index();
            $table->date('entry_date');
            $table->boolean('castrated')->nullable();
            $table->date('castration_at')->nullable();
            $table->string('castration_site')->nullable();
            $table->boolean('dewormed')->nullable();
            $table->string('infirmity')->nullable();
            $table->string('origin')->nullable();
            $table->string('collection_site')->nullable();
            $table->string('collection_reason')->nullable();
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_entry_dates');
    }
};
