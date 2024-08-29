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
        Schema::create('t_job_container', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_job_hdr')->constrained('t_job_hdr');
            $table->string('no_cont');
            $table->string('size');
            $table->string('type_cont');
            $table->softDeletes(); // Adds deleted_at column for soft delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_job_container');
    }
};
