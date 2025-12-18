<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanPeriodeKuisioner extends Model
{
    protected $table = 'pertanyaan_periode_kuisioner';
    protected $primaryKey = 'id_pertanyaan_periode_kuisioner';
    protected $fillable = ['id_periode_kuisioner', 'id_pertanyaan'];

    public function periode()
    {
        return $this->belongsTo(PeriodeKuisioner::class, 'id_periode_kuisioner', 'id_periode');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }
}
