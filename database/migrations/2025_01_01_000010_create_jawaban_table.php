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
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->string('nim');
            $table->foreignId('id_pertanyaan')->constrained('pertanyaan', 'id_pertanyaan')->onDelete('cascade');
            $table->foreignId('id_pilihan_jawaban_pertanyaan')->constrained('pilihan_jawaban_pertanyaan', 'id_pilihan_jawaban')->onDelete('cascade');
            $table->foreignId('id_periode')->constrained('periode_kuisioner', 'id_periode')->onDelete('cascade');
            $table->timestamps();
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->unique(['nim', 'id_pertanyaan', 'id_periode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban');
    }
};
