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
        Schema::create('t_order_delivery_dtl', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('order_id'); // Foreign key linking to t_order_delivery_hdr
            $table->string('no_cont'); // Nomor Kontainer
            $table->string('size'); // Ukuran Kontainer
            $table->string('type'); // Jenis Kontainer
            $table->timestamps(); // created_at, updated_at

            // Define foreign key constraint
            $table->foreign('order_id')->references('id')->on('t_order_delivery_hdr')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_order_delivery_dtl');
    }
};
