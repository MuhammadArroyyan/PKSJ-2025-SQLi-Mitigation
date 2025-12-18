<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilihanJawabanPertanyaan extends Model
{
    protected $table = 'pilihan_jawaban_pertanyaan';
    protected $primaryKey = 'id_pilihan_jawaban';
    protected $fillable = ['deskripsi_pilihan', 'id_pertanyaan'];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_pilihan_jawaban_pertanyaan');
    }
}
