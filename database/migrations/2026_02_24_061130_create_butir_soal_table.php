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
        Schema::create('butir_soal', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_aktivitas')
                ->constrained('aktivitas')
                ->onDelete('cascade');

            $table->enum('tipe',['pilgan','essay','truefalse','dragdrop']);

            $table->integer('nomor'); // WAJIB
            $table->text('pertanyaan');

            $table->text('pilihan_a')->nullable();
            $table->text('pilihan_b')->nullable();
            $table->text('pilihan_c')->nullable();
            $table->text('pilihan_d')->nullable();

            $table->string('jawaban_benar'); // a,b,c,d

            $table->unique(['id_aktivitas', 'nomor']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('butir_soal');
    }
};
