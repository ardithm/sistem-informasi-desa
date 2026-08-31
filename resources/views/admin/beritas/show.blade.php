<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Berita</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">
                    Detail Berita
                </h1>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.beritas.index') }}"
                   class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <a href="{{ route('admin.beritas.edit', $berita) }}"
                   class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Data
                </a>
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

            {{-- Kolom Kiri Utama: Konten Berita --}}
            <div class="lg:col-span-2 space-y-6">
                
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    
                    {{-- Header Berita --}}
                    <div class="border-b border-adm-border bg-adm-card px-6 py-5 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                        <div>
                            <h2 class="text-[20px] font-bold text-adm-text-main leading-snug">
                                {{ $berita->judul }}
                            </h2>
                            <p class="mt-2 text-[12px] font-mono text-adm-text-muted">
                                /berita/{{ $berita->slug }}
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            @if ($berita->status === 'published')
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-[12px] font-bold bg-adm-green-bg text-adm-green-fg shadow-sm">
                                Published
                            </span>
                            @else
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-[12px] font-bold bg-yellow-100 text-yellow-800 shadow-sm">
                                Draft
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Gambar --}}
                    @if ($berita->gambar)
                    <div class="border-b border-adm-border bg-adm-canvas p-4 sm:p-6 flex justify-center">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="max-h-96 w-auto object-contain rounded-lg shadow-sm border border-adm-border">
                    </div>
                    @endif

                    {{-- Isi Berita --}}
                    <div class="p-6">
                        <h3 class="text-[13px] font-semibold text-adm-text-main mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Konten Artikel
                        </h3>
                        
                        <div class="prose prose-sm max-w-none text-adm-text-body leading-relaxed">
                            {!! nl2br(e($berita->isi)) !!}
                        </div>
                    </div>
                </section>

            </div>

            {{-- Kolom Kanan: Info Metadata --}}
            <div class="space-y-6">
                
                {{-- Detail Publikasi --}}
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-6 py-4 flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-canvas border border-adm-border">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-[15px] font-semibold text-adm-text-main">Meta Informasi</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-5">
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Penulis</p>
                                <p class="mt-1 flex items-center gap-2 text-[13px] font-medium text-adm-text-main">
                                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-adm-primary-soft text-[10px] font-bold text-adm-primary">
                                        {{ strtoupper(substr($berita->user->name ?? 'A', 0, 1)) }}
                                    </span>
                                    {{ $berita->user->name ?? 'Admin' }}
                                </p>
                            </div>
                            
                            <hr class="border-adm-border">
                            
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Status</p>
                                <p class="mt-1 text-[13px] font-medium text-adm-text-main">
                                    {{ ucfirst($berita->status) }}
                                </p>
                            </div>

                            <hr class="border-adm-border">
                            
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Dibuat Pada</p>
                                <p class="mt-1 text-[13px] font-medium text-adm-text-main">{{ $berita->created_at->format('d M Y - H:i') }}</p>
                            </div>
                            
                            <hr class="border-adm-border">
                            
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Terakhir Diperbarui</p>
                                <p class="mt-1 text-[13px] font-medium text-adm-text-main">{{ $berita->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Hapus Berita --}}
                <section class="rounded-[12px] border border-adm-rose-fg/20 bg-adm-rose-bg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-[13px] font-semibold text-adm-rose-fg flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Zona Berbahaya
                        </h3>
                        <p class="mt-2 text-[12px] text-adm-rose-fg/80 leading-relaxed">
                            Penghapusan berita bersifat permanen dan tidak dapat dibatalkan. Pastikan Anda benar-benar ingin menghapusnya.
                        </p>
                        
                        <form action="{{ route('admin.beritas.destroy', $berita) }}" method="POST" class="mt-4" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini secara permanen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center items-center gap-1.5 rounded-[8px] bg-white border border-adm-rose-fg/30 px-4 py-2 text-[13px] font-semibold text-adm-rose-fg transition hover:bg-adm-rose-fg hover:text-white shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus Berita
                            </button>
                        </form>
                    </div>
                </section>

            </div>

        </div>
    </div>

</x-app-layout>