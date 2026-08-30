<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/10 bg-[#0f1011]/80 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center gap-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#847dff] text-sm font-semibold text-white shadow-lg shadow-[#847dff]/30">
                        D
                    </div>
                    <div>
                        <div class="text-sm font-semibold tracking-[0.2em] text-white uppercase">Desa Kita</div>
                        <div class="text-[10px] uppercase tracking-[0.18em] text-[#9f9fa0]">Admin Panel</div>
                    </div>
                </a>

                <div class="hidden items-center gap-2 sm:flex">
                    <a href="{{ route('admin.dashboard') }}" class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-[#f5f5f7] transition hover:bg-white/10 {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#0f1011]' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.pengajuan.index') }}" class="rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-[#f5f5f7] transition hover:bg-white/10 {{ request()->routeIs('admin.pengajuan.index') || request()->routeIs('admin.pengajuan.show') ? 'bg-white text-[#0f1011]' : '' }}">
                        Pengajuan
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <div class="rounded-full border border-white/10 bg-white/5 px-3 py-2 text-sm text-[#f5f5f7]">
                    {{ Auth::user()->username }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-full border border-white/15 bg-white px-4 py-2 text-sm font-medium text-[#0f1011] transition hover:bg-[#d1c9ff]">
                        Logout
                    </button>
                </form>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center rounded-full border border-white/10 bg-white/5 p-2 text-[#f5f5f7]">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" class="border-t border-white/10 sm:hidden">
        <div class="space-y-2 px-4 py-3">
            <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 text-sm text-[#f5f5f7] {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : 'bg-white/5' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.pengajuan.index') }}" class="block rounded-lg px-3 py-2 text-sm text-[#f5f5f7] {{ request()->routeIs('admin.pengajuan.index') || request()->routeIs('admin.pengajuan.show') ? 'bg-white/10' : 'bg-white/5' }}">
                Pengajuan
            </a>
            <form method="POST" action="{{ route('logout') }}" class="pt-2">
                @csrf
                <button type="submit" class="w-full rounded-lg bg-white px-3 py-2 text-left text-sm font-medium text-[#0f1011]">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>