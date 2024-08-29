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
        Schema::create('t_job_hdr', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('nomor_order');
            $table->string('status');
            $table->softDeletes(); // Adds deleted_at column for soft delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_job_hdr');
    }
};
