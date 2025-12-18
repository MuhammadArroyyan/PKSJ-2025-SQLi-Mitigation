<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class _2301020106_Pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';
    protected $fillable = ['pertanyaan', 'id_prodi'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function pilihanJawaban()
    {
        return $this->hasMany(PilihanJawabanPertanyaan::class, 'id_pertanyaan');
    }

    public function periode()
    {
        return $this->belongsToMany(PeriodeKuisioner::class, 'pertanyaan_periode_kuisioner', 'id_pertanyaan', 'id_periode_kuisioner', 'id_pertanyaan', 'id_periode');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_pertanyaan');
    }
}
