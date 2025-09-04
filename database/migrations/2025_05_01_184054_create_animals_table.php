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
            $table->foreignId('tenant_id')->nullable()->constrained();
            $table->foreignId('company_id')->nullable()->constrained();
            $table->foreignId('tutor_id')->nullable()->constrained('users');

            $table->string('name');
            $table->string('species')->index();
            $table->string('gender')->index();
            $table->float('weight');
            $table->date('birth_date');
            $table->boolean('castrated');
            $table->date('castration_at')->nullable();
            $table->string('castration_site')->nullable();
            $table->string('size')->nullable()->index();
            $table->string('color')->nullable();
            $table->string('coat')->nullable();
            $table->string('characteristics')->nullable();
            $table->string('surname')->nullable();
            $table->date('entry_date')->nullable();
            $table->string('picture')->nullable();
            $table->string('collection_site')->nullable();
            $table->string('collection_reason')->nullable();
            $table->string('microchip_number')->nullable()->unique()->index();
            $table->string('registration_number')->nullable()->unique()->index();
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
