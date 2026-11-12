<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->default('#');
            $table->string('initials', 3)->default('P');
            $table->string('color_start', 7)->default('#dbeafe');
            $table->string('color_end', 7)->default('#4f63f0');
            $table->string('categories')->nullable();
            $table->text('description')->nullable();
            $table->string('github_url')->nullable();
            $table->string('technologies')->nullable();
            $table->string('year', 4)->nullable();
            $table->string('status')->default('Live');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
