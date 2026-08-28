<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;;

use Illuminate\Database\Eloquent\Model;

class DetailPengantarKtp extends Model
{
    use HasFactory;

    protected $table = 'detail_pengantar_ktp';

    protected $fillable = [
        'pengajuan_id',
        'keperluan_ktp',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
