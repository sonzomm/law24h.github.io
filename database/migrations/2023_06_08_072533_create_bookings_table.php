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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number', 40)->nullable();
            $table->integer('user_id')->default(0);
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->text('guest_details')->nullable();
            $table->decimal('tax_charge', 28, 8)->default(0.00000000);
            $table->decimal('booking_fare', 28, 8)->default(0.00000000)->comment('Total of room * nights fare');
            $table->decimal('service_cost', 28, 8)->default(0.00000000);
            $table->decimal('extra_charge', 28, 8)->default(0.00000000);
            $table->decimal('extra_charge_subtracted', 28, 8)->default(0.00000000);
            $table->decimal('paid_amount', 28, 8)->default(0.00000000);
            $table->decimal('cancellation_fee', 28, 8)->default(0.00000000);
            $table->decimal('refunded_amount', 28, 8)->default(0.00000000);
            $table->tinyInteger('key_status')->default(0);
            $table->tinyInteger('status')->unsigned()->default(0)->comment('1 = success/active; 3 = cancelled; 9 = checked Out');
            $table->datetime('checked_in_at')->nullable();
            $table->datetime('checked_out_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
