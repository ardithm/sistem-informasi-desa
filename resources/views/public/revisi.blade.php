@extends('layouts.public')

@section('title', 'Upload Ulang Dokumen')

@section('content')

<div class="py-12">

    <div class="max-w-xl mx-auto px-6">

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">

            <div class="p-6">

                <h1 class="text-xl font-semibold text-gray-800">
                    Upload Ulang Dokumen
                </h1>

                <p class="text-sm text-gray-500 mt-2">
                    Silakan upload dokumen baru untuk mengganti dokumen
                    yang perlu diperbaiki.
                </p>

                {{-- Informasi Dokumen --}}
                <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md">

                    <p class="text-xs text-gray-500">
                        Dokumen
                    </p>

                    <p class="text-base font-semibold text-gray-800 mt-1">
                        {{ $dokumen->jenis_dokumen }}
                    </p>

                    @if ($dokumen->catatan)

                    <div class="mt-3">

                        <p class="text-xs font-medium text-red-600">
                            Catatan Admin
                        </p>

                        <p class="text-sm text-red-700 mt-1">
                            {{ $dokumen->catatan }}
                        </p>

                    </div>

                    @endif

                </div>

                {{-- Error Validasi --}}
                @if ($errors->any())

                <div class="mt-5 p-4 bg-red-50 border border-red-200 rounded-md">

                    <ul class="text-sm text-red-700 list-disc list-inside">

                        @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

                @endif

                {{-- Form Upload --}}
                <form
                    action="{{ route('status.revisi.store', [$pengajuan->id, $dokumen->id]) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="mt-6">

                    @csrf

                    <div>

                        <label
                            for="dokumen"
                            class="block text-sm font-medium text-gray-700 mb-2">

                            Dokumen Baru

                        </label>

                        <input
                            type="file"
                            name="dokumen"
                            id="dokumen"
                            accept=".jpg,.jpeg,.png,.pdf"
                            required
                            class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md">

                        <p class="text-xs text-gray-500 mt-2">
                            Format: JPG, JPEG, PNG, PDF. Maksimal 2 MB.
                        </p>

                    </div>

                    <div class="mt-6 flex gap-3">

                        <a
                            href="{{ route('status.hasil', $pengajuan->id) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm hover:bg-gray-300">

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                            Upload Dokumen

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection