@extends('layouts.public')

@section('title', 'Pengajuan Surat Keterangan Domisili')

@section('content')

<div class="py-12">

    <div class="max-w-3xl mx-auto px-6">


        {{-- Header --}}
        <div class="mb-6">

            <h1 class="text-2xl font-semibold text-gray-800">
                Pengajuan Surat Keterangan Domisili
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


                    {{-- NIK --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            NIK
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">
                            {{ $penduduk->nik }}
                        </div>

                    </div>


                    {{-- Nama --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            Nama Lengkap
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">
                            {{ $penduduk->nama_lengkap }}
                        </div>

                    </div>


                    {{-- Tempat Tanggal Lahir --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            Tempat, Tanggal Lahir
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">

                            {{ $penduduk->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->translatedFormat('d F Y') }}

                        </div>

                    </div>


                    {{-- Jenis Kelamin --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            Jenis Kelamin
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">

                            {{ $penduduk->jenis_kelamin === 'L'
                                ? 'Laki-laki'
                                : 'Perempuan'
                            }}

                        </div>

                    </div>


                    {{-- Status Perkawinan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            Status Perkawinan
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">

                            @switch($penduduk->status_perkawinan)

                            @case('belum_kawin')
                            Belum Kawin
                            @break

                            @case('kawin')
                            Kawin
                            @break

                            @case('cerai_hidup')
                            Cerai Hidup
                            @break

                            @case('cerai_mati')
                            Cerai Mati
                            @break

                            @default
                            -

                            @endswitch

                        </div>

                    </div>


                    {{-- Pekerjaan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            Pekerjaan
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">
                            {{ $penduduk->pekerjaan }}
                        </div>

                    </div>


                    {{-- Alamat KTP --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            Alamat Sesuai KTP
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">
                            {{ $penduduk->alamat }}
                        </div>

                    </div>


                    {{-- RT/RW --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">

                        <div class="text-sm font-medium text-gray-500">
                            RT/RW
                        </div>

                        <div class="sm:col-span-2 text-sm text-gray-800">
                            RT {{ $penduduk->rt }} / RW {{ $penduduk->rw }}
                        </div>

                    </div>


                </div>

            </div>

        </div>


        {{-- Form Pengajuan --}}
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">

            <form
                action="{{ route('layanan.domisili.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <input
                    type="hidden"
                    name="penduduk_id"
                    value="{{ $penduduk->id }}">

                <input
                    type="hidden"
                    name="layanan_id"
                    value="{{ $layanan->id }}">

                <div class="p-6 space-y-6">


                    {{-- Nomor HP --}}
                    <div>

                        <input type="hidden" name="no_hp" value="{{ $no_hp }}">

                        <label
                            for="no_hp_display"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Nomor HP

                            <span class="text-red-600">*</span>

                        </label>

                        <input
                            id="no_hp_display"
                            type="tel"
                            value="{{ $no_hp }}"
                            maxlength="20"
                            class="w-full border-gray-300 rounded-md bg-gray-50 focus:border-gray-500 focus:ring-gray-500"
                            disabled>

                        <p class="text-xs text-gray-500 mt-2">
                            Pastikan nomor HP masih aktif.
                        </p>

                    </div>


                    {{-- Alamat Domisili --}}
                    <div>

                        <label
                            for="alamat_domisili"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Alamat Domisili Saat Ini

                            <span class="text-red-600">*</span>

                        </label>

                        <textarea
                            id="alamat_domisili"
                            name="alamat_domisili"
                            rows="4"
                            required
                            placeholder="Masukkan alamat tempat tinggal saat ini..."
                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">{{ old('alamat_domisili') }}</textarea>

                        @if (isset($errors) && $errors->has('alamat_domisili'))
                        <p class="text-sm text-red-600 mt-1">
                            {{ $errors->first('alamat_domisili') }}
                        </p>
                        @endif

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
                            placeholder="Contoh: Untuk keperluan administrasi pekerjaan..."
                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">{{ old('keperluan') }}</textarea>

                        @if (isset($errors) && $errors->has('keperluan'))
                        <p class="text-sm text-red-600 mt-1">
                            {{ $errors->first('keperluan') }}
                        </p>
                        @endif

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
                                Format JPG, JPEG, PNG, atau PDF. Maksimal 2 MB.
                            </p>

                        </div>


                        {{-- KK --}}
                        <div class="mb-5">

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
                                Format JPG, JPEG, PNG, atau PDF. Maksimal 2 MB.
                            </p>

                        </div>


                        {{-- Surat RT/RW --}}
                        <div>

                            <label
                                for="surat_rt_rw"
                                class="block text-sm font-medium text-gray-700 mb-2">

                                Surat Pengantar RT/RW

                            </label>

                            <input
                                id="surat_rt_rw"
                                type="file"
                                name="surat_rt_rw"
                                accept=".jpg,.jpeg,.png,.pdf"
                                class="block w-full text-sm text-gray-600 border border-gray-300 rounded-md cursor-pointer">

                            <p class="text-xs text-gray-500 mt-2">
                                Jika diwajibkan oleh desa.
                                Format JPG, JPEG, PNG, atau PDF. Maksimal 2 MB.
                            </p>

                        </div>

                    </div>


                </div>


                {{-- Footer --}}
                <div class="px-6 py-4 bg-gray-50 border-t">

                    <div class="flex justify-between items-center">


                        <a
                            href="{{ route('layanan.domisili') }}"
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