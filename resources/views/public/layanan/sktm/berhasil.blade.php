@extends('layouts.public')

@section('title', 'Pengajuan SKTM Berhasil')

@section('content')

<div class="py-12">

    <div class="max-w-xl mx-auto px-6">

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">

            <div class="p-6">

                <div class="text-center">

                    <div class="mx-auto w-12 h-12 flex items-center justify-center rounded-full bg-green-100">

                        <span class="text-green-600 text-xl">
                            ✓
                        </span>

                    </div>

                    <h1 class="mt-4 text-xl font-semibold text-gray-800">
                        Pengajuan Berhasil
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Pengajuan Surat Keterangan Tidak Mampu berhasil
                        dikirim dan sedang menunggu verifikasi admin.
                    </p>

                </div>

                {{-- Nomor Pengajuan --}}
                <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md">

                    <p class="text-xs text-gray-500">
                        Nomor Pengajuan
                    </p>

                    <p class="text-lg font-semibold text-gray-800 mt-1">
                        {{ $pengajuan->nomor_pengajuan }}
                    </p>

                    <p class="text-xs text-gray-500 mt-2">
                        Simpan nomor ini untuk mengecek status pengajuan.
                    </p>

                </div>

                {{-- Informasi --}}
                <div class="mt-5 border border-gray-200 rounded-md divide-y">

                    <div class="p-4 flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Nama
                        </span>

                        <span class="text-sm font-medium text-gray-800">
                            {{ $pengajuan->penduduk->nama_lengkap }}
                        </span>

                    </div>

                    <div class="p-4 flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Layanan
                        </span>

                        <span class="text-sm font-medium text-gray-800">
                            {{ $pengajuan->layanan->nama_layanan }}
                        </span>

                    </div>

                    <div class="p-4 flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Status
                        </span>

                        <span class="text-sm font-semibold text-gray-800">
                            Menunggu Verifikasi
                        </span>

                    </div>

                </div>

                {{-- Tombol --}}
                <div class="mt-6 space-y-3">

                    <a
                        href="{{ route('status') }}"
                        class="block w-full text-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                        Cek Status Pengajuan

                    </a>

                    <a
                        href="{{ route('layanan') }}"
                        class="block w-full text-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50">

                        Kembali ke Layanan

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection