<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePendudukRequest;
use App\Http\Requests\UpdatePendudukRequest;
use App\Models\Penduduk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendudukController extends Controller
{
    /**
     * Menampilkan daftar penduduk.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $jenisKelamin = $request->input('jenis_kelamin');

        $penduduks = Penduduk::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nik', 'like', "%{$search}%")
                        ->orWhere(
                            'nama_lengkap',
                            'like',
                            "%{$search}%"
                        );
                });
            })
            ->when($status, function ($query, $status) {
                $query->where('status_penduduk', $status);
            })
            ->when($jenisKelamin, function ($query, $jenisKelamin) {
                $query->where('jenis_kelamin', $jenisKelamin);
            })
            ->orderBy('nama_lengkap')
            ->paginate(10)
            ->withQueryString();

        return view('admin.penduduks.index', compact(
            'penduduks',
            'search',
            'status',
            'jenisKelamin'
        ));
    }

    /**
     * Menampilkan form tambah penduduk.
     */
    public function create(): View
    {
        return view('admin.penduduks.create');
    }

    /**
     * Menyimpan penduduk baru.
     */
    public function store(
        StorePendudukRequest $request
    ): RedirectResponse {
        Penduduk::create(
            $request->validated()
        );

        return redirect()
            ->route('admin.penduduks.index')
            ->with(
                'success',
                'Data penduduk berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail penduduk.
     */
    public function show(Penduduk $penduduk): View
    {
        return view(
            'admin.penduduks.show',
            compact('penduduk')
        );
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Penduduk $penduduk): View
    {
        return view(
            'admin.penduduks.edit',
            compact('penduduk')
        );
    }

    /**
     * Memperbarui data penduduk.
     */
    public function update(
        UpdatePendudukRequest $request,
        Penduduk $penduduk
    ): RedirectResponse {
        $penduduk->update(
            $request->validated()
        );

        return redirect()
            ->route(
                'admin.penduduks.show',
                $penduduk
            )
            ->with(
                'success',
                'Data penduduk berhasil diperbarui.'
            );
    }

    /**
     * Menonaktifkan penduduk.
     */
    public function destroy(
        Penduduk $penduduk
    ): RedirectResponse {
        if ($penduduk->pengajuans()->exists()) {
            return redirect()
                ->route('admin.penduduks.index')
                ->with(
                    'error',
                    'Data penduduk tidak dapat dihapus karena sudah memiliki riwayat pengajuan. Silakan nonaktifkan penduduk.'
                );
        }

        $nama = $penduduk->nama_lengkap;

        $penduduk->delete();

        return redirect()
            ->route('admin.penduduks.index')
            ->with(
                'success',
                "Data penduduk {$nama} berhasil dihapus."
            );
    }

    public function deactivate(
        Penduduk $penduduk
    ): RedirectResponse {
        $penduduk->update([
            'status_penduduk' => 'tidak_aktif',
        ]);

        return redirect()
            ->route('admin.penduduks.index')
            ->with(
                'success',
                'Penduduk berhasil dinonaktifkan.'
            );
    }
}
