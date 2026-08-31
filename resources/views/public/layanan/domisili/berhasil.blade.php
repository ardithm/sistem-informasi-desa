@extends('layouts.public')

@section('title', 'Pengajuan Berhasil')

@section('content')

<div class="py-24">

    <div class="max-w-xl mx-auto px-6">

        <div class="bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] overflow-hidden">

            <div class="p-8 md:p-12 text-center">

                {{-- Ikon Berhasil --}}
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 bg-adm-green-bg text-adm-green-fg rounded-full flex items-center justify-center border border-adm-green-fg/10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                {{-- Judul --}}
                <div class="mb-8">
                    <h1 class="font-display text-[28px] md:text-[32px] leading-tight text-adm-text-main font-semibold">
                        Pengajuan Berhasil
                    </h1>
                    <p class="font-sans font-light text-[14px] text-adm-text-body mt-2">
                        Pengajuan Surat Keterangan Domisili Anda telah berhasil dikirim ke sistem.
                    </p>
                </div>

                {{-- Nomor Pengajuan --}}
                <div class="mb-8 p-5 bg-adm-canvas border border-adm-border rounded-[16px] text-left">
                    <p class="text-[11px] font-mono tracking-widest text-adm-text-muted uppercase mb-1">
                        Nomor Pengajuan
                    </p>
                    <p class="font-mono text-[18px] font-bold text-adm-text-main">
                        {{ $pengajuan->nomor_pengajuan }}
                    </p>
                    <p class="text-[12px] text-adm-text-muted mt-2">
                        Gunakan nomor pengajuan di atas untuk memeriksa status permohonan surat Anda di menu "Cek Status".
                    </p>
                </div>

                {{-- Informasi Pengajuan --}}
                <div class="border border-adm-border rounded-[16px] divide-y divide-adm-border overflow-hidden bg-adm-card text-left">

                    <div class="p-4 flex justify-between items-center gap-4">
                        <span class="text-[13px] font-medium text-adm-text-muted">
                            Nama Pemohon
                        </span>
                        <span class="text-[13px] font-semibold text-adm-text-main text-right">
                            {{ $pengajuan->penduduk->nama_lengkap }}
                        </span>
                    </div>

                    <div class="p-4 flex justify-between items-center gap-4">
                        <span class="text-[13px] font-medium text-adm-text-muted">
                            Jenis Layanan
                        </span>
                        <span class="text-[13px] font-semibold text-adm-text-main text-right">
                            {{ $pengajuan->layanan->nama_layanan }}
                        </span>
                    </div>

                    <div class="p-4 flex justify-between items-center gap-4">
                        <span class="text-[13px] font-medium text-adm-text-muted">
                            Status
                        </span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold bg-adm-amber-bg text-adm-amber-fg border border-adm-amber-fg/10">
                            Menunggu Verifikasi
                        </span>
                    </div>

                </div>

                {{-- Informasi Berikutnya --}}
                <div class="mt-8 p-5 bg-adm-blue-bg border border-adm-blue-fg/10 rounded-[16px] text-left">
                    <p class="font-sans font-medium text-[13px] text-adm-blue-fg leading-relaxed">
                        Pengajuan Anda saat ini sedang dalam antrean verifikasi oleh perangkat desa. Kami akan memvalidasi kesesuaian berkas and data yang Anda kirimkan. Silakan periksa status secara berkala.
                    </p>
                </div>

                {{-- Tombol --}}
                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('status.hasil', $pengajuan->id) }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                        Lihat Progres Surat
                    </a>
                    <a href="{{ route('layanan') }}" class="w-full sm:w-auto inline-flex items-center justify-center bg-white border border-adm-border text-adm-text-main hover:bg-adm-canvas px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-sm">
                        Kembali ke Layanan
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection