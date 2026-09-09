<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-[22px] font-bold leading-tight text-adm-text-main">
                    Tambah Akun Baru
                </h2>
                <p class="text-[13px] text-adm-text-muted mt-0.5">
                    Buat akun administrator baru untuk membantu pengelolaan pelayanan desa.
                </p>
            </div>
            <div>
                <a href="{{ route('admin.users.index') }}"
                   class="inline-flex items-center gap-1.5 h-[38px] rounded-[8px] bg-white border border-adm-border px-4 text-[13px] font-medium text-adm-text-body transition hover:bg-slate-50 shadow-sm">
                    &larr; Kembali ke Daftar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl">
        {{-- Card Form --}}
        <div class="rounded-[12px] border border-adm-border bg-white shadow-sm overflow-hidden">
            <div class="border-b border-adm-border px-6 py-4 bg-adm-canvas/30">
                <h3 class="text-[15px] font-semibold text-adm-text-main">
                    Informasi Akun Administrator
                </h3>
                <p class="text-[12px] text-adm-text-muted mt-0.5">
                    Pastikan informasi akun dan kredensial login diisi dengan benar dan aman.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.users.store') }}" class="p-6 space-y-5">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label for="name" class="block text-[12px] font-semibold uppercase tracking-wider text-adm-text-muted mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh: Siti Nurhaliza"
                           class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input px-3.5 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary @error('name') border-red-400 @enderror">
                    @error('name')
                        <p class="mt-1 text-[12px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label for="username" class="block text-[12px] font-semibold uppercase tracking-wider text-adm-text-muted mb-1.5">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-adm-text-muted text-[13px]">
                            &#64;
                        </div>
                        <input type="text" name="username" id="username" value="{{ old('username') }}" required placeholder="admin_layanan"
                               class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input pl-8 pr-3.5 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary @error('username') border-red-400 @enderror">
                    </div>
                    <p class="mt-1 text-[11px] text-adm-text-muted">Gunakan huruf kecil, angka, atau underscore tanpa spasi.</p>
                    @error('username')
                        <p class="mt-1 text-[12px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role Selection --}}
                <div>
                    <label class="block text-[12px] font-semibold uppercase tracking-wider text-adm-text-muted mb-2">
                        Pilih Peran (Role) <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        {{-- Admin Biasa --}}
                        <label class="relative flex cursor-pointer rounded-[10px] border border-adm-border p-4 hover:border-adm-primary/50 transition focus:outline-none">
                            <input type="radio" name="role" value="admin" class="mt-0.5 h-4 w-4 text-adm-primary focus:ring-adm-primary border-adm-border"
                                   {{ old('role', 'admin') === 'admin' ? 'checked' : '' }}>
                            <div class="ml-3 flex flex-col">
                                <span class="block text-[13px] font-semibold text-adm-text-main">
                                    Administrator
                                </span>
                                <span class="block text-[12px] text-adm-text-muted mt-0.5">
                                    Dapat mengelola pengajuan, data kependudukan, layanan, berita, dan laporan.
                                </span>
                            </div>
                        </label>

                        {{-- Super Admin --}}
                        <label class="relative flex cursor-pointer rounded-[10px] border border-adm-border p-4 hover:border-purple-400 transition focus:outline-none">
                            <input type="radio" name="role" value="super_admin" class="mt-0.5 h-4 w-4 text-purple-600 focus:ring-purple-500 border-adm-border"
                                   {{ old('role') === 'super_admin' ? 'checked' : '' }}>
                            <div class="ml-3 flex flex-col">
                                <span class="block text-[13px] font-semibold text-purple-700 flex items-center gap-1.5">
                                    Super Administrator
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-purple-100 text-purple-700">Penuh</span>
                                </span>
                                <span class="block text-[12px] text-adm-text-muted mt-0.5">
                                    Akses seluruh sistem dan hak eksklusif mengelola akun admin lain.
                                </span>
                            </div>
                        </label>
                    </div>
                    @error('role')
                        <p class="mt-1 text-[12px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Grid Password & Konfirmasi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-[12px] font-semibold uppercase tracking-wider text-adm-text-muted mb-1.5">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" id="password" required placeholder="Minimal 6 karakter"
                               class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input px-3.5 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary @error('password') border-red-400 @enderror">
                        @error('password')
                            <p class="mt-1 text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-[12px] font-semibold uppercase tracking-wider text-adm-text-muted mb-1.5">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password"
                               class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input px-3.5 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                    </div>
                </div>

                {{-- Status Aktif --}}
                <div class="pt-2">
                    <label class="inline-flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked
                               class="h-4 w-4 rounded border-adm-border text-adm-primary focus:ring-adm-primary">
                        <span class="text-[13px] font-medium text-adm-text-main">
                            Aktifkan akun ini segera setelah dibuat
                        </span>
                    </label>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-adm-border">
                    <a href="{{ route('admin.users.index') }}"
                       class="inline-flex items-center justify-center h-[38px] rounded-[8px] bg-white border border-adm-border px-4 text-[13px] font-medium text-adm-text-body transition hover:bg-slate-50 shadow-sm">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center h-[38px] rounded-[8px] bg-adm-primary px-5 text-[13px] font-medium text-white transition hover:bg-adm-primary-hover shadow-sm border border-transparent">
                        Simpan Akun Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
