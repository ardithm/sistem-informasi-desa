<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'nomor_surat',
        'tanggal_terbit',
        'file_pdf',
        'diterbitkan_oleh',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'date',
        ];
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    public function diterbitkanOleh()
    {
        return $this->belongsTo(User::class, 'diterbitkan_oleh');
    }
}
