<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->default('Sultan Bayezid — Senior Full Stack Software Engineer');
            $table->text('meta_description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('robots')->default('index, follow');
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('twitter_handle')->nullable();
            $table->string('ga4_id')->nullable();
            $table->string('gsc_verify')->nullable();
            $table->string('fb_pixel')->nullable();
            $table->string('hotjar_id')->nullable();
            $table->string('schema_type')->default('Person');
            $table->text('json_ld')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
