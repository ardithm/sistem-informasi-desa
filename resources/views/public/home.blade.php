@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

{{-- Hero --}}
<section class="bg-gray-800 text-white">

    <div class="max-w-7xl mx-auto px-6 py-20">

        <div class="max-w-3xl">

            <p class="text-sm uppercase tracking-wider text-gray-300 mb-4">
                Website Resmi Desa
            </p>

            <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                Selamat Datang di Desa Kita
            </h1>

            <p class="mt-5 text-gray-300 text-lg leading-relaxed">
                Portal informasi dan pelayanan administrasi
                masyarakat Desa Kita.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">

                <a
                    href="{{ route('layanan') }}"
                    class="px-6 py-3 bg-white text-gray-800 rounded-md font-medium hover:bg-gray-100">
                    Layanan Masyarakat
                </a>

                <a
                    href="{{ route('profil') }}"
                    class="px-6 py-3 border border-gray-500 rounded-md font-medium hover:bg-gray-700">
                    Profil Desa
                </a>

            </div>

        </div>

    </div>

</section>


{{-- Layanan --}}
<section class="py-16">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-10">

            <p class="text-sm text-gray-500 uppercase tracking-wider">
                Pelayanan
            </p>

            <h2 class="text-3xl font-bold mt-2">
                Layanan Administrasi Desa
            </h2>

            <p class="text-gray-500 mt-3">
                Ajukan kebutuhan administrasi desa secara mudah.
            </p>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-lg shadow-sm border">

                <h3 class="font-semibold">
                    Surat Keterangan Domisili
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Pengajuan surat keterangan domisili.
                </p>

            </div>


            <div class="bg-white p-6 rounded-lg shadow-sm border">

                <h3 class="font-semibold">
                    Surat Pengantar KTP
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Pengajuan surat pengantar pembuatan KTP.
                </p>

            </div>


            <div class="bg-white p-6 rounded-lg shadow-sm border">

                <h3 class="font-semibold">
                    Surat Pengantar KK
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Pengajuan surat pengantar pembuatan KK.
                </p>

            </div>


            <div class="bg-white p-6 rounded-lg shadow-sm border">

                <h3 class="font-semibold">
                    Surat Keterangan Tidak Mampu
                </h3>

                <p class="text-sm text-gray-500 mt-2">
                    Pengajuan Surat Keterangan Tidak Mampu.
                </p>

            </div>

        </div>


        <div class="text-center mt-8">

            <a
                href="{{ route('layanan') }}"
                class="text-sm font-medium text-gray-700 hover:underline">
                Lihat semua layanan →
            </a>

        </div>

    </div>

</section>


{{-- Informasi Desa --}}
<section class="bg-white py-16 border-y">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <div>

                <p class="text-sm text-gray-500 uppercase tracking-wider">
                    Tentang Desa
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    Mengenal Desa Kita
                </h2>

                <p class="text-gray-600 mt-5 leading-relaxed">
                    Desa Kita merupakan bagian dari wilayah
                    Kecamatan dan Kabupaten. Website ini
                    menyediakan informasi desa serta layanan
                    administrasi bagi masyarakat.
                </p>

                <a
                    href="{{ route('profil') }}"
                    class="inline-block mt-6 text-sm font-medium text-gray-700 hover:underline">
                    Selengkapnya →
                </a>

            </div>


            <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center">

                <span class="text-gray-400">
                    Foto Desa
                </span>

            </div>

        </div>

    </div>

</section>

@endsection