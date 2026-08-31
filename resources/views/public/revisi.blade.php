@extends('layouts.public')

@section('title', 'Upload Ulang Dokumen')

@section('content')

<div class="py-24">

    <div class="max-w-xl mx-auto px-6">

        <div class="bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] overflow-hidden">

            <div class="p-8 md:p-12">

                <h1 class="font-display text-[28px] md:text-[32px] leading-tight text-adm-text-main font-semibold">
                    Unggah Ulang Dokumen
                </h1>

                <p class="font-sans font-light text-[14px] text-adm-text-body mt-2">
                    Silakan unggah berkas dokumen baru untuk menggantikan berkas yang ditolak/perlu diperbaiki.
                </p>

                {{-- Informasi Dokumen --}}
                <div class="mt-6 p-5 bg-adm-canvas border border-adm-border rounded-[16px]">

                    <p class="text-[11px] font-mono tracking-widest text-adm-text-muted uppercase mb-1">
                        Jenis Dokumen
                    </p>

                    <p class="font-sans text-[16px] font-bold text-adm-text-main">
                        {{ $dokumen->jenis_dokumen }}
                    </p>

                    @if ($dokumen->catatan)
                    <div class="mt-4 p-4 bg-adm-rose-bg border border-adm-rose-fg/10 rounded-[12px]">
                        <p class="text-[11px] font-semibold uppercase tracking-wider text-adm-rose-fg">
                            Catatan Koreksi Admin:
                        </p>
                        <p class="text-[13px] text-adm-rose-fg mt-1">
                            {{ $dokumen->catatan }}
                        </p>
                    </div>
                    @endif

                </div>

                {{-- Error Validasi --}}
                @if ($errors->any())
                <div class="mt-5 p-4 bg-adm-rose-bg border border-adm-rose-fg/20 rounded-[12px] text-adm-rose-fg">
                    <ul class="text-[13px] list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Form Upload --}}
                <form action="{{ route('status.revisi.store', [$pengajuan->id, $dokumen->id]) }}" method="POST" enctype="multipart/form-data" class="mt-8">
                    @csrf

                    <div class="mb-6">
                        <label for="dokumen" class="block text-[13px] font-medium text-adm-text-main mb-2">
                            Pilih Berkas Baru <span class="text-adm-rose-fg">*</span>
                        </label>
                        <input
                            type="file"
                            name="dokumen"
                            id="dokumen"
                            accept=".jpg,.jpeg,.png,.pdf"
                            required
                            class="block w-full text-[13px] text-adm-text-body file:mr-4 file:py-2 file:px-4 file:rounded-[6px] file:border-0 file:text-[13px] file:font-semibold file:bg-adm-primary-soft file:text-adm-primary hover:file:bg-adm-primary hover:file:text-white file:transition-colors border border-adm-border bg-adm-input rounded-[8px] cursor-pointer">

                        <p class="text-[11px] text-adm-text-muted mt-2">
                            Format berkas yang diperbolehkan: JPG, JPEG, PNG, atau PDF. Maksimal 2 MB.
                        </p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-adm-border flex items-center justify-between gap-4">
                        <a href="{{ route('status.hasil', $pengajuan->id) }}" class="inline-flex items-center justify-center bg-white border border-adm-border text-adm-text-main hover:bg-adm-canvas px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-sm">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                            Kirim Berkas Baru
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection