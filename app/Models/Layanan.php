<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_layanan',
        'deskripsi',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'aktif' => 'boolean',
        ];
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
