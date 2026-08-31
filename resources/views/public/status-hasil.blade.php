@extends('layouts.public')

@section('title', 'Status Pengajuan')

@section('content')

<div class="py-24">

    <div class="max-w-xl mx-auto px-6">

        <div class="reveal bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] overflow-hidden">

            <div class="p-8 md:p-12">

                <h1 class="font-display text-[28px] md:text-[32px] leading-tight text-adm-text-main font-semibold">
                    Status Pengajuan
                </h1>

                {{-- Nomor Pengajuan --}}
                <div class="mt-6 p-5 bg-adm-canvas border border-adm-border rounded-[16px]">
                    <p class="text-[11px] font-mono tracking-widest text-adm-text-muted uppercase">
                        Nomor Pengajuan
                    </p>
                    <p class="font-mono text-[16px] md:text-[18px] font-bold text-adm-text-main mt-1">
                        {{ $pengajuan->nomor_pengajuan }}
                    </p>
                </div>

                {{-- Informasi Pengajuan --}}
                <div class="mt-6 border border-adm-border rounded-[16px] divide-y divide-adm-border overflow-hidden bg-adm-card">

                    {{-- Nama --}}
                    <div class="p-4 flex justify-between items-center gap-4">
                        <span class="text-[13px] font-medium text-adm-text-muted">
                            Nama Pemohon
                        </span>
                        <span class="text-[13px] font-semibold text-adm-text-main text-right">
                            {{ $pengajuan->penduduk->nama_lengkap }}
                        </span>
                    </div>

                    {{-- Layanan --}}
                    <div class="p-4 flex justify-between items-center gap-4">
                        <span class="text-[13px] font-medium text-adm-text-muted">
                            Jenis Layanan
                        </span>
                        <span class="text-[13px] font-semibold text-adm-text-main text-right">
                            {{ $pengajuan->layanan->nama_layanan }}
                        </span>
                    </div>

                    {{-- Status --}}
                    <div class="p-4 flex justify-between items-center gap-4">
                        <span class="text-[13px] font-medium text-adm-text-muted">
                            Status Pengajuan
                        </span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold 
                            @if($pengajuan->status === 'selesai') bg-adm-green-bg text-adm-green-fg 
                            @elseif($pengajuan->status === 'ditolak') bg-adm-rose-bg text-adm-rose-fg 
                            @else bg-adm-amber-bg text-adm-amber-fg 
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $pengajuan->status)) }}
                        </span>
                    </div>

                </div>

                {{-- Dokumen Pengajuan --}}
                <div class="mt-8">

                    <h2 class="font-display text-[18px] md:text-[20px] font-semibold text-adm-text-main mb-4">
                        Dokumen Persyaratan
                    </h2>

                    <div class="border border-adm-border rounded-[16px] divide-y divide-adm-border overflow-hidden bg-adm-card">

                        @foreach ($pengajuan->dokumens as $dokumen)

                        <div class="p-5">

                            <div class="flex justify-between items-start gap-4">

                                <div>
                                    <p class="text-[14px] font-semibold text-adm-text-main">
                                        {{ $dokumen->jenis_dokumen }}
                                    </p>
                                    <p class="text-[12px] font-mono text-adm-text-muted mt-1 truncate max-w-[220px] sm:max-w-xs">
                                        {{ $dokumen->nama_file }}
                                    </p>
                                </div>

                                {{-- Status Dokumen --}}
                                <div>
                                    @if ($dokumen->status_verifikasi === 'valid')
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-semibold bg-adm-green-bg text-adm-green-fg border border-adm-green-fg/10">
                                        Valid
                                    </span>
                                    @elseif ($dokumen->status_verifikasi === 'tidak_valid')
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-semibold bg-adm-rose-bg text-adm-rose-fg border border-adm-rose-fg/10">
                                        Tidak Valid
                                    </span>
                                    @elseif ($dokumen->status_verifikasi === 'ditolak')
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-semibold bg-adm-rose-bg text-adm-rose-fg border border-adm-rose-fg/10">
                                        Ditolak
                                    </span>
                                    @else
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-semibold bg-adm-amber-bg text-adm-amber-fg border border-adm-amber-fg/10">
                                        Menunggu Verifikasi
                                    </span>
                                    @endif
                                </div>

                            </div>

                            {{-- Catatan Admin --}}
                            @if ($dokumen->catatan)
                            <div class="mt-4 p-4 bg-adm-rose-bg border border-adm-rose-fg/10 rounded-[12px]">
                                <p class="text-[11px] font-semibold uppercase tracking-wider text-adm-rose-fg">
                                    Catatan Koreksi Admin:
                                </p>
                                <p class="text-[13px] text-adm-rose-fg mt-1">
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
                                <a href="{{ route('status.revisi', [$pengajuan->id, $dokumen->id]) }}" class="inline-flex items-center gap-1.5 bg-adm-amber-bg text-adm-amber-fg border border-adm-amber-fg/20 px-4 py-2 rounded-[8px] text-[12px] font-semibold transition-all hover:bg-adm-amber-fg hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>
                                    Unggah Ulang Dokumen
                                </a>
                            </div>
                            @endif

                        </div>

                        @endforeach

                    </div>

                </div>

                {{-- Tombol Lihat Surat --}}
                @if ($pengajuan->status === 'selesai' && $pengajuan->surat)
                <div class="mt-8">
                    <a href="/status-pengajuan/{{ $pengajuan->id }}/surat" target="_blank" rel="noopener noreferrer" class="w-full inline-flex items-center justify-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3.5 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
                        Unduh / Lihat Surat
                    </a>
                </div>
                @endif

                {{-- Tombol Cek Pengajuan Lain --}}
                <div class="mt-4">
                    <a href="{{ route('status') }}" class="w-full inline-flex items-center justify-center gap-1.5 bg-white border border-adm-border text-adm-text-main hover:bg-adm-canvas px-6 py-3.5 rounded-[8px] text-[14px] font-semibold transition-all shadow-sm">
                        Cek Pengajuan Lain
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection