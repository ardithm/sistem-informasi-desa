@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.public')

@section('title', 'Berita Desa')

@section('content')

<section class="py-24">

    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-16">
            <p class="reveal font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase">
                INFORMASI DESA
            </p>
            <h1 class="reveal delay-100 font-display text-4xl md:text-5xl lg:text-[64px] leading-none text-adm-text-main tracking-tight mt-4">
                Berita & Kegiatan
            </h1>
            <p class="reveal delay-200 font-sans font-light text-[18px] text-adm-text-body mt-4">
                Informasi terbaru mengenai kegiatan, pengumuman, dan perkembangan Desa Kita.
            </p>
        </div>

        {{-- Daftar Berita --}}
        @if ($beritas->count())

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach ($beritas as $index => $berita)

            <article class="reveal delay-{{ ($index % 3 + 1) * 100 }} bg-adm-card border border-adm-border rounded-[24px] overflow-hidden hover:-translate-y-1.5 hover:shadow-[0_12px_40px_rgba(29,114,254,0.08)] transition-all duration-500 flex flex-col h-full">

                {{-- Gambar --}}
                @if ($berita->gambar)
                <div class="relative overflow-hidden aspect-video">
                    <img
                        src="{{ asset('storage/' . $berita->gambar) }}"
                        alt="{{ $berita->judul }}"
                        class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                </div>
                @else
                <div class="w-full aspect-video bg-adm-input flex items-center justify-center border-b border-adm-border">
                    <span class="text-adm-text-muted text-[13px] font-medium">
                        Tidak ada gambar
                    </span>
                </div>
                @endif

                {{-- Isi Card --}}
                <div class="p-8 flex-1 flex flex-col justify-between">

                    <div>
                        {{-- Tanggal --}}
                        <p class="font-mono text-[11px] font-medium tracking-wider text-adm-text-muted">
                            {{ $berita->published_at->translatedFormat('d F Y') }}
                        </p>

                        {{-- Judul --}}
                        <h2 class="font-display text-[22px] leading-[1.2] text-adm-text-main font-semibold mt-3">
                            <a href="{{ route('berita.show', $berita->slug) }}" class="hover:text-adm-primary transition-colors">
                                {{ $berita->judul }}
                            </a>
                        </h2>

                        {{-- Ringkasan --}}
                        <p class="font-sans font-light text-[14px] leading-relaxed text-adm-text-body mt-4 line-clamp-3">
                            {{ Str::limit(strip_tags($berita->isi), 120) }}
                        </p>
                    </div>

                    {{-- Detail Link --}}
                    <div class="mt-6 pt-6 border-t border-adm-border">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-adm-primary hover:text-adm-primary-hover transition-colors">
                            Baca selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                </div>

            </article>

            @endforeach

        </div>

        {{-- Pagination --}}
        @if ($beritas->hasPages())
        <div class="mt-16 pt-8 border-t border-adm-border">
            {{ $beritas->links() }}
        </div>
        @endif

        @else

        {{-- Belum ada berita --}}
        <div class="bg-adm-card border border-adm-border rounded-[24px] p-16 text-center shadow-sm">
            <p class="text-adm-text-body text-[16px]">
                Belum ada berita atau kegiatan desa yang diterbitkan.
            </p>
        </div>

        @endif

    </div>

</section>

@endsection