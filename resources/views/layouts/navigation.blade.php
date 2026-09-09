<aside
    id="admin-sidebar"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-40 flex w-[240px] flex-col bg-adm-sidebar -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out"
>
    {{-- ===== BRAND LOGO ===== --}}
    <div class="flex items-center gap-3 border-b border-adm-sidebar-border px-5 py-5">
        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-adm-primary shadow-lg shadow-adm-primary/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
        </div>
        <div>
            <div class="text-[13px] font-bold tracking-wide text-white">Desa Kita</div>
            <div class="text-[10px] font-medium uppercase tracking-widest text-adm-sidebar-text">Admin Panel</div>
        </div>
    </div>

    {{-- ===== NAVIGATION MENU ===== --}}
    <nav id="admin-sidebar-nav" class="flex-1 overflow-y-auto px-3 py-4">

        {{-- GRUP 1: UTAMA --}}
        <div class="mb-1.5 px-3 text-[10px] font-bold uppercase tracking-wider text-adm-sidebar-text/60">
            UTAMA
        </div>
        <ul class="space-y-0.5 mb-4">
            {{-- Dashboard --}}
            <li>
                @php $isDashboard = request()->routeIs('admin.dashboard'); @endphp
                <a href="{{ route('admin.dashboard') }}"
                   class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium transition-all duration-150
                          {{ $isDashboard
                              ? 'bg-adm-primary text-white shadow-[0_4px_12px_rgba(29,114,254,0.3)]'
                              : 'text-adm-sidebar-text hover:bg-adm-sidebar-hover hover:text-white' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>
            </li>

            {{-- Pengajuan --}}
            <li>
                @php $isPengajuan = request()->routeIs('admin.pengajuan.*'); @endphp
                <a href="{{ route('admin.pengajuan.index') }}"
                   class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium transition-all duration-150
                          {{ $isPengajuan
                              ? 'bg-adm-primary text-white shadow-[0_4px_12px_rgba(29,114,254,0.3)]'
                              : 'text-adm-sidebar-text hover:bg-adm-sidebar-hover hover:text-white' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Pengajuan
                </a>
            </li>
        </ul>

        {{-- GRUP 2: DATA & KONTEN --}}
        <div class="mb-1.5 px-3 text-[10px] font-bold uppercase tracking-wider text-adm-sidebar-text/60">
            DATA & KONTEN
        </div>
        <ul class="space-y-0.5 mb-4">
            {{-- Penduduk --}}
            <li>
                @php $isPenduduk = request()->routeIs('admin.penduduks.*'); @endphp
                <a href="{{ route('admin.penduduks.index') }}"
                   class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium transition-all duration-150
                          {{ $isPenduduk
                              ? 'bg-adm-primary text-white shadow-[0_4px_12px_rgba(29,114,254,0.3)]'
                              : 'text-adm-sidebar-text hover:bg-adm-sidebar-hover hover:text-white' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Penduduk
                </a>
            </li>

            {{-- Layanan --}}
            <li>
                @php $isLayanan = request()->routeIs('admin.layanans.*'); @endphp
                <a href="{{ route('admin.layanans.index') }}"
                   class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium transition-all duration-150
                          {{ $isLayanan
                              ? 'bg-adm-primary text-white shadow-[0_4px_12px_rgba(29,114,254,0.3)]'
                              : 'text-adm-sidebar-text hover:bg-adm-sidebar-hover hover:text-white' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Layanan
                </a>
            </li>

            {{-- Berita --}}
            <li>
                @php $isBerita = request()->routeIs('admin.beritas.*'); @endphp
                <a href="{{ route('admin.beritas.index') }}"
                   class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium transition-all duration-150
                          {{ $isBerita
                              ? 'bg-adm-primary text-white shadow-[0_4px_12px_rgba(29,114,254,0.3)]'
                              : 'text-adm-sidebar-text hover:bg-adm-sidebar-hover hover:text-white' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Berita
                </a>
            </li>
        </ul>

        {{-- GRUP 3: OUTPUT & PENGATURAN --}}
        <div class="mb-1.5 px-3 text-[10px] font-bold uppercase tracking-wider text-adm-sidebar-text/60">
            OUTPUT & PENGATURAN
        </div>
        <ul class="space-y-0.5">
            {{-- Laporan --}}
            <li>
                @php $isLaporan = request()->routeIs('admin.laporan.*'); @endphp
                <a href="{{ route('admin.laporan.index') }}"
                   class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium transition-all duration-150
                          {{ $isLaporan
                              ? 'bg-adm-primary text-white shadow-[0_4px_12px_rgba(29,114,254,0.3)]'
                              : 'text-adm-sidebar-text hover:bg-adm-sidebar-hover hover:text-white' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Laporan
                </a>
            </li>

            {{-- Kelola Akun (Super Admin Only) --}}
            @if (Auth::user() && Auth::user()->isSuperAdmin())
            <li>
                @php $isUsers = request()->routeIs('admin.users.*'); @endphp
                <a href="{{ route('admin.users.index') }}"
                   class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium transition-all duration-150
                          {{ $isUsers
                              ? 'bg-adm-primary text-white shadow-[0_4px_12px_rgba(29,114,254,0.3)]'
                              : 'text-adm-sidebar-text hover:bg-adm-sidebar-hover hover:text-white' }}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Kelola Akun
                </a>
            </li>
            @endif
        </ul>
    </nav>

    {{-- ===== BOTTOM: USER + LOGOUT ===== --}}
    <div class="border-t border-adm-sidebar-border px-3 py-4">
        <div class="mb-3 flex items-center gap-3 rounded-lg px-3 py-2">
            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-adm-primary/20 text-xs font-bold text-adm-primary">
                {{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}
            </div>
            <div class="min-w-0 flex-1">
                <div class="truncate text-[13px] font-medium text-white">{{ Auth::user()->username ?? 'Admin' }}</div>
                <div class="text-[10px] text-adm-sidebar-text">
                    {{ (Auth::user() && Auth::user()->role === 'super_admin') ? 'Super Administrator' : 'Administrator' }}
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-[13px] font-medium text-adm-sidebar-text transition-all duration-150 hover:bg-adm-sidebar-hover hover:text-white"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>