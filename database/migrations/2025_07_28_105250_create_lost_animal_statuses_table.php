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
        Schema::create('lost_animal_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status')->index();
            $table->text('description')->nullable();
            $table->foreignId('lost_animal_id')->constrained('lost_animals');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_animal_statuses');
    }
};
