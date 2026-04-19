<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('praktikum', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_aktivitas')
                ->constrained('aktivitas')
                ->onDelete('cascade');

            $table->string('judul');
            $table->text('deskripsi');
            $table->string('file_soal')->nullable();
            $table->dateTime('batas_waktu')->nullable();
            $table->integer('bobot')->default(100);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('praktikum');
    }
};
