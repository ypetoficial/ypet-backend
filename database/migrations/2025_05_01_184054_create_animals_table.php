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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->nullable()->unique()->index();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            // Caso seja para adoçaão o animal precisa está em um local
            $table->foreignId('place_id')->nullable()->constrained()->onDelete('cascade');
            // Caso tenha um dono precisa do id do cidadão
            $table->foreignId('citizen_id')->nullable()->constrained()->onDelete('cascade');

            $table->tinyInteger('type')->comment('1: cahorro, 2: gato, 3: coruja, 4: equideo, 5: urubu, 6: outro');
            $table->integer('breed');
            $table->tinyInteger('status');
            $table->string('name');
            $table->string('color');
            $table->string('size')->nullable();
            $table->date('birth_date');
            $table->tinyInteger('gender')->comment('1: macho, 2: fêmea');
            $table->string('profile_picture')->nullable();
            $table->boolean('castrated')->default(false);
            $table->date('castration_at')->nullable();
            $table->string('castration_site')->nullable();
            $table->string('registration_number')->nullable()->unique()->index();
            $table->date('entry_date')->nullable();
            $table->string('collection_site')->nullable();
            $table->string('collection_reason')->nullable();
            $table->string('microchip')->nullable()->unique()->index();
            $table->string('tracker_number')->nullable()->unique()->index();
            $table->string('medal_code')->nullable()->unique()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
