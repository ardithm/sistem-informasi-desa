<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;;

use Illuminate\Database\Eloquent\Model;


class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_perkawinan',
        'pekerjaan',
        'alamat',
        'rt',
        'rw',
        'status_penduduk',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
