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
        Schema::create('booked_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained();
            $table->foreignId('room_type_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->date('booked_for')->nullable();
            $table->decimal('fare', 28, 8)->nullable();
            $table->decimal('tax_charge', 28, 8);
            $table->decimal('cancellation_fee', 28, 8);
            $table->unsignedTinyInteger('status')->default(0)->comment('1 = success/active; 3 = cancelled; 9 = checked Out');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_rooms');
    }
};
