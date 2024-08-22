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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('MenuID'); // Primary key with custom column name
            $table->unsignedBigInteger('ParentMenuID')->nullable(); // Foreign key to self
            $table->string('DisplayMenu');
            $table->string('UrlMenu')->nullable();
            $table->integer('OrderMenu');
            $table->boolean('IsHeader')->default(false);
            $table->boolean('IsAccordion')->default(false);
            $table->timestamps();

            // Optionally, you can add a foreign key constraint if ParentMenuID should reference the same table
            $table->foreign('ParentMenuID')->references('MenuID')->on('menus')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
