<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;;


use Illuminate\Database\Eloquent\Model;

class DetailDomisili extends Model
{
    use HasFactory;

    protected $table = 'detail_domisili';

    protected $fillable = [
        'pengajuan_id',
        'alamat_domisili',
        'keperluan',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
