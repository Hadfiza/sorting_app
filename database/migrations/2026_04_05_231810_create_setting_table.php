<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_dosen')
                ->constrained('dosen')
                ->onDelete('cascade');
                
            // Menambahkan relasi ke aktivitas (kuis)
            $table->foreignId('id_aktivitas')
                ->constrained('aktivitas')
                ->onDelete('cascade');

            // KKM spesifik untuk aktivitas tersebut
            $table->integer('kkm')->default(75);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};