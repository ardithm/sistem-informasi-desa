@extends('layouts.public')

@section('title', 'Cek Status Pengajuan')

@section('content')

<div class="py-24">

    <div class="max-w-xl mx-auto px-6">

        <div class="reveal bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] overflow-hidden">

            <div class="p-8 md:p-12">

                <h1 class="font-display text-[28px] md:text-[32px] leading-tight text-adm-text-main font-semibold">
                    Cek Status Pengajuan
                </h1>

                <p class="font-sans font-light text-[14px] text-adm-text-body mt-2 mb-8">
                    Masukkan nomor pengajuan untuk melihat status perkembangan surat administrasi Anda secara real-time.
                </p>

                {{-- Pesan error --}}
                @if (session('error'))
                <div class="mb-6 p-4 bg-adm-rose-bg border border-adm-rose-fg/20 rounded-[12px]">
                    <p class="text-[13px] font-semibold text-adm-rose-fg">
                        {{ session('error') }}
                    </p>
                </div>
                @endif

                <form action="{{ route('status.cek') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="nomor_pengajuan" class="block text-[13px] font-medium text-adm-text-main mb-2">
                            Nomor Pengajuan
                        </label>
                        <input
                            type="text"
                            name="nomor_pengajuan"
                            id="nomor_pengajuan"
                            value="{{ old('nomor_pengajuan') }}"
                            placeholder="Contoh: SKD-20260829113005-GMUR"
                            class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2.5 px-3.5 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary"
                            required>

                        @error('nomor_pengajuan')
                        <p class="mt-2 text-[12px] text-adm-rose-fg">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center gap-1.5 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md">
                        Cek Status Pengajuan
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection