<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengumpulan_praktikum', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('id_praktikum')->constrained('praktikum')->onDelete('cascade');
            $table->foreignId('id_mahasiswa')->constrained('users')->onDelete('cascade');

            // Isi Submission
            $table->longText('kode_program');
            $table->longText('output')->nullable();
            $table->text('penjelasan');

            // Penilaian
            $table->integer('nilai')->nullable();
            $table->text('feedback_dosen')->nullable();

            // Status
            $table->enum('status', ['submitted', 'dinilai', 'revisi'])
                ->default('submitted');

            $table->timestamps();

            // Supaya 1 mahasiswa 1 submission per praktikum
            $table->unique(['id_praktikum', 'id_mahasiswa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_praktikum');
    }
};
