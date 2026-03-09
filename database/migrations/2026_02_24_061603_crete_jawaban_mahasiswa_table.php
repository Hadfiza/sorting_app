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
        Schema::create('jawaban_mahasiswa', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_mahasiswa')
                ->constrained('mahasiswa')
                ->onDelete('cascade');

            $table->foreignId('id_aktivitas')
                ->constrained('aktivitas')
                ->onDelete('cascade');

            $table->integer('skor'); // 0 - 100
            $table->boolean('status_lulus');
            $table->integer('attempt')->default(1);

            $table->json('detail_jawaban')->nullable();

            $table->timestamp('waktu_mulai')->nullable();
            $table->timestamp('waktu_selesai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
