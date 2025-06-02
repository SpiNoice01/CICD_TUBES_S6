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
        Schema::create('package_details', function (Blueprint $table) {
            $table->foreignId('id_package')->constrained('packages', 'id_package')->cascadeOnDelete();
            $table->foreignId('id_product')->constrained('products', 'id_product')->cascadeOnDelete();
            $table->integer('quantity');
            $table->primary(['id_package', 'id_product']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_details');
    }
};
