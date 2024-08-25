<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('t_order_delivery_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('order_number'); // Nomor Order
            $table->dateTime('release_time'); // Waktu Pengeluaran
            $table->string('document_type'); // Jenis Dokumen
            $table->string('document_number'); // Nomor Dokumen
            $table->date('document_date'); // Tanggal Dokumen
            $table->string('truck_type'); // Jenis Truk
            $table->string('license_plate'); // Nomor Polisi
            $table->string('destination'); // Tujuan
            $table->text('notes')->nullable(); // Catatan
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_order_delivery_hdr');
    }
};
