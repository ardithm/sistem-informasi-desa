<?php

namespace App\Http\Controllers;

use App\Models\Berita;

use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        return view('public.home');
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
        return view('public.layanan');
    }

    public function kontak(): View
    {
        return view('public.kontak');
    }
}
