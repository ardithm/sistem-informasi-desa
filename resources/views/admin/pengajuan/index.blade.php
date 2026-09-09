<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Pengajuan</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">Data Pengajuan</h1>
            </div>
            <p class="text-sm text-adm-text-muted">
                Daftar semua pengajuan layanan surat dari masyarakat desa.
            </p>
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

        {{-- ============================================================
             SECTION FILTER & SEARCH
        ============================================================ --}}
        <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="border-b border-adm-border bg-adm-card px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <h2 class="text-[14px] font-semibold text-adm-text-main">Filter & Pencarian Pengajuan</h2>
                    </div>

                    @php
                        $hasActiveFilters = !empty($search) || !empty($status) || !empty($layananId) || ($perPage != 10);
                    @endphp

                    @if ($hasActiveFilters)
                    <a href="{{ route('admin.pengajuan.index') }}"
                       class="inline-flex items-center gap-1 text-[12px] font-medium text-adm-rose-fg hover:underline transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reset Semua Filter
                    </a>
                    @endif
                </div>
            </div>

            <form method="GET" action="{{ route('admin.pengajuan.index') }}" class="p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-12 items-end">

                    {{-- 1. Input Cari NIK / Nama / Nomor --}}
                    <div class="sm:col-span-2 lg:col-span-6">
                        <label for="search" class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">
                            Cari Pengajuan
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-adm-text-muted" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                            <input type="text"
                                   id="search"
                                   name="search"
                                   value="{{ $search ?? '' }}"
                                   placeholder="Nomor pengajuan, NIK, atau nama pemohon..."
                                   class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 pl-9 pr-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">
                        </div>
                    </div>

                    {{-- 2. Dropdown Status --}}
                    <div class="sm:col-span-1 lg:col-span-3">
                        <label for="status" class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">
                            Status
                        </label>
                        <select id="status"
                                name="status"
                                class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 pl-3 pr-8 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ ($status ?? '') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diverifikasi" {{ ($status ?? '') === 'diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                            <option value="perlu_perbaikan" {{ ($status ?? '') === 'perlu_perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                            <option value="diproses" {{ ($status ?? '') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ ($status ?? '') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ ($status ?? '') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    {{-- 3. Dropdown Jenis Layanan --}}
                    <div class="sm:col-span-1 lg:col-span-3">
                        <label for="layanan_id" class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">
                            Jenis Layanan
                        </label>
                        <select id="layanan_id"
                                name="layanan_id"
                                class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 pl-3 pr-8 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                            <option value="">Semua Layanan</option>
                            @foreach ($layanans as $layanan)
                            <option value="{{ $layanan->id }}" {{ ($layananId ?? '') == $layanan->id ? 'selected' : '' }}>
                                {{ $layanan->nama_layanan }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- Baris Bawah: Per Page & Tombol Filter --}}
                <div class="mt-4 pt-4 border-t border-adm-border flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <label for="per_page" class="text-[12px] font-medium text-adm-text-muted">Tampilkan:</label>
                        <select id="per_page"
                                name="per_page"
                                class="rounded-[8px] border-adm-border bg-adm-input py-1.5 pl-3 pr-7 text-[12px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                            <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10 per hal</option>
                            <option value="25" {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>25 per hal</option>
                            <option value="50" {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50 per hal</option>
                            <option value="100" {{ ($perPage ?? 10) == 100 ? 'selected' : '' }}>100 per hal</option>
                        </select>
                        <span class="text-[12px] text-adm-text-muted">
                            Total: <strong class="text-adm-text-main tabular-nums">{{ $pengajuans->total() }}</strong> pengajuan
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        @if ($hasActiveFilters)
                        <a href="{{ route('admin.pengajuan.index') }}"
                           class="inline-flex items-center justify-center gap-1.5 rounded-[8px] border border-adm-border bg-white px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                            Reset
                        </a>
                        @endif

                        <button type="submit"
                                class="inline-flex items-center justify-center gap-1.5 rounded-[8px] bg-adm-primary px-5 py-2 text-[13px] font-semibold text-white transition hover:bg-adm-primary-hover shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </section>

        {{-- ============================================================
             SECTION TABEL PENGAJUAN
        ============================================================ --}}
        <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
            
            {{-- Header tabel --}}
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between px-6 py-4 border-b border-adm-border bg-adm-card">
                <div>
                    <h2 class="text-[16px] font-semibold text-adm-text-main">Daftar Pengajuan</h2>
                    <p class="text-[12px] text-adm-text-muted mt-0.5">
                        Menampilkan halaman {{ $pengajuans->currentPage() }} dari {{ $pengajuans->lastPage() }}
                    </p>
                </div>

                @if ($hasActiveFilters)
                <div class="flex items-center gap-1.5 text-[11px] font-medium text-adm-primary bg-adm-primary-soft px-3 py-1 rounded-full">
                    <span>Filter Aktif:</span>
                    <span class="font-bold">{{ $pengajuans->total() }} hasil ditemukan</span>
                </div>
                @endif
            </div>

            {{-- Tabel --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-adm-border bg-adm-canvas">
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">No</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Nomor Pengajuan</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Pemohon</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Layanan</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Status</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Tanggal Masuk</th>
                            <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-adm-border">
                        @forelse ($pengajuans as $index => $pengajuan)
                        <tr class="transition-colors duration-150 hover:bg-slate-50">
                            
                            {{-- Nomor --}}
                            <td class="px-5 py-4 font-mono text-[12px] text-adm-text-muted">
                                {{ $pengajuans->firstItem() + $index }}
                            </td>

                            {{-- Nomor Pengajuan --}}
                            <td class="px-5 py-4 font-mono text-[12px] font-medium text-adm-text-main">
                                {{ $pengajuan->nomor_pengajuan }}
                            </td>

                            {{-- Pemohon --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-adm-primary-soft text-[11px] font-bold text-adm-primary">
                                        {{ strtoupper(substr($pengajuan->penduduk->nama_lengkap ?? 'W', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-medium text-adm-text-main">
                                            {{ $pengajuan->penduduk->nama_lengkap ?? 'Penduduk Tidak Ditemukan' }}
                                        </div>
                                        <div class="text-[11px] font-mono text-adm-text-muted mt-0.5">
                                            {{ $pengajuan->penduduk->nik ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Layanan --}}
                            <td class="px-5 py-4 text-[13px] text-adm-text-body">
                                {{ $pengajuan->layanan->nama_layanan ?? '-' }}
                            </td>

                            {{-- Status Badge --}}
                            <td class="px-5 py-4">
                                @php
                                $statusKey = str_replace(' ', '_', strtolower($pengajuan->status));
                                $badgeClasses = match($statusKey) {
                                    'menunggu'        => 'bg-adm-amber-bg text-adm-amber-fg border-adm-amber-fg/20',
                                    'diverifikasi'    => 'bg-adm-blue-bg text-adm-blue-fg border-adm-blue-fg/20',
                                    'diproses'        => 'bg-adm-blue-bg text-adm-blue-fg border-adm-blue-fg/20',
                                    'selesai'         => 'bg-adm-green-bg text-adm-green-fg border-adm-green-fg/20',
                                    'ditolak'         => 'bg-adm-rose-bg text-adm-rose-fg border-adm-rose-fg/20',
                                    'perlu_perbaikan' => 'bg-adm-purple-bg text-adm-purple-fg border-adm-purple-fg/20',
                                    default           => 'bg-adm-input text-adm-text-muted border-adm-border',
                                };
                                @endphp
                                <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-[11px] font-semibold {{ $badgeClasses }}">
                                    {{ str_replace('_', ' ', ucfirst($pengajuan->status)) }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-5 py-4 text-[12px] text-adm-text-muted whitespace-nowrap">
                                <div>{{ $pengajuan->created_at->format('d/m/Y') }}</div>
                                <div class="text-[10px] text-adm-text-muted/70 font-mono">{{ $pengajuan->created_at->format('H:i') }} WIB</div>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('admin.pengajuan.show', $pengajuan) }}" class="inline-flex items-center gap-1.5 rounded-[8px] border border-adm-border bg-adm-card px-3 py-1.5 text-[12px] font-medium text-adm-text-main transition hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                                    Detail
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="mx-auto max-w-sm">
                                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-adm-canvas">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-[14px] font-semibold text-adm-text-main">
                                        {{ $hasActiveFilters ? 'Tidak ada data yang sesuai filter' : 'Belum ada pengajuan masuk' }}
                                    </p>
                                    <p class="mt-1 text-[12px] text-adm-text-muted">
                                        {{ $hasActiveFilters ? 'Silakan ubah kata kunci pencarian atau sesuaikan filter status dan tanggal Anda.' : 'Data pengajuan dari warga desa akan tercantum di sini.' }}
                                    </p>
                                    @if ($hasActiveFilters)
                                    <div class="mt-4">
                                        <a href="{{ route('admin.pengajuan.index') }}"
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
            @if ($pengajuans->hasPages())
            <div class="px-6 py-4 border-t border-adm-border bg-adm-card">
                {{ $pengajuans->links() }}
            </div>
            @endif

        </section>

    </div>

</x-app-layout>