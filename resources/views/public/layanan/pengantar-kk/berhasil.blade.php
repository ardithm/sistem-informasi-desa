@extends('layouts.public')

@section('title', 'Pengajuan Surat Pengantar KK Berhasil')

@section('content')

<div class="py-12">
    <div class="max-w-xl mx-auto px-6">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-8 text-center">
                <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-green-100 text-green-600 mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 3" />
                    </svg>
                </div>

                <h1 class="text-2xl font-semibold text-gray-800">
                    Pengajuan Berhasil Dikirim
                </h1>

                <p class="mt-4 text-gray-600">
                    Pengajuan Surat Pengantar KK Anda telah berhasil dikirim dan menunggu verifikasi dari petugas desa.
                </p>

                <div class="mt-6 bg-gray-50 border border-gray-200 rounded-md p-4 text-left">
                    <p class="text-sm text-gray-500">Nomor Pengajuan</p>
                    <p class="mt-1 text-lg font-semibold text-gray-800">{{ $pengajuan->nomor_pengajuan }}</p>
                    <p class="mt-2 text-sm text-gray-500">Layanan: {{ $pengajuan->layanan->nama_layanan }}</p>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
                    <a href="{{ route('home') }}" class="px-5 py-2.5 bg-gray-800 text-white rounded-md hover:bg-gray-700 text-sm font-medium">
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('status') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 text-sm font-medium">
                        Cek Status Pengajuan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection