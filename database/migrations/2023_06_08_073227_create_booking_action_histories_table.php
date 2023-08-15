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
        Schema::create('booking_action_histories', function (Blueprint $table) {
            $table->id();
            $table->string('remark', 40)->nullable();
            $table->string('details', 40)->nullable();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_action_histories');
    }
};
