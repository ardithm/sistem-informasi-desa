<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Berita</p>
                <h2 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">
                    Berita Desa
                </h2>
                <p class="text-sm text-adm-text-muted mt-1">
                    Kelola berita dan kegiatan desa.
                </p>
            </div>

            <a href="{{ route('admin.beritas.create') }}"
               class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-primary px-4 py-2 text-[13px] font-semibold text-white transition hover:bg-adm-primary-hover shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Berita
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Pesan sukses --}}
        @if (session('success'))
        <div class="rounded-[12px] border border-adm-green-fg/20 bg-adm-green-bg px-4 py-3 text-[13px] font-medium text-adm-green-fg shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        {{-- Pesan error --}}
        @if (session('error'))
        <div class="rounded-[12px] border border-adm-rose-fg/20 bg-adm-rose-bg px-4 py-3 text-[13px] font-medium text-adm-rose-fg shadow-sm">
            {{ session('error') }}
        </div>
        @endif

        {{-- Search & Filter Container --}}
        <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
            
            {{-- Header & Filter --}}
            <div class="border-b border-adm-border bg-adm-card px-6 py-4">
                <form method="GET" action="{{ route('admin.beritas.index') }}" class="flex flex-col md:flex-row gap-4 items-stretch md:items-end">
                    
                    <div class="flex-1 w-full relative">
                        <label class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">Cari Berita</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-adm-text-muted" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Masukkan judul berita..."
                                   class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input py-2 pl-10 pr-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">
                        </div>
                    </div>

                    <div class="w-full md:w-48 relative">
                        <label class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">Status</label>
                        <select name="status" class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input py-2 pl-3 pr-8 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                            <option value="">Semua Status</option>
                            <option value="draft" @selected(($status ?? '') === 'draft')>Draft</option>
                            <option value="published" @selected(($status ?? '') === 'published')>Published</option>
                        </select>
                    </div>

                    <div class="flex gap-2 w-full md:w-auto shrink-0 md:self-end">
                        <button type="submit" class="inline-flex items-center justify-center w-full md:w-auto h-[38px] rounded-[8px] bg-adm-primary px-5 py-2 text-[13px] font-medium text-white transition hover:bg-adm-primary-hover shadow-sm border border-transparent">
                            Cari
                        </button>
                        
                        @if (($search ?? '') || ($status ?? ''))
                        <a href="{{ route('admin.beritas.index') }}" class="inline-flex items-center justify-center w-full md:w-auto h-[38px] rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                            Reset
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Header info jika ada filter --}}
            @if (($search ?? '') || ($status ?? ''))
            <div class="flex items-center justify-between px-6 py-3 border-b border-adm-border bg-adm-canvas/50">
                <div class="flex items-center gap-1.5 text-[11px] font-medium text-adm-primary bg-adm-primary-soft px-3 py-1 rounded-full">
                    <span>Filter Aktif:</span>
                    <span class="font-bold">{{ $beritas->total() }} berita ditemukan</span>
                </div>
                <a href="{{ route('admin.beritas.index') }}" class="text-[11px] font-medium text-adm-rose-fg hover:underline transition">
                    Reset Filter
                </a>
            </div>
            @endif

            {{-- Tabel --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-adm-border bg-adm-canvas">
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted w-16">No</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Judul Berita</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Status</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-adm-border">
                        @forelse ($beritas as $index => $berita)
                        <tr class="transition-colors duration-150 hover:bg-slate-50">
                            
                            {{-- Nomor --}}
                            <td class="px-5 py-4 font-mono text-[12px] text-adm-text-muted">
                                {{ $beritas->firstItem() + $index }}
                            </td>

                            {{-- Judul, Penulis & Tanggal --}}
                            <td class="px-5 py-4">
                                <div class="flex items-start gap-4">
                                    <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-[8px] border border-adm-border bg-adm-canvas hidden sm:block">
                                        @if ($berita->gambar)
                                            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="flex h-full w-full items-center justify-center text-adm-text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.beritas.show', $berita) }}" class="text-[14px] font-semibold text-adm-text-main hover:text-adm-primary transition-colors leading-snug block">
                                            {{ Str::limit($berita->judul, 70) }}
                                        </a>
                                        <div class="mt-1 flex items-center gap-3 text-[11px] text-adm-text-muted">
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                {{ $berita->user->name ?? 'Admin' }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $berita->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4">
                                @if ($berita->status === 'published')
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold bg-adm-green-bg text-adm-green-fg">
                                    Published
                                </span>
                                @else
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold bg-yellow-100 text-yellow-800">
                                    Draft
                                </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.beritas.show', $berita) }}" class="inline-flex items-center gap-1.5 rounded-[8px] border border-adm-border bg-white px-3 py-1.5 text-[12px] font-medium text-adm-text-main transition hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                                    Detail
                                </a>
                                <a href="{{ route('admin.beritas.edit', $berita) }}" class="inline-flex items-center gap-1.5 rounded-[8px] border border-adm-border bg-white px-3 py-1.5 text-[12px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.beritas.destroy', $berita) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-[8px] border border-adm-rose-fg/20 bg-adm-rose-bg px-3 py-1.5 text-[12px] font-medium text-adm-rose-fg transition hover:bg-adm-rose-fg hover:text-white shadow-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-5 py-16 text-center">
                                <div class="mx-auto max-w-sm">
                                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-adm-canvas">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
                                        </svg>
                                    </div>
                                    <p class="text-[14px] font-semibold text-adm-text-main">
                                        {{ (($search ?? '') || ($status ?? '')) ? 'Tidak ada berita yang sesuai filter' : 'Belum ada berita' }}
                                    </p>
                                    <p class="mt-1 text-[12px] text-adm-text-muted">
                                        {{ (($search ?? '') || ($status ?? '')) ? 'Silakan ubah kata kunci pencarian atau sesuaikan status berita.' : 'Tidak ada data berita yang ditemukan atau belum dibuat.' }}
                                    </p>
                                    @if (($search ?? '') || ($status ?? ''))
                                    <div class="mt-4">
                                        <a href="{{ route('admin.beritas.index') }}"
                                           class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-primary px-4 py-2 text-[12px] font-semibold text-white transition hover:bg-adm-primary-hover shadow-sm">
                                            Reset Filter
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer Pagination --}}
            @if ($beritas->hasPages())
            <div class="px-6 py-4 border-t border-adm-border bg-adm-card">
                {{ $beritas->links() }}
            </div>
            @endif

        </section>

    </div>

</x-app-layout>