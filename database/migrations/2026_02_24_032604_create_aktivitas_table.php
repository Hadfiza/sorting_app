<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('folder'); // contoh: bubble
            $table->string('slug');   // contoh: quiz
            $table->integer('urutan');
            $table->enum('tipe', ['materi','quiz','praktikum']);
            $table->integer('durasi')->nullable(); // menit

            $table->timestamps();

            $table->unique(['folder','slug']); // supaya tidak bentrok
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};