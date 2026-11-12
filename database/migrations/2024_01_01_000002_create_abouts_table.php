<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('section_label')->default('About Me');
            $table->string('section_title')->default('Senior Full Stack Software Engineer');
            $table->text('paragraph_1')->nullable();
            $table->text('paragraph_2')->nullable();
            $table->string('name')->default('Sultan Bayezid');
            $table->string('place_of_birth')->nullable();
            $table->string('nationality')->default('Bangladeshi');
            $table->string('marital_status')->nullable();
            $table->string('profession')->default('Senior Full Stack Software Engineer');
            $table->string('contact_no')->default('+880 1XXX-XXXXXX');
            $table->string('email')->default('sultanbayezidai@gmail.com');
            $table->string('location')->default('Bangladesh');
            $table->string('experience')->default('5+ Years');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
