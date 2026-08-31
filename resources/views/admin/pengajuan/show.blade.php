<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Pengajuan</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">Detail Pengajuan</h1>
            </div>
            <a href="{{ route('admin.pengajuan.index') }}"
                class="inline-flex items-center gap-1.5 rounded-[8px] border border-adm-border bg-adm-card px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
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

        {{-- TWO-COLUMN LAYOUT --}}
        <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">
            
            {{-- ========================================= --}}
            {{-- MAIN COLUMN (Kiri): Verifikasi Dokumen --}}
            {{-- ========================================= --}}
            <div class="space-y-6 lg:col-span-2" x-data="{ showModal: false, previewUrl: '', previewTitle: '' }">
                
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <h2 class="text-[15px] font-semibold text-adm-text-main">Verifikasi Dokumen Persyaratan</h2>
                        <span class="text-[12px] font-medium text-adm-text-muted">{{ $pengajuan->dokumens->count() }} Dokumen</span>
                    </div>

                    <div class="divide-y divide-adm-border">
                        @forelse ($pengajuan->dokumens as $dokumen)
                        <div class="p-6 transition-colors duration-150 hover:bg-slate-50/50">
                            
                            {{-- Info Dokumen Header --}}
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-3">
                                        <h3 class="text-[14px] font-semibold text-adm-text-main">{{ $dokumen->jenis_dokumen }}</h3>
                                        @php
                                        $statusVerif = $dokumen->status_verifikasi;
                                        $verifClasses = match($statusVerif) {
                                            'menunggu'    => 'bg-adm-amber-bg text-adm-amber-fg border-adm-amber-fg/20',
                                            'valid'       => 'bg-adm-green-bg text-adm-green-fg border-adm-green-fg/20',
                                            'tidak_valid' => 'bg-adm-purple-bg text-adm-purple-fg border-adm-purple-fg/20',
                                            'ditolak'     => 'bg-adm-rose-bg text-adm-rose-fg border-adm-rose-fg/20',
                                            default       => 'bg-adm-input text-adm-text-muted border-adm-border',
                                        };
                                        @endphp
                                        <span class="inline-flex items-center rounded-full border px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider {{ $verifClasses }}">
                                            {{ str_replace('_', ' ', $statusVerif) }}
                                        </span>
                                    </div>
                                    <div class="mt-1 flex items-center gap-3 text-[12px] text-adm-text-muted">
                                        <span class="font-mono">{{ $dokumen->nama_file }}</span>
                                        <span>&bull;</span>
                                        <span>{{ number_format($dokumen->ukuran_file / 1024, 0) }} KB</span>
                                    </div>
                                </div>
                                <button type="button" @click="previewUrl = '{{ Storage::url($dokumen->path_file) }}'; previewTitle = '{{ $dokumen->jenis_dokumen }}'; showModal = true"
                                   class="shrink-0 inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-3 py-1.5 text-[12px] font-medium text-adm-text-main transition hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Buka File
                                </button>
                            </div>

                            {{-- Form Verifikasi Interaktif --}}
                            <form action="{{ route('admin.pengajuan.dokumen.verifikasi', $dokumen) }}" method="POST" 
                                  class="mt-5 rounded-[10px] bg-adm-canvas p-4 border border-adm-border/60">
                                @csrf
                                @method('PATCH')
                                
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-2.5">Perbarui Status</p>
                                
                                <div class="grid grid-cols-3 gap-3 mb-4">
                                    {{-- Radio Kustom: Valid --}}
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="status_verifikasi" value="valid" class="peer sr-only" @checked($dokumen->status_verifikasi === 'valid')>
                                        <div class="flex items-center justify-center gap-2 rounded-[8px] border border-adm-border bg-white px-3 py-2 text-[12px] font-semibold text-adm-text-muted transition-all peer-checked:border-adm-green-fg peer-checked:bg-adm-green-bg peer-checked:text-adm-green-fg hover:bg-slate-50 peer-checked:shadow-[inset_0_0_0_1px_rgba(22,163,74,0.3)]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                            Valid
                                        </div>
                                    </label>
                                    
                                    {{-- Radio Kustom: Tidak Valid --}}
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="status_verifikasi" value="tidak_valid" class="peer sr-only" @checked($dokumen->status_verifikasi === 'tidak_valid')>
                                        <div class="flex items-center justify-center gap-2 rounded-[8px] border border-adm-border bg-white px-3 py-2 text-[12px] font-semibold text-adm-text-muted transition-all peer-checked:border-adm-purple-fg peer-checked:bg-adm-purple-bg peer-checked:text-adm-purple-fg hover:bg-slate-50 peer-checked:shadow-[inset_0_0_0_1px_rgba(147,51,234,0.3)]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Revisi
                                        </div>
                                    </label>

                                    {{-- Radio Kustom: Ditolak --}}
                                    <label class="cursor-pointer relative">
                                        <input type="radio" name="status_verifikasi" value="ditolak" class="peer sr-only" @checked($dokumen->status_verifikasi === 'ditolak')>
                                        <div class="flex items-center justify-center gap-2 rounded-[8px] border border-adm-border bg-white px-3 py-2 text-[12px] font-semibold text-adm-text-muted transition-all peer-checked:border-adm-rose-fg peer-checked:bg-adm-rose-bg peer-checked:text-adm-rose-fg hover:bg-slate-50 peer-checked:shadow-[inset_0_0_0_1px_rgba(225,29,72,0.3)]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            Ditolak
                                        </div>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label for="catatan_{{ $dokumen->id }}" class="block text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1.5">Catatan (Opsional)</label>
                                    <textarea id="catatan_{{ $dokumen->id }}" name="catatan" rows="1" maxlength="1000" placeholder="Tulis alasan jika revisi/ditolak..."
                                              class="w-full rounded-[8px] border-adm-border bg-white text-[13px] text-adm-text-main placeholder-gray-400 focus:border-adm-primary focus:ring-adm-primary resize-none">{{ $dokumen->catatan }}</textarea>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-primary px-5 py-2 text-[12px] font-semibold text-white transition hover:bg-adm-primary-hover shadow-sm">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                        @empty
                        <div class="p-8 text-center">
                            <p class="text-[13px] text-adm-text-muted">Tidak ada dokumen persyaratan.</p>
                        </div>
                        @endforelse
                    </div>
                </section>

                {{-- Modal Preview Dokumen --}}
                <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex min-h-screen items-end justify-center p-4 text-center sm:block sm:p-0">
                        {{-- Background overlay --}}
                        <div x-show="showModal" 
                             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                             class="fixed inset-0 bg-slate-900/75 backdrop-blur-sm transition-opacity" @click="showModal = false" aria-hidden="true"></div>
                
                        <span class="hidden sm:inline-block sm:h-screen sm:align-middle" aria-hidden="true">&#8203;</span>
                
                        {{-- Modal panel --}}
                        <div x-show="showModal"
                             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             class="inline-block w-full max-w-5xl transform overflow-hidden rounded-[16px] bg-adm-card text-left align-bottom shadow-2xl transition-all sm:my-8 sm:align-middle">
                            
                            {{-- Modal Header --}}
                            <div class="border-b border-adm-border bg-adm-card px-5 py-4 flex items-center justify-between">
                                <h3 class="text-[16px] font-semibold text-adm-text-main" id="modal-title" x-text="previewTitle"></h3>
                                <button type="button" @click="showModal = false" class="rounded-full p-1.5 text-adm-text-muted hover:bg-slate-100 hover:text-adm-text-main focus:outline-none transition-colors">
                                    <span class="sr-only">Close</span>
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            
                            {{-- Modal Body (Iframe) --}}
                            <div class="bg-adm-canvas h-[75vh] w-full relative">
                                {{-- Loading Spinner (CSS only, sits behind iframe) --}}
                                <div class="absolute inset-0 flex items-center justify-center -z-10">
                                    <svg class="animate-spin h-8 w-8 text-adm-text-muted/50" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                                <iframe :src="previewUrl" class="w-full h-full border-0 relative z-10" title="Preview Dokumen"></iframe>
                            </div>
                            
                            {{-- Modal Footer --}}
                            <div class="border-t border-adm-border bg-adm-card px-5 py-3 flex justify-end">
                                <a :href="previewUrl" target="_blank" class="inline-flex items-center gap-2 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                                    Buka di Tab Baru
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>
                
                        </div>
                    </div>
                </div>

            </div>

            {{-- ========================================= --}}
            {{-- SIDEBAR COLUMN (Kanan): Meta & Aksi       --}}
            {{-- ========================================= --}}
            <div class="space-y-6 lg:col-span-1">
                
                {{-- Aksi Utama (Dipindah ke atas agar paling menonjol) --}}
                @if (in_array($pengajuan->status, ['diverifikasi', 'diproses', 'selesai']) || $pengajuan->catatan_admin)
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-5 py-3">
                        <h2 class="text-[14px] font-semibold text-adm-text-main">Tindakan Lanjutan</h2>
                    </div>
                    <div class="p-5">
                        
                        @if ($pengajuan->catatan_admin)
                        <div class="mb-5 rounded-[8px] bg-adm-canvas p-3 border border-adm-border text-center">
                            <p class="text-[10px] font-semibold uppercase tracking-widest text-adm-text-muted mb-1">Catatan Admin (Global)</p>
                            <p class="text-[12px] text-adm-text-main font-medium whitespace-pre-line">{{ $pengajuan->catatan_admin }}</p>
                        </div>
                        @endif

                        @if ($pengajuan->status === 'diverifikasi')
                        <div class="rounded-[8px] bg-adm-blue-bg border border-adm-blue-fg/20 p-4 text-center">
                            <div class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-adm-blue-fg/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-adm-blue-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-[14px] font-bold text-adm-blue-fg">Siap Diproses</h3>
                            <p class="mt-1 mb-4 text-[12px] text-adm-blue-fg/80 leading-relaxed">Semua dokumen valid. Silakan klik tombol di bawah untuk mulai memproses pengajuan ini.</p>
                            <form action="{{ route('admin.pengajuan.proses', $pengajuan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full rounded-[8px] bg-adm-primary px-4 py-2.5 text-[13px] font-bold text-white transition hover:bg-adm-primary-hover shadow-sm hover:-translate-y-0.5">
                                    Mulai Proses
                                </button>
                            </form>
                        </div>
                        @endif

                        @if ($pengajuan->status === 'diproses' && !$pengajuan->surat)
                        <div class="rounded-[8px] bg-adm-amber-bg border border-adm-amber-fg/20 p-4 text-center">
                            <div class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-adm-amber-fg/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-adm-amber-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-[14px] font-bold text-adm-amber-fg">Penerbitan Surat</h3>
                            <p class="mt-1 mb-4 text-[12px] text-adm-amber-fg/80 leading-relaxed">Pengajuan sedang diproses. Buat dan terbitkan surat secara offline/sistem lalu konfirmasi.</p>
                            <form action="{{ route('admin.pengajuan.terbitkan-surat', $pengajuan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full rounded-[8px] bg-adm-amber-fg px-4 py-2.5 text-[13px] font-bold text-white transition hover:bg-amber-600 shadow-sm hover:-translate-y-0.5">
                                    Terbitkan Surat
                                </button>
                            </form>
                        </div>
                        @endif

                        @if ($pengajuan->status === 'selesai' && $pengajuan->surat)
                        <div class="rounded-[8px] bg-adm-green-bg border border-adm-green-fg/20 p-4 text-center">
                            <div class="mx-auto mb-2 flex h-10 w-10 items-center justify-center rounded-full bg-adm-green-fg/10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-adm-green-fg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-[14px] font-bold text-adm-green-fg">Surat Diterbitkan</h3>
                            <p class="mt-1 mb-4 text-[12px] text-adm-green-fg/80">Proses pengajuan telah selesai.</p>
                            <a href="{{ route('admin.pengajuan.surat', $pengajuan->id) }}" target="_blank"
                               class="flex w-full items-center justify-center gap-2 rounded-[8px] bg-white border border-adm-green-fg/30 px-4 py-2 text-[13px] font-semibold text-adm-green-fg transition hover:bg-adm-green-fg hover:text-white shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Lihat Arsip Surat
                            </a>
                        </div>
                        @endif

                    </div>
                </section>
                @endif

                {{-- Status & Informasi Pengajuan --}}
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-5 py-3">
                        <h2 class="text-[14px] font-semibold text-adm-text-main">Ringkasan Pengajuan</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Status Saat Ini</p>
                            <div class="mt-1">
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
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-bold {{ $badgeClasses }}">
                                    {{ str_replace('_', ' ', ucfirst($pengajuan->status)) }}
                                </span>
                            </div>
                        </div>

                        <hr class="border-adm-border">

                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Nomor Pengajuan</p>
                            <p class="mt-1 font-mono text-[13px] font-semibold text-adm-text-main">{{ $pengajuan->nomor_pengajuan }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Layanan</p>
                            <p class="mt-1 text-[13px] font-semibold text-adm-text-main">{{ $pengajuan->layanan->nama_layanan }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Waktu Masuk</p>
                            <p class="mt-1 text-[12px] font-medium text-adm-text-body">{{ $pengajuan->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                    </div>
                </section>

                {{-- Data Pemohon --}}
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-5 py-3">
                        <h2 class="text-[14px] font-semibold text-adm-text-main">Data Pemohon</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-adm-primary-soft text-[14px] font-bold text-adm-primary">
                                {{ strtoupper(substr($pengajuan->penduduk->nama_lengkap, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-[14px] font-bold text-adm-text-main leading-tight">{{ $pengajuan->penduduk->nama_lengkap }}</p>
                                <p class="mt-0.5 font-mono text-[11px] text-adm-text-muted">{{ $pengajuan->penduduk->nik }}</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">No WhatsApp</p>
                            <p class="mt-1 font-mono text-[13px] text-adm-text-body">{{ $pengajuan->no_hp }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Alamat Pemohon</p>
                            <p class="mt-1 text-[12px] leading-relaxed text-adm-text-body">{{ $pengajuan->penduduk->alamat }} (RT {{ $pengajuan->penduduk->rt }} / RW {{ $pengajuan->penduduk->rw }})</p>
                        </div>
                    </div>
                </section>

                {{-- Detail Layanan Khusus --}}
                @if (in_array($pengajuan->layanan->kode, ['SKD', 'SKKK', 'SKTP', 'SKTM']))
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-5 py-3">
                        <h2 class="text-[14px] font-semibold text-adm-text-main">Info Tambahan Form</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        
                        @if ($pengajuan->layanan->kode === 'SKD')
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Alamat Domisili</p>
                                <p class="mt-1 text-[12px] text-adm-text-body whitespace-pre-line">{{ $pengajuan->detailDomisili->alamat_domisili }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Keperluan</p>
                                <p class="mt-1 text-[12px] text-adm-text-body whitespace-pre-line">{{ $pengajuan->detailDomisili->keperluan }}</p>
                            </div>
                        @elseif ($pengajuan->layanan->kode === 'SKKK')
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Nomor KK Baru</p>
                                <p class="mt-1 font-mono text-[12px] text-adm-text-body">{{ $pengajuan->detailPengantarKk->nomor_kk }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Keperluan</p>
                                <p class="mt-1 text-[12px] text-adm-text-body whitespace-pre-line">{{ $pengajuan->detailPengantarKk->keperluan }}</p>
                            </div>
                        @elseif ($pengajuan->layanan->kode === 'SKTP')
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Alasan Pengajuan</p>
                                <p class="mt-1 text-[12px] font-semibold text-adm-text-main">
                                    @switch($pengajuan->detailPengantarKtp->keperluan_ktp)
                                        @case('pembuatan_baru') Pembuatan Baru @break
                                        @case('hilang') Hilang @break
                                        @case('rusak') Rusak @break
                                        @case('perubahan_data') Perubahan Data @break
                                        @default -
                                    @endswitch
                                </p>
                            </div>
                        @elseif ($pengajuan->layanan->kode === 'SKTM')
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Jml. Anggota Keluarga</p>
                                <p class="mt-1 text-[12px] font-semibold text-adm-text-main">{{ $pengajuan->detailSktm->jumlah_anggota_keluarga }} orang</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Penghasilan</p>
                                <p class="mt-1 text-[12px] font-semibold text-adm-text-main">Rp {{ number_format($pengajuan->detailSktm->penghasilan_per_bulan, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Keperluan</p>
                                <p class="mt-1 text-[12px] text-adm-text-body whitespace-pre-line">{{ $pengajuan->detailSktm->keperluan }}</p>
                            </div>
                        @endif

                    </div>
                </section>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>