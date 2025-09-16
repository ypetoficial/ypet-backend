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
        Schema::create('protectors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique();
            $table->integer('user_id');
            $table->date('birth_date');
            $table->string('gender')->nullable();
            $table->integer('special_permissions')->nullable();
            $table->string('document')->nullable()->unique();
            $table->boolean('status');
            $table->integer('pet_status')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->text('observations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protectors');
    }
};
