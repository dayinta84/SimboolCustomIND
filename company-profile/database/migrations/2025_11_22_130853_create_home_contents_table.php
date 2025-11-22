<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('home_contents', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();     // Judul besar
        $table->string('subtitle')->nullable();  // Teks kecil
        $table->text('why_1_title')->nullable();
        $table->text('why_1_desc')->nullable();
        $table->text('why_2_title')->nullable();
        $table->text('why_2_desc')->nullable();
        $table->text('why_3_title')->nullable();
        $table->text('why_3_desc')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_contents');
    }
};