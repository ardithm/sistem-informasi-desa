<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Layanan</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">
                    Detail Layanan
                </h1>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.layanans.index') }}"
                   class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <a href="{{ route('admin.layanans.edit', $layanan) }}"
                   class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Data
                </a>

                @if ($layanan->aktif)
                <form action="{{ route('admin.layanans.deactivate', $layanan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menonaktifkan layanan ini? Warga tidak akan bisa mengajukan permohonan untuk layanan ini.');">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-rose-bg border border-adm-rose-fg/20 px-4 py-2 text-[13px] font-semibold text-adm-rose-fg transition hover:bg-adm-rose-fg hover:text-white shadow-sm">
                        Nonaktifkan
                    </button>
                </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        {{-- Pesan Sukses --}}
        @if (session('success'))
        <div class="rounded-[12px] border border-adm-green-fg/20 bg-adm-green-bg px-4 py-3 text-[13px] font-medium text-adm-green-fg shadow-sm">
            {{ session('success') }}
        </div>
        @endif


        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- Kolom Kiri: Informasi Utama Layanan --}}
            <div class="lg:col-span-2 space-y-6">
                
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-6 py-4 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-canvas border border-adm-border">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-[15px] font-semibold text-adm-text-main">Informasi Layanan</h3>
                        </div>
                        <div>
                            @if ($layanan->aktif)
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-bold bg-adm-green-bg text-adm-green-fg">
                                Layanan Aktif
                            </span>
                            @else
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-bold bg-gray-100 text-gray-600">
                                Layanan Nonaktif
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-6">
                            
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Nama Layanan</p>
                                <p class="mt-1.5 text-[15px] font-semibold text-adm-text-main">{{ $layanan->nama_layanan }}</p>
                            </div>

                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Kode Layanan</p>
                                <p class="mt-1.5 font-mono text-[13px] font-medium text-adm-text-main">{{ $layanan->kode }}</p>
                            </div>

                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Deskripsi / Keterangan</p>
                                <p class="mt-1.5 text-[13px] leading-relaxed text-adm-text-body">{{ $layanan->deskripsi ?: 'Tidak ada deskripsi yang ditambahkan untuk layanan ini.' }}</p>
                            </div>

                        </div>
                    </div>
                </section>

            </div>

            {{-- Kolom Kanan: Meta Info --}}
            <div class="space-y-6">
                
                {{-- Informasi Sistem --}}
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-6 py-4 flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-canvas border border-adm-border">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-[15px] font-semibold text-adm-text-main">Meta Data</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-5">
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">ID Sistem</p>
                                <p class="mt-1 font-mono text-[13px] font-medium text-adm-text-main">{{ $layanan->id }}</p>
                            </div>
                            
                            <hr class="border-adm-border">
                            
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Dibuat Pada</p>
                                <p class="mt-1 text-[13px] font-medium text-adm-text-main">{{ $layanan->created_at->format('d M Y - H:i') }}</p>
                            </div>
                            
                            <hr class="border-adm-border">
                            
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Terakhir Diperbarui</p>
                                <p class="mt-1 text-[13px] font-medium text-adm-text-main">{{ $layanan->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

        </div>
    </div>

</x-app-layout>