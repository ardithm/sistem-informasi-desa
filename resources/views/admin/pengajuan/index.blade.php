<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Pengajuan</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">Data Pengajuan</h1>
            </div>
            <p class="text-sm text-adm-text-muted">
                Daftar semua pengajuan layanan surat dari masyarakat.
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Pesan sukses --}}
        @if (session('success'))
        <div class="mb-6 rounded-[12px] border border-adm-green-fg/20 bg-adm-green-bg px-4 py-3 text-[13px] font-medium text-adm-green-fg shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        {{-- Section Tabel Pengajuan --}}
        <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
            
            {{-- Header tabel --}}
            <div class="flex items-center px-6 py-5 border-b border-adm-border bg-adm-card">
                <h2 class="text-[16px] font-semibold text-adm-text-main">Daftar Pengajuan</h2>
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
                            <th class="px-5 py-3 text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Tanggal</th>
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
                                        {{ strtoupper(substr($pengajuan->penduduk->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-[13px] font-medium text-adm-text-main">{{ $pengajuan->penduduk->nama_lengkap }}</div>
                                        <div class="text-[11px] font-mono text-adm-text-muted mt-0.5">{{ $pengajuan->penduduk->nik }}</div>
                                    </div>
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
                                    'diverifikasi'    => 'bg-adm-blue-bg text-adm-blue-fg',
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
                            <td class="px-5 py-4 text-[12px] text-adm-text-muted">
                                {{ $pengajuan->created_at->format('d/m/Y H:i') }}
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
                                <div class="mx-auto max-w-xs">
                                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-adm-canvas">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-[13px] font-medium text-adm-text-main">Tidak ada data</p>
                                    <p class="mt-1 text-[12px] text-adm-text-muted">Belum ada pengajuan masuk.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($pengajuans->hasPages())
            <div class="px-6 py-4 border-t border-adm-border bg-adm-card">
                {{ $pengajuans->links() }}
            </div>
            @endif

        </section>

    </div>

</x-app-layout>