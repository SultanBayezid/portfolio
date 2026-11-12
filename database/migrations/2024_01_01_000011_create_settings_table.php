<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->default('Sultan Bayezid — Portfolio');
            $table->string('site_logo')->default('Sultan Bayezid');
            $table->string('copyright')->default('© 2026 Sultan Bayezid. All rights reserved.');
            $table->string('language')->default('English');
            $table->string('timezone')->default('Asia/Dhaka');
            $table->boolean('dark_mode_toggle')->default(false);
            $table->boolean('dark_mode_default')->default(false);
            $table->string('primary_accent', 7)->default('#4f63f0');
            $table->string('secondary_accent', 7)->default('#10b98a');
            $table->string('heading_color', 7)->default('#1a1d2e');
            $table->string('background', 7)->default('#ffffff');
            $table->string('body_font')->default('Montserrat');
            $table->string('heading_font')->default('Montserrat');
            $table->json('filter_categories')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
