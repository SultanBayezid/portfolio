<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visibilities', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique();
            $table->string('section_name');
            $table->string('description')->nullable();
            $table->boolean('visible')->default(true);
            $table->enum('type', ['section', 'nav', 'feature'])->default('section');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visibilities');
    }
};
