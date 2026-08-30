<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;;

use Illuminate\Database\Eloquent\Model;

class DetailPengantarKk extends Model
{
    use HasFactory;

    protected $table = 'detail_pengantar_kk';

    protected $fillable = [
        'pengajuan_id',
        'nomor_kk',
        'keperluan',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function anggotaPengajuan()
    {
        return $this->hasMany(AnggotaPengajuan::class, 'pengajuan_id', 'pengajuan_id');
    }
}
