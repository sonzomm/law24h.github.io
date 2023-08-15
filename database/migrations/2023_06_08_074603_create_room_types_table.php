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
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('total_adult')->default(0);
            $table->integer('total_child')->default(0);
            $table->decimal('fare', 28, 16)->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->text('beds')->nullable();
            $table->decimal('cancellation_fee', 28, 8)->default(0);
            $table->text('cancellation_policy')->nullable();
            $table->tinyInteger('feature_status')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
