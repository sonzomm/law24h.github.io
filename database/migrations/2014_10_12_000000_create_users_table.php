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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 40)->nullable();
            $table->string('lastname', 40)->nullable();
            $table->string('username', 40)->nullable();
            $table->string('email', 40)->nullable();
            $table->string('country_code', 40)->nullable();
            $table->string('mobile', 40)->nullable();
            $table->string('password', 255);
            $table->text('address')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('ev')->default(0);
            $table->tinyInteger('sv')->default(1);
            $table->tinyInteger('profile_complete')->default(0);
            $table->string('ver_code', 40)->nullable();
            $table->datetime('ver_code_send_at')->nullable();
            $table->string('ban_reason', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
