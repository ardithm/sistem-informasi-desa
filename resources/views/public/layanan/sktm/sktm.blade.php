@extends('layouts.public')

@section('title', 'Surat Keterangan Tidak Mampu')

@section('content')

<div class="py-24">

    <div class="max-w-xl mx-auto px-6">

        {{-- Error --}}
        @if (isset($errors) && $errors->any())
        <div class="mb-6 bg-adm-rose-bg border border-adm-rose-fg/20 text-adm-rose-fg px-5 py-4 rounded-[12px]">
            <p class="font-semibold text-[14px] mb-2">
                Periksa kembali data:
            </p>
            <ul class="list-disc list-inside text-[13px] space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Session Error --}}
        @if (session('error'))
        <div class="mb-6 bg-adm-rose-bg border border-adm-rose-fg/20 text-adm-rose-fg px-5 py-4 rounded-[12px]">
            {{ session('error') }}
        </div>
        @endif

        {{-- Card --}}
        <div class="bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] overflow-hidden">

            <div class="p-8 md:p-12">

                {{-- Judul --}}
                <div class="mb-8">
                    <p class="font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase">
                        SURAT KETERANGAN TIDAK MAMPU
                    </p>
                    <h1 class="font-display text-[28px] md:text-[32px] leading-tight text-adm-text-main font-semibold mt-2">
                        Verifikasi Data Penduduk
                    </h1>
                </div>

                {{-- Informasi --}}
                <div class="mb-8 p-5 bg-adm-primary-soft border border-adm-primary/10 rounded-[16px]">
                    <p class="font-sans font-light text-[14px] leading-relaxed text-adm-text-body">
                        Silakan masukkan NIK dan nomor handphone Anda untuk memverifikasi data penduduk sebelum melanjutkan pengisian formulir surat.
                    </p>
                </div>

                {{-- Form --}}
                <form action="{{ route('layanan.sktm.verifikasi') }}" method="POST">
                    @csrf

                    {{-- NIK --}}
                    <div class="mb-6">
                        <label for="nik" class="block text-[13px] font-medium text-adm-text-main mb-2">
                            NIK (Nomor Induk Kependudukan) <span class="text-adm-rose-fg">*</span>
                        </label>
                        <input
                            id="nik"
                            type="text"
                            name="nik"
                            value="{{ old('nik') }}"
                            inputmode="numeric"
                            maxlength="16"
                            required
                            autofocus
                            placeholder="Masukkan 16 digit NIK Anda"
                            class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2.5 px-3.5 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">

                        @error('nik')
                        <p class="text-[12px] text-adm-rose-fg mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Nomor HP --}}
                    <div class="mb-8">
                        <label for="no_hp" class="block text-[13px] font-medium text-adm-text-main mb-2">
                            Nomor WhatsApp <span class="text-adm-rose-fg">*</span>
                        </label>
                        <input
                            id="no_hp"
                            type="tel"
                            name="no_hp"
                            value="{{ old('no_hp') }}"
                            maxlength="20"
                            required
                            placeholder="Contoh: 081234567890"
                            class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2.5 px-3.5 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">

                        <p class="text-[11px] text-adm-text-muted mt-2">
                            Nomor aktif yang dapat dihubungi untuk konfirmasi pengajuan surat Anda.
                        </p>

                        @error('no_hp')
                        <p class="text-[12px] text-adm-rose-fg mt-2">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex items-center justify-between gap-4 pt-6 border-t border-adm-border">
                        <a href="{{ route('layanan') }}" class="inline-flex items-center justify-center bg-white border border-adm-border text-adm-text-main hover:bg-adm-canvas px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-sm">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                            Lanjut Pengajuan
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection