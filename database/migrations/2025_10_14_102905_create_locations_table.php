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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('location_name');
            $table->string('location_type');
            $table->string('responsible_name');
            $table->bigInteger('phone');
            $table->string('email')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('bank_account_or_pix')->nullable();
            $table->tinyInteger('status');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
