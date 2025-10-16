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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->tinyInteger('status')->default(1);
            $table->string('legal_name');
            $table->string('business_name');
            $table->string('document', 14);
            $table->string('municipal_registration')->nullable();
            $table->string('state_registration')->nullable();
            $table->string('representative');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
