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
        Schema::create('pilihan_jawaban_pertanyaan', function (Blueprint $table) {
            $table->id('id_pilihan_jawaban');
            $table->text('deskripsi_pilihan');
            $table->foreignId('id_pertanyaan')->constrained('pertanyaan', 'id_pertanyaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilihan_jawaban_pertanyaan');
    }
};
