<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function pengajuanDiproses()
    {
        return $this->hasMany(Pengajuan::class, 'diproses_oleh');
    }

    public function riwayatPengajuan()
    {
        return $this->hasMany(RiwayatPengajuan::class);
    }

    public function suratDiterbitkan()
    {
        return $this->hasMany(Surat::class, 'diterbitkan_oleh');
    }

    public function beritas()
    {
        return $this->hasMany(Berita::class,);
    }
}
