<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} — Admin</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])
</head>

<body class="font-sans antialiased bg-adm-canvas text-adm-text-body min-h-screen">
    {{-- Sidebar + Main layout wrapper --}}
    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">

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
        <div class="flex flex-1 flex-col lg:pl-[240px]">

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
</body>

</html>