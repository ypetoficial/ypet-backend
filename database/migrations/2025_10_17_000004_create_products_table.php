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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('name');

            // Domain attributes
            $table->string('category'); // enum via validation: vaccine, vermifuge, medication, supplement, food, other
            $table->string('manufacturer')->nullable();
            $table->string('target_species')->nullable(); // enum via validation: dog, cat, both
            $table->string('unit')->nullable(); // enum via validation: ml, mg, g, kg, unidade, dose

            // Stock & control
            $table->integer('stock')->default(0);
            $table->boolean('has_stock_control')->default(true);
            $table->integer('min_stock')->default(0);

            // Expiration & lot
            $table->date('expiration_date')->nullable();
            $table->string('lot_number')->nullable();

            // Supply calculation parameters
            $table->decimal('standard_quantity', 10, 2)->nullable();
            $table->decimal('reference_weight', 10, 2)->nullable();
            $table->integer('standard_days')->nullable();
            $table->string('base_unit')->nullable(); // enum via validation: ml, g, kg

            // Misc
            $table->text('observations')->nullable();
            $table->boolean('status')->default(true);

            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();

            // indexes
            $table->index(['category']);
            $table->index(['status']);
            $table->index(['name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
