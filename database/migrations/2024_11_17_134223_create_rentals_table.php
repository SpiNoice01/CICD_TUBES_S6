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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id('id_rental');
            $table->foreignId('id_renter')->constrained('renters', 'id_renter')->cascadeOnDelete();
            $table->date('rental_date');
            $table->date('return_date');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'rented', 'completed', 'canceled'])->default('pending');
            $table->string('payment_proof', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
