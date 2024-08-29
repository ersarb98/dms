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
        Schema::create('t_job_operation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_job_container')->constrained('t_job_container');
            $table->string('no_cont');
            $table->string('jenis_job');
            $table->timestamp('wk_status_created');
            $table->string('lokasi_awal');
            $table->string('tier_awal');
            $table->string('lokasi_akhir');
            $table->string('tier_akhir');
            $table->string('status');
            $table->timestamp('wk_status_done')->nullable();
            $table->softDeletes(); // Adds deleted_at column for soft delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_job_operation');
    }
};
