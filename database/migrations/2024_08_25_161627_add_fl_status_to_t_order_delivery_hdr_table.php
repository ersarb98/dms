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
        Schema::table('t_order_delivery_hdr', function (Blueprint $table) {
            $table->enum('FL_STATUS', ['Y', 'N', 'X'])->default('N')->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_order_delivery_hdr', function (Blueprint $table) {
            $table->dropColumn('FL_STATUS');
        });
    }
};
