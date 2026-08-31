@extends('layouts.public')

@section('title', 'Layanan Masyarakat')

@section('content')

<section class="py-24">

    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-16">
            <p class="reveal font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase">
                PELAYANAN DESA
            </p>
            <h1 class="reveal delay-100 font-display text-4xl md:text-5xl lg:text-[64px] leading-none text-adm-text-main tracking-tight mt-4">
                Layanan Masyarakat
            </h1>
            <p class="reveal delay-200 font-sans font-light text-[18px] text-adm-text-body mt-4">
                Pilih dan ajukan berbagai kebutuhan surat keterangan administrasi desa secara online.
            </p>
        </div>

        {{-- Grid Layanan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- 1. Domisili --}}
            <div class="reveal delay-100 bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] p-8 md:p-10 flex flex-col justify-between hover:-translate-y-1.5 transition-all duration-500">
                <div>
                    <div class="w-12 h-12 rounded-full bg-adm-primary-soft text-adm-primary flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <h2 class="font-display text-[24px] md:text-[28px] leading-[1.2] text-adm-text-main font-semibold">
                        Surat Keterangan Domisili
                    </h2>
                    <p class="font-sans font-light text-[15px] leading-relaxed text-adm-text-body mt-4">
                        Pengajuan surat keterangan tempat tinggal bagi penduduk menetap atau sementara di wilayah desa.
                    </p>
                </div>
                <div class="mt-8 pt-6 border-t border-adm-border">
                    <a href="{{ route('layanan.domisili') }}" class="inline-flex items-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                        Ajukan Layanan
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            {{-- 2. Pengantar KTP --}}
            <div class="reveal delay-200 bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] p-8 md:p-10 flex flex-col justify-between hover:-translate-y-1.5 transition-all duration-500">
                <div>
                    <div class="w-12 h-12 rounded-full bg-adm-primary-soft text-adm-primary flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                    </div>
                    <h2 class="font-display text-[24px] md:text-[28px] leading-[1.2] text-adm-text-main font-semibold">
                        Surat Pengantar KTP
                    </h2>
                    <p class="font-sans font-light text-[15px] leading-relaxed text-adm-text-body mt-4">
                        Pengajuan surat pengantar perekaman baru, cetak ulang, atau perubahan data Kartu Tanda Penduduk.
                    </p>
                </div>
                <div class="mt-8 pt-6 border-t border-adm-border">
                    <a href="{{ route('layanan.pengantar-ktp') }}" class="inline-flex items-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                        Ajukan Layanan
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            {{-- 3. Pengantar KK --}}
            <div class="reveal delay-300 bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] p-8 md:p-10 flex flex-col justify-between hover:-translate-y-1.5 transition-all duration-500">
                <div>
                    <div class="w-12 h-12 rounded-full bg-adm-primary-soft text-adm-primary flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h2 class="font-display text-[24px] md:text-[28px] leading-[1.2] text-adm-text-main font-semibold">
                        Surat Pengantar KK
                    </h2>
                    <p class="font-sans font-light text-[15px] leading-relaxed text-adm-text-body mt-4">
                        Surat pengantar untuk penerbitan Kartu Keluarga baru, perubahan susunan anggota, atau kehilangan.
                    </p>
                </div>
                <div class="mt-8 pt-6 border-t border-adm-border">
                    <a href="{{ route('layanan.pengantar-kk') }}" class="inline-flex items-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                        Ajukan Layanan
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            {{-- 4. SKTM --}}
            <div class="reveal delay-400 bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] p-8 md:p-10 flex flex-col justify-between hover:-translate-y-1.5 transition-all duration-500">
                <div>
                    <div class="w-12 h-12 rounded-full bg-adm-primary-soft text-adm-primary flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h2 class="font-display text-[24px] md:text-[28px] leading-[1.2] text-adm-text-main font-semibold">
                        Surat Keterangan Tidak Mampu
                    </h2>
                    <p class="font-sans font-light text-[15px] leading-relaxed text-adm-text-body mt-4">
                        Pengajuan Surat Keterangan Tidak Mampu (SKTM) untuk kebutuhan beasiswa, keringanan biaya medis, atau bantuan sosial.
                    </p>
                </div>
                <div class="mt-8 pt-6 border-t border-adm-border">
                    <a href="{{ route('layanan.sktm') }}" class="inline-flex items-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                        Ajukan Layanan
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        </div>

    </div>

</section>

@endsection