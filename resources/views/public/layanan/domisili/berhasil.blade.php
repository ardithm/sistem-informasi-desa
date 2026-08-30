@extends('layouts.public')

@section('title', 'Pengajuan Berhasil')

@section('content')

<div class="py-12">

    <div class="max-w-xl mx-auto px-6">

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">

            <div class="p-6">

                {{-- Ikon berhasil --}}
                <div class="flex justify-center mb-5">

                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">

                        <svg
                            class="w-8 h-8 text-green-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7">
                            </path>

                        </svg>

                    </div>

                </div>


                {{-- Judul --}}
                <div class="text-center mb-6">

                    <h1 class="text-xl font-semibold text-gray-800">
                        Pengajuan Berhasil
                    </h1>

                    <p class="text-sm text-gray-500 mt-2">
                        Pengajuan Surat Keterangan Domisili
                        berhasil dikirim.
                    </p>

                </div>


                {{-- Nomor Pengajuan --}}
                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-md">

                    <p class="text-xs text-gray-500 mb-1">
                        Nomor Pengajuan
                    </p>

                    <p class="text-lg font-semibold text-gray-800">
                        {{ $pengajuan->nomor_pengajuan }}
                    </p>

                    <p class="text-xs text-gray-500 mt-2">
                        Simpan nomor pengajuan ini untuk
                        keperluan pengecekan status pengajuan.
                    </p>

                </div>


                {{-- Informasi Pengajuan --}}
                <div class="border border-gray-200 rounded-md divide-y">

                    <div class="p-4 flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Nama
                        </span>

                        <span class="text-sm font-medium text-gray-800 text-right">
                            {{ $pengajuan->penduduk->nama_lengkap }}
                        </span>

                    </div>


                    <div class="p-4 flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Layanan
                        </span>

                        <span class="text-sm font-medium text-gray-800 text-right">
                            {{ $pengajuan->layanan->nama_layanan }}
                        </span>

                    </div>


                    <div class="p-4 flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Status
                        </span>

                        <span class="text-sm font-medium text-yellow-700">
                            Menunggu Verifikasi
                        </span>

                    </div>

                </div>


                {{-- Informasi berikutnya --}}
                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-md">

                    <p class="text-sm text-blue-800 leading-relaxed">

                        Pengajuan Anda telah diterima oleh sistem.
                        Petugas desa akan melakukan verifikasi
                        terhadap data dan dokumen yang Anda kirimkan.

                    </p>

                </div>


                {{-- Tombol --}}
                <div class="mt-6 flex justify-center">

                    <a
                        href="{{ route('layanan') }}"
                        class="px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                        Kembali ke Layanan

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection