<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Dokumen;
use App\Models\Surat;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminPengajuanController extends Controller
{
    /**
     * Menampilkan daftar pengajuan.
     */
    public function index(): View
    {
        $pengajuans = Pengajuan::with([
            'penduduk',
            'layanan',
        ])
            ->latest()
            ->paginate(10);

        return view(
            'admin.pengajuan.index',
            compact('pengajuans')
        );
    }

    /**
     * Menampilkan detail pengajuan.
     */
    public function show(Pengajuan $pengajuan): View
    {
        $pengajuan->load([
            'penduduk',
            'layanan',
            'dokumens',
            'detailDomisili',
            'detailPengantarKk',
            'detailSktm',
            'surat',
        ]);

        return view(
            'admin.pengajuan.show',
            compact('pengajuan')
        );
    }

    /**
     * Verifikasi dokumen pengajuan.
     */
    public function verifikasiDokumen(
        Request $request,
        Dokumen $dokumen
    ): RedirectResponse {

        $validated = $request->validate([
            'status_verifikasi' => [
                'required',
                'in:valid,tidak_valid,ditolak',
            ],

            'catatan' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [

            'status_verifikasi.required' =>
            'Status verifikasi wajib dipilih.',

            'status_verifikasi.in' =>
            'Status verifikasi tidak valid.',

            'catatan.max' =>
            'Catatan maksimal 1000 karakter.',
        ]);

        // Update status dokumen
        $dokumen->update([
            'status_verifikasi' => $validated['status_verifikasi'],
            'catatan' => $validated['catatan'] ?? null,
        ]);

        // Ambil pengajuan dari dokumen
        $pengajuan = $dokumen->pengajuan;

        // Hitung status seluruh dokumen
        $jumlahDokumen = $pengajuan->dokumens()->count();

        $jumlahValid = $pengajuan->dokumens()
            ->where('status_verifikasi', 'valid')
            ->count();

        $adaTidakValid = $pengajuan->dokumens()
            ->where('status_verifikasi', 'tidak_valid')
            ->exists();

        $adaDitolak = $pengajuan->dokumens()
            ->where('status_verifikasi', 'ditolak')
            ->exists();

        // Jika ada dokumen ditolak
        if ($adaDitolak) {

            $pengajuan->update([
                'status' => 'ditolak',
            ]);

            // Jika ada dokumen tidak valid
        } elseif ($adaTidakValid) {

            $pengajuan->update([
                'status' => 'perlu_perbaikan',
            ]);

            // Jika semua dokumen valid
        } elseif (
            $jumlahDokumen > 0 &&
            $jumlahValid === $jumlahDokumen
        ) {

            $pengajuan->update([
                'status' => 'diverifikasi',
            ]);
        }

        return back()->with(
            'success',
            'Status dokumen berhasil diperbarui.'
        );
    }

    /**
     * Memproses pengajuan setelah semua dokumen diverifikasi.
     */
    public function proses(Pengajuan $pengajuan): RedirectResponse
    {
        // Pengajuan harus sudah diverifikasi
        if ($pengajuan->status !== 'diverifikasi') {

            return back()->with(
                'error',
                'Pengajuan belum dapat diproses karena dokumen belum diverifikasi.'
            );
        }

        $pengajuan->update([
            'status' => 'diproses',
            'diproses_oleh' => Auth::id(),
            'tanggal_diproses' => now(),
        ]);

        return back()->with(
            'success',
            'Pengajuan berhasil diproses.'
        );
    }

    /**
     * Menerbitkan surat sekaligus menyelesaikan pengajuan.
     */
    public function terbitkanSurat(Pengajuan $pengajuan): RedirectResponse
    {
        // Surat hanya dapat diterbitkan ketika pengajuan sedang diproses
        if ($pengajuan->status !== 'diproses') {

            return back()->with(
                'error',
                'Surat belum dapat diterbitkan karena pengajuan belum dalam proses.'
            );
        }

        // Pastikan surat belum pernah diterbitkan
        if ($pengajuan->surat) {

            return back()->with(
                'error',
                'Surat untuk pengajuan ini sudah diterbitkan.'
            );
        }

        try {

            DB::transaction(function () use ($pengajuan) {

                // Pastikan relasi layanan dan detail tersedia
                $pengajuan->load([
                    'layanan',
                    'penduduk',
                    'detailDomisili',
                    'detailPengantarKk',
                    'detailSktm',
                ]);

                /*
            |--------------------------------------------------------------------------
            | 1. Tentukan kode dan jenis surat
            |--------------------------------------------------------------------------
            */

                $kodeLayanan = $pengajuan->layanan->kode;

                if ($kodeLayanan === 'SKD') {

                    $kodeSurat = 'SKD';
                    $namaSurat = 'domisili';
                } elseif ($kodeLayanan === 'SKTP') {

                    $kodeSurat = 'SKTP';
                    $namaSurat = 'pengantar-ktp';
                } elseif ($kodeLayanan === 'SKKK') {

                    $kodeSurat = 'SKKK';
                    $namaSurat = 'pengantar-kk';
                } elseif ($kodeLayanan === 'SKTM') {

                    $kodeSurat = 'SKTM';
                    $namaSurat = 'sktm';
                } else {

                    throw new \Exception(
                        'Jenis layanan belum memiliki template surat.'
                    );
                }


                /*
            |--------------------------------------------------------------------------
            | 2. Buat nomor surat
            |--------------------------------------------------------------------------
            */

                $nomorSurat =
                    '470/' .
                    $pengajuan->id .
                    '/' .
                    $kodeSurat .
                    '/' .
                    now()->format('Y');


                /*
            |--------------------------------------------------------------------------
            | 3. Buat data surat
            |--------------------------------------------------------------------------
            */

                $surat = Surat::create([
                    'pengajuan_id' => $pengajuan->id,
                    'nomor_surat' => $nomorSurat,
                    'tanggal_terbit' => now(),
                    'file_pdf' => '',
                    'diterbitkan_oleh' => Auth::id(),
                ]);


                /*
            |--------------------------------------------------------------------------
            | 4. Tentukan template surat
            |--------------------------------------------------------------------------
            */

                $template = 'admin.surat.' . $namaSurat;


                /*
            |--------------------------------------------------------------------------
            | 5. Buat PDF
            |--------------------------------------------------------------------------
            */

                $pdf = Pdf::loadView(
                    $template,
                    [
                        'surat' => $surat,
                        'pengajuan' => $pengajuan,
                    ]
                );


                /*
            |--------------------------------------------------------------------------
            | 6. Tentukan nama dan lokasi PDF
            |--------------------------------------------------------------------------
            */

                $namaFile =
                    'surat-' .
                    $namaSurat .
                    '-' .
                    $pengajuan->id .
                    '.pdf';


                $pathFile =
                    'pengajuan/' .
                    $namaSurat .
                    '/' .
                    $pengajuan->id .
                    '/' .
                    $namaFile;


                /*
            |--------------------------------------------------------------------------
            | 7. Simpan PDF
            |--------------------------------------------------------------------------
            */

                Storage::disk('public')->put(
                    $pathFile,
                    $pdf->output()
                );


                /*
            |--------------------------------------------------------------------------
            | 8. Simpan path PDF
            |--------------------------------------------------------------------------
            */

                $surat->update([
                    'file_pdf' => $pathFile,
                ]);


                /*
            |--------------------------------------------------------------------------
            | 9. Pengajuan selesai
            |--------------------------------------------------------------------------
            */

                $pengajuan->update([
                    'status' => 'selesai',
                    'tanggal_selesai' => now(),
                ]);
            });


            return back()->with(
                'success',
                'Surat berhasil diterbitkan dan pengajuan telah diselesaikan.'
            );
        } catch (\Throwable $e) {

            return back()->with(
                'error',
                'Surat gagal diterbitkan: ' . $e->getMessage()
            );
        }
    }

    public function lihatSurat(Pengajuan $pengajuan)
    {
        $surat = $pengajuan->surat;

        if (!$surat) {
            return back()->with(
                'error',
                'Surat untuk pengajuan ini belum diterbitkan.'
            );
        }

        if (!$surat->file_pdf) {
            return back()->with(
                'error',
                'File surat belum tersedia.'
            );
        }

        if (!Storage::disk('public')->exists($surat->file_pdf)) {
            return back()->with(
                'error',
                'File surat tidak ditemukan di penyimpanan.'
            );
        }

        return response()->file(
            Storage::disk('public')->path($surat->file_pdf)
        );
    }
}
