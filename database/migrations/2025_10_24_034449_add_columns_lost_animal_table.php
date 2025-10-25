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
        Schema::table('lost_animals', function (Blueprint $table) {
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('animal_id')->constrained('animals');
            $table->date('lost_at')->nullable();;
            $table->time('lost_time')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('lost_animals', function (Blueprint $table) {
            $table->dropColumn([
                'created_by',
                'animal_id',
                'lost_at',
                'lost_time'
            ]);
        });
    }
};
