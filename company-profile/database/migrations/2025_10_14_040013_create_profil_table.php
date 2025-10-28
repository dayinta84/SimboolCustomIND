<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();      // Judul atau nama bagian profil
            $table->text('tentang')->nullable();      // Tentang kami
            $table->text('visi')->nullable();         // Visi
            $table->text('misi')->nullable();         // Misi
            //$table->text('layanan')->nullable();      // Layanan
            $table->string('image')->nullable();      // Gambar profil
            $table->string('image_tentang')->nullable(); // Gambar tentang kami
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil');
    }
};

