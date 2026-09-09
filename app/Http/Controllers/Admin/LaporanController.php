<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Penduduk;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Statistik Ringkas
        $totalPengajuan = Pengajuan::count();
        $pengajuanSelesai = Pengajuan::where('status', 'selesai')->count();
        $pengajuanProses = Pengajuan::whereIn('status', ['menunggu', 'diverifikasi', 'diproses', 'perlu_perbaikan'])->count();
        $pengajuanDitolak = Pengajuan::where('status', 'ditolak')->count();

        $totalPenduduk = Penduduk::count();
        $pendudukLakiLaki = Penduduk::where('jenis_kelamin', 'L')->count();
        $pendudukPerempuan = Penduduk::where('jenis_kelamin', 'P')->count();
        $pendudukAktif = Penduduk::where('status_penduduk', 'aktif')->count();

        // 2. Data Master untuk Filter
        $rtList = Penduduk::whereNotNull('rt')->where('rt', '!=', '')->distinct()->orderBy('rt')->pluck('rt');
        $layananList = Layanan::orderBy('nama_layanan')->get();

        // 3. Filter & Pratinjau Data Penduduk
        $filterRt = $request->get('rt');

        $pendudukQuery = Penduduk::query();
        if ($filterRt) {
            $pendudukQuery->where('rt', $filterRt);
        }
        $penduduks = $pendudukQuery->orderBy('rt')->orderBy('nama_lengkap')
            ->paginate(10, ['*'], 'penduduk_page')
            ->withQueryString();

        // 4. Filter & Pratinjau Rekap Surat Keluar
        $filterLayananId = $request->get('layanan_id');
        $tanggalDari = $request->get('tanggal_dari');
        $tanggalSampai = $request->get('tanggal_sampai');

        $suratQuery = Pengajuan::where('status', 'selesai')
            ->with(['penduduk', 'layanan', 'surat', 'diprosesOleh']);

        if ($filterLayananId) {
            $suratQuery->where('layanan_id', $filterLayananId);
        }
        if ($tanggalDari) {
            $suratQuery->whereDate('tanggal_selesai', '>=', $tanggalDari);
        }
        if ($tanggalSampai) {
            $suratQuery->whereDate('tanggal_selesai', '<=', $tanggalSampai);
        }

        $suratKeluar = $suratQuery->latest('tanggal_selesai')
            ->paginate(10, ['*'], 'surat_page')
            ->withQueryString();

        return view('admin.laporan.index', compact(
            'totalPengajuan',
            'pengajuanSelesai',
            'pengajuanProses',
            'pengajuanDitolak',
            'totalPenduduk',
            'pendudukLakiLaki',
            'pendudukPerempuan',
            'pendudukAktif',
            'rtList',
            'layananList',
            'filterRt',
            'penduduks',
            'filterLayananId',
            'tanggalDari',
            'tanggalSampai',
            'suratKeluar'
        ));
    }

    /**
     * Halaman cetak laporan data kependudukan berdasarkan RT.
     */
    public function cetakPenduduk(Request $request)
    {
        $rt = $request->get('rt');

        $query = Penduduk::query();
        if ($rt) {
            $query->where('rt', $rt);
        }

        $penduduks = $query->orderBy('rt')->orderBy('nama_lengkap')->get();

        $totalJiwa = $penduduks->count();
        $totalL = $penduduks->where('jenis_kelamin', 'L')->count();
        $totalP = $penduduks->where('jenis_kelamin', 'P')->count();
        $totalAktif = $penduduks->where('status_penduduk', 'aktif')->count();

        return view('admin.laporan.cetak-penduduk', compact(
            'penduduks',
            'rt',
            'totalJiwa',
            'totalL',
            'totalP',
            'totalAktif'
        ));
    }

    /**
     * Halaman cetak rekapitulasi surat yang keluar berdasarkan jenis surat & periode.
     */
    public function cetakSuratKeluar(Request $request)
    {
        $layananId = $request->get('layanan_id');
        $tanggalDari = $request->get('tanggal_dari');
        $tanggalSampai = $request->get('tanggal_sampai');

        $selectedLayanan = $layananId ? Layanan::find($layananId) : null;

        $query = Pengajuan::where('status', 'selesai')
            ->with(['penduduk', 'layanan', 'surat', 'diprosesOleh']);

        if ($layananId) {
            $query->where('layanan_id', $layananId);
        }
        if ($tanggalDari) {
            $query->whereDate('tanggal_selesai', '>=', $tanggalDari);
        }
        if ($tanggalSampai) {
            $query->whereDate('tanggal_selesai', '<=', $tanggalSampai);
        }

        $suratKeluar = $query->oldest('tanggal_selesai')->get();
        $totalSurat = $suratKeluar->count();

        // Rekap per jenis layanan
        $rekapPerLayanan = $suratKeluar->groupBy(function ($item) {
            return $item->layanan->nama_layanan ?? 'Lainnya';
        })->map->count();

        return view('admin.laporan.cetak-surat', compact(
            'suratKeluar',
            'selectedLayanan',
            'tanggalDari',
            'tanggalSampai',
            'totalSurat',
            'rekapPerLayanan'
        ));
    }
}
