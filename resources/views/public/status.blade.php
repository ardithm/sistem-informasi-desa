@extends('layouts.public')

@section('title', 'Cek Status Pengajuan')

@section('content')

<div class="py-12">

    <div class="max-w-xl mx-auto px-6">

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">

            <div class="p-6">

                <h1 class="text-xl font-semibold text-gray-800">
                    Cek Status Pengajuan
                </h1>

                <p class="text-sm text-gray-500 mt-2 mb-6">
                    Masukkan nomor pengajuan untuk melihat status pengajuan surat Anda.
                </p>

                {{-- Pesan error --}}
                @if (session('error'))

                <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-md">
                    <p class="text-sm text-red-700">
                        {{ session('error') }}
                    </p>
                </div>

                @endif

                <form
                    action="{{ route('status.cek') }}"
                    method="POST">

                    @csrf

                    <div class="mb-5">

                        <label
                            for="nomor_pengajuan"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Nomor Pengajuan

                        </label>

                        <input
                            type="text"
                            name="nomor_pengajuan"
                            id="nomor_pengajuan"
                            value="{{ old('nomor_pengajuan') }}"
                            placeholder="Contoh: SKD-20260829113005-GMUR"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500"
                            required>

                        @error('nomor_pengajuan')

                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="w-full px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                        Cek Status

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection