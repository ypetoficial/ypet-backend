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
        Schema::table('adoption_visits', function (Blueprint $table) {

            $table->time('visit_time')->nullable();

            $table->dropForeign(['user_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adoption_visits', function (Blueprint $table) {

            $table->dropColumn('visit_time');

            $table->dropForeign(['user_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('citizens')
                ->onDelete('cascade');
        });
    }
};
