<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('display_name')->default('Sultan Bayezid');
            $table->string('status_badge')->default('Available for projects');
            $table->string('avatar_initials', 4)->default('SB');
            $table->string('sub_line')->default('Sultan');
            $table->string('hire_btn_label')->default('Hire Me');
            $table->string('hire_btn_url')->default('https://lastlineweb.com');
            $table->string('view_work_label')->default('View Work');
            $table->string('view_work_target')->default('#projects');
            $table->string('facebook_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('website_url')->nullable();
            $table->json('typing_words')->nullable();
            $table->string('section_label')->default('Available for projects');
            $table->string('blob_color_1', 7)->default('#dbeafe');
            $table->string('blob_color_2', 7)->default('#ede9fe');
            $table->string('avatar_gradient', 7)->default('#4f63f0');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
