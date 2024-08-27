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
        Schema::create('t_order_receiving_dtl', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing
            $table->unsignedBigInteger('order_receiving_hdr_id'); // Foreign key to the header table
            $table->string('no_cont', 50); // Container Number
            $table->string('type', 50); // Container Type
            $table->string('size', 20); // Container Size
            $table->timestamps(); // created_at and updated_at columns

            // Define foreign key constraint
            $table->foreign('order_receiving_hdr_id')
                  ->references('id')
                  ->on('t_order_receiving_hdr')
                  ->onDelete('cascade'); // Optional: delete related containers if the order is deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_order_receiving_dtl');
    }
};
