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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name', 40)->nullable();
            $table->string('email', 40)->nullable();
            $table->string('ticket', 40)->nullable();
            $table->string('subject', 255)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0: Open, 1: Answered, 2: Replied, 3: Closed');
            $table->tinyInteger('priority')->default(0)->comment('1 = Low, 2 = medium, 3 = high');
            $table->datetime('last_reply')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
