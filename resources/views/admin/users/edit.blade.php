<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-[22px] font-bold leading-tight text-adm-text-main">
                    Edit Akun Admin
                </h2>
                <p class="text-[13px] text-adm-text-muted mt-0.5">
                    Perbarui profil atau atur ulang password akun administrator: <strong class="text-adm-text-main">{{ $user->name }}</strong>
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
                    Edit Informasi Akun
                </h3>
                <p class="text-[12px] text-adm-text-muted mt-0.5">
                    Ubah data akun di bawah ini. Kosongkan kolom password jika Anda tidak berniat mengganti password.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                {{-- Nama Lengkap --}}
                <div>
                    <label for="name" class="block text-[12px] font-semibold uppercase tracking-wider text-adm-text-muted mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required placeholder="Contoh: Siti Nurhaliza"
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
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required placeholder="admin_layanan"
                               class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input pl-8 pr-3.5 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary @error('username') border-red-400 @enderror">
                    </div>
                    <p class="mt-1 text-[11px] text-adm-text-muted">Gunakan huruf kecil, angka, atau garis bawah tanpa spasi.</p>
                    @error('username')
                        <p class="mt-1 text-[12px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Peran / Role (Info) --}}
                <div>
                    <label class="block text-[12px] font-semibold uppercase tracking-wider text-adm-text-muted mb-1.5">
                        Peran Akun
                    </label>
                    <div class="flex items-center gap-3 rounded-[8px] border border-adm-border bg-slate-50 p-3">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[12px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Administrator
                        </span>
                        <span class="text-[12px] text-adm-text-muted">
                            Akun ini berstatus sebagai Administrator operasional desa.
                        </span>
                    </div>
                </div>

                {{-- Ubah Password (Opsional) --}}
                <div class="rounded-[10px] border border-dashed border-adm-border p-4 bg-adm-canvas/40 space-y-4">
                    <div>
                        <h4 class="text-[13px] font-semibold text-adm-text-main">Atur Ulang Password (Opsional)</h4>
                        <p class="text-[11px] text-adm-text-muted">Biarkan kosong jika Anda tidak ingin mengganti password akun ini.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Password Baru --}}
                        <div>
                            <label for="password" class="block text-[12px] font-semibold uppercase tracking-wider text-adm-text-muted mb-1.5">
                                Password Baru
                            </label>
                            <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak diubah"
                                   class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input px-3.5 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary @error('password') border-red-400 @enderror">
                            @error('password')
                                <p class="mt-1 text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password Baru --}}
                        <div>
                            <label for="password_confirmation" class="block text-[12px] font-semibold uppercase tracking-wider text-adm-text-muted mb-1.5">
                                Konfirmasi Password Baru
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password baru"
                                   class="block w-full h-[38px] rounded-[8px] border border-adm-border bg-adm-input px-3.5 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                        </div>
                    </div>
                </div>

                {{-- Status Aktif --}}
                <div class="pt-1">
                    <label class="inline-flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 rounded border-adm-border text-adm-primary focus:ring-adm-primary">
                        <span class="text-[13px] font-medium text-adm-text-main">
                            Status Akun Aktif (Dapat Login ke Sistem)
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
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
