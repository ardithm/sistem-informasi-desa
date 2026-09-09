<x-guest-layout>
    <x-slot:title>Lupa Kata Sandi — Desa Kita</x-slot:title>

    <div class="min-h-screen bg-adm-canvas flex flex-col justify-center items-center py-12 px-6 relative overflow-hidden">

        {{-- Ambient radial background glow --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-adm-primary/5 rounded-full blur-[130px] pointer-events-none"></div>
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-cyan-signal/5 rounded-full blur-[100px] pointer-events-none"></div>

        {{-- Brand Header (Logo Desa Kita Sesuai Halaman Masyarakat) --}}
        <div class="mb-8 text-center relative z-10">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3.5 group">
                <div class="w-12 h-12 bg-adm-primary text-white rounded-full flex items-center justify-center font-display text-2xl shadow-lg shadow-adm-primary/25 transition-transform group-hover:scale-105">
                    D
                </div>
                <div class="text-left">
                    <div class="font-bold text-adm-text-main text-xl tracking-wide">
                        Desa Kita
                    </div>
                    <div class="text-[11px] uppercase font-mono tracking-widest text-adm-text-muted">
                        Kecamatan • Kabupaten
                    </div>
                </div>
            </a>
        </div>

        {{-- Card Container (Style Halaman Masyarakat, Tanpa Header & Footer) --}}
        <div class="w-full max-w-md bg-adm-card border border-adm-border shadow-[0_8px_40px_rgba(29,114,254,0.06)] rounded-[24px] md:rounded-[32px] p-8 md:p-10 relative z-10 overflow-hidden">
            
            {{-- Card Header --}}
            <div class="text-center mb-8">
                <div class="w-14 h-14 rounded-full bg-adm-primary-soft text-adm-primary flex items-center justify-center mx-auto mb-4 shadow-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <p class="font-mono text-[11px] font-medium tracking-widest text-adm-primary uppercase mb-1">
                    PEMULIHAN KATA SANDI
                </p>
                <h1 class="font-display text-3xl md:text-[32px] leading-tight text-adm-text-main font-bold">
                    Atur Ulang Kata Sandi
                </h1>
                <p class="font-sans font-light text-[13px] text-adm-text-body mt-2 leading-relaxed">
                    Verifikasi username dan nama lengkap terdaftar Anda untuk membuat kata sandi baru.
                </p>
            </div>

            {{-- Status Alert --}}
            @if (session('status'))
            <div class="mb-6 p-4 bg-adm-primary-soft border border-adm-primary/20 rounded-[12px] text-[13px] font-medium text-adm-primary">
                {{ session('status') }}
            </div>
            @endif

            {{-- Global Validation Error --}}
            @if ($errors->any())
            <div class="mb-6 p-4 bg-adm-rose-bg border border-adm-rose-fg/20 rounded-[12px]">
                <div class="flex items-center gap-2 text-[13px] font-semibold text-adm-rose-fg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Gagal Memproses Pemulihan</span>
                </div>
                <p class="text-[12px] mt-1 text-adm-rose-fg/90">
                    {{ $errors->first() }}
                </p>
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                {{-- Username Input --}}
                <div>
                    <label for="username" class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                        Username Akun
                    </label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                            <svg class="h-4 w-4 text-adm-text-muted" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text"
                               id="username"
                               name="username"
                               value="{{ old('username') }}"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="Contoh: admin"
                               class="block w-full rounded-[8px] border border-adm-border bg-adm-input py-2.5 pl-10 pr-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary transition"
                        >
                    </div>
                </div>

                {{-- Nama Lengkap Input (Verifikasi Identitas) --}}
                <div>
                    <label for="name" class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                        Nama Lengkap Terdaftar
                    </label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                            <svg class="h-4 w-4 text-adm-text-muted" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>
                        </div>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               placeholder="Nama lengkap sesuai akun..."
                               class="block w-full rounded-[8px] border border-adm-border bg-adm-input py-2.5 pl-10 pr-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary transition"
                        >
                    </div>
                    <p class="mt-1 text-[11px] text-adm-text-muted">Digunakan untuk memastikan Anda adalah pemilik sah akun.</p>
                </div>

                {{-- Password Baru with Alpine Show/Hide --}}
                <div x-data="{ showPassword: false }">
                    <label for="password" class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                        Kata Sandi Baru
                    </label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                            <svg class="h-4 w-4 text-adm-text-muted" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input :type="showPassword ? 'text' : 'password'"
                               id="password"
                               name="password"
                               required
                               autocomplete="new-password"
                               placeholder="Minimal 6 karakter..."
                               class="block w-full rounded-[8px] border border-adm-border bg-adm-input py-2.5 pl-10 pr-10 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary transition"
                        >
                        <button type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-adm-text-muted hover:text-adm-text-main transition focus:outline-none"
                                tabindex="-1"
                        >
                            <svg x-show="!showPassword" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" x-cloak class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Konfirmasi Password Baru --}}
                <div>
                    <label for="password_confirmation" class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                        Konfirmasi Kata Sandi Baru
                    </label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                            <svg class="h-4 w-4 text-adm-text-muted" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                               placeholder="Ulangi kata sandi baru..."
                               class="block w-full rounded-[8px] border border-adm-border bg-adm-input py-2.5 pl-10 pr-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary transition"
                        >
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-adm-primary text-white hover:bg-adm-primary-hover px-6 py-3 rounded-[8px] text-[14px] font-semibold transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0"
                    >
                        <span>Simpan Kata Sandi Baru</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 13l4 4L19 7" />
                        </svg>
                    </button>
                </div>
            </form>

            {{-- Callout Bantuan Super Admin --}}
            <div class="mt-6 p-4 rounded-[12px] bg-adm-canvas border border-adm-border/80 text-[12px] text-adm-text-muted leading-relaxed">
                <div class="flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-adm-primary shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <strong class="text-adm-text-main">Lupa Data Akun?</strong>
                        <p class="mt-0.5">
                            Jika Anda lupa nama lengkap atau akun dinonaktifkan, hubungi <strong>Super Administrator</strong> kantor desa untuk mereset akun Anda secara langsung melalui menu <em>Kelola Akun</em>.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Back Link to Login --}}
            <div class="mt-6 pt-5 border-t border-adm-border text-center">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-[13px] font-medium text-adm-text-muted hover:text-adm-primary transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Halaman Masuk</span>
                </a>
            </div>

        </div>

        {{-- Bottom Copyright Note --}}
        <p class="text-center text-[12px] text-adm-text-muted mt-8 relative z-10">
            &copy; {{ date('Y') }} Pemerintah Desa Kita • Akses Resmi Petugas
        </p>

    </div>
</x-guest-layout>
