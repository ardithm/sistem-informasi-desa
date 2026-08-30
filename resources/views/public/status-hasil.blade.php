@extends('layouts.public')

@section('title', 'Status Pengajuan')

@section('content')

<div class="py-12">

    <div class="max-w-xl mx-auto px-6">

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">

            <div class="p-6">

                <h1 class="text-xl font-semibold text-gray-800">
                    Status Pengajuan
                </h1>

                {{-- Nomor Pengajuan --}}
                <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md">

                    <p class="text-xs text-gray-500">
                        Nomor Pengajuan
                    </p>

                    <p class="text-lg font-semibold text-gray-800 mt-1">
                        {{ $pengajuan->nomor_pengajuan }}
                    </p>

                </div>

                {{-- Informasi Pengajuan --}}
                <div class="mt-5 border border-gray-200 rounded-md divide-y">

                    {{-- Nama --}}
                    <div class="p-4 flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Nama
                        </span>

                        <span class="text-sm font-medium text-gray-800 text-right">
                            {{ $pengajuan->penduduk->nama_lengkap }}
                        </span>

                    </div>

                    {{-- Layanan --}}
                    <div class="p-4 flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Layanan
                        </span>

                        <span class="text-sm font-medium text-gray-800 text-right">
                            {{ $pengajuan->layanan->nama_layanan }}
                        </span>

                    </div>

                    {{-- Status --}}
                    <div class="p-4 flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Status
                        </span>

                        <span class="text-sm font-semibold text-gray-800">
                            {{ ucfirst(str_replace('_', ' ', $pengajuan->status)) }}
                        </span>

                    </div>

                </div>

                {{-- Dokumen Pengajuan --}}
                <div class="mt-6">

                    <h2 class="text-base font-semibold text-gray-800 mb-3">
                        Dokumen Pengajuan
                    </h2>

                    <div class="border border-gray-200 rounded-md divide-y">

                        @foreach ($pengajuan->dokumens as $dokumen)

                        <div class="p-4">

                            <div class="flex justify-between items-start gap-4">

                                <div>

                                    <p class="text-sm font-medium text-gray-800">
                                        {{ $dokumen->jenis_dokumen }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $dokumen->nama_file }}
                                    </p>

                                </div>


                                {{-- Status Dokumen --}}
                                @if ($dokumen->status_verifikasi === 'valid')

                                <span class="text-xs font-medium text-green-700">
                                    Valid
                                </span>

                                @elseif ($dokumen->status_verifikasi === 'tidak_valid')

                                <span class="text-xs font-medium text-red-700">
                                    Tidak Valid
                                </span>

                                @elseif ($dokumen->status_verifikasi === 'ditolak')

                                <span class="text-xs font-medium text-red-700">
                                    Ditolak
                                </span>

                                @else

                                <span class="text-xs font-medium text-yellow-700">
                                    Menunggu Verifikasi
                                </span>

                                @endif

                            </div>


                            {{-- Catatan Admin --}}
                            @if ($dokumen->catatan)

                            <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-md">

                                <p class="text-xs font-medium text-red-700">
                                    Catatan Admin
                                </p>

                                <p class="text-sm text-red-700 mt-1">
                                    {{ $dokumen->catatan }}
                                </p>

                            </div>

                            @endif


                            {{-- Upload Ulang --}}
                            @if (
                            $dokumen->status_verifikasi === 'tidak_valid' ||
                            $dokumen->status_verifikasi === 'ditolak'
                            )

                            <div class="mt-4">

                                <a
                                    href="{{ route('status.revisi', [$pengajuan->id, $dokumen->id]) }}"
                                    class="inline-block px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                                    Upload Ulang

                                </a>

                            </div>

                            @endif

                        </div>

                        @endforeach

                    </div>

                </div>

                {{-- Tombol Lihat Surat --}}
                @if ($pengajuan->status === 'selesai' && $pengajuan->surat)

                <div class="mt-6">

                    <a
                        href="/status-pengajuan/{{ $pengajuan->id }}/surat"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="block w-full text-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                        Lihat Surat

                    </a>

                </div>

                @endif

                {{-- Tombol Cek Pengajuan Lain --}}
                <div class="mt-6">

                    <a
                        href="{{ route('status') }}"
                        class="block w-full text-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                        Cek Pengajuan Lain

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection