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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('bellnumber')->nullable();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('hall')->nullable();
            $table->string('room')->nullable();
            $table->string('date')->nullable();
            $table->decimal('price', 10,2)->nullable();
            $table->decimal('paied', 10,2)->nullable();
            $table->decimal('remaining', 10,2)->nullable();
            $table->decimal('tax', 5,2)->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
