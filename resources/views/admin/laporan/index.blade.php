<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-[22px] font-bold leading-tight text-adm-text-main">
                    Laporan & Rekapitulasi
                </h2>
                <p class="text-[13px] text-adm-text-muted mt-0.5">
                    Pusat rekap data kependudukan dan pencetakan register surat keluar desa.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        {{-- ========================================================= --}}
        {{-- 1. RINGKASAN METRIK & STATISTIK                           --}}
        {{-- ========================================================= --}}
        <div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                {{-- Total Penduduk --}}
                <div class="flex flex-col justify-between rounded-[12px] border border-adm-border bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[12px] font-medium text-adm-text-muted">Total Penduduk</p>
                            <h4 class="mt-1 text-[22px] font-bold text-adm-text-main tabular-nums">{{ $totalPenduduk }}</h4>
                            <p class="mt-1 text-[11px] text-adm-text-body font-medium">
                                <span class="text-blue-600 font-semibold">{{ $pendudukLakiLaki }} L</span> &bull; 
                                <span class="text-pink-500 font-semibold">{{ $pendudukPerempuan }} P</span>
                            </p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-[10px] bg-indigo-50 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Penduduk Aktif --}}
                <div class="flex flex-col justify-between rounded-[12px] border border-adm-border bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[12px] font-medium text-adm-text-muted">Status Penduduk Aktif</p>
                            <h4 class="mt-1 text-[22px] font-bold text-adm-text-main tabular-nums">{{ $pendudukAktif }}</h4>
                            <p class="mt-1 text-[11px] text-emerald-600 font-semibold">
                                Terdaftar dan Berdomisili
                            </p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-[10px] bg-emerald-50 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Total Pengajuan Masuk --}}
                <div class="flex flex-col justify-between rounded-[12px] border border-adm-border bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[12px] font-medium text-adm-text-muted">Total Pengajuan Surat</p>
                            <h4 class="mt-1 text-[22px] font-bold text-adm-text-main tabular-nums">{{ $totalPengajuan }}</h4>
                            <p class="mt-1 text-[11px] text-amber-500 font-medium">
                                {{ $pengajuanProses }} Dalam Proses
                            </p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-[10px] bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Surat Selesai / Keluar --}}
                <div class="flex flex-col justify-between rounded-[12px] border border-adm-border bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[12px] font-medium text-adm-text-muted">Surat Keluar / Selesai</p>
                            <h4 class="mt-1 text-[22px] font-bold text-emerald-600 tabular-nums">{{ $pengajuanSelesai }}</h4>
                            <p class="mt-1 text-[11px] text-adm-text-muted">
                                Diterbitkan & Selesai Diproses
                            </p>
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-[10px] bg-emerald-50 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================================= --}}
        {{-- 2. MODUL: LAPORAN PENDUDUK (BERDASARKAN RT)                 --}}
        {{-- ========================================================= --}}
        <div class="rounded-[12px] border border-adm-border bg-white shadow-sm overflow-hidden">
            <div class="border-b border-adm-border px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-adm-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                        <h3 class="text-[16px] font-semibold text-adm-text-main">
                            Laporan Data Penduduk
                        </h3>
                    </div>
                    <p class="text-[12px] text-adm-text-muted mt-0.5 ml-9">
                        Saring data kependudukan berdasarkan RT untuk pratinjau dan cetak dokumen resmi.
                    </p>
                </div>

                {{-- Action Quick Print --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.laporan.cetak-penduduk', ['rt' => $filterRt]) }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 h-[38px] rounded-[8px] bg-emerald-600 px-4 text-[13px] font-medium text-white transition hover:bg-emerald-700 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Laporan Penduduk
                    </a>
                </div>
            </div>

            {{-- Filter Form --}}
            <div class="border-b border-adm-border bg-adm-canvas/40 px-6 py-4">
                <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-col md:flex-row md:items-end gap-3">
                    {{-- Pertahankan filter surat jika ada --}}
                    @if($filterLayananId)<input type="hidden" name="layanan_id" value="{{ $filterLayananId }}">@endif
                    @if($tanggalDari)<input type="hidden" name="tanggal_dari" value="{{ $tanggalDari }}">@endif
                    @if($tanggalSampai)<input type="hidden" name="tanggal_sampai" value="{{ $tanggalSampai }}">@endif

                    {{-- RT Select --}}
                    <div class="w-full md:w-48">
                        <label class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">
                            Pilih RT
                        </label>
                        <select name="rt" class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input py-2 pl-3 pr-8 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                            <option value="">Semua RT</option>
                            @foreach ($rtList as $rt)
                                <option value="{{ $rt }}" @selected($filterRt == $rt)>RT {{ $rt }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-2 w-full md:w-auto shrink-0">
                        <button type="submit" class="inline-flex items-center justify-center w-full md:w-auto h-[38px] rounded-[8px] bg-adm-primary px-5 py-2 text-[13px] font-medium text-white transition hover:bg-adm-primary-hover shadow-sm border border-transparent">
                            Tampilkan Data
                        </button>

                        @if ($filterRt)
                        <a href="{{ route('admin.laporan.index', array_filter(['layanan_id' => $filterLayananId, 'tanggal_dari' => $tanggalDari, 'tanggal_sampai' => $tanggalSampai])) }}"
                           class="inline-flex items-center justify-center w-full md:w-auto h-[38px] rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-body transition hover:bg-slate-50 shadow-sm">
                            Reset
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Filter Status Info --}}
            @if ($filterRt)
            <div class="flex items-center justify-between px-6 py-2.5 border-b border-adm-border bg-blue-50/60">
                <div class="flex items-center gap-2 text-[12px] font-medium text-blue-700">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>
                        Filter Penduduk Aktif:
                        <strong>RT {{ $filterRt }}</strong>
                        &bull; {{ $penduduks->total() }} jiwa ditemukan
                    </span>
                </div>
                <a href="{{ route('admin.laporan.index', array_filter(['layanan_id' => $filterLayananId, 'tanggal_dari' => $tanggalDari, 'tanggal_sampai' => $tanggalSampai])) }}"
                   class="text-[11px] font-semibold text-adm-rose-fg hover:underline">
                    Hapus Filter
                </a>
            </div>
            @endif

            {{-- Table Pratinjau Penduduk --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[13px]">
                    <thead class="bg-adm-canvas/75 text-[11px] font-semibold uppercase tracking-wider text-adm-text-muted border-b border-adm-border">
                        <tr>
                            <th class="px-6 py-3.5">NIK / Warga</th>
                            <th class="px-6 py-3.5">L/P</th>
                            <th class="px-6 py-3.5">Tempat, Tgl Lahir</th>
                            <th class="px-6 py-3.5">Alamat</th>
                            <th class="px-6 py-3.5">RT / RW</th>
                            <th class="px-6 py-3.5">Pekerjaan</th>
                            <th class="px-6 py-3.5 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-adm-border text-adm-text-body">
                        @forelse ($penduduks as $p)
                        <tr class="hover:bg-slate-50/75 transition-colors">
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <div class="font-bold text-adm-text-main">{{ $p->nama_lengkap }}</div>
                                <div class="text-[12px] text-adm-text-muted tabular-nums">{{ $p->nik }}</div>
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                @if($p->jenis_kelamin === 'L')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 text-blue-600">Laki-laki</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-pink-50 text-pink-600">Perempuan</span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <div>{{ $p->tempat_lahir }}</div>
                                <div class="text-[11px] text-adm-text-muted tabular-nums">{{ $p->tanggal_lahir ? \Carbon\Carbon::parse($p->tanggal_lahir)->translatedFormat('d M Y') : '-' }}</div>
                            </td>
                            <td class="px-6 py-3.5 max-w-xs truncate">
                                {{ $p->alamat }}
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap tabular-nums">
                                <span class="font-medium text-adm-text-main">RT {{ $p->rt }} / RW {{ $p->rw }}</span>
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                {{ $p->pekerjaan ?? '-' }}
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap text-center">
                                @if($p->status_penduduk === 'aktif')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-600">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-600">Tidak Aktif</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-adm-text-muted">
                                Tidak ada data penduduk yang sesuai dengan kriteria filter.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($penduduks->hasPages())
            <div class="px-6 py-4 border-t border-adm-border bg-white">
                {{ $penduduks->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>

        {{-- ========================================================= --}}
        {{-- 3. MODUL: REKAP SURAT KELUAR (BERDASARKAN JENIS SURAT)    --}}
        {{-- ========================================================= --}}
        <div class="rounded-[12px] border border-adm-border bg-white shadow-sm overflow-hidden">
            <div class="border-b border-adm-border px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </span>
                        <h3 class="text-[16px] font-semibold text-adm-text-main">
                            Rekapitulasi Surat Keluar
                        </h3>
                    </div>
                    <p class="text-[12px] text-adm-text-muted mt-0.5 ml-9">
                        Daftar register surat yang telah diterbitkan kepada warga berdasarkan jenis layanan & periode.
                    </p>
                </div>

                {{-- Action Quick Print --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.laporan.cetak-surat', ['layanan_id' => $filterLayananId, 'tanggal_dari' => $tanggalDari, 'tanggal_sampai' => $tanggalSampai]) }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 h-[38px] rounded-[8px] bg-emerald-600 px-4 text-[13px] font-medium text-white transition hover:bg-emerald-700 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Rekap Surat Keluar
                    </a>
                </div>
            </div>

            {{-- Filter Form --}}
            <div class="border-b border-adm-border bg-adm-canvas/40 px-6 py-4">
                <form method="GET" action="{{ route('admin.laporan.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end">
                    {{-- Pertahankan filter penduduk jika ada --}}
                    @if($filterRt)<input type="hidden" name="rt" value="{{ $filterRt }}">@endif

                    {{-- Jenis Surat Select --}}
                    <div>
                        <label class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">
                            Jenis Surat
                        </label>
                        <select name="layanan_id" class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input py-2 pl-3 pr-8 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                            <option value="">Semua Jenis Surat</option>
                            @foreach ($layananList as $l)
                                <option value="{{ $l->id }}" @selected($filterLayananId == $l->id)>{{ $l->nama_layanan }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Dari --}}
                    <div>
                        <label class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">
                            Tanggal Dari
                        </label>
                        <input type="date" name="tanggal_dari" value="{{ $tanggalDari }}"
                               class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                    </div>

                    {{-- Tanggal Sampai --}}
                    <div>
                        <label class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">
                            Tanggal Sampai
                        </label>
                        <input type="date" name="tanggal_sampai" value="{{ $tanggalSampai }}"
                               class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                    </div>

                    <div class="flex gap-2 w-full">
                        <button type="submit" class="inline-flex items-center justify-center flex-1 h-[38px] rounded-[8px] bg-adm-primary px-4 py-2 text-[13px] font-medium text-white transition hover:bg-adm-primary-hover shadow-sm border border-transparent">
                            Filter Rekap
                        </button>

                        @if ($filterLayananId || $tanggalDari || $tanggalSampai)
                        <a href="{{ route('admin.laporan.index', array_filter(['rt' => $filterRt])) }}"
                           class="inline-flex items-center justify-center h-[38px] rounded-[8px] bg-white border border-adm-border px-3 py-2 text-[13px] font-medium text-adm-text-body transition hover:bg-slate-50 shadow-sm">
                            Reset
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Filter Active Info --}}
            @if ($filterLayananId || $tanggalDari || $tanggalSampai)
            <div class="flex items-center justify-between px-6 py-2.5 border-b border-adm-border bg-emerald-50/60">
                <div class="flex items-center gap-2 text-[12px] font-medium text-emerald-800">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>
                        Filter Surat Aktif:
                        <strong>{{ $filterLayananId ? ($layananList->firstWhere('id', $filterLayananId)->nama_layanan ?? 'Jenis Terpilih') : 'Semua Jenis Surat' }}</strong>
                        @if($tanggalDari || $tanggalSampai)
                            ({{ $tanggalDari ?: 'Awal' }} s/d {{ $tanggalSampai ?: 'Sekarang' }})
                        @endif
                        &bull; {{ $suratKeluar->total() }} surat ditemukan
                    </span>
                </div>
                <a href="{{ route('admin.laporan.index', array_filter(['rt' => $filterRt])) }}"
                   class="text-[11px] font-semibold text-adm-rose-fg hover:underline">
                    Hapus Filter
                </a>
            </div>
            @endif

            {{-- Table Pratinjau Surat Keluar --}}
            <div class="overflow-x-auto">
                <table class="w-full text-left text-[13px]">
                    <thead class="bg-adm-canvas/75 text-[11px] font-semibold uppercase tracking-wider text-adm-text-muted border-b border-adm-border">
                        <tr>
                            <th class="px-6 py-3.5">No. Surat / Registrasi</th>
                            <th class="px-6 py-3.5">Tanggal Selesai</th>
                            <th class="px-6 py-3.5">Pemohon</th>
                            <th class="px-6 py-3.5">Jenis Surat</th>
                            <th class="px-6 py-3.5">RT / RW</th>
                            <th class="px-6 py-3.5">Petugas</th>
                            <th class="px-6 py-3.5 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-adm-border text-adm-text-body">
                        @forelse ($suratKeluar as $item)
                        @php
                            $nomorSurat = $item->surat->nomor_surat ?? $item->nomor_pengajuan;
                            $tglSelesai = $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') : \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y');
                        @endphp
                        <tr class="hover:bg-slate-50/75 transition-colors">
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <div class="font-bold text-adm-text-main tabular-nums">{{ $nomorSurat }}</div>
                                @if($item->surat)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-blue-600">Surat Resmi Diterbitkan</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-600">Pengajuan Selesai</span>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap tabular-nums">
                                {{ $tglSelesai }}
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <div class="font-semibold text-adm-text-main">{{ $item->penduduk->nama_lengkap ?? '-' }}</div>
                                <div class="text-[12px] text-adm-text-muted tabular-nums">{{ $item->penduduk->nik ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-[6px] text-[12px] font-medium bg-slate-100 text-adm-text-main">
                                    {{ $item->layanan->nama_layanan ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap tabular-nums">
                                RT {{ $item->penduduk->rt ?? '-' }} / RW {{ $item->penduduk->rw ?? '-' }}
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap text-adm-text-muted">
                                {{ $item->diprosesOleh->username ?? 'Admin' }}
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap text-center">
                                @if($item->surat)
                                    <a href="{{ route('admin.pengajuan.surat', $item->id) }}" target="_blank"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[6px] bg-blue-50 text-adm-primary hover:bg-adm-primary hover:text-white transition text-[12px] font-medium">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Lihat Dokumen
                                    </a>
                                @else
                                    <a href="{{ route('admin.pengajuan.show', $item->id) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[6px] bg-slate-100 text-adm-text-body hover:bg-slate-200 transition text-[12px] font-medium">
                                        Detail Pengajuan
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-adm-text-muted">
                                Belum ada riwayat surat keluar atau tidak ada data yang cocok dengan filter.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($suratKeluar->hasPages())
            <div class="px-6 py-4 border-t border-adm-border bg-white">
                {{ $suratKeluar->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
