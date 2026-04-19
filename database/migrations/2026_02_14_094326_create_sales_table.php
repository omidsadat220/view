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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('employee_id');
            $table->integer('quantity');
            $table->decimal('buy_price', 10,2);
            $table->decimal('sale_price', 10,2);
            $table->decimal('charges', 10,2)->nullable();
            $table->string('province');
            $table->decimal('profit', 10,2)->nullable();
            $table->date('date');
            $table->string('bill')->nullable();
            $table->enum('status', ['pending','completed','cancelled'])->default('pending');
            $table->decimal('total', 10,2);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('employee_id')->references('id')->on('employees')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
