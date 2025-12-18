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
        Schema::create('pertanyaan_periode_kuisioner', function (Blueprint $table) {
            $table->id('id_pertanyaan_periode_kuisioner');
            $table->foreignId('id_periode_kuisioner')->constrained('periode_kuisioner', 'id_periode');
            $table->foreignId('id_pertanyaan')->constrained('pertanyaan', 'id_pertanyaan');
            $table->timestamps();
            $table->unique(['id_periode_kuisioner', 'id_pertanyaan'], 'pk_periode_pertanyaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_periode_kuisioner');
    }
};
