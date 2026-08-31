@extends('layouts.public')

@section('title', $berita->judul)

@section('content')

<section class="py-24">

    <div class="max-w-4xl mx-auto px-6">

        {{-- Kembali --}}
        <a href="{{ route('berita') }}" class="reveal inline-flex items-center gap-1.5 text-[14px] font-semibold text-adm-primary hover:text-adm-primary-hover transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            Kembali ke berita
        </a>

        {{-- Header --}}
        <div class="mt-8">

            <p class="reveal delay-100 font-mono text-[11px] font-medium tracking-wider text-adm-primary uppercase">
                {{ $berita->published_at->translatedFormat('d F Y, H:i') }} WIB
            </p>

            <h1 class="reveal delay-200 font-display text-4xl md:text-5xl lg:text-[56px] leading-[1.1] text-adm-text-main tracking-tight mt-4">
                {{ $berita->judul }}
            </h1>

            <div class="reveal delay-300 mt-6 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-adm-primary-soft text-adm-primary flex items-center justify-center font-bold text-[13px]">
                    {{ strtoupper(substr($berita->user->name ?? 'A', 0, 1)) }}
                </div>
                <p class="font-sans text-[14px] font-medium text-adm-text-body">
                    Ditulis oleh <span class="text-adm-text-main font-semibold">{{ $berita->user->name ?? 'Admin Desa' }}</span>
                </p>
            </div>

        </div>

        {{-- Gambar --}}
        @if ($berita->gambar)
        <div class="reveal delay-400 mt-12 overflow-hidden rounded-[24px] border border-adm-border shadow-[0_8px_30px_rgba(29,114,254,0.05)]">
            <img
                src="{{ asset('storage/' . $berita->gambar) }}"
                alt="{{ $berita->judul }}"
                class="w-full max-h-[500px] object-cover">
        </div>
        @endif

        {{-- Isi Artikel --}}
        <article class="reveal delay-500 mt-12 bg-adm-card border border-adm-border rounded-[24px] md:rounded-[40px] p-8 md:p-16 shadow-[0_8px_40px_rgba(29,114,254,0.05)]">

            <div class="font-sans font-light text-[16px] md:text-[18px] leading-relaxed text-adm-text-body whitespace-pre-line">
                {{ $berita->isi }}
            </div>

        </article>

        {{-- Footer Navigasi --}}
        <div class="mt-12 pt-8 border-t border-adm-border flex justify-start">
            <a href="{{ route('berita') }}" class="inline-flex items-center gap-1.5 text-[14px] font-semibold text-adm-primary hover:text-adm-primary-hover transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                Lihat berita lainnya
            </a>
        </div>

    </div>

</section>

@endsection