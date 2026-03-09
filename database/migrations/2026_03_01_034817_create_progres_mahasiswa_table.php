<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progres_mahasiswa', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_mahasiswa')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('id_aktivitas')
                  ->constrained('aktivitas')
                  ->onDelete('cascade');

            $table->enum('status', ['belum','selesai'])
                  ->default('belum');

            $table->integer('nilai')->nullable(); // untuk quiz
            $table->timestamps();

            $table->unique(['id_mahasiswa','id_aktivitas']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progres_mahasiswa');
    }
};