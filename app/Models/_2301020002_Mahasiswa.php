<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class _2301020002_Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nim', 'nama_mahasiswa', 'id_user_mahasiswa', 'id_prodi'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user_mahasiswa');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'nim', 'nim');
    }
}
