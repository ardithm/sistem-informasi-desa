@extends('layouts.public')

@section('title', 'Layanan Masyarakat')

@section('content')

<section class="py-16">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-10">

            <p class="text-sm text-gray-500 uppercase tracking-wider">
                Pelayanan Desa
            </p>

            <h1 class="text-4xl font-bold mt-2">
                Layanan Masyarakat
            </h1>

            <p class="text-gray-500 mt-3">
                Pilih layanan administrasi yang ingin diajukan.
            </p>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white border rounded-lg p-6">
                <h2 class="text-xl font-semibold">
                    Surat Keterangan Domisili
                </h2>

                <p class="text-gray-500 mt-3">
                    Pengajuan Surat Keterangan Domisili.
                </p>

                <a
                    href="{{ route('layanan.domisili') }}"
                    class="inline-block mt-5 px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                    Ajukan Layanan
                </a>
            </div>

            <div class="bg-white border rounded-lg p-6">
                <h2 class="text-xl font-semibold">
                    Surat Pengantar KTP
                </h2>

                <p class="text-gray-500 mt-3">
                    Pengajuan Surat Pengantar KTP.
                </p>

                <a
                    href="{{ route('layanan.pengantar-ktp') }}"
                    class="inline-block mt-5 px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                    Ajukan Layanan
                </a>
            </div>

            <div class="bg-white border rounded-lg p-6">
                <h2 class="text-xl font-semibold">
                    Surat Pengantar KK
                </h2>

                <p class="text-gray-500 mt-3">
                    Pengajuan Surat Pengantar KK.
                </p>

                <a
                    href="{{ route('layanan.pengantar-kk') }}"
                    class="inline-block mt-5 px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                    Ajukan Layanan
                </a>
            </div>

            <div class="bg-white border rounded-lg p-6">
                <h2 class="text-xl font-semibold">
                    Surat Keterangan Tidak Mampu
                </h2>

                <p class="text-gray-500 mt-3">
                    Pengajuan Surat Keterangan Tidak Mampu.
                </p>

                <a
                    href="{{ route('layanan.sktm') }}"
                    class="inline-block mt-5 px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                    Ajukan Layanan
                </a>
            </div>

        </div>

    </div>

</section>

</section>

@endsection