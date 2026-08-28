<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;;

use Illuminate\Database\Eloquent\Model;

class DetailSktm extends Model
{
    use HasFactory;

    protected $table = 'detail_sktm';

    protected $fillable = [
        'pengajuan_id',
        'jumlah_anggota_keluarga',
        'penghasilan_per_builan',
        'keperluan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_anggota_keluarga' => 'integer',
            'penghasilan_per_perbulan' => 'decimal:2',
        ];
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
