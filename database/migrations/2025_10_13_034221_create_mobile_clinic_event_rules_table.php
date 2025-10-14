<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobile_clinic_event_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobile_clinic_event_id')->constrained('mobile_clinic_events');
            $table->string('specie')->index();
            $table->string('gender')->index();
            $table->integer('max_registrations');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobile_clinic_event_rules');
    }
};
