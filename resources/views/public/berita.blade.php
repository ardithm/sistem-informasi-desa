@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.public')

@section('title', 'Berita Desa')

@section('content')

<section class="py-16">

    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-10">

            <p class="text-sm text-gray-500 uppercase tracking-wider">
                Informasi Desa
            </p>

            <h1 class="text-4xl font-bold mt-2">
                Berita & Kegiatan Desa
            </h1>

            <p class="text-gray-500 mt-3">
                Informasi terbaru mengenai kegiatan dan perkembangan desa.
            </p>

        </div>


        {{-- Daftar Berita --}}
        @if ($beritas->count())

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach ($beritas as $berita)

            <article
                class="bg-white border rounded-lg overflow-hidden hover:shadow-md transition">

                {{-- Gambar --}}
                @if ($berita->gambar)

                <img
                    src="{{ asset('storage/' . $berita->gambar) }}"
                    alt="{{ $berita->judul }}"
                    class="w-full h-48 object-cover">

                @else

                <div class="w-full h-48 bg-gray-100 flex items-center justify-center">

                    <span class="text-gray-400 text-sm">
                        Tidak ada gambar
                    </span>

                </div>

                @endif


                {{-- Isi Card --}}
                <div class="p-6">

                    {{-- Tanggal --}}
                    <p class="text-xs text-gray-500">

                        {{ $berita->published_at->format('d F Y') }}

                    </p>


                    {{-- Judul --}}
                    <h2 class="text-xl font-semibold text-gray-800 mt-2">

                        {{ $berita->judul }}

                    </h2>


                    {{-- Ringkasan --}}
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">

                        {{ Str::limit(strip_tags($berita->isi), 120) }}

                    </p>


                    {{-- Detail --}}
                    <a
                        href="{{ route('berita.show', $berita->slug) }}"
                        class="inline-block mt-5 text-sm font-medium text-gray-700 hover:underline">
                        Baca selengkapnya →
                    </a>

                </div>

            </article>

            @endforeach

        </div>


        {{-- Pagination --}}
        @if ($beritas->hasPages())

        <div class="mt-10">

            {{ $beritas->links() }}

        </div>

        @endif


        @else

        {{-- Belum ada berita --}}
        <div class="bg-white border rounded-lg p-10 text-center">

            <p class="text-gray-500">
                Belum ada berita atau kegiatan desa.
            </p>

        </div>

        @endif

    </div>

</section>

@endsection