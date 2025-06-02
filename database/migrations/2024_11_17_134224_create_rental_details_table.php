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
        Schema::create('rental_details', function (Blueprint $table) {
            $table->foreignId('id_rental')->constrained('rentals', 'id_rental')->cascadeOnDelete();
            $table->foreignId('id_product')->nullable()->constrained('products', 'id_product')->cascadeOnDelete();
            $table->foreignId('id_package')->nullable()->constrained('packages', 'id_package')->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('price_per_item', 10, 2);
            $table->primary(['id_rental']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_details');
    }
};
