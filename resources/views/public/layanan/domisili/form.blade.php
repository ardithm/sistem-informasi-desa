@extends('layouts.public')

@section('title', 'Pengajuan Surat Keterangan Domisili')

@section('content')

<div class="py-24">

    <div class="max-w-3xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-12">
            <p class="font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase">
                FORMULIR LAYANAN
            </p>
            <h1 class="font-display text-4xl md:text-5xl lg:text-[48px] leading-none text-adm-text-main tracking-tight mt-4">
                Pengajuan Surat Keterangan Domisili
            </h1>
            <p class="font-sans font-light text-[16px] text-adm-text-body mt-3">
                Lengkapi data pengajuan dan unggah dokumen persyaratan di bawah ini.
            </p>
        </div>

        {{-- Data Penduduk --}}
        <div class="bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] overflow-hidden mb-8">
            <div class="p-8">
                <h2 class="font-display text-[22px] text-adm-text-main font-semibold mb-6">
                    Data Identitas Pemohon
                </h2>

                <div class="bg-adm-canvas border border-adm-border rounded-[16px] p-6 space-y-4">
                    
                    {{-- NIK --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 pb-3 border-b border-adm-border/60">
                        <div class="text-[13px] font-medium text-adm-text-muted">NIK</div>
                        <div class="sm:col-span-2 text-[13px] font-semibold font-mono text-adm-text-main">
                            {{ $penduduk->nik }}
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 pb-3 border-b border-adm-border/60">
                        <div class="text-[13px] font-medium text-adm-text-muted">Nama Lengkap</div>
                        <div class="sm:col-span-2 text-[13px] font-semibold text-adm-text-main">
                            {{ $penduduk->nama_lengkap }}
                        </div>
                    </div>

                    {{-- Tempat Tanggal Lahir --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 pb-3 border-b border-adm-border/60">
                        <div class="text-[13px] font-medium text-adm-text-muted">Tempat, Tanggal Lahir</div>
                        <div class="sm:col-span-2 text-[13px] font-medium text-adm-text-main">
                            {{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
                        </div>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 pb-3 border-b border-adm-border/60">
                        <div class="text-[13px] font-medium text-adm-text-muted">Jenis Kelamin</div>
                        <div class="sm:col-span-2 text-[13px] font-medium text-adm-text-main">
                            {{ $penduduk->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </div>
                    </div>

                    {{-- Status Perkawinan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 pb-3 border-b border-adm-border/60">
                        <div class="text-[13px] font-medium text-adm-text-muted">Status Perkawinan</div>
                        <div class="sm:col-span-2 text-[13px] font-medium text-adm-text-main">
                            @switch($penduduk->status_perkawinan)
                                @case('belum_kawin') Belum Kawin @break
                                @case('kawin') Kawin @break
                                @case('cerai_hidup') Cerai Hidup @break
                                @case('cerai_mati') Cerai Mati @break
                                @default -
                            @endswitch
                        </div>
                    </div>

                    {{-- Pekerjaan --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 pb-3 border-b border-adm-border/60">
                        <div class="text-[13px] font-medium text-adm-text-muted">Pekerjaan</div>
                        <div class="sm:col-span-2 text-[13px] font-medium text-adm-text-main">
                            {{ $penduduk->pekerjaan }}
                        </div>
                    </div>

                    {{-- Alamat KTP --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4 pb-3 border-b border-adm-border/60">
                        <div class="text-[13px] font-medium text-adm-text-muted">Alamat Sesuai KTP</div>
                        <div class="sm:col-span-2 text-[13px] font-medium text-adm-text-main leading-relaxed">
                            {{ $penduduk->alamat }}
                        </div>
                    </div>

                    {{-- RT/RW --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
                        <div class="text-[13px] font-medium text-adm-text-muted">RT/RW</div>
                        <div class="sm:col-span-2 text-[13px] font-medium text-adm-text-main">
                            RT {{ $penduduk->rt }} / RW {{ $penduduk->rw }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Form Pengajuan --}}
        <div class="bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] overflow-hidden">

            <form action="{{ route('layanan.domisili.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="penduduk_id" value="{{ $penduduk->id }}">
                <input type="hidden" name="layanan_id" value="{{ $layanan->id }}">

                <div class="p-8 space-y-6">

                    {{-- Nomor HP --}}
                    <div>
                        <input type="hidden" name="no_hp" value="{{ $no_hp }}">
                        <label for="no_hp_display" class="block text-[13px] font-medium text-adm-text-main mb-2">
                            Nomor WhatsApp <span class="text-adm-rose-fg">*</span>
                        </label>
                        <input
                            id="no_hp_display"
                            type="tel"
                            value="{{ $no_hp }}"
                            maxlength="20"
                            class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2.5 px-3.5 text-[13px] text-adm-text-muted select-none cursor-not-allowed"
                            disabled>
                        <p class="text-[11px] text-adm-text-muted mt-2">
                            Sesuai dengan nomor verifikasi WhatsApp di tahap awal.
                        </p>
                    </div>

                    {{-- Alamat Domisili --}}
                    <div>
                        <label for="alamat_domisili" class="block text-[13px] font-medium text-adm-text-main mb-2">
                            Alamat Domisili Saat Ini <span class="text-adm-rose-fg">*</span>
                        </label>
                        <textarea
                            id="alamat_domisili"
                            name="alamat_domisili"
                            rows="3"
                            required
                            placeholder="Masukkan alamat lengkap domisili tempat tinggal saat ini..."
                            class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2.5 px-3.5 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">{{ old('alamat_domisili') }}</textarea>

                        @error('alamat_domisili')
                        <p class="text-[12px] text-adm-rose-fg mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Keperluan --}}
                    <div>
                        <label for="keperluan" class="block text-[13px] font-medium text-adm-text-main mb-2">
                            Keperluan Pembuatan Surat <span class="text-adm-rose-fg">*</span>
                        </label>
                        <textarea
                            id="keperluan"
                            name="keperluan"
                            rows="3"
                            required
                            placeholder="Contoh: Kebutuhan melamar pekerjaan, pembukaan rekening bank, dsb..."
                            class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2.5 px-3.5 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">{{ old('keperluan') }}</textarea>

                        @error('keperluan')
                        <p class="text-[12px] text-adm-rose-fg mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Dokumen --}}
                    <div class="pt-6 border-t border-adm-border">
                        <h2 class="font-display text-[22px] text-adm-text-main font-semibold mb-6">
                            Dokumen Persyaratan
                        </h2>

                        @php
                            $fileInputClasses = "block w-full text-[13px] text-adm-text-body file:mr-4 file:py-2 file:px-4 file:rounded-[6px] file:border-0 file:text-[13px] file:font-semibold file:bg-adm-primary-soft file:text-adm-primary hover:file:bg-adm-primary hover:file:text-white file:transition-colors border border-adm-border bg-adm-input rounded-[8px] cursor-pointer";
                        @endphp

                        {{-- KTP --}}
                        <div class="mb-6">
                            <label for="ktp" class="block text-[13px] font-medium text-adm-text-main mb-2">
                                Foto / Scan KTP <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input
                                id="ktp"
                                type="file"
                                name="ktp"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                                class="{{ $fileInputClasses }}">
                            <p class="text-[11px] text-adm-text-muted mt-2">
                                Format: JPG, JPEG, PNG, atau PDF. Maksimal berkas: 2 MB.
                            </p>
                            @error('ktp')
                            <p class="text-[12px] text-adm-rose-fg mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- KK --}}
                        <div class="mb-6">
                            <label for="kk" class="block text-[13px] font-medium text-adm-text-main mb-2">
                                Foto / Scan Kartu Keluarga (KK) <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input
                                id="kk"
                                type="file"
                                name="kk"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                                class="{{ $fileInputClasses }}">
                            <p class="text-[11px] text-adm-text-muted mt-2">
                                Format: JPG, JPEG, PNG, atau PDF. Maksimal berkas: 2 MB.
                            </p>
                            @error('kk')
                            <p class="text-[12px] text-adm-rose-fg mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Surat RT/RW --}}
                        <div>
                            <label for="surat_rt_rw" class="block text-[13px] font-medium text-adm-text-main mb-2">
                                Foto / Scan Surat Pengantar RT/RW <span class="text-adm-text-muted">(Opsional)</span>
                            </label>
                            <input
                                id="surat_rt_rw"
                                type="file"
                                name="surat_rt_rw"
                                accept=".jpg,.jpeg,.png,.pdf"
                                class="{{ $fileInputClasses }}">
                            <p class="text-[11px] text-adm-text-muted mt-2">
                                Diunggah jika diwajibkan oleh RT/RW setempat. Format: JPG, JPEG, PNG, atau PDF. Maksimal 2 MB.
                            </p>
                            @error('surat_rt_rw')
                            <p class="text-[12px] text-adm-rose-fg mt-2">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                    </div>

                </div>

                {{-- Footer Buttons --}}
                <div class="px-8 py-6 bg-adm-canvas border-t border-adm-border flex items-center justify-between gap-4">
                    <a href="{{ route('layanan.domisili') }}" class="inline-flex items-center justify-center bg-white border border-adm-border text-adm-text-main hover:bg-adm-canvas px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-sm">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                        Ajukan Permohonan
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection