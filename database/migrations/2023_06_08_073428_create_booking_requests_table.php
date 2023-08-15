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
        Schema::create('booking_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->default(0);
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('number_of_rooms');
            $table->decimal('unit_fare', 28, 8)->default(0.00000000);
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->decimal('tax_charge', 28, 8)->default(0.00000000);
            $table->decimal('total_amount', 28, 8)->default(0.00000000);
            $table->tinyInteger('status')->default(0)->comment('0 = pending, 1 = approved, 3 = cancelled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_requests');
    }
};
