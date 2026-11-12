<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('section_label')->default('Contact');
            $table->string('section_heading')->default('Get In Touch');
            $table->text('subtext')->nullable();
            $table->string('form_action')->nullable();
            $table->string('button_label')->default('Send Message');
            $table->boolean('show_name')->default(true);
            $table->boolean('show_email')->default(true);
            $table->boolean('show_subject')->default(true);
            $table->boolean('show_message')->default(true);
            $table->string('recaptcha_key')->nullable();
            $table->string('notification_email')->nullable();
            $table->text('auto_reply')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
