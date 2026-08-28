<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;;

use Illuminate\Database\Eloquent\Model;

class AnggotaPengajuan extends Model
{
    use HasFactory;

    protected $table = 'anggota_pengajuan';

    protected $fillable = [
        'pengajuan_id',
        'nik',
        'nama_lengkap',
        'hubungan',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
