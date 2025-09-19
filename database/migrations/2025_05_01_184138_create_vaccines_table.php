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
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('name');
            $table->string('type');
            $table->string('status');
            $table->string('purpose')->nullable();
            $table->dateTime('alert_at')->nullable();
            $table->boolean('alert_sent')->nullable();
            $table->string('target_specie');
            $table->integer('dose_count');
            $table->integer('dose_interval');
            $table->string('manu_facturer')->nullable();
            $table->date('expiration_date');
            $table->string('batch');
            $table->foreignId('updated_by')->nullable()->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccines');
    }
};
