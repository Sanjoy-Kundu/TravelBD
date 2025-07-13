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
        Schema::table('packages', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('status')->after('status');
            $table->date('end_date')->nullable()->after('start_date')->after('start_date');
            $table->unsignedInteger('total_sold')->default(0)->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'end_date', 'total_sold']);
        });
    }
};
