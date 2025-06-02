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
            $table->id('id_product');
            $table->foreignId('id_brand')->constrained('brands', 'id_brand')->cascadeOnDelete();
            $table->foreignId('id_category')->constrained('categories', 'id_category')->cascadeOnDelete();
            $table->string('product_name', 200);
            $table->text('description')->nullable();
            $table->decimal('rental_price', 10, 2);
            $table->integer('stock');
            $table->string('image', 255)->nullable();
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
