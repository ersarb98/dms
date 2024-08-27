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
        Schema::create('t_order_receiving_hdr', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing
            $table->string('order_number', 50)->unique(); // Order Number, assuming it needs to be unique
            $table->string('tipe_dokumen', 50); // Tipe Dokumen
            $table->string('nomor_dokumen', 50); // Nomor Dokumen
            $table->date('tanggal_dokumen'); // Tanggal Dokumen
            $table->string('pengirim', 100); // Pengirim
            $table->string('shipping_line', 100); // Shipping Line
            $table->string('voyage', 50); // Voyage
            $table->string('vessel', 100); // Vessel
            $table->string('asal', 100); // Asal
            $table->string('moda', 50)->nullable(); // Moda, optional
            $table->dateTime('waktu_gate_in'); // Waktu Gate In
            $table->text('catatan')->nullable(); // Catatan, optional
            $table->enum('status', ['Y', 'N', 'X'])->default('N'); // Status field
            $table->timestamps(); // created_at and updated_at columns
            $table->softDeletes(); // deleted_at column for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_order_receiving_hdr');
    }
};
