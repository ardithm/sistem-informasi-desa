<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_pengajuan',
        'penduduk_id',
        'layanan_id',
        'no_hp',
        'status',
        'catatan_admin',
        'diproses_oleh',
        'tanggal_diproses',
        'tanggal_selesai',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_diproses' => 'datetime',
            'tanggal_selesai' => 'datetime',
        ];
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function diprosesOleh()
    {
        return $this->belongsTo(User::class, 'diproses_oleh');
    }

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class);
    }

    public function detailDomisili()
    {
        return $this->hasOne(DetailDomisili::class);
    }

    public function detailPengantarKtp()
    {
        return $this->hasOne(DetailPengantarKtp::class);
    }

    public function detailPengantarKk()
    {
        return $this->hasOne(DetailPengantarKk::class);
    }

    public function anggotaPengajuan()
    {
        return $this->hasMany(AnggotaPengajuan::class);
    }

    public function detailSktm()
    {
        return $this->hasOne(DetailSktm::class);
    }

    public function riwayatPengajuans()
    {
        return $this->hasMany(RiwayatPengajuan::class);
    }

    public function surat()
    {
        return $this->hasOne(Surat::class);
    }
}
