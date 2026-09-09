<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $pageTitle = $title ?? null;
        if (!$pageTitle) {
            if (request()->routeIs('admin.dashboard')) {
                $pageTitle = 'Dashboard';
            } elseif (request()->routeIs('admin.pengajuan.show')) {
                $pageTitle = 'Detail Pengajuan';
            } elseif (request()->routeIs('admin.pengajuan.*')) {
                $pageTitle = 'Pengajuan';
            } elseif (request()->routeIs('admin.penduduks.create')) {
                $pageTitle = 'Tambah Penduduk';
            } elseif (request()->routeIs('admin.penduduks.edit')) {
                $pageTitle = 'Edit Penduduk';
            } elseif (request()->routeIs('admin.penduduks.show')) {
                $pageTitle = 'Detail Penduduk';
            } elseif (request()->routeIs('admin.penduduks.*')) {
                $pageTitle = 'Data Penduduk';
            } elseif (request()->routeIs('admin.layanans.create')) {
                $pageTitle = 'Tambah Layanan';
            } elseif (request()->routeIs('admin.layanans.edit')) {
                $pageTitle = 'Edit Layanan';
            } elseif (request()->routeIs('admin.layanans.*')) {
                $pageTitle = 'Layanan';
            } elseif (request()->routeIs('admin.beritas.create')) {
                $pageTitle = 'Tulis Berita';
            } elseif (request()->routeIs('admin.beritas.edit')) {
                $pageTitle = 'Edit Berita';
            } elseif (request()->routeIs('admin.beritas.*')) {
                $pageTitle = 'Berita';
            } elseif (request()->routeIs('admin.laporan.*')) {
                $pageTitle = 'Laporan';
            } elseif (request()->routeIs('admin.users.create')) {
                $pageTitle = 'Tambah Akun Admin';
            } elseif (request()->routeIs('admin.users.edit')) {
                $pageTitle = 'Edit Akun Admin';
            } elseif (request()->routeIs('admin.users.*')) {
                $pageTitle = 'Kelola Akun';
            } else {
                $pageTitle = 'Panel Admin';
            }
        }
    @endphp
    <title>{{ $pageTitle === 'Panel Admin' ? 'Panel Admin — Desa Kita' : $pageTitle . ' — Panel Admin Desa Kita' }}</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>

<body class="font-sans antialiased bg-adm-canvas text-adm-text-body min-h-screen">
    {{-- Top progress indicator for smooth navigation --}}
    <div id="admin-progress-bar" style="width: 0%; opacity: 0;"></div>

    {{-- Sidebar + Main layout wrapper --}}
    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }" @close-sidebar.window="sidebarOpen = false">

        {{-- ========== SIDEBAR (dark, fixed) ========== --}}
        @include('layouts.navigation')

        {{-- Overlay mobile --}}
        <div
            x-show="sidebarOpen"
            x-cloak
            @click="sidebarOpen = false"
            class="fixed inset-0 z-30 bg-black/50 lg:hidden"
        ></div>

        {{-- ========== CONTENT AREA ========== --}}
        <div id="admin-content-shell" class="flex flex-1 flex-col min-w-0 lg:pl-[240px]">

            {{-- Mobile topbar --}}
            <div class="flex h-16 items-center gap-4 border-b border-adm-border bg-adm-card px-4 lg:hidden">
                <button
                    @click="sidebarOpen = true"
                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-adm-border text-adm-text-muted hover:bg-adm-canvas transition"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="text-sm font-semibold text-adm-text-main">Desa Kita — Admin</span>
            </div>

            {{-- Dynamic Page Content (Swapped smoothly during admin menu transitions) --}}
            <div id="admin-page-content" class="flex flex-1 flex-col min-w-0">
                {{-- Page Header --}}
                @isset($header)
                <header class="border-b border-adm-border bg-adm-card px-6 py-5 lg:px-8">
                    {{ $header }}
                </header>
                @endisset

                {{-- Main Content --}}
                <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>

</html>