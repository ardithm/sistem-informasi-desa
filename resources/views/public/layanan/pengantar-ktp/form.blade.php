@extends('layouts.public')

@section('title', 'Pengajuan Surat Pengantar KTP')

@section('content')

<div class="py-24">

    <div class="max-w-3xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-12">
            <p class="font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase">
                FORMULIR LAYANAN
            </p>
            <h1 class="font-display text-4xl md:text-5xl lg:text-[48px] leading-none text-adm-text-main tracking-tight mt-4">
                Pengajuan Surat Pengantar KTP
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

                    {{-- Alamat KTP --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-1 sm:gap-4">
                        <div class="text-[13px] font-medium text-adm-text-muted">Alamat Sesuai KTP</div>
                        <div class="sm:col-span-2 text-[13px] font-medium text-adm-text-main leading-relaxed">
                            {{ $penduduk->alamat }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Form Pengajuan --}}
        <div class="bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] overflow-hidden">

            <form action="{{ route('layanan.pengantar-ktp.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="nik" value="{{ $penduduk->nik }}">
                <input type="hidden" name="penduduk_id" value="{{ $penduduk->id }}">
                <input type="hidden" name="layanan_id" value="{{ $layanan->id }}">
                <input type="hidden" name="no_hp" value="{{ $no_hp }}">

                <div class="p-8 space-y-6">

                    {{-- Nomor HP --}}
                    <div>
                        <label for="no_hp_display" class="block text-[13px] font-medium text-adm-text-main mb-2">
                            Nomor WhatsApp
                        </label>
                        <input
                            id="no_hp_display"
                            type="tel"
                            value="{{ $no_hp }}"
                            readonly
                            class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2.5 px-3.5 text-[13px] text-adm-text-muted select-none cursor-not-allowed">
                    </div>

                    {{-- Keperluan KTP --}}
                    <div>
                        <label for="keperluan_ktp" class="block text-[13px] font-medium text-adm-text-main mb-2">
                            Keperluan Pembuatan KTP <span class="text-adm-rose-fg">*</span>
                        </label>
                        <select
                            id="keperluan_ktp"
                            name="keperluan_ktp"
                            required
                            class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2.5 px-3.5 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                            <option value="">-- Pilih Keperluan --</option>
                            <option value="pembuatan_baru" {{ old('keperluan_ktp') === 'pembuatan_baru' ? 'selected' : '' }}>Pembuatan Baru</option>
                            <option value="hilang" {{ old('keperluan_ktp') === 'hilang' ? 'selected' : '' }}>Hilang</option>
                            <option value="rusak" {{ old('keperluan_ktp') === 'rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="perubahan_data" {{ old('keperluan_ktp') === 'perubahan_data' ? 'selected' : '' }}>Perubahan Data</option>
                        </select>

                        @error('keperluan_ktp')
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
                                Foto / Scan KTP (KTP lama / Surat Keterangan / Laporan Kehilangan jika hilang) <span class="text-adm-rose-fg">*</span>
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
                    <a href="{{ route('layanan.pengantar-ktp') }}" class="inline-flex items-center justify-center bg-white border border-adm-border text-adm-text-main hover:bg-adm-canvas px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-sm">
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