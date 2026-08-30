@extends('layouts.public')

@section('title', 'Surat Pengantar KK')

@section('content')

<div class="py-12">

    <div class="max-w-xl mx-auto px-6">

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

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">

            <div class="p-6">

                <div class="mb-6">
                    <h1 class="text-xl font-semibold text-gray-800">
                        Verifikasi Data Penduduk
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Surat Pengantar KK
                    </p>
                </div>

                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-md">
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Silakan masukkan NIK dan nomor HP untuk memverifikasi data penduduk sebelum melanjutkan pengajuan surat.
                    </p>
                </div>

                <form action="{{ route('layanan.pengantar-kk.verifikasi') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">
                            NIK
                            <span class="text-red-600">*</span>
                        </label>
                        <input
                            id="nik"
                            type="text"
                            name="nik"
                            value="{{ old('nik') }}"
                            inputmode="numeric"
                            maxlength="16"
                            required
                            autofocus
                            placeholder="Masukkan 16 digit NIK"
                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                        @if (isset($errors) && $errors->has('nik'))
                        @error('nik')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        @endif
                    </div>

                    <div class="mb-6">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor HP
                            <span class="text-red-600">*</span>
                        </label>
                        <input
                            id="no_hp"
                            type="tel"
                            name="no_hp"
                            value="{{ old('no_hp') }}"
                            maxlength="20"
                            required
                            placeholder="Contoh: 081234567890"
                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                        <p class="text-xs text-gray-500 mt-2">
                            Nomor HP digunakan untuk keperluan pengajuan dan komunikasi terkait layanan.
                        </p>

                        @if (isset($errors) && $errors->has('no_hp'))
                        @error('no_hp')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        @endif
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <a href="{{ route('layanan') }}" class="text-sm text-gray-600 hover:text-gray-800">
                            Kembali
                        </a>

                        <button type="submit" class="px-5 py-2.5 bg-gray-800 text-white rounded-md hover:bg-gray-700 text-sm font-medium">
                            Verifikasi Data
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection