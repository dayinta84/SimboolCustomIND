<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marketplaces', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // Shopee, TikTok, Instagram, Linktree
            $table->string('username')->nullable();
            $table->string('followers')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('icon')->nullable(); // Simpan path gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marketplaces');
    }
};
