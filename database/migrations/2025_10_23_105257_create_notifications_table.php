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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['alerta', 'lembrete', 'confirmacao', 'informativa']);
            $table->string('action_label')->nullable();
            $table->string('action_target')->nullable();
            $table->enum('status', ['lida', 'nao_lida'])->default('nao_lida');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            // Índices para performance
            $table->index(['user_id', 'created_at']);
            $table->index('status');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
