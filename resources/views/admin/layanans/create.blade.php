<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.layanans.index') }}" class="rounded-full p-2 text-adm-text-muted hover:bg-slate-100 hover:text-adm-text-main transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Layanan</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">
                    Tambah Layanan Baru
                </h1>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        @if ($errors->any())
        <div class="rounded-[12px] border border-adm-rose-fg/20 bg-adm-rose-bg px-4 py-3 shadow-sm">
            <ul class="list-disc list-inside text-[13px] text-adm-rose-fg">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <form method="POST" action="{{ route('admin.layanans.store') }}">
            @csrf

            <div class="max-w-4xl rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="border-b border-adm-border bg-adm-card px-6 py-4">
                    <h3 class="text-[15px] font-semibold text-adm-text-main">Formulir Data Layanan</h3>
                </div>
                
                <div class="p-6 sm:p-8 space-y-6">
                    
                    {{-- Kode & Status --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Kode Layanan <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input type="text" name="kode" value="{{ old('kode') }}" maxlength="20" required placeholder="Contoh: SKD"
                                   class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary uppercase">
                            @error('kode')
                            <p class="text-[12px] text-adm-rose-fg mt-1.5">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-[11px] text-adm-text-muted">Kode unik untuk layanan. Direkomendasikan menggunakan singkatan kapital.</p>
                        </div>
                        
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Status <span class="text-adm-rose-fg">*</span>
                            </label>
                            <select name="aktif" required
                                    class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                                <option value="1" @selected(old('aktif') == 1)>Aktif (Ditampilkan ke publik)</option>
                                <option value="0" @selected(old('aktif') != null && old('aktif') == 0)>Tidak Aktif (Disembunyikan)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div>
                        <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                            Nama Layanan <span class="text-adm-rose-fg">*</span>
                        </label>
                        <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}" maxlength="150" required placeholder="Contoh: Surat Keterangan Domisili"
                               class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">
                        @error('nama_layanan')
                        <p class="text-[12px] text-adm-rose-fg mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" rows="4" placeholder="Jelaskan secara singkat mengenai layanan ini..."
                                  class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <p class="text-[12px] text-adm-rose-fg mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="border-t border-adm-border bg-slate-50 px-6 py-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.layanans.index') }}" class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-primary px-4 py-2 text-[13px] font-semibold text-white transition hover:bg-adm-primary-hover shadow-sm">
                        Simpan Data
                    </button>
                </div>
            </div>

        </form>
    </div>

</x-app-layout>