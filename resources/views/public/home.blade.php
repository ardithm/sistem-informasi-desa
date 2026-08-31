@extends('layouts.public')

@section('title', 'Beranda')

@section('content')

{{-- Hero Section --}}
<section class="relative pt-12 pb-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col items-center text-center">
        
        {{-- Promo Eyebrow Badge --}}
        <div class="reveal inline-flex items-center rounded-full bg-adm-primary/10 border border-adm-primary/20 px-[18px] py-[10px] mb-8">
            <span class="font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase">
                PORTAL RESMI — DESA KITA 2026
            </span>
        </div>

        {{-- Whisper-weight Serif Headline --}}
        <h1 class="reveal delay-100 font-display text-5xl md:text-7xl lg:text-[96px] leading-[0.9] text-adm-text-main max-w-4xl tracking-tight mb-8">
            Membangun desa digital, transparan, dan maju.
        </h1>

        <p class="reveal delay-200 font-sans font-light text-[18px] md:text-[20px] leading-[1.6] text-adm-text-body max-w-2xl mb-14">
            Nikmati kemudahan mengakses informasi dan mengajukan layanan administrasi desa langsung dari genggaman Anda.
        </p>

        <div class="reveal delay-300 flex flex-col sm:flex-row items-center gap-4 mb-24">
            <a href="{{ route('layanan') }}" class="inline-flex items-center gap-2 bg-adm-primary text-white px-[24px] py-[16px] rounded-[8px] text-[16px] font-medium transition-all hover:bg-adm-primary-hover hover:-translate-y-1 shadow-lg">
                Ajukan Layanan
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
            <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 bg-white border border-adm-border text-adm-text-main px-[24px] py-[16px] rounded-[8px] text-[16px] font-medium transition-colors hover:bg-adm-canvas shadow-sm">
                Mengenal Desa
            </a>
        </div>

        {{-- Phone Mockup / Product Showcase Module --}}
        <div class="reveal delay-400 w-full max-w-5xl bg-adm-card rounded-[24px] md:rounded-[40px] p-6 md:p-12 lg:p-20 shadow-[0_8px_40px_rgba(29,114,254,0.1)] border border-adm-border relative">
            
            {{-- Decorative blur --}}
            <div class="absolute inset-0 bg-adm-primary/5 blur-[100px] rounded-[40px] pointer-events-none"></div>

            <div class="relative rounded-[16px] overflow-hidden border border-adm-border shadow-lg transform hover:scale-[1.01] transition-transform duration-700">
                <img src="{{ asset('images/dashboard_public.jpg') }}" alt="Tampilan Portal Desa" class="w-full h-auto object-cover">
            </div>
            
        </div>

    </div>
</section>


{{-- Feature Modules (Layanan) --}}
<section class="py-24 bg-white border-y border-adm-border">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="reveal">
                <p class="font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase mb-4">Layanan Administrasi</p>
                <h2 class="font-display text-4xl md:text-5xl lg:text-[64px] leading-none text-adm-text-main tracking-tight">
                    Layanan publik <br>tanpa antrean.
                </h2>
            </div>
            <div class="reveal delay-100">
                <a href="{{ route('layanan') }}" class="inline-flex items-center gap-2 text-adm-primary font-medium hover:text-adm-primary-hover transition-colors">
                    Lihat Semua Layanan
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Card 1: Iris Gleam --}}
            <a href="{{ route('layanan.domisili') }}" class="reveal delay-100 bg-iris-gleam rounded-[30px] p-8 md:p-10 text-white transform transition-transform duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(132,125,255,0.3)] flex flex-col justify-between h-[340px] cursor-pointer">
                <div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <h3 class="font-display text-[32px] md:text-[38px] leading-[1.1] mb-4">Keterangan <br>Domisili</h3>
                </div>
                <p class="font-sans font-light text-white/90 text-[15px] leading-relaxed">
                    Pengajuan surat keterangan tempat tinggal sementara atau permanen.
                </p>
            </a>

            {{-- Card 2: Cyan Signal --}}
            <a href="{{ route('layanan.pengantar-ktp') }}" class="reveal delay-200 bg-cyan-signal rounded-[30px] p-8 md:p-10 text-white transform transition-transform duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(0,179,221,0.3)] flex flex-col justify-between h-[340px] cursor-pointer">
                <div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                    </div>
                    <h3 class="font-display text-[32px] md:text-[38px] leading-[1.1] mb-4">Pengantar <br>KTP</h3>
                </div>
                <p class="font-sans font-light text-white/90 text-[15px] leading-relaxed">
                    Urus surat pengantar dari desa untuk pembuatan atau perpanjangan KTP.
                </p>
            </a>

            {{-- Card 3: Orchid Bloom --}}
            <a href="{{ route('layanan.pengantar-kk') }}" class="reveal delay-300 bg-orchid-bloom rounded-[30px] p-8 md:p-10 text-white transform transition-transform duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(221,144,216,0.3)] flex flex-col justify-between h-[340px] cursor-pointer">
                <div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="font-display text-[32px] md:text-[38px] leading-[1.1] mb-4">Pengantar <br>KK</h3>
                </div>
                <p class="font-sans font-light text-white/90 text-[15px] leading-relaxed">
                    Pengajuan surat pengantar untuk pembuatan atau perubahan Kartu Keluarga.
                </p>
            </a>

            {{-- Card 4: Periwinkle --}}
            <a href="{{ route('layanan.sktm') }}" class="reveal delay-400 bg-periwinkle rounded-[30px] p-8 md:p-10 text-white transform transition-transform duration-500 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(144,184,240,0.3)] flex flex-col justify-between h-[340px] cursor-pointer">
                <div>
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="font-display text-[32px] md:text-[38px] leading-[1.1] mb-4">Surat Tidak <br>Mampu</h3>
                </div>
                <p class="font-sans font-light text-white/90 text-[15px] leading-relaxed">
                    Layanan pengajuan SKTM untuk berbagai keperluan administratif dan bantuan.
                </p>
            </a>

        </div>
    </div>
</section>


{{-- Inverted Stat Card / Profile Summary --}}
<section class="py-24 bg-adm-canvas">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="reveal bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.1)] rounded-[30px] md:rounded-[40px] p-10 md:p-16 lg:p-24 flex flex-col items-center text-center">
            
            <p class="font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase mb-8">
                TENTANG KAMI
            </p>

            <h2 class="font-display text-4xl md:text-5xl lg:text-[64px] leading-[1.1] text-adm-text-main max-w-4xl tracking-tight mb-8">
                Desa Kita hadir dengan komitmen memberikan pelayanan prima, memajukan potensi daerah, dan menjaga kearifan lokal.
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 w-full mt-12 pt-12 border-t border-adm-border">
                <div>
                    <p class="font-display text-5xl text-adm-text-main mb-2">2,400+</p>
                    <p class="font-sans text-[15px] font-medium text-adm-text-body">Penduduk Terdaftar</p>
                </div>
                <div>
                    <p class="font-display text-5xl text-adm-text-main mb-2">4</p>
                    <p class="font-sans text-[15px] font-medium text-adm-text-body">Dusun Wilayah</p>
                </div>
                <div>
                    <p class="font-display text-5xl text-adm-text-main mb-2">12</p>
                    <p class="font-sans text-[15px] font-medium text-adm-text-body">Program Pemberdayaan</p>
                </div>
            </div>

        </div>

    </div>
</section>


{{-- Berita Terbaru (Simple list in dark mode) --}}
<section class="py-24 bg-white border-t border-adm-border">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="reveal">
                <p class="font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase mb-4">Informasi</p>
                <h2 class="font-display text-4xl md:text-5xl leading-none text-adm-text-main tracking-tight">
                    Kabar Terkini
                </h2>
            </div>
            <div class="reveal delay-100">
                <a href="{{ route('berita') }}" class="inline-flex items-center gap-2 text-adm-primary font-medium hover:text-adm-primary-hover transition-colors">
                    Semua Berita
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @forelse ($beritas as $index => $berita)
            <a href="{{ route('berita.show', $berita->slug) }}" class="reveal delay-{{ ($index + 1) * 100 }} group block">
                <div class="aspect-video w-full bg-adm-input rounded-[16px] mb-6 overflow-hidden relative border border-adm-border">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="text-adm-text-muted text-[13px] font-medium">Tidak ada gambar</span>
                        </div>
                    @endif
                    <div class="absolute bottom-4 left-4">
                        <span class="inline-block bg-white/20 backdrop-blur-md rounded-full px-3 py-1 font-mono text-[10px] text-white uppercase tracking-wider">
                            Kabar Desa
                        </span>
                    </div>
                </div>
                <h3 class="font-display text-2xl text-adm-text-main mb-3 group-hover:text-adm-primary transition-colors">
                    {{ $berita->judul }}
                </h3>
                <p class="font-sans font-light text-[15px] text-adm-text-body line-clamp-2">
                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}
                </p>
                <div class="mt-4 font-mono text-[11px] text-adm-text-muted">
                    {{ $berita->published_at->translatedFormat('d F Y') }}
                </div>
            </a>
            @empty
            <div class="col-span-3 bg-adm-card border border-adm-border rounded-[24px] p-12 text-center text-adm-text-muted">
                Belum ada berita atau kegiatan desa terkini.
            </div>
            @endforelse

        </div>

    </div>
</section>

@endsection