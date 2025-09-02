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
            $table->string('uuid')->nullable()->unique();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade'); 
            $table->string('name');
            $table->string('document')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('phone')->nullable();     
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->integer('special_permissions')->nullable();
            $table->boolean('status');
            $table->integer('pet_status')->nullable();   
            $table->foreignId('updated_by')->nullable()->constrained('users');
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
