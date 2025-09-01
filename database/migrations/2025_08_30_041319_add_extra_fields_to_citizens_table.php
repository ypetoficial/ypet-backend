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
        Schema::table('citizens', function (Blueprint $table) {
            $table->date('birth_date')->nullable();
            $table->string('gender', 10);
            $table->boolean('special_permissions');
            $table->boolean('can_report_abuse');
            $table->boolean('can_mobile_castration');
            $table->boolean('status');
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
            $table->dropColumn([
                'birth_date',
                'gender',
                'special_permissions',
                'can_report_abuse',
                'can_mobile_castration',
                'status',
            ]);
        });
    }
};
