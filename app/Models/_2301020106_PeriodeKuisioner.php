<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class _2301020106_PeriodeKuisioner extends Model
{
    protected $table = 'periode_kuisioner';
    protected $primaryKey = 'id_periode';
    protected $fillable = ['keterangan', 'status_periode'];

    public function pertanyaan()
    {
        return $this->belongsToMany(Pertanyaan::class, 'pertanyaan_periode_kuisioner', 'id_periode_kuisioner', 'id_pertanyaan', 'id_periode', 'id_pertanyaan');
    }

    public function pertanyaanPeriode()
    {
        return $this->hasMany(PertanyaanPeriodeKuisioner::class, 'id_periode_kuisioner', 'id_periode');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_periode');
    }
}
