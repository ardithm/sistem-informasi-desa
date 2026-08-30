<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 pb-2 pt-4 md:flex-row md:items-end md:justify-between">
            <div>
                <div class="mb-3 inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[10px] font-medium uppercase tracking-[0.18em] text-[#d1c9ff]">
                    Dashboard Operasional
                </div>
                <h2 class="font-display text-4xl text-white md:text-5xl">
                    Ringkasan Desa
                </h2>
            </div>
            <p class="max-w-xl text-sm text-[#9f9fa0] md:text-right">
                Monitoring pelayanan, pengajuan aktif, dan status dokumen secara real time.
            </p>
        </div>
    </x-slot>

    <div class="space-y-8 py-8">
        <section class="metrics-grid grid gap-5">
            <div class="admin-stat metric-accent-iris rounded-[30px] p-6 text-white">
                <div class="mb-6 flex items-center justify-between">
                    <span class="text-[10px] uppercase tracking-[0.18em] text-[#d1c9ff]">Penduduk aktif</span>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10 text-[#f5f5f7]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zm-8 9a4 4 0 014-4h0a4 4 0 014 4v1H8v-1z" />
                        </svg>
                    </div>
                </div>
                <div class="text-4xl font-semibold tracking-tight text-white">{{ $totalPenduduk }}</div>
                <div class="mt-4 text-sm text-[#d1c9ff]">Data penduduk terdaftar</div>
            </div>

            <div class="admin-stat metric-accent-cyan rounded-[30px] p-6 text-white">
                <div class="mb-6 flex items-center justify-between">
                    <span class="text-[10px] uppercase tracking-[0.18em] text-[#d1c9ff]">Total pengajuan</span>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10 text-[#f5f5f7]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="text-4xl font-semibold tracking-tight text-white">{{ $totalPengajuan }}</div>
                <div class="mt-4 text-sm text-[#d1c9ff]">Semua pengajuan masuk</div>
            </div>

            <div class="admin-stat metric-accent-orchid rounded-[30px] p-6 text-white">
                <div class="mb-6 flex items-center justify-between">
                    <span class="text-[10px] uppercase tracking-[0.18em] text-[#f7d7f1]">Diproses</span>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10 text-[#f5f5f7]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="text-4xl font-semibold tracking-tight text-white">{{ $pengajuanDiproses }}</div>
                <div class="mt-4 text-sm text-[#f7d7f1]">Sedang ditangani</div>
            </div>

            <div class="admin-stat metric-accent-periwinkle rounded-[30px] p-6 text-white">
                <div class="mb-6 flex items-center justify-between">
                    <span class="text-[10px] uppercase tracking-[0.18em] text-[#dfeaff]">Selesai</span>
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-white/10 text-[#f5f5f7]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 3" />
                        </svg>
                    </div>
                </div>
                <div class="text-4xl font-semibold tracking-tight text-white">{{ $pengajuanSelesai }}</div>
                <div class="mt-4 text-sm text-[#dfeaff]">Surat telah terbit</div>
            </div>
        </section>

        <section class="admin-panel rounded-[30px] p-6 sm:p-8">
            <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="text-[10px] uppercase tracking-[0.18em] text-[#9f9fa0]">Status pengajuan</div>
                    <h3 class="mt-2 font-display text-3xl text-white">Kondisi harian</h3>
                </div>
                <div class="text-sm text-[#9f9fa0]">Update otomatis berdasarkan data sistem</div>
            </div>

            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-[24px] border border-white/10 bg-[#171819] p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-[10px] uppercase tracking-[0.18em] text-[#9f9fa0]">Menunggu</div>
                        <div class="rounded-full bg-[#f7d577]/10 p-2 text-[#f7d577]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-3xl font-semibold text-white">{{ $pengajuanMenunggu }}</div>
                </div>

                <div class="rounded-[24px] border border-white/10 bg-[#171819] p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-[10px] uppercase tracking-[0.18em] text-[#9f9fa0]">Perbaikan</div>
                        <div class="rounded-full bg-[#f3bce9]/10 p-2 text-[#f3bce9]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.458 19h13.084A2.458 2.458 0 0021 16.542V11.5A2.458 2.458 0 0018.542 9H16V7a4 4 0 10-8 0v2H5.458A2.458 2.458 0 003 11.5v5.042A2.458 2.458 0 005.458 19z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-3xl font-semibold text-white">{{ $pengajuanPerluPerbaikan }}</div>
                </div>

                <div class="rounded-[24px] border border-white/10 bg-[#171819] p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-[10px] uppercase tracking-[0.18em] text-[#9f9fa0]">Diproses</div>
                        <div class="rounded-full bg-[#7ed9f6]/10 p-2 text-[#7ed9f6]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-3xl font-semibold text-white">{{ $pengajuanDiproses }}</div>
                </div>

                <div class="rounded-[24px] border border-white/10 bg-[#171819] p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-[10px] uppercase tracking-[0.18em] text-[#9f9fa0]">Ditolak</div>
                        <div class="rounded-full bg-[#f8b5b5]/10 p-2 text-[#f8b5b5]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 text-3xl font-semibold text-white">{{ $pengajuanDitolak }}</div>
                </div>
            </div>
        </section>

        <section class="admin-card overflow-hidden rounded-[30px]">
            <div class="flex flex-col gap-3 border-b border-white/10 p-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <div class="text-[10px] uppercase tracking-[0.18em] text-[#9f9fa0]">Aktivitas terbaru</div>
                    <h3 class="mt-2 font-display text-3xl text-white">Pengajuan terakhir</h3>
                </div>
                <a href="{{ route('admin.pengajuan.index') }}" class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm text-[#f5f5f7] transition hover:bg-white/10">
                    Lihat semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-white/5 text-[#9f9fa0]">
                        <tr>
                            <th class="px-6 py-4 text-[10px] uppercase tracking-[0.18em]">Nomor</th>
                            <th class="px-6 py-4 text-[10px] uppercase tracking-[0.18em]">Pemohon</th>
                            <th class="px-6 py-4 text-[10px] uppercase tracking-[0.18em]">Layanan</th>
                            <th class="px-6 py-4 text-[10px] uppercase tracking-[0.18em]">Status</th>
                            <th class="px-6 py-4 text-[10px] uppercase tracking-[0.18em] text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10 text-[#f5f5f7]">
                        @forelse ($pengajuanTerbaru as $pengajuan)
                        <tr class="transition hover:bg-white/5">
                            <td class="px-6 py-4 text-sm font-medium">{{ $pengajuan->nomor_pengajuan }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#847dff] text-xs font-semibold text-white">
                                        {{ strtoupper(substr($pengajuan->penduduk->nama_lengkap, 0, 1)) }}
                                    </div>
                                    <span class="text-sm text-[#f5f5f7]">{{ $pengajuan->penduduk->nama_lengkap }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-[#d1c9ff]">{{ $pengajuan->layanan->nama_layanan }}</td>
                            <td class="px-6 py-4">
                                @php
                                $statusKey = str_replace(' ', '_', strtolower($pengajuan->status));
                                @endphp
                                <span class="status-badge status-{{ $statusKey }}">
                                    {{ str_replace('_', ' ', ucfirst($pengajuan->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right text-sm text-[#9f9fa0]">{{ $pengajuan->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="mx-auto max-w-sm">
                                    <div class="text-sm uppercase tracking-[0.18em] text-[#9f9fa0]">Tidak ada data</div>
                                    <p class="mt-2 text-[#f5f5f7]">Belum ada pengajuan yang masuk ke sistem.</p>
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