<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Dashboard Operasional</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">Ringkasan Desa</h1>
            </div>
            <p class="text-sm text-adm-text-muted">
                Monitoring pelayanan, pengajuan aktif, dan status dokumen secara real time.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- ============================================================
             SECTION 1 — METRIC CARDS (4-column)
        ============================================================ --}}
        <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Card: Penduduk Aktif (Green) --}}
            <div class="flex items-center gap-4 rounded-[12px] border border-adm-border bg-adm-card p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.04)]">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-[10px] bg-adm-green-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-adm-green-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-[12px] font-medium text-adm-text-muted">Penduduk Aktif</div>
                    <div class="mt-0.5 text-[20px] font-bold tabular-nums text-adm-text-main">{{ $totalPenduduk }}</div>
                </div>
            </div>

            {{-- Card: Total Pengajuan (Blue) --}}
            <div class="flex items-center gap-4 rounded-[12px] border border-adm-border bg-adm-card p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.04)]">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-[10px] bg-adm-blue-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-adm-blue-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-[12px] font-medium text-adm-text-muted">Total Pengajuan</div>
                    <div class="mt-0.5 text-[20px] font-bold tabular-nums text-adm-text-main">{{ $totalPengajuan }}</div>
                </div>
            </div>

            {{-- Card: Diproses (Amber) --}}
            <div class="flex items-center gap-4 rounded-[12px] border border-adm-border bg-adm-card p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.04)]">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-[10px] bg-adm-amber-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-adm-amber-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-[12px] font-medium text-adm-text-muted">Sedang Diproses</div>
                    <div class="mt-0.5 text-[20px] font-bold tabular-nums text-adm-text-main">{{ $pengajuanDiproses }}</div>
                </div>
            </div>

            {{-- Card: Selesai (Purple) --}}
            <div class="flex items-center gap-4 rounded-[12px] border border-adm-border bg-adm-card p-5 shadow-[0_1px_3px_0_rgba(0,0,0,0.04)]">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-[10px] bg-adm-purple-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-adm-purple-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 3" />
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-[12px] font-medium text-adm-text-muted">Selesai</div>
                    <div class="mt-0.5 text-[20px] font-bold tabular-nums text-adm-text-main">{{ $pengajuanSelesai }}</div>
                </div>
            </div>

        </section>

        {{-- ============================================================
             SECTION 2 — STATUS KONDISI HARIAN (4 sub-cards)
        ============================================================ --}}
        <section class="rounded-[12px] border border-adm-border bg-adm-card p-6 shadow-[0_1px_3px_0_rgba(0,0,0,0.04)]">
            <div class="mb-5 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Status Pengajuan</p>
                    <h2 class="mt-0.5 text-[16px] font-semibold text-adm-text-main">Kondisi Harian</h2>
                </div>
                <span class="text-[12px] text-adm-text-muted">Update otomatis berdasarkan data sistem</span>
            </div>

            <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">

                {{-- Menunggu --}}
                <div class="rounded-[10px] border border-adm-border bg-adm-canvas px-5 py-4">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Menunggu</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-amber-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-amber-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-[28px] font-bold tabular-nums text-adm-text-main">{{ $pengajuanMenunggu }}</div>
                </div>

                {{-- Perlu Perbaikan --}}
                <div class="rounded-[10px] border border-adm-border bg-adm-canvas px-5 py-4">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Perbaikan</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-purple-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-purple-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.458 19h13.084A2.458 2.458 0 0021 16.542V11.5A2.458 2.458 0 0018.542 9H16V7a4 4 0 10-8 0v2H5.458A2.458 2.458 0 003 11.5v5.042A2.458 2.458 0 005.458 19z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-[28px] font-bold tabular-nums text-adm-text-main">{{ $pengajuanPerluPerbaikan }}</div>
                </div>

                {{-- Diproses --}}
                <div class="rounded-[10px] border border-adm-border bg-adm-canvas px-5 py-4">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Diproses</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-blue-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-blue-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-[28px] font-bold tabular-nums text-adm-text-main">{{ $pengajuanDiproses }}</div>
                </div>

                {{-- Ditolak --}}
                <div class="rounded-[10px] border border-adm-border bg-adm-canvas px-5 py-4">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Ditolak</span>
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-rose-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-rose-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 text-[28px] font-bold tabular-nums text-adm-text-main">{{ $pengajuanDitolak }}</div>
                </div>

            </div>
        </section>

        {{-- ============================================================
             SECTION 3 — TABEL PENGAJUAN TERBARU
        ============================================================ --}}
        <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
            {{-- Table Header --}}
            <div class="flex flex-col gap-3 border-b border-adm-border px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Aktivitas Terbaru</p>
                    <h2 class="mt-0.5 text-[16px] font-semibold text-adm-text-main">Pengajuan Terakhir</h2>
                </div>
                <a href="{{ route('admin.pengajuan.index') }}"
                   class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-primary px-4 py-2 text-[13px] font-medium text-white transition hover:bg-adm-primary-hover"
                >
                    Lihat semua
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead>
                        <tr class="border-b border-adm-border bg-adm-canvas">
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Nomor</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Pemohon</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Layanan</th>
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Status</th>
                            <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-adm-border">
                        @forelse ($pengajuanTerbaru as $pengajuan)
                        <tr class="transition-colors duration-150 hover:bg-slate-50">
                            {{-- Nomor --}}
                            <td class="px-5 py-4 font-mono text-[12px] text-adm-text-muted">
                                {{ $pengajuan->nomor_pengajuan }}
                            </td>

                            {{-- Pemohon --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-adm-primary-soft text-[11px] font-bold text-adm-primary">
                                        {{ strtoupper(substr($pengajuan->penduduk->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <span class="text-[13px] font-medium text-adm-text-main">{{ $pengajuan->penduduk->nama_lengkap }}</span>
                                </div>
                            </td>

                            {{-- Layanan --}}
                            <td class="px-5 py-4 text-[13px] text-adm-text-body">
                                {{ $pengajuan->layanan->nama_layanan }}
                            </td>

                            {{-- Status Badge --}}
                            <td class="px-5 py-4">
                                @php
                                $statusKey = str_replace(' ', '_', strtolower($pengajuan->status));
                                $badgeClasses = match($statusKey) {
                                    'menunggu'        => 'bg-adm-amber-bg text-adm-amber-fg',
                                    'diproses'        => 'bg-adm-blue-bg text-adm-blue-fg',
                                    'selesai'         => 'bg-adm-green-bg text-adm-green-fg',
                                    'ditolak'         => 'bg-adm-rose-bg text-adm-rose-fg',
                                    'perlu_perbaikan' => 'bg-adm-purple-bg text-adm-purple-fg',
                                    default           => 'bg-adm-input text-adm-text-muted',
                                };
                                @endphp
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold {{ $badgeClasses }}">
                                    {{ str_replace('_', ' ', ucfirst($pengajuan->status)) }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-5 py-4 text-right text-[12px] text-adm-text-muted">
                                {{ $pengajuan->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">
                                <div class="mx-auto max-w-xs">
                                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-adm-canvas">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-[13px] font-medium text-adm-text-main">Tidak ada data</p>
                                    <p class="mt-1 text-[12px] text-adm-text-muted">Belum ada pengajuan yang masuk ke sistem.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</x-app-layout>