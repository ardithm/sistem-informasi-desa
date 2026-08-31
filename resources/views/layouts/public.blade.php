<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Desa Kita') — Portal Resmi
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>


<body class="bg-adm-canvas text-adm-text-main font-sans antialiased selection:bg-adm-primary selection:text-white">


    {{-- Navbar --}}
    <header class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur-[24px] border-b border-adm-border transition-all duration-300">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between h-20">

                {{-- Logo / Nama Desa --}}
                <a href="{{ route('home') }}" class="flex items-center gap-4 group">
                    <div class="w-10 h-10 bg-adm-primary text-white rounded-full flex items-center justify-center font-display text-xl transition-transform group-hover:scale-105">
                        D
                    </div>
                    <div>
                        <div class="font-bold text-adm-text-main text-lg tracking-wide">
                            Desa Kita
                        </div>
                        <div class="text-[10px] uppercase font-mono tracking-widest text-adm-text-muted mt-0.5">
                            Kecamatan • Kabupaten
                        </div>
                    </div>
                </a>


                {{-- Navigation --}}
                <nav class="hidden md:flex items-center gap-2">
                    
                    @php
                        $navItemClasses = "px-4 py-2 text-[14px] font-medium text-adm-text-body hover:text-adm-text-main transition-colors rounded-[8px] hover:bg-adm-canvas";
                    @endphp

                    <a href="{{ route('home') }}" class="{{ $navItemClasses }}">Beranda</a>
                    <a href="{{ route('profil') }}" class="{{ $navItemClasses }}">Profil</a>
                    <a href="{{ route('sejarah') }}" class="{{ $navItemClasses }}">Sejarah</a>
                    <a href="{{ route('berita') }}" class="{{ $navItemClasses }}">Berita</a>
                    <a href="{{ route('layanan') }}" class="{{ $navItemClasses }}">Layanan</a>
                    <a href="{{ route('status') }}" class="{{ $navItemClasses }}">Cek Status</a>

                    {{-- Login Button (Primary CTA) --}}
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="ml-4 inline-flex items-center gap-2 bg-adm-primary text-white px-[18px] py-[10px] rounded-[8px] text-[14px] font-medium transition-transform hover:-translate-y-0.5 hover:bg-adm-primary-hover shadow-sm">
                            Dashboard
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="ml-4 inline-flex items-center gap-2 bg-adm-primary text-white px-[18px] py-[10px] rounded-[8px] text-[14px] font-medium transition-all hover:bg-adm-primary-hover shadow-sm">
                            Login Admin
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                    @endauth

                </nav>


                {{-- Mobile menu button --}}
                <button type="button" class="md:hidden p-2 text-adm-text-muted hover:text-adm-text-main transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

            </div>

        </div>

    </header>


    {{-- Content --}}
    <main class="pt-20 min-h-screen">
        @yield('content')
    </main>


    {{-- Footer --}}
    <footer class="bg-adm-sidebar text-adm-sidebar-text border-t border-adm-sidebar-border py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                
                {{-- Identitas --}}
                <div class="md:col-span-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-4 mb-6">
                        <div class="w-8 h-8 bg-adm-primary text-white rounded-full flex items-center justify-center font-display text-lg">
                            D
                        </div>
                        <div class="font-bold text-white tracking-wide">
                            Desa Kita
                        </div>
                    </a>
                    <p class="text-[14px] leading-relaxed max-w-md">
                        Website resmi Desa Kita sebagai media informasi digital dan pelayanan administrasi masyarakat desa yang cepat, transparan, dan terpercaya.
                    </p>
                </div>

                {{-- Tautan Cepat --}}
                <div>
                    <p class="text-[11px] font-mono tracking-widest uppercase text-adm-sidebar-text/50 mb-6">
                        Navigasi
                    </p>
                    <ul class="space-y-4 text-[14px]">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('profil') }}" class="hover:text-white transition-colors">Profil Desa</a></li>
                        <li><a href="{{ route('layanan') }}" class="hover:text-white transition-colors">Layanan Publik</a></li>
                        <li><a href="{{ route('status') }}" class="hover:text-white transition-colors">Cek Status Pengajuan</a></li>
                        <li><a href="{{ route('berita') }}" class="hover:text-white transition-colors">Berita & Pengumuman</a></li>
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <p class="text-[11px] font-mono tracking-widest uppercase text-adm-sidebar-text/50 mb-6">
                        Kontak Kami
                    </p>
                    <ul class="space-y-4 text-[14px]">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white/40 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <span>Jl. Raya Desa No. 123,<br>Kecamatan, Kabupaten 45678</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            <span>pemdes@desakita.go.id</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            <span>(021) 1234-5678</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-16 pt-8 border-t border-adm-sidebar-border flex flex-col md:flex-row items-center justify-between gap-4 text-[12px] text-adm-sidebar-text/50">
                <p>&copy; {{ date('Y') }} Pemerintah Desa Kita. Hak Cipta Dilindungi.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>