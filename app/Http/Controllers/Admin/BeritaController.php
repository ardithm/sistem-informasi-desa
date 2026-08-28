<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use App\Models\Berita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $beritas = Berita::with('user')
            ->when($search, function ($query, $search) {
                $query->where('judul', 'like', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.beritas.index',
            compact(
                'beritas',
                'search',
                'status'
            )
        );
    }

    /**
     * Form tambah berita.
     */
    public function create(): View
    {
        return view('admin.beritas.create');
    }

    /**
     * Menyimpan berita.
     */
    public function store(
        StoreBeritaRequest $request
    ): RedirectResponse {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        $data['slug'] = $this->generateUniqueSlug(
            $data['judul']
        );

        /*
         * Jika berita langsung dipublikasikan
         * dan published_at kosong, gunakan waktu sekarang.
         */
        if (
            $data['status'] === 'published'
            && empty($data['published_at'])
        ) {
            $data['published_at'] = now();
        }

        /*
         * Jika draft, jangan memiliki waktu publikasi.
         */
        if ($data['status'] === 'draft') {
            $data['published_at'] = null;
        }

        /*
         * Upload gambar jika ada.
         */
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request
                ->file('gambar')
                ->store('berita', 'public');
        }

        $berita = Berita::create($data);

        return redirect()
            ->route('admin.beritas.show', $berita)
            ->with(
                'success',
                'Berita berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail berita.
     */
    public function show(Berita $berita): View
    {
        $berita->load('user');

        return view(
            'admin.beritas.show',
            compact('berita')
        );
    }

    /**
     * Form edit berita.
     */
    public function edit(Berita $berita): View
    {
        return view(
            'admin.beritas.edit',
            compact('berita')
        );
    }

    /**
     * Memperbarui berita.
     */
    public function update(
        UpdateBeritaRequest $request,
        Berita $berita
    ): RedirectResponse {
        $data = $request->validated();

        /*
         * Generate slug baru jika judul berubah.
         */
        if ($berita->judul !== $data['judul']) {
            $data['slug'] = $this->generateUniqueSlug(
                $data['judul'],
                $berita->id
            );
        }

        /*
         * Atur published_at.
         */
        if (
            $data['status'] === 'published'
            && empty($data['published_at'])
        ) {
            $data['published_at'] =
                $berita->published_at ?? now();
        }

        if ($data['status'] === 'draft') {
            $data['published_at'] = null;
        }

        /*
         * Upload gambar baru.
         */
        if ($request->hasFile('gambar')) {

            if ($berita->gambar) {
                Storage::disk('public')
                    ->delete($berita->gambar);
            }

            $data['gambar'] = $request
                ->file('gambar')
                ->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()
            ->route(
                'admin.beritas.show',
                $berita
            )
            ->with(
                'success',
                'Berita berhasil diperbarui.'
            );
    }

    /**
     * Menghapus berita.
     */
    public function destroy(
        Berita $berita
    ): RedirectResponse {

        if ($berita->gambar) {
            Storage::disk('public')
                ->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()
            ->route('admin.beritas.index')
            ->with(
                'success',
                'Berita berhasil dihapus.'
            );
    }

    /**
     * Membuat slug unik.
     */
    private function generateUniqueSlug(
        string $judul,
        ?int $ignoreId = null
    ): string {

        $slug = Str::slug($judul);

        $originalSlug = $slug;
        $counter = 1;

        while (
            Berita::where('slug', $slug)
            ->when(
                $ignoreId,
                fn($query) =>
                $query->where(
                    'id',
                    '!=',
                    $ignoreId
                )
            )
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
