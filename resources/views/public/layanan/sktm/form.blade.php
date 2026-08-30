@extends('layouts.public')

@section('title', 'Pengajuan Surat Keterangan Tidak Mampu')

@section('content')

<div class="py-12">

    <div class="max-w-3xl mx-auto px-6">

        {{-- Error --}}
        @if (isset($errors) && $errors->any())

        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md">

            <p class="font-medium mb-2">
                Periksa kembali data:
            </p>

            <ul class="list-disc list-inside text-sm space-y-1">

                @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        {{-- Header --}}
        <div class="mb-6">

            <h1 class="text-2xl font-semibold text-gray-800">
                Pengajuan Surat Keterangan Tidak Mampu
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Lengkapi data pengajuan dan dokumen yang diperlukan.
            </p>

        </div>

        {{-- Data Penduduk --}}
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

            <div class="p-6">

                <h2 class="text-lg font-semibold text-gray-800 mb-5">
                    Data Penduduk
                </h2>

                <div class="space-y-4">

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            NIK
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">
                            {{ $penduduk->nik }}
                        </div>

                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            Nama Lengkap
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">
                            {{ $penduduk->nama_lengkap }}
                        </div>

                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            Alamat
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">
                            {{ $penduduk->alamat }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Form Pengajuan --}}
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">

            <form
                action="{{ route('layanan.sktm.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <input
                    type="hidden"
                    name="nik"
                    value="{{ $penduduk->nik }}">

                <input
                    type="hidden"
                    name="penduduk_id"
                    value="{{ $penduduk->id }}">

                <input
                    type="hidden"
                    name="layanan_id"
                    value="{{ $layanan->id }}">

                <input
                    type="hidden"
                    name="no_hp"
                    value="{{ $no_hp }}">

                <div class="p-6 space-y-6">

                    {{-- Nomor HP --}}
                    <div>

                        <label
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Nomor HP

                        </label>

                        <input
                            type="tel"
                            value="{{ $no_hp }}"
                            readonly
                            class="w-full border-gray-300 rounded-md bg-gray-50">

                    </div>

                    {{-- Jumlah Anggota --}}
                    <div>

                        <label
                            for="jumlah_anggota_keluarga"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Jumlah Anggota Keluarga

                            <span class="text-red-600">*</span>

                        </label>

                        <input
                            id="jumlah_anggota_keluarga"
                            type="number"
                            name="jumlah_anggota_keluarga"
                            value="{{ old('jumlah_anggota_keluarga') }}"
                            min="1"
                            required
                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                        @error('jumlah_anggota_keluarga')

                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                    {{-- Penghasilan --}}
                    <div>

                        <label
                            for="penghasilan_per_bulan"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Penghasilan Per Bulan

                            <span class="text-red-600">*</span>

                        </label>

                        <input
                            id="penghasilan_per_bulan"
                            type="number"
                            name="penghasilan_per_bulan"
                            value="{{ old('penghasilan_per_bulan') }}"
                            min="0"
                            required
                            placeholder="Contoh: 1500000"
                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                        @error('penghasilan_per_bulan')

                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                    {{-- Keperluan --}}
                    <div>

                        <label
                            for="keperluan"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Keperluan Pembuatan Surat

                            <span class="text-red-600">*</span>

                        </label>

                        <textarea
                            id="keperluan"
                            name="keperluan"
                            rows="4"
                            required
                            placeholder="Contoh: Untuk keperluan bantuan sosial..."
                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">{{ old('keperluan') }}</textarea>

                        @error('keperluan')

                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                    {{-- Dokumen --}}
                    <div>

                        <h2 class="text-lg font-semibold text-gray-800 mb-4">
                            Dokumen Persyaratan
                        </h2>

                        {{-- KTP --}}
                        <div class="mb-5">

                            <label
                                for="ktp"
                                class="block text-sm font-medium text-gray-700 mb-2">

                                KTP

                                <span class="text-red-600">*</span>

                            </label>

                            <input
                                id="ktp"
                                type="file"
                                name="ktp"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                                class="block w-full text-sm text-gray-600 border border-gray-300 rounded-md cursor-pointer">

                            <p class="text-xs text-gray-500 mt-2">
                                JPG, JPEG, PNG, atau PDF. Maksimal 2 MB.
                            </p>

                        </div>

                        {{-- KK --}}
                        <div>

                            <label
                                for="kk"
                                class="block text-sm font-medium text-gray-700 mb-2">

                                Kartu Keluarga (KK)

                                <span class="text-red-600">*</span>

                            </label>

                            <input
                                id="kk"
                                type="file"
                                name="kk"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                                class="block w-full text-sm text-gray-600 border border-gray-300 rounded-md cursor-pointer">

                            <p class="text-xs text-gray-500 mt-2">
                                JPG, JPEG, PNG, atau PDF. Maksimal 2 MB.
                            </p>

                        </div>

                    </div>

                </div>

                {{-- Footer --}}
                <div class="px-6 py-4 bg-gray-50 border-t">

                    <div class="flex justify-between items-center">

                        <a
                            href="{{ route('layanan.sktm') }}"
                            class="px-5 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-white">

                            Kembali

                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                            Ajukan Permohonan

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection