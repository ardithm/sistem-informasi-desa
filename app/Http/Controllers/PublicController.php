<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Penduduk;
use App\Models\Layanan;
use App\Models\Pengajuan;
use App\Models\Dokumen;
use App\Models\DetailDomisili;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;




class PublicController extends Controller
{
    public function home(): View
    {
        $beritas = Berita::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.home', compact('beritas'));
    }

    public function profil(): View
    {
        return view('public.profil');
    }

    public function sejarah(): View
    {
        return view('public.sejarah');
    }

    public function visiMisi(): View
    {
        return view('public.visi-misi');
    }

    public function berita(): View
    {
        $beritas = Berita::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(9);

        return view(
            'public.berita',
            compact('beritas')
        );
    }

    public function beritaShow(
        Berita $berita
    ): View {

        abort_if(
            $berita->status !== 'published'
                || is_null($berita->published_at),
            404
        );

        return view(
            'public.berita-show',
            compact('berita')
        );
    }

    public function layanan(): View
    {
        $layanans = Layanan::where('aktif', true)
            ->orderBy('id')
            ->get();

        return view('public.layanan', compact('layanans'));
    }

    public function kontak(): View
    {
        return view('public.kontak');
    }

    public function domisili(): View
    {
        $layanan = Layanan::where('kode', 'SKD')
            ->where('aktif', true)
            ->firstOrFail();

        return view(
            'public.layanan.domisili.domisili',
            compact('layanan')
        );
    }

    public function verifikasiDomisili(Request $request): View|RedirectResponse
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'digits:16',
            ],
            'no_hp' => [
                'required',
                'string',
                'min:10',
                'max:20',
            ],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',
        ]);

        $penduduk = Penduduk::where('nik', $validated['nik'])
            ->where('status_penduduk', 'aktif')
            ->first();

        if (!$penduduk) {
            return back()
                ->withInput()
                ->withErrors([
                    'nik' => 'NIK tidak ditemukan atau data penduduk tidak aktif.',
                ]);
        }

        $layanan = Layanan::where('kode', 'SKD')
            ->where('aktif', true)
            ->firstOrFail();

        session([
            'domisili.penduduk_id' => $penduduk->id,
            'domisili.layanan_id' => $layanan->id,
            'domisili.no_hp' => $validated['no_hp'],
        ]);

        return redirect()
            ->route('layanan.domisili.form');
    }

    public function formDomisili(): View|RedirectResponse
    {
        $pendudukId = session('domisili.penduduk_id');
        $layananId = session('domisili.layanan_id');
        $noHp = session('domisili.no_hp');

        if (!$pendudukId || !$layananId || !$noHp) {
            return redirect()
                ->route('layanan.domisili')
                ->withErrors([
                    'nik' => 'Sesi verifikasi telah berakhir. Silakan lakukan verifikasi kembali.',
                ]);
        }

        $penduduk = Penduduk::where('id', $pendudukId)
            ->where('status_penduduk', 'aktif')
            ->firstOrFail();

        $layanan = Layanan::where('id', $layananId)
            ->where('kode', 'SKD')
            ->where('aktif', true)
            ->firstOrFail();

        return view(
            'public.layanan.domisili.form',
            [
                'penduduk' => $penduduk,
                'layanan' => $layanan,
                'no_hp' => $noHp,
            ]
        );
    }

    public function storeDomisili(Request $request)
    {
        $validated = $request->validate([
            'penduduk_id' => [
                'required',
                'exists:penduduks,id',
            ],

            'layanan_id' => [
                'required',
                'exists:layanans,id',
            ],

            'no_hp' => [
                'required',
                'string',
                'min:10',
                'max:20',
            ],

            'alamat_domisili' => [
                'required',
                'string',
                'max:1000',
            ],

            'keperluan' => [
                'required',
                'string',
                'max:1000',
            ],

            'ktp' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],

            'kk' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],

            'surat_rt_rw' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
        ], [
            'penduduk_id.required' => 'Data penduduk tidak valid.',
            'penduduk_id.exists' => 'Data penduduk tidak ditemukan.',

            'layanan_id.required' => 'Layanan tidak valid.',
            'layanan_id.exists' => 'Layanan tidak ditemukan.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.min' => 'Nomor HP minimal 10 karakter.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',

            'alamat_domisili.required' => 'Alamat domisili wajib diisi.',
            'alamat_domisili.max' => 'Alamat domisili terlalu panjang.',

            'keperluan.required' => 'Keperluan wajib diisi.',
            'keperluan.max' => 'Keperluan terlalu panjang.',

            'ktp.required' => 'KTP wajib diunggah.',
            'ktp.mimes' => 'KTP harus berupa JPG, JPEG, PNG, atau PDF.',
            'ktp.max' => 'Ukuran KTP maksimal 2 MB.',

            'kk.required' => 'KK wajib diunggah.',
            'kk.mimes' => 'KK harus berupa JPG, JPEG, PNG, atau PDF.',
            'kk.max' => 'Ukuran KK maksimal 2 MB.',

            'surat_rt_rw.mimes' => 'Surat RT/RW harus berupa JPG, JPEG, PNG, atau PDF.',
            'surat_rt_rw.max' => 'Ukuran surat RT/RW maksimal 2 MB.',
        ]);
        $penduduk = Penduduk::where('id', $validated['penduduk_id'])
            ->where('status_penduduk', 'aktif')
            ->firstOrFail();

        $layanan = Layanan::where('id', $validated['layanan_id'])
            ->where('kode', 'SKD')
            ->where('aktif', true)
            ->firstOrFail();

        $nomorPengajuan = 'SKD-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4));

        $result = DB::transaction(function () use (
            $request,
            $validated,
            $penduduk,
            $layanan,
            $nomorPengajuan
        ) {

            $pengajuan = Pengajuan::create([
                'nomor_pengajuan' => $nomorPengajuan,
                'penduduk_id' => $penduduk->id,
                'layanan_id' => $layanan->id,
                'no_hp' => $validated['no_hp'],
                'status' => 'menunggu',
            ]);

            DetailDomisili::create([
                'pengajuan_id' => $pengajuan->id,
                'alamat_domisili' => $validated['alamat_domisili'],
                'keperluan' => $validated['keperluan'],
            ]);

            $ktp = $request->file('ktp');

            $ktpPath = $ktp->store(
                'pengajuan/domisili/' . $pengajuan->id,
                'public'
            );

            Dokumen::create([
                'pengajuan_id' => $pengajuan->id,
                'jenis_dokumen' => 'KTP',
                'nama_file' => $ktp->getClientOriginalName(),
                'path_file' => $ktpPath,
                'mime_type' => $ktp->getMimeType(),
                'ukuran_file' => $ktp->getSize(),
                'status_verifikasi' => 'menunggu',
            ]);

            $kk = $request->file('kk');

            $kkPath = $kk->store(
                'pengajuan/domisili/' . $pengajuan->id,
                'public'
            );

            Dokumen::create([
                'pengajuan_id' => $pengajuan->id,
                'jenis_dokumen' => 'KK',
                'nama_file' => $kk->getClientOriginalName(),
                'path_file' => $kkPath,
                'mime_type' => $kk->getMimeType(),
                'ukuran_file' => $kk->getSize(),
                'status_verifikasi' => 'menunggu',
            ]);

            if ($request->hasFile('surat_rt_rw')) {

                $suratRtRw = $request->file('surat_rt_rw');

                $suratRtRwPath = $suratRtRw->store(
                    'pengajuan/domisili/' . $pengajuan->id,
                    'public'
                );

                Dokumen::create([
                    'pengajuan_id' => $pengajuan->id,
                    'jenis_dokumen' => 'Surat Pengantar RT/RW',
                    'nama_file' => $suratRtRw->getClientOriginalName(),
                    'path_file' => $suratRtRwPath,
                    'mime_type' => $suratRtRw->getMimeType(),
                    'ukuran_file' => $suratRtRw->getSize(),
                    'status_verifikasi' => 'menunggu',
                ]);
            }

            return $pengajuan;
        });

        return redirect()
            ->route('layanan.domisili.berhasil', $result->id)
            ->with('success', 'Pengajuan Surat Keterangan Domisili berhasil dikirim.');
    }

    public function domisiliBerhasil(Pengajuan $pengajuan)
    {
        $pengajuan->load([
            'penduduk',
            'layanan',
        ]);

        return view('public.layanan.domisili.berhasil', compact('pengajuan'));
    }

    public function pengantarKtp(): View
    {
        $layanan = Layanan::where('kode', 'SKTP')
            ->where('aktif', true)
            ->firstOrFail();

        return view(
            'public.layanan.pengantar-ktp.pengantar-ktp',
            compact('layanan')
        );
    }

    public function verifikasiPengantarKtp(Request $request): View|RedirectResponse
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'digits:16',
            ],
            'no_hp' => [
                'required',
                'string',
                'min:10',
                'max:20',
            ],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',
        ]);

        $penduduk = Penduduk::where('nik', $validated['nik'])
            ->where('status_penduduk', 'aktif')
            ->first();

        if (!$penduduk) {
            return back()
                ->withInput()
                ->withErrors([
                    'nik' => 'NIK tidak ditemukan atau data penduduk tidak aktif.',
                ]);
        }

        $layanan = Layanan::where('kode', 'SKTP')
            ->where('aktif', true)
            ->firstOrFail();

        session([
            'pengantar_ktp.penduduk_id' => $penduduk->id,
            'pengantar_ktp.layanan_id' => $layanan->id,
            'pengantar_ktp.no_hp' => $validated['no_hp'],
        ]);

        return redirect()->route('layanan.pengantar-ktp.form');
    }

    public function formPengantarKtp(): View|RedirectResponse
    {
        $pendudukId = session('pengantar_ktp.penduduk_id');
        $layananId = session('pengantar_ktp.layanan_id');
        $noHp = session('pengantar_ktp.no_hp');

        if (!$pendudukId || !$layananId || !$noHp) {
            return redirect()
                ->route('layanan.pengantar-ktp')
                ->withErrors([
                    'nik' => 'Sesi verifikasi telah berakhir. Silakan lakukan verifikasi kembali.',
                ]);
        }

        $penduduk = Penduduk::where('id', $pendudukId)
            ->where('status_penduduk', 'aktif')
            ->firstOrFail();

        $layanan = Layanan::where('id', $layananId)
            ->where('kode', 'SKTP')
            ->where('aktif', true)
            ->firstOrFail();

        return view(
            'public.layanan.pengantar-ktp.form',
            [
                'penduduk' => $penduduk,
                'layanan' => $layanan,
                'no_hp' => $noHp,
            ]
        );
    }

    public function storePengantarKtp(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nik' => ['required', 'string', 'size:16'],
            'penduduk_id' => ['required', 'exists:penduduks,id'],
            'layanan_id' => ['required', 'exists:layanans,id'],
            'no_hp' => ['required', 'string', 'max:20'],
            'keperluan_ktp' => ['required', 'in:pembuatan_baru,hilang,rusak,perubahan_data'],
            'ktp' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'kk' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'surat_rt_rw' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus terdiri dari 16 digit.',
            'penduduk_id.required' => 'Data penduduk tidak valid.',
            'penduduk_id.exists' => 'Data penduduk tidak ditemukan.',
            'layanan_id.required' => 'Layanan tidak valid.',
            'layanan_id.exists' => 'Layanan tidak ditemukan.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',
            'keperluan_ktp.required' => 'Keperluan KTP wajib dipilih.',
            'keperluan_ktp.in' => 'Keperluan KTP tidak valid.',
            'ktp.required' => 'KTP wajib diunggah.',
            'ktp.mimes' => 'KTP harus berupa JPG, JPEG, PNG, atau PDF.',
            'ktp.max' => 'Ukuran KTP maksimal 2 MB.',
            'kk.required' => 'KK wajib diunggah.',
            'kk.mimes' => 'KK harus berupa JPG, JPEG, PNG, atau PDF.',
            'kk.max' => 'Ukuran KK maksimal 2 MB.',
            'surat_rt_rw.mimes' => 'Surat RT/RW harus berupa JPG, JPEG, PNG, atau PDF.',
            'surat_rt_rw.max' => 'Ukuran surat RT/RW maksimal 2 MB.',
        ]);

        $layanan = Layanan::where('kode', 'SKTP')
            ->where('aktif', true)
            ->firstOrFail();

        $penduduk = Penduduk::findOrFail($validated['penduduk_id']);

        $pengajuan = DB::transaction(function () use ($validated, $layanan, $penduduk, $request) {
            $pengajuan = Pengajuan::create([
                'nomor_pengajuan' => 'SKTP-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
                'penduduk_id' => $penduduk->id,
                'layanan_id' => $layanan->id,
                'no_hp' => $validated['no_hp'],
                'status' => 'menunggu',
            ]);

            $pengajuan->detailPengantarKtp()->create([
                'keperluan_ktp' => $validated['keperluan_ktp'],
            ]);

            $dokumen = [
                'ktp' => 'KTP',
                'kk' => 'KK',
                'surat_rt_rw' => 'Surat Pengantar RT/RW',
            ];

            foreach ($dokumen as $field => $jenis) {
                if (!$request->hasFile($field)) {
                    continue;
                }

                $file = $request->file($field);
                $pathFile = $file->store(
                    'pengajuan/pengantar-ktp/' . $pengajuan->id,
                    'public'
                );

                $pengajuan->dokumens()->create([
                    'jenis_dokumen' => $jenis,
                    'nama_file' => $file->getClientOriginalName(),
                    'path_file' => $pathFile,
                    'mime_type' => $file->getMimeType(),
                    'ukuran_file' => $file->getSize(),
                    'status_verifikasi' => 'menunggu',
                    'catatan' => null,
                ]);
            }

            return $pengajuan;
        });

        return redirect()
            ->route('layanan.pengantar-ktp.berhasil', $pengajuan->id)
            ->with('success', 'Pengajuan Surat Pengantar KTP berhasil dibuat.');
    }

    public function pengantarKtpBerhasil(Pengajuan $pengajuan): View
    {
        $pengajuan->load([
            'penduduk',
            'layanan',
        ]);

        return view(
            'public.layanan.pengantar-ktp.berhasil',
            compact('pengajuan')
        );
    }

    public function pengantarKk(): View
    {
        $layanan = Layanan::where('kode', 'SKKK')
            ->where('aktif', true)
            ->firstOrFail();

        return view(
            'public.layanan.pengantar-kk.pengantar-kk',
            compact('layanan')
        );
    }

    public function verifikasiPengantarKk(Request $request): View|RedirectResponse
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'digits:16',
            ],
            'no_hp' => [
                'required',
                'string',
                'min:10',
                'max:20',
            ],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',
        ]);

        $penduduk = Penduduk::where('nik', $validated['nik'])
            ->where('status_penduduk', 'aktif')
            ->first();

        if (!$penduduk) {
            return back()
                ->withInput()
                ->withErrors([
                    'nik' => 'NIK tidak ditemukan atau data penduduk tidak aktif.',
                ]);
        }

        $layanan = Layanan::where('kode', 'SKKK')
            ->where('aktif', true)
            ->firstOrFail();

        session([
            'pengantar_kk.penduduk_id' => $penduduk->id,
            'pengantar_kk.layanan_id' => $layanan->id,
            'pengantar_kk.no_hp' => $validated['no_hp'],
        ]);

        return redirect()->route('layanan.pengantar-kk.form');
    }

    public function formPengantarKk(): View|RedirectResponse
    {
        $pendudukId = session('pengantar_kk.penduduk_id');
        $layananId = session('pengantar_kk.layanan_id');
        $noHp = session('pengantar_kk.no_hp');

        if (!$pendudukId || !$layananId || !$noHp) {
            return redirect()
                ->route('layanan.pengantar-kk')
                ->withErrors([
                    'nik' => 'Sesi verifikasi telah berakhir. Silakan lakukan verifikasi kembali.',
                ]);
        }

        $penduduk = Penduduk::where('id', $pendudukId)
            ->where('status_penduduk', 'aktif')
            ->firstOrFail();

        $layanan = Layanan::where('id', $layananId)
            ->where('kode', 'SKKK')
            ->where('aktif', true)
            ->firstOrFail();

        return view(
            'public.layanan.pengantar-kk.form',
            [
                'penduduk' => $penduduk,
                'layanan' => $layanan,
                'no_hp' => $noHp,
            ]
        );
    }

    public function storePengantarKk(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'string',
                'size:16',
            ],
            'penduduk_id' => [
                'required',
                'exists:penduduks,id',
            ],
            'layanan_id' => [
                'required',
                'exists:layanans,id',
            ],
            'no_hp' => [
                'required',
                'string',
                'max:20',
            ],
            'nomor_kk' => [
                'required',
                'string',
                'max:16',
            ],
            'keperluan' => [
                'required',
                'string',
                'max:1000',
            ],
            'ktp' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
            'kk' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
            'surat_rt_rw' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus terdiri dari 16 digit.',
            'penduduk_id.required' => 'Data penduduk tidak valid.',
            'penduduk_id.exists' => 'Data penduduk tidak ditemukan.',
            'layanan_id.required' => 'Layanan tidak valid.',
            'layanan_id.exists' => 'Layanan tidak ditemukan.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',
            'nomor_kk.required' => 'Nomor KK wajib diisi.',
            'nomor_kk.max' => 'Nomor KK maksimal 16 karakter.',
            'keperluan.required' => 'Keperluan wajib diisi.',
            'keperluan.max' => 'Keperluan terlalu panjang.',
            'ktp.required' => 'KTP wajib diunggah.',
            'ktp.mimes' => 'KTP harus berupa JPG, JPEG, PNG, atau PDF.',
            'ktp.max' => 'Ukuran KTP maksimal 2 MB.',
            'kk.required' => 'KK wajib diunggah.',
            'kk.mimes' => 'KK harus berupa JPG, JPEG, PNG, atau PDF.',
            'kk.max' => 'Ukuran KK maksimal 2 MB.',
            'surat_rt_rw.mimes' => 'Surat RT/RW harus berupa JPG, JPEG, PNG, atau PDF.',
            'surat_rt_rw.max' => 'Ukuran surat RT/RW maksimal 2 MB.',
        ]);

        $layanan = Layanan::where('kode', 'SKKK')
            ->where('aktif', true)
            ->firstOrFail();

        $penduduk = Penduduk::findOrFail($validated['penduduk_id']);

        $pengajuan = DB::transaction(function () use ($validated, $layanan, $penduduk, $request) {
            $pengajuan = Pengajuan::create([
                'nomor_pengajuan' => 'SKKK-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(4)),
                'penduduk_id' => $penduduk->id,
                'layanan_id' => $layanan->id,
                'no_hp' => $validated['no_hp'],
                'status' => 'menunggu',
            ]);

            $pengajuan->detailPengantarKk()->create([
                'nomor_kk' => $validated['nomor_kk'],
                'keperluan' => $validated['keperluan'],
            ]);

            $dokumen = [
                'ktp' => 'KTP',
                'kk' => 'KK',
                'surat_rt_rw' => 'Surat Pengantar RT/RW',
            ];

            foreach ($dokumen as $field => $jenis) {
                if (!$request->hasFile($field)) {
                    continue;
                }

                $file = $request->file($field);
                $pathFile = $file->store(
                    'pengajuan/pengantar-kk/' . $pengajuan->id,
                    'public'
                );

                $pengajuan->dokumens()->create([
                    'jenis_dokumen' => $jenis,
                    'nama_file' => $file->getClientOriginalName(),
                    'path_file' => $pathFile,
                    'mime_type' => $file->getMimeType(),
                    'ukuran_file' => $file->getSize(),
                    'status_verifikasi' => 'menunggu',
                    'catatan' => null,
                ]);
            }

            return $pengajuan;
        });

        return redirect()
            ->route('layanan.pengantar-kk.berhasil', $pengajuan->id)
            ->with('success', 'Pengajuan Surat Pengantar KK berhasil dibuat.');
    }

    public function pengantarKkBerhasil(Pengajuan $pengajuan): View
    {
        $pengajuan->load([
            'penduduk',
            'layanan',
        ]);

        return view(
            'public.layanan.pengantar-kk.berhasil',
            compact('pengajuan')
        );
    }

    public function status(): View
    {
        return view('public.status');
    }

    public function cekStatus(Request $request): View|RedirectResponse
    {
        $validated = $request->validate([
            'nomor_pengajuan' => [
                'required',
                'string',
                'max:50',
            ],
        ], [
            'nomor_pengajuan.required' =>
            'Nomor pengajuan wajib diisi.',

            'nomor_pengajuan.max' =>
            'Nomor pengajuan maksimal 50 karakter.',
        ]);

        $pengajuan = Pengajuan::with([
            'penduduk',
            'layanan',
            'dokumens',
            'surat',
        ])
            ->where(
                'nomor_pengajuan',
                $validated['nomor_pengajuan']
            )
            ->first();

        if (!$pengajuan) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Nomor pengajuan tidak ditemukan.'
                );
        }

        return redirect()
            ->route('status.hasil', $pengajuan->id);
    }

    public function sktm()
    {
        $layanan = \App\Models\Layanan::where('kode', 'SKTM')
            ->where('aktif', true)
            ->firstOrFail();

        return view('public.layanan.sktm.sktm', compact('layanan'));
    }

    public function verifikasiSktm(Request $request): View|RedirectResponse
    {
        $validated = $request->validate([
            'nik' => [
                'required',
                'digits:16',
            ],
            'no_hp' => [
                'required',
                'string',
                'min:10',
                'max:20',
            ],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus terdiri dari 16 digit.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'no_hp.max' => 'Nomor HP maksimal 20 karakter.',
        ]);

        $penduduk = Penduduk::where('nik', $validated['nik'])
            ->where('status_penduduk', 'aktif')
            ->first();

        if (!$penduduk) {
            return back()
                ->withInput()
                ->withErrors([
                    'nik' => 'NIK tidak ditemukan atau data penduduk tidak aktif.',
                ]);
        }

        $layanan = Layanan::where('kode', 'SKTM')
            ->where('aktif', true)
            ->firstOrFail();

        session([
            'sktm.penduduk_id' => $penduduk->id,
            'sktm.layanan_id' => $layanan->id,
            'sktm.no_hp' => $validated['no_hp'],
        ]);

        return redirect()
            ->route('layanan.sktm.form');
    }

    public function formSktm(): View|RedirectResponse
    {
        $layanan = Layanan::where('kode', 'SKTM')
            ->where('aktif', true)
            ->firstOrFail();

        // Ambil data dari session hasil verifikasi
        $pendudukId = session('sktm.penduduk_id');
        $no_hp = session('sktm.no_hp');

        // Pastikan sudah melakukan verifikasi NIK
        if (!$pendudukId) {
            return redirect()
                ->route('layanan.sktm')
                ->with(
                    'error',
                    'Silakan verifikasi NIK terlebih dahulu.'
                );
        }

        // Ambil penduduk berdasarkan ID dari session
        $penduduk = Penduduk::where('id', $pendudukId)
            ->where('status_penduduk', 'aktif')
            ->first();

        if (!$penduduk) {
            session()->forget([
                'sktm.penduduk_id',
                'sktm.layanan_id',
                'sktm.no_hp',
            ]);

            return redirect()
                ->route('layanan.sktm')
                ->with(
                    'error',
                    'Data penduduk tidak ditemukan atau tidak aktif.'
                );
        }

        return view(
            'public.layanan.sktm.form',
            compact(
                'layanan',
                'penduduk',
                'no_hp'
            )
        );
    }

    public function storeSktm(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'nik' => [
                'required',
                'string',
                'size:16',
            ],

            'no_hp' => [
                'required',
                'string',
                'max:20',
            ],

            'penduduk_id' => [
                'required',
                'exists:penduduks,id',
            ],

            'jumlah_anggota_keluarga' => [
                'required',
                'integer',
                'min:1',
            ],

            'penghasilan_per_bulan' => [
                'required',
                'numeric',
                'min:0',
            ],

            'keperluan' => [
                'required',
                'string',
                'max:1000',
            ],

            'ktp' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],

            'kk' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],

            'surat_rt_rw' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],

        ]);

        $layanan = \App\Models\Layanan::where('kode', 'SKTM')
            ->where('aktif', true)
            ->firstOrFail();

        $penduduk = \App\Models\Penduduk::findOrFail(
            $validated['penduduk_id']
        );

        $pengajuan = DB::transaction(function () use (
            $validated,
            $layanan,
            $penduduk,
            $request
        ) {

            $pengajuan = Pengajuan::create([
                'nomor_pengajuan' => 'SKTM-' . now()->format('YmdHis') . '-' . strtoupper(
                    \Illuminate\Support\Str::random(4)
                ),
                'penduduk_id' => $penduduk->id,
                'layanan_id' => $layanan->id,
                'no_hp' => $validated['no_hp'],
                'status' => 'menunggu',
            ]);

            $pengajuan->detailSktm()->create([
                'jumlah_anggota_keluarga' =>
                $validated['jumlah_anggota_keluarga'],

                'penghasilan_per_bulan' =>
                $validated['penghasilan_per_bulan'],

                'keperluan' =>
                $validated['keperluan'],
            ]);

            $dokumen = [
                'ktp' => 'KTP',
                'kk' => 'KK',
                'surat_rt_rw' => 'Surat Pengantar RT/RW',
            ];

            foreach ($dokumen as $field => $jenis) {

                if (!$request->hasFile($field)) {
                    continue;
                }

                $file = $request->file($field);

                $pathFile = $file->store(
                    'pengajuan/sktm/' . $pengajuan->id,
                    'public'
                );

                $pengajuan->dokumens()->create([
                    'jenis_dokumen' => $jenis,
                    'nama_file' => $file->getClientOriginalName(),
                    'path_file' => $pathFile,
                    'mime_type' => $file->getMimeType(),
                    'ukuran_file' => $file->getSize(),
                    'status_verifikasi' => 'menunggu',
                    'catatan' => null,
                ]);
            }

            return $pengajuan;
        });

        return redirect()
            ->route('layanan.sktm.berhasil', $pengajuan->id)
            ->with(
                'success',
                'Pengajuan SKTM berhasil dibuat.'
            );
    }

    public function sktmBerhasil(Pengajuan $pengajuan): View
    {
        $pengajuan->load([
            'penduduk',
            'layanan',
        ]);

        return view(
            'public.layanan.sktm.berhasil',
            compact('pengajuan')
        );
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
                'File surat tidak ditemukan.'
            );
        }

        return response()->file(
            Storage::disk('public')->path($surat->file_pdf)
        );
    }

    public function formRevisiDokumen(
        Pengajuan $pengajuan,
        Dokumen $dokumen
    ): View|RedirectResponse {

        // Pastikan dokumen milik pengajuan
        if ($dokumen->pengajuan_id !== $pengajuan->id) {
            abort(404);
        }

        // Hanya dokumen yang tidak valid / ditolak
        // yang boleh diperbaiki
        if (!in_array($dokumen->status_verifikasi, [
            'tidak_valid',
            'ditolak'
        ])) {
            return redirect()
                ->route('status')
                ->with(
                    'error',
                    'Dokumen ini tidak perlu diperbaiki.'
                );
        }

        return view(
            'public.revisi',
            compact('pengajuan', 'dokumen')
        );
    }

    public function revisiDokumen(
        Request $request,
        Pengajuan $pengajuan,
        Dokumen $dokumen
    ): RedirectResponse {

        // Pastikan dokumen milik pengajuan
        if ($dokumen->pengajuan_id !== $pengajuan->id) {
            abort(404);
        }

        // Hanya dokumen bermasalah yang boleh di-upload ulang
        if (
            !in_array(
                $dokumen->status_verifikasi,
                ['tidak_valid', 'ditolak']
            )
        ) {
            return redirect()
                ->route('status')
                ->with(
                    'error',
                    'Dokumen ini tidak perlu diperbaiki.'
                );
        }

        $validated = $request->validate([
            'dokumen' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:2048',
            ],
        ], [
            'dokumen.required' =>
            'Dokumen wajib diunggah.',

            'dokumen.mimes' =>
            'Dokumen harus berupa JPG, JPEG, PNG, atau PDF.',

            'dokumen.max' =>
            'Ukuran dokumen maksimal 2 MB.',
        ]);

        $file = $request->file('dokumen');

        // Simpan file baru
        $pathFile = $file->store(
            'pengajuan/domisili/' . $pengajuan->id,
            'public'
        );

        // Update data dokumen
        $dokumen->update([
            'nama_file' => $file->getClientOriginalName(),
            'path_file' => $pathFile,
            'mime_type' => $file->getMimeType(),
            'ukuran_file' => $file->getSize(),
            'status_verifikasi' => 'menunggu',
            'catatan' => null,
        ]);

        // Pengajuan kembali menunggu verifikasi
        $pengajuan->update([
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('status')
            ->with(
                'success',
                'Dokumen berhasil diunggah ulang dan menunggu verifikasi admin.'
            );
    }

    public function hasilStatus(Pengajuan $pengajuan): View
    {
        $pengajuan->load([
            'penduduk',
            'layanan',
            'dokumens',
            'surat',
        ]);

        return view(
            'public.status-hasil',
            compact('pengajuan')
        );
    }
}
