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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name', 40)->nullable();
            $table->string('cur_text', 40)->nullable()->comment('currency text');
            $table->string('cur_sym', 40)->nullable()->comment('currency symbol');
            $table->string('email_from', 40)->nullable();
            $table->text('email_template')->nullable();
            $table->string('base_color', 40)->nullable();
            $table->text('mail_config')->nullable()->comment('email configuration');
            $table->text('global_shortcodes')->nullable();
            $table->tinyInteger('ev')->default(0)->comment('email verification, 0 - dont check, 1 - check');
            $table->tinyInteger('en')->default(0)->comment('email notification, 0 - dont send, 1 - send');
            $table->decimal('tax', 5, 2)->default(0.00);
            $table->string('tax_name', 40)->nullable();
            $table->tinyInteger('force_ssl')->default(0);
            $table->tinyInteger('secure_password')->default(0);
            $table->tinyInteger('agree')->default(0);
            $table->tinyInteger('registration')->default(0)->comment('0: Off, 1: On');
            $table->string('active_template', 40)->nullable();
            $table->text('system_info')->nullable();
            $table->time('checkin_time')->nullable();
            $table->time('checkout_time')->nullable();
            $table->unsignedInteger('upcoming_checkin_days')->default(1);
            $table->unsignedInteger('upcoming_checkout_days')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
