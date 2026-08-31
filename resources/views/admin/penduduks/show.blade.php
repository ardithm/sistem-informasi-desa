<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Penduduk</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">
                    Detail Penduduk
                </h1>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.penduduks.index') }}"
                   class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <a href="{{ route('admin.penduduks.edit', $penduduk) }}"
                   class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 hover:text-adm-primary shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Data
                </a>

                @if ($penduduk->status_penduduk === 'aktif')
                <form action="{{ route('admin.penduduks.deactivate', $penduduk) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menonaktifkan penduduk ini? Data tidak akan dihapus permanen, tapi tidak akan bisa melakukan pengajuan.');">
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

        {{-- Pesan Error --}}
        @if (session('error'))
        <div class="rounded-[12px] border border-adm-rose-fg/20 bg-adm-rose-bg px-4 py-3 text-[13px] font-medium text-adm-rose-fg shadow-sm">
            {{ session('error') }}
        </div>
        @endif

        {{-- Highlight Card (Avatar & Nama) --}}
        <div class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="p-6 sm:p-8 flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-adm-primary-soft text-[24px] font-bold text-adm-primary">
                        {{ strtoupper(substr($penduduk->nama_lengkap, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-[20px] font-bold text-adm-text-main leading-tight">{{ $penduduk->nama_lengkap }}</h2>
                        <div class="mt-1 flex items-center gap-3">
                            <p class="font-mono text-[13px] text-adm-text-muted">NIK: {{ $penduduk->nik }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    @if ($penduduk->status_penduduk === 'aktif')
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-[12px] font-bold bg-adm-green-bg text-adm-green-fg">
                        Status Aktif
                    </span>
                    @else
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-[12px] font-bold bg-gray-100 text-gray-600">
                        Tidak Aktif
                    </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            {{-- Kartu Informasi Pribadi --}}
            <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="border-b border-adm-border bg-adm-card px-6 py-4 flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-canvas border border-adm-border">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-[15px] font-semibold text-adm-text-main">Informasi Pribadi</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-6">
                        
                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Jenis Kelamin</p>
                            <p class="mt-1 text-[13px] font-medium text-adm-text-main">{{ $penduduk->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>

                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Tempat, Tanggal Lahir</p>
                            <p class="mt-1 text-[13px] font-medium text-adm-text-main">{{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                        </div>

                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Status Perkawinan</p>
                            <p class="mt-1 text-[13px] font-medium text-adm-text-main">
                                {{ ucwords(str_replace('_', ' ', $penduduk->status_perkawinan)) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Pekerjaan</p>
                            <p class="mt-1 text-[13px] font-medium text-adm-text-main">{{ $penduduk->pekerjaan }}</p>
                        </div>

                    </div>
                </div>
            </section>


            {{-- Kartu Alamat & Sistem --}}
            <div class="space-y-6">
                
                {{-- Alamat & Kontak --}}
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-6 py-4 flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-canvas border border-adm-border">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-[15px] font-semibold text-adm-text-main">Alamat & Kontak</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-6">
                            
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Alamat Lengkap</p>
                                <p class="mt-1 text-[13px] font-medium text-adm-text-main leading-relaxed">{{ $penduduk->alamat }}</p>
                            </div>

                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">RT / RW</p>
                                <p class="mt-1 font-mono text-[13px] font-medium text-adm-text-main">RT {{ str_pad($penduduk->rt, 3, '0', STR_PAD_LEFT) }} / RW {{ str_pad($penduduk->rw, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>

                        </div>
                    </div>
                </section>

                {{-- Informasi Sistem --}}
                <section class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                    <div class="border-b border-adm-border bg-adm-card px-6 py-4 flex items-center gap-3">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-adm-canvas border border-adm-border">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-adm-text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-[15px] font-semibold text-adm-text-main">Informasi Akun (Sistem)</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-6">
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Waktu Terdaftar</p>
                                <p class="mt-1 text-[13px] font-medium text-adm-text-main">{{ $penduduk->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-text-muted">Pembaruan Terakhir</p>
                                <p class="mt-1 text-[13px] font-medium text-adm-text-main">{{ $penduduk->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

        </div>
    </div>

</x-app-layout>