<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class _2301020002_Fakultas extends Model
{
    protected $table = 'fakultas';
    protected $primaryKey = 'id_fakultas';
    protected $fillable = ['nama_fakultas'];

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class, 'id_fakultas');
    }
}
