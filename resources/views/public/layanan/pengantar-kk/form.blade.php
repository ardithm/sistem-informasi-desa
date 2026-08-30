@extends('layouts.public')

@section('title', 'Pengajuan Surat Pengantar KK')

@section('content')

<div class="py-12">

    <div class="max-w-3xl mx-auto px-6">

        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Pengajuan Surat Pengantar KK
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Lengkapi data pengajuan dan dokumen yang diperlukan.
            </p>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-5">
                    Data Penduduk
                </h2>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
                        <div class="text-sm font-medium text-gray-500">NIK</div>
                        <div class="sm:col-span-2 text-sm text-gray-800">{{ $penduduk->nik }}</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
                        <div class="text-sm font-medium text-gray-500">Nama Lengkap</div>
                        <div class="sm:col-span-2 text-sm text-gray-800">{{ $penduduk->nama_lengkap }}</div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
                        <div class="text-sm font-medium text-gray-500">Alamat</div>
                        <div class="sm:col-span-2 text-sm text-gray-800">{{ $penduduk->alamat }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <form action="{{ route('layanan.pengantar-kk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="nik" value="{{ $penduduk->nik }}">
                <input type="hidden" name="penduduk_id" value="{{ $penduduk->id }}">
                <input type="hidden" name="layanan_id" value="{{ $layanan->id }}">
                <input type="hidden" name="no_hp" value="{{ $no_hp }}">

                <div class="p-6 space-y-6">
                    <div>
                        <label for="no_hp_display" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor HP
                        </label>
                        <input
                            id="no_hp_display"
                            type="tel"
                            value="{{ $no_hp }}"
                            readonly
                            class="w-full border-gray-300 rounded-md bg-gray-50">
                    </div>

                    <div>
                        <label for="nomor_kk" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor KK
                            <span class="text-red-600">*</span>
                        </label>
                        <input
                            id="nomor_kk"
                            type="text"
                            name="nomor_kk"
                            value="{{ old('nomor_kk') }}"
                            maxlength="16"
                            required
                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                        @error('nomor_kk')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-2">
                            Keperluan
                            <span class="text-red-600">*</span>
                        </label>
                        <textarea
                            id="keperluan"
                            name="keperluan"
                            rows="4"
                            required
                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">{{ old('keperluan') }}</textarea>

                        @error('keperluan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4 border-t border-gray-200 pt-6">
                        <div>
                            <label for="ktp" class="block text-sm font-medium text-gray-700 mb-2">
                                KTP
                                <span class="text-red-600">*</span>
                            </label>
                            <input
                                id="ktp"
                                type="file"
                                name="ktp"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-800 file:text-white hover:file:bg-gray-700">

                            @error('ktp')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kk" class="block text-sm font-medium text-gray-700 mb-2">
                                KK
                                <span class="text-red-600">*</span>
                            </label>
                            <input
                                id="kk"
                                type="file"
                                name="kk"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-800 file:text-white hover:file:bg-gray-700">

                            @error('kk')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="surat_rt_rw" class="block text-sm font-medium text-gray-700 mb-2">
                                Surat Pengantar RT/RW (Opsional)
                            </label>
                            <input
                                id="surat_rt_rw"
                                type="file"
                                name="surat_rt_rw"
                                accept=".jpg,.jpeg,.png,.pdf"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-800 file:text-white hover:file:bg-gray-700">

                            @error('surat_rt_rw')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('layanan.pengantar-kk') }}" class="text-sm text-gray-600 hover:text-gray-800">
                            Kembali
                        </a>

                        <button type="submit" class="px-5 py-2.5 bg-gray-800 text-white rounded-md hover:bg-gray-700 text-sm font-medium">
                            Ajukan Pengantar KK
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection