@extends('layouts.public')

@section('title', $berita->judul)

@section('content')

<section class="py-16">

    <div class="max-w-4xl mx-auto px-6">

        {{-- Kembali --}}
        <a
            href="{{ route('berita') }}"
            class="text-sm text-gray-600 hover:text-gray-900">
            ← Kembali ke berita
        </a>


        {{-- Header --}}
        <div class="mt-6">

            <p class="text-sm text-gray-500">

                {{ $berita->published_at->format('d F Y, H:i') }}

                WIB

            </p>

            <h1 class="text-4xl font-bold text-gray-800 mt-3">
                {{ $berita->judul }}
            </h1>

            <p class="text-sm text-gray-500 mt-3">
                Ditulis oleh {{ $berita->user->name ?? 'Admin Desa' }}
            </p>

        </div>


        {{-- Gambar --}}
        @if ($berita->gambar)

        <div class="mt-8">

            <img
                src="{{ asset('storage/' . $berita->gambar) }}"
                alt="{{ $berita->judul }}"
                class="w-full max-h-[500px] object-cover rounded-lg">

        </div>

        @endif


        {{-- Isi --}}
        <article class="mt-8 bg-white border rounded-lg p-8">

            <div class="text-gray-700 leading-8 whitespace-pre-line">

                {{ $berita->isi }}

            </div>

        </article>


        {{-- Footer --}}
        <div class="mt-8">

            <a
                href="{{ route('berita') }}"
                class="text-sm font-medium text-gray-700 hover:underline">
                ← Lihat berita lainnya
            </a>

        </div>

    </div>

</section>

@endsection