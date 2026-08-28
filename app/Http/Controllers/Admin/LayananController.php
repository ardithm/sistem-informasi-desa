<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLayananRequest;
use App\Http\Requests\UpdateLayananRequest;
use App\Models\Layanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LayananController extends Controller
{
    /**
     * Menampilkan daftar layanan.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $layanans = Layanan::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where(
                        'kode',
                        'like',
                        "%{$search}%"
                    )
                        ->orWhere(
                            'nama_layanan',
                            'like',
                            "%{$search}%"
                        );
                });
            })
            ->orderBy('nama_layanan')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.layanans.index',
            compact('layanans', 'search')
        );
    }

    /**
     * Form tambah layanan.
     */
    public function create(): View
    {
        return view('admin.layanans.create');
    }

    /**
     * Menyimpan layanan.
     */
    public function store(
        StoreLayananRequest $request
    ): RedirectResponse {
        Layanan::create(
            $request->validated()
        );

        return redirect()
            ->route('admin.layanans.index')
            ->with(
                'success',
                'Layanan berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail layanan.
     */
    public function show(Layanan $layanan): View
    {
        return view(
            'admin.layanans.show',
            compact('layanan')
        );
    }

    /**
     * Form edit layanan.
     */
    public function edit(Layanan $layanan): View
    {
        return view(
            'admin.layanans.edit',
            compact('layanan')
        );
    }

    /**
     * Memperbarui layanan.
     */
    public function update(
        UpdateLayananRequest $request,
        Layanan $layanan
    ): RedirectResponse {
        $layanan->update(
            $request->validated()
        );

        return redirect()
            ->route(
                'admin.layanans.show',
                $layanan
            )
            ->with(
                'success',
                'Layanan berhasil diperbarui.'
            );
    }

    /**
     * Menonaktifkan layanan.
     */
    public function destroy(
        Layanan $layanan
    ): RedirectResponse {
        if ($layanan->pengajuans()->exists()) {
            return redirect()
                ->route('admin.layanans.index')
                ->with(
                    'error',
                    'Layanan tidak dapat dihapus karena sudah memiliki riwayat pengajuan. Silakan nonaktifkan layanan.'
                );
        }

        $nama = $layanan->nama_layanan;

        $layanan->delete();

        return redirect()
            ->route('admin.layanans.index')
            ->with(
                'success',
                "Layanan {$nama} berhasil dihapus."
            );
    }

    public function deactivate(
        Layanan $layanan
    ): RedirectResponse {
        $layanan->update([
            'aktif' => false,
        ]);

        return redirect()
            ->route('admin.layanans.index')
            ->with(
                'success',
                'Layanan berhasil dinonaktifkan.'
            );
    }
}
