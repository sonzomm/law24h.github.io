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
        Schema::create('used_extra_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained();
            $table->foreignId('extra_service_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->foreignId('booked_room_id')->constrained();
            $table->unsignedBigInteger('qty');
            $table->decimal('unit_price', 28, 8);
            $table->decimal('total_amount', 28, 8);
            $table->date('service_date')->nullable();
            $table->foreignId('admin_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('used_extra_services');
    }
};
