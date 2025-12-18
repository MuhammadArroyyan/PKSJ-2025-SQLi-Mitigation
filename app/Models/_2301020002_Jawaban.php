<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class _2301020002_Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $primaryKey = 'id_jawaban';
    protected $fillable = ['nim', 'id_pertanyaan', 'id_pilihan_jawaban_pertanyaan', 'id_periode'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }

    public function pilihanJawaban()
    {
        return $this->belongsTo(PilihanJawabanPertanyaan::class, 'id_pilihan_jawaban_pertanyaan');
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeKuisioner::class, 'id_periode');
    }
}
