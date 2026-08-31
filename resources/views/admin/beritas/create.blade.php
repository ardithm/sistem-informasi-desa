<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.beritas.index') }}" class="rounded-full p-2 text-adm-text-muted hover:bg-slate-100 hover:text-adm-text-main transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Berita</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">
                    Tambah Berita Baru
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


        <form method="POST" action="{{ route('admin.beritas.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="max-w-4xl rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="border-b border-adm-border bg-adm-card px-6 py-4">
                    <h3 class="text-[15px] font-semibold text-adm-text-main">Formulir Data Berita</h3>
                </div>
                
                <div class="p-6 sm:p-8 space-y-6">
                    
                    {{-- Judul --}}
                    <div>
                        <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                            Judul Berita <span class="text-adm-rose-fg">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}" maxlength="200" required autofocus placeholder="Contoh: Gotong Royong Membersihkan Lingkungan Desa"
                               class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">
                        @error('judul')
                        <p class="text-[12px] text-adm-rose-fg mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status & Gambar --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Status Publikasi <span class="text-adm-rose-fg">*</span>
                            </label>
                            <select name="status" required
                                    class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                                <option value="draft" @selected(old('status') === 'draft')>Draft (Simpan Sementara)</option>
                                <option value="published" @selected(old('status') === 'published')>Published (Terbitkan ke Publik)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Gambar Thumbnail
                            </label>
                            <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp"
                                   class="block w-full text-[13px] text-adm-text-main file:mr-4 file:py-2 file:px-4 file:rounded-[8px] file:border-0 file:text-[12px] file:font-medium file:bg-adm-canvas file:text-adm-text-main file:border file:border-adm-border hover:file:bg-slate-50 cursor-pointer border border-adm-border rounded-[8px] bg-adm-input">
                            <p class="text-[11px] text-adm-text-muted mt-1.5">
                                Format: JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                            </p>
                            @error('gambar')
                            <p class="text-[12px] text-adm-rose-fg mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Isi Berita --}}
                    <div>
                        <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                            Konten Berita <span class="text-adm-rose-fg">*</span>
                        </label>
                        <textarea name="isi" rows="12" required placeholder="Tulis konten lengkap berita di sini..."
                                  class="block w-full rounded-[8px] border-adm-border bg-adm-input py-3 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">{{ old('isi') }}</textarea>
                        @error('isi')
                        <p class="text-[12px] text-adm-rose-fg mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="border-t border-adm-border bg-slate-50 px-6 py-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.beritas.index') }}" class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-primary px-4 py-2 text-[13px] font-semibold text-white transition hover:bg-adm-primary-hover shadow-sm">
                        Simpan Berita
                    </button>
                </div>
            </div>

        </form>
    </div>

</x-app-layout>