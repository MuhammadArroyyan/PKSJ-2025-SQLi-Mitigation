<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method \Illuminate\Database\Eloquent\Relations\HasMany prodi()
 * @method \Illuminate\Database\Eloquent\Relations\HasOne mahasiswa()
 */
class _2301020109_User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the prodi for the user (as kaprodi)
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prodi()
    {
        return $this->hasMany(Prodi::class, 'id_user_kaprodi', 'id_user');
    }

    /**
     * Get the mahasiswa record for the user
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id_user', 'id_user');
    }
}
