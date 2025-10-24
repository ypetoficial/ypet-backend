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
        Schema::create('applications', function (Blueprint $table) {
            $table->id(); // bigint unsigned primary key
            $table->uuid()->unique(); // identificador único universal

            $table->foreignId('animal_id')->constrained('animals'); // referência ao animal
            $table->foreignId('product_id')->constrained('products'); // referência ao produto/insumo

            $table->string('category'); // ProductCategoryEnum
            $table->date('application_date'); // data da aplicação

            $table->decimal('animal_weight', 10, 2)->nullable(); // peso do animal na aplicação
            $table->decimal('estimated_days_supply', 10, 2)->nullable(); // dias estimados de suprimento

            $table->foreignId('responsible_user_id')->constrained('users'); // usuário responsável

            $table->string('lot_number')->nullable(); // lote do produto
            $table->date('expiration_date')->nullable(); // validade do produto
            $table->string('supplement_type', 255)->nullable(); // tipo de suplemento (mesmo da products)
            $table->string('via_administration', 255)->nullable(); // via de administração
            $table->date('next_dose_date')->nullable(); // próxima dose
            $table->string('frequency', 255)->nullable(); // frequência
            $table->integer('period_days')->nullable(); // duração do tratamento em dias
            $table->text('dosage_observations')->nullable(); // observações de dosagem
            $table->decimal('daily_quantity_g_per_kg', 10, 3)->nullable(); // quantidade diária por kg
            $table->integer('meals_per_day')->nullable(); // refeições por dia
            $table->text('observations')->nullable(); // observações gerais

            $table->timestamps(); // created_at e updated_at

            // Índice auxiliar para buscas comuns
            $table->index(['animal_id', 'product_id', 'category', 'application_date'], 'applications_search_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
