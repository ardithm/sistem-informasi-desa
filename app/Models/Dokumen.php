<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengajuan_id',
        'jenis_dokumen',
        'nama_file',
        'path_file',
        'mime_type',
        'ukuran_file',
        'status_verifikasi',
        'catatan',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
