<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hire_banners', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->default("I'm available for projects");
            $table->text('subtext')->nullable();
            $table->string('button_label')->default('Hire Me');
            $table->string('button_url')->default('https://lastlineweb.com');
            $table->string('button_icon')->default('bi-send');
            $table->boolean('visible')->default(true);
            $table->string('gradient_start', 7)->default('#4f63f0');
            $table->string('gradient_end', 7)->default('#10b98a');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hire_banners');
    }
};
