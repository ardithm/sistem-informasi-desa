@extends('layouts.public')

@section('title', 'Layanan Masyarakat')

@section('content')

<section class="py-24">

    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-14 max-w-3xl">
            <p class="reveal font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase">
                PELAYANAN DESA DIGITAL
            </p>
            <h1 class="reveal delay-100 font-display text-4xl md:text-5xl lg:text-[60px] leading-none text-adm-text-main tracking-tight mt-3">
                Layanan Masyarakat
            </h1>
            <p class="reveal delay-200 font-sans font-light text-[17px] md:text-[18px] text-adm-text-body mt-4 leading-relaxed">
                Pilih dan ajukan berbagai kebutuhan surat keterangan administrasi desa secara online, cepat, dan transparan dari mana saja.
            </p>
        </div>

        {{-- Card Alur Layanan --}}
        <div class="reveal delay-200 mb-16 bg-white border border-adm-border rounded-[24px] md:rounded-[32px] p-6 sm:p-8 lg:p-10 shadow-[0_8px_40px_rgba(29,114,254,0.06)] relative overflow-hidden">
            
            {{-- Decorative ambient background glow --}}
            <div class="absolute -right-24 -top-24 w-80 h-80 bg-adm-primary/5 rounded-full blur-[90px] pointer-events-none"></div>
            <div class="absolute -left-24 -bottom-24 w-80 h-80 bg-cyan-signal/5 rounded-full blur-[90px] pointer-events-none"></div>

            {{-- Alur Header --}}
            <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4 pb-8 mb-8 border-b border-adm-border">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-adm-primary-soft text-adm-primary text-[11px] font-semibold tracking-wide uppercase mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-adm-primary animate-pulse"></span>
                        Panduan Pengajuan Surat
                    </div>
                    <h2 class="font-display text-2xl md:text-3xl text-adm-text-main font-bold tracking-tight">
                        Alur Pelayanan Administrasi Mandiri
                    </h2>
                    <p class="font-sans text-[14px] md:text-[15px] text-adm-text-body mt-1">
                        4 langkah praktis mengurus dokumen desa dari rumah tanpa perlu antre di kantor.
                    </p>
                </div>

                {{-- Direct CTA Cek Status --}}
                <div class="flex-shrink-0">
                    <a href="{{ route('status') }}" class="inline-flex items-center gap-2 bg-adm-canvas hover:bg-adm-primary-soft/60 border border-adm-border hover:border-adm-primary/30 text-adm-text-main hover:text-adm-primary px-4 py-2.5 rounded-[10px] text-[13px] font-semibold transition-all shadow-sm group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-adm-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        Lacak Status Surat
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-adm-text-muted group-hover:text-adm-primary group-hover:translate-x-0.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Steps Grid with Connector Line on Desktop --}}
            <div class="relative z-10">
                {{-- Desktop Connecting Line behind icons --}}
                <div class="hidden lg:block absolute top-[36px] left-[70px] right-[70px] h-[2px] bg-gradient-to-r from-adm-primary/20 via-adm-primary/40 to-adm-primary/20 z-0"></div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">
                    
                    {{-- Step 1 --}}
                    <div class="group bg-adm-canvas/80 hover:bg-white border border-adm-border/80 hover:border-adm-primary/30 rounded-[20px] p-6 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1 hover:shadow-md">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-14 h-14 rounded-[14px] bg-adm-primary-soft text-adm-primary flex items-center justify-center shadow-xs group-hover:bg-adm-primary group-hover:text-white transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </div>
                                <span class="font-mono text-xs font-bold text-adm-primary bg-white px-2.5 py-1 rounded-full border border-adm-border shadow-xs">01</span>
                            </div>
                            <h3 class="font-display text-[18px] font-bold text-adm-text-main mb-2">
                                Pilih & Isi Formulir
                            </h3>
                            <p class="font-sans text-[13px] leading-relaxed text-adm-text-body">
                                Pilih jenis surat di katalog bawah, isi data diri pemohon, dan lampirkan berkas persyaratan (KTP/KK).
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-adm-border/60 text-[11px] font-medium text-adm-text-muted flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-adm-green-fg"></span> Online 24 Jam
                        </div>
                    </div>

                    {{-- Step 2 --}}
                    <div class="group bg-adm-canvas/80 hover:bg-white border border-adm-border/80 hover:border-adm-primary/30 rounded-[20px] p-6 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1 hover:shadow-md">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-14 h-14 rounded-[14px] bg-adm-primary-soft text-adm-primary flex items-center justify-center shadow-xs group-hover:bg-adm-primary group-hover:text-white transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <span class="font-mono text-xs font-bold text-adm-primary bg-white px-2.5 py-1 rounded-full border border-adm-border shadow-xs">02</span>
                            </div>
                            <h3 class="font-display text-[18px] font-bold text-adm-text-main mb-2">
                                Verifikasi Berkas
                            </h3>
                            <p class="font-sans text-[13px] leading-relaxed text-adm-text-body">
                                Petugas administrasi desa memvalidasi NIK warga dan memeriksa keabsahan dokumen yang diunggah.
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-adm-border/60 text-[11px] font-medium text-adm-text-muted flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Jam Kerja Kantor
                        </div>
                    </div>

                    {{-- Step 3 --}}
                    <div class="group bg-adm-canvas/80 hover:bg-white border border-adm-border/80 hover:border-adm-primary/30 rounded-[20px] p-6 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1 hover:shadow-md">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-14 h-14 rounded-[14px] bg-adm-primary-soft text-adm-primary flex items-center justify-center shadow-xs group-hover:bg-adm-primary group-hover:text-white transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="font-mono text-xs font-bold text-adm-primary bg-white px-2.5 py-1 rounded-full border border-adm-border shadow-xs">03</span>
                            </div>
                            <h3 class="font-display text-[18px] font-bold text-adm-text-main mb-2">
                                Penerbitan Surat
                            </h3>
                            <p class="font-sans text-[13px] leading-relaxed text-adm-text-body">
                                Surat resmi diproses, diregistrasikan nomor keluarnya, dan disahkan oleh kepala desa atau pejabat berwenang.
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-adm-border/60 text-[11px] font-medium text-adm-text-muted flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-adm-primary"></span> Terintegrasi Sistem
                        </div>
                    </div>

                    {{-- Step 4 --}}
                    <div class="group bg-adm-canvas/80 hover:bg-white border border-adm-border/80 hover:border-adm-primary/30 rounded-[20px] p-6 transition-all duration-300 flex flex-col justify-between hover:-translate-y-1 hover:shadow-md">
                        <div>
                            <div class="flex items-center justify-between mb-5">
                                <div class="w-14 h-14 rounded-[14px] bg-adm-primary-soft text-adm-primary flex items-center justify-center shadow-xs group-hover:bg-adm-primary group-hover:text-white transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="font-mono text-xs font-bold text-adm-primary bg-white px-2.5 py-1 rounded-full border border-adm-border shadow-xs">04</span>
                            </div>
                            <h3 class="font-display text-[18px] font-bold text-adm-text-main mb-2">
                                Pengambilan Dokumen
                            </h3>
                            <p class="font-sans text-[13px] leading-relaxed text-adm-text-body">
                                Pantau status secara berkala. Ambil dokumen fisik asli di kantor desa atau unduh surat digital secara langsung.
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-adm-border/60 text-[11px] font-medium text-adm-text-muted flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Siap Diterima
                        </div>
                    </div>

                </div>
            </div>

            {{-- Bottom info callout strip --}}
            <div class="relative z-10 mt-8 pt-6 border-t border-adm-border flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-[13px] text-adm-text-muted">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-adm-primary flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Simpan <strong class="text-adm-text-main">Nomor Registrasi</strong> yang didapatkan setelah pengajuan untuk melacak perkembangan surat.</span>
                </div>
                <div class="inline-flex items-center gap-2 text-[12px] font-medium text-adm-text-main bg-adm-canvas px-3.5 py-1.5 rounded-full border border-adm-border whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-adm-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Estimasi Selesai: 1 Hari Kerja
                </div>
            </div>

        </div>

        {{-- Section Divider & Title: Pilihan Layanan --}}
        <div class="reveal delay-300 flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-3">
            <div>
                <p class="font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase">KATALOG SURAT</p>
                <h2 class="font-display text-2xl md:text-3xl text-adm-text-main font-bold tracking-tight mt-1">
                    Daftar Layanan Tersedia
                </h2>
            </div>
            <p class="text-[13px] text-adm-text-muted">
                Klik "Ajukan Layanan" pada formulir surat yang Anda butuhkan
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