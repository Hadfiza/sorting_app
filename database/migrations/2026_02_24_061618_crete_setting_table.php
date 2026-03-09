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
        Schema::create('setting', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_dosen')
                ->constrained('dosen')
                ->onDelete('cascade');

            $table->integer('kkm_quiz')->default(75);
            $table->integer('kkm_evaluasi')->default(75);

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
