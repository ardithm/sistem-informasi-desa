<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenduduk = Penduduk::where(
            'status_penduduk',
            'aktif'
        )->count();

        $totalPengajuan = Pengajuan::count();

        $pengajuanMenunggu = Pengajuan::where(
            'status',
            'menunggu'
        )->count();

        $pengajuanPerluPerbaikan = Pengajuan::where(
            'status',
            'perlu_perbaikan'
        )->count();

        $pengajuanDiproses = Pengajuan::where(
            'status',
            'diproses'
        )->count();

        $pengajuanSelesai = Pengajuan::where(
            'status',
            'selesai'
        )->count();

        $pengajuanDitolak = Pengajuan::where(
            'status',
            'ditolak'
        )->count();

        $pengajuanTerbaru = Pengajuan::with([
            'penduduk',
            'layanan',
        ])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalPenduduk',
            'totalPengajuan',
            'pengajuanMenunggu',
            'pengajuanPerluPerbaikan',
            'pengajuanDiproses',
            'pengajuanSelesai',
            'pengajuanDitolak',
            'pengajuanTerbaru'
        ));
    }
}
