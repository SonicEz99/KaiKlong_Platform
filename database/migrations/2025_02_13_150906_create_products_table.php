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
            $table->id('product_id');
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->decimal('product_price', 10, 2);
            $table->enum('product_status', ['ยังมีสินค้าอยู่', 'สินค้าหมดแล้ว'])->default('ยังมีสินค้าอยู่');
            $table->enum('product_condition', ['มือหนึ่ง', 'มือสอง'])->default('มือหนึ่ง');
            $table->string('product_location');
            $table->string('product_phone');
            $table->foreignId('type_id')->constrained('types', 'type_id')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands', 'brand_id')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories', 'category_id')->onDelete('cascade');
            $table->timestamps();
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
