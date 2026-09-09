<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-[22px] font-bold leading-tight text-adm-text-main">
                    Kelola Akun
                </h2>
                <p class="text-[13px] text-adm-text-muted mt-0.5">
                    Manajemen akun administrator desa, pembagian peran, dan kontrol akses.
                </p>
            </div>
            <div>
                <a href="{{ route('admin.users.create') }}"
                   class="inline-flex items-center gap-2 h-[38px] rounded-[8px] bg-adm-primary px-4 text-[13px] font-medium text-white transition hover:bg-adm-primary-hover shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Admin Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        {{-- Flash Notification Alerts --}}
        @if (session('success'))
        <div class="flex items-center gap-3 rounded-[10px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800 shadow-sm">
            <svg class="h-5 w-5 flex-shrink-0 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="text-[13px] font-medium">{{ session('success') }}</div>
        </div>
        @endif

        @if (session('error'))
        <div class="flex items-center gap-3 rounded-[10px] border border-red-200 bg-red-50 px-4 py-3 text-red-800 shadow-sm">
            <svg class="h-5 w-5 flex-shrink-0 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="text-[13px] font-medium">{{ session('error') }}</div>
        </div>
        @endif

        {{-- Ringkasan Akun --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="flex items-center justify-between rounded-[12px] border border-adm-border bg-white p-4 shadow-sm">
                <div>
                    <p class="text-[12px] font-medium text-adm-text-muted">Super Administrator</p>
                    <h4 class="mt-1 text-[20px] font-bold text-adm-text-main tabular-nums">{{ $totalSuperAdmin }} User</h4>
                    <p class="mt-0.5 text-[11px] text-purple-600 font-medium">Akses Penuh & Kelola Admin</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-[10px] bg-purple-50 text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-between rounded-[12px] border border-adm-border bg-white p-4 shadow-sm">
                <div>
                    <p class="text-[12px] font-medium text-adm-text-muted">Administrator Biasa</p>
                    <h4 class="mt-1 text-[20px] font-bold text-adm-text-main tabular-nums">{{ $totalAdmin }} User</h4>
                    <p class="mt-0.5 text-[11px] text-blue-600 font-medium">Pelayanan, Berita & Penduduk</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-[10px] bg-blue-50 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-between rounded-[12px] border border-adm-border bg-white p-4 shadow-sm">
                <div>
                    <p class="text-[12px] font-medium text-adm-text-muted">Total Admin Terdaftar</p>
                    <h4 class="mt-1 text-[20px] font-bold text-adm-text-main tabular-nums">{{ $totalSuperAdmin + $totalAdmin }} Akun</h4>
                    <p class="mt-0.5 text-[11px] text-emerald-600 font-medium">Status Akun Aktif</p>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-[10px] bg-emerald-50 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Table Container --}}
        <div class="rounded-[12px] border border-adm-border bg-white shadow-sm overflow-hidden">
            {{-- Filter & Search Form --}}
            <div class="border-b border-adm-border bg-adm-canvas/40 px-6 py-4">
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col md:flex-row md:items-end gap-3">
                    {{-- Input Pencarian --}}
                    <div class="flex-1">
                        <label class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">
                            Cari Admin
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-adm-text-muted" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Masukkan nama atau username admin..."
                                   class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input py-2 pl-10 pr-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">
                        </div>
                    </div>

                    {{-- Role Filter --}}
                    <div class="w-full md:w-52">
                        <label class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">
                            Peran / Role
                        </label>
                        <select name="role" class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input py-2 pl-3 pr-8 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                            <option value="">Semua Peran</option>
                            <option value="super_admin" @selected(($role ?? '') === 'super_admin')>Super Admin</option>
                            <option value="admin" @selected(($role ?? '') === 'admin')>Admin</option>
                        </select>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-2 w-full md:w-auto shrink-0">
                        <button type="submit" class="inline-flex items-center justify-center w-full md:w-auto h-[38px] rounded-[8px] bg-adm-primary px-5 py-2 text-[13px] font-medium text-white transition hover:bg-adm-primary-hover shadow-sm border border-transparent">
                            Cari
                        </button>
                        
                        @if (($search ?? '') || ($role ?? ''))
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center w-full md:w-auto h-[38px] rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-body transition hover:bg-slate-50 shadow-sm">
                            Reset
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Table Data Admin --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[13px]">
                    <thead class="bg-adm-canvas/75 text-[11px] font-semibold uppercase tracking-wider text-adm-text-muted border-b border-adm-border">
                        <tr>
                            <th class="px-6 py-3.5">User Administrator</th>
                            <th class="px-6 py-3.5">Peran / Role</th>
                            <th class="px-6 py-3.5 text-center">Status</th>
                            <th class="px-6 py-3.5">Terdaftar Sejak</th>
                            <th class="px-6 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-adm-border text-adm-text-body">
                        @forelse ($users as $u)
                        <tr class="hover:bg-slate-50/75 transition-colors">
                            {{-- User Info --}}
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full {{ $u->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }} text-xs font-bold">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 font-bold text-adm-text-main">
                                            {{ $u->name }}
                                            @if($u->id === Auth::id())
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-100 text-emerald-800">
                                                    Anda
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-[12px] text-adm-text-muted">
                                            &#64;{{ $u->username }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Role --}}
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                @if($u->role === 'super_admin')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-purple-50 text-purple-700 border border-purple-200">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Super Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Admin
                                    </span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-3.5 whitespace-nowrap text-center">
                                @if($u->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-600">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            {{-- Tanggal Dibuat --}}
                            <td class="px-6 py-3.5 whitespace-nowrap tabular-nums text-adm-text-body">
                                {{ $u->created_at ? $u->created_at->translatedFormat('d M Y') : '-' }}
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-3.5 whitespace-nowrap text-right">
                                <div class="inline-flex items-center gap-2">
                                    {{-- Edit Button (Khusus Admin Biasa) --}}
                                    @if($u->role === 'admin')
                                    <a href="{{ route('admin.users.edit', $u->id) }}"
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-[6px] bg-slate-100 text-adm-text-main hover:bg-slate-200 transition text-[12px] font-medium"
                                       title="Edit Akun Admin">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    @endif

                                    {{-- Toggle Status Button --}}
                                    @if($u->id !== Auth::id())
                                    <form method="POST" action="{{ route('admin.users.toggle-active', $u->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="inline-flex items-center px-2.5 py-1.5 rounded-[6px] text-[12px] font-medium transition
                                                {{ $u->is_active ? 'bg-amber-50 text-amber-700 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}"
                                                title="{{ $u->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                                            {{ $u->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>

                                    {{-- Tombol Hapus Admin --}}
                                    <form method="POST" action="{{ route('admin.users.destroy', $u->id) }}"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin \'{{ $u->name }}\'? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-[6px] bg-red-50 text-red-600 hover:bg-red-100 transition text-[12px] font-medium"
                                                title="Hapus Admin">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                    @else
                                    <span class="text-[11px] font-medium text-adm-text-muted italic">
                                        Akun Utama
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-adm-text-muted">
                                Tidak ada data user admin yang cocok dengan pencarian.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
            <div class="px-6 py-4 border-t border-adm-border bg-white">
                {{ $users->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
