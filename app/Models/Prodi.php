<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'id_prodi';
    protected $fillable = ['nama_prodi', 'id_user_kaprodi', 'id_jurusan'];

    public function kaprodi()
    {
        return $this->belongsTo(User::class, 'id_user_kaprodi');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_prodi');
    }

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'id_prodi');
    }
}
