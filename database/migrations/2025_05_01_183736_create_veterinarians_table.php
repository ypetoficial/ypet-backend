<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('veterinarians', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->nullable()->unique()->index();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('crmv')->index();
            $table->string('profile_picture')->nullable();
            $table->string('linked_institution')->nullable();
            $table->tinyInteger('linked_type')->nullable()->comment('1: Efetivo, 2: Voluntário, 3: Conveniado');
            $table->text('observations')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veterinarians');
    }
};
