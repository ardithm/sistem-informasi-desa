<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Penduduk</p>
                <h2 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">
                    Data Penduduk
                </h2>
                <p class="text-sm text-adm-text-muted mt-1">
                    Kelola data master kependudukan warga desa.
                </p>
            </div>

            <a href="{{ route('admin.penduduks.create') }}"
               class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-primary px-4 py-2 text-[13px] font-semibold text-white transition hover:bg-adm-primary-hover shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Penduduk
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

        {{-- Pesan Error --}}
        @if (session('error'))
        <div class="rounded-[12px] border border-adm-rose-fg/20 bg-adm-rose-bg px-4 py-3 text-[13px] font-medium text-adm-rose-fg shadow-sm">
            {{ session('error') }}
        </div>
        @endif

        {{-- Search & Table Container --}}
        <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
            
            {{-- Header & Search --}}
            <div class="border-b border-adm-border bg-adm-card px-6 py-4">
                <form method="GET" action="{{ route('admin.penduduks.index') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1 max-w-md">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-adm-text-muted" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari NIK atau Nama Lengkap..."
                               class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 pl-10 pr-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary sm:leading-6">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-primary px-4 py-2 text-[13px] font-medium text-white transition hover:bg-adm-primary-hover shadow-sm">
                            Cari
                        </button>
                        
                        @if ($search)
                        <a href="{{ route('admin.penduduks.index') }}" class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                            Reset
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Tabel --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-adm-border bg-adm-canvas">
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">No</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Penduduk</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">JK</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">RT/RW</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Status</th>
                            <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-adm-border">
                        @forelse ($penduduks as $index => $penduduk)
                        <tr class="transition-colors duration-150 hover:bg-slate-50">
                            
                            {{-- Nomor --}}
                            <td class="px-5 py-4 font-mono text-[12px] text-adm-text-muted">
                                {{ $penduduks->firstItem() + $index }}
                            </td>

                            {{-- Info Utama (Avatar + Nama + NIK) --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-adm-primary-soft text-[11px] font-bold text-adm-primary">
                                        {{ strtoupper(substr($penduduk->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-medium text-adm-text-main leading-tight">{{ $penduduk->nama_lengkap }}</div>
                                        <div class="text-[11px] font-mono text-adm-text-muted mt-0.5">{{ $penduduk->nik }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- Jenis Kelamin --}}
                            <td class="px-5 py-4 text-[13px] text-adm-text-body">
                                {{ $penduduk->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>

                            {{-- RT/RW --}}
                            <td class="px-5 py-4 font-mono text-[12px] text-adm-text-muted">
                                {{ str_pad($penduduk->rt, 3, '0', STR_PAD_LEFT) }} / {{ str_pad($penduduk->rw, 3, '0', STR_PAD_LEFT) }}
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4">
                                @if ($penduduk->status_penduduk === 'aktif')
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold bg-adm-green-bg text-adm-green-fg">
                                    Aktif
                                </span>
                                @else
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold bg-gray-100 text-gray-600">
                                    Tidak Aktif
                                </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4 text-right space-x-2">
                                <a href="{{ route('admin.penduduks.show', $penduduk) }}" class="inline-flex items-center gap-1.5 rounded-[8px] border border-adm-border bg-white px-3 py-1.5 text-[12px] font-medium text-adm-text-main transition hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                                    Detail
                                </a>
                                <a href="{{ route('admin.penduduks.edit', $penduduk) }}" class="inline-flex items-center gap-1.5 rounded-[8px] border border-adm-border bg-white px-3 py-1.5 text-[12px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                                    Edit
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center">
                                <div class="mx-auto max-w-xs">
                                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-adm-canvas">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-[13px] font-medium text-adm-text-main">Tidak ada data</p>
                                    <p class="mt-1 text-[12px] text-adm-text-muted">Data penduduk tidak ditemukan atau belum ditambahkan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($penduduks->hasPages())
            <div class="border-t border-adm-border bg-adm-card px-6 py-4">
                {{ $penduduks->links() }}
            </div>
            @endif

        </section>

    </div>

</x-app-layout>