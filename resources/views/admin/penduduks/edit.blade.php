<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.penduduks.index') }}" class="rounded-full p-2 text-adm-text-muted hover:bg-slate-100 hover:text-adm-text-main transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <p class="text-[11px] font-semibold uppercase tracking-widest text-adm-primary">Kelola Penduduk</p>
                <h1 class="mt-0.5 text-[22px] font-bold leading-tight text-adm-text-main">
                    Edit Penduduk
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


        <form method="POST" action="{{ route('admin.penduduks.update', $penduduk) }}">
            @csrf
            @method('PUT')

            <div class="rounded-[12px] border border-adm-border bg-adm-card shadow-[0_1px_3px_0_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="border-b border-adm-border bg-adm-card px-6 py-4 flex items-center justify-between">
                    <h3 class="text-[15px] font-semibold text-adm-text-main">Formulir Data Penduduk</h3>
                    
                    @if ($penduduk->status_penduduk === 'aktif')
                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold bg-adm-green-bg text-adm-green-fg">
                        Status Aktif
                    </span>
                    @else
                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold bg-gray-100 text-gray-600">
                        Tidak Aktif
                    </span>
                    @endif
                </div>
                
                <div class="p-6 sm:p-8">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        {{-- NIK --}}
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                NIK <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input type="text" name="nik" value="{{ old('nik', $penduduk->nik) }}" maxlength="16" required
                                   class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">
                            @error('nik')
                            <p class="text-[12px] text-adm-rose-fg mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status Penduduk --}}
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Status Penduduk <span class="text-adm-rose-fg">*</span>
                            </label>
                            <select name="status_penduduk" required
                                    class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                                <option value="aktif" @selected(old('status_penduduk', $penduduk->status_penduduk) === 'aktif')>Aktif</option>
                                <option value="tidak_aktif" @selected(old('status_penduduk', $penduduk->status_penduduk) === 'tidak_aktif')>Tidak Aktif</option>
                            </select>
                        </div>

                        {{-- Nama --}}
                        <div class="md:col-span-2">
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Nama Lengkap <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $penduduk->nama_lengkap) }}" required
                                   class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">
                            @error('nama_lengkap')
                            <p class="text-[12px] text-adm-rose-fg mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tempat Lahir --}}
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Tempat Lahir <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" required
                                   class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">
                        </div>


                        {{-- Tanggal Lahir --}}
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Tanggal Lahir <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir->format('Y-m-d')) }}" required
                                   class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                        </div>


                        {{-- Jenis Kelamin --}}
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Jenis Kelamin <span class="text-adm-rose-fg">*</span>
                            </label>
                            <select name="jenis_kelamin" required
                                    class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                                <option value="L" @selected(old('jenis_kelamin', $penduduk->jenis_kelamin) === 'L')>Laki-laki</option>
                                <option value="P" @selected(old('jenis_kelamin', $penduduk->jenis_kelamin) === 'P')>Perempuan</option>
                            </select>
                        </div>


                        {{-- Status Perkawinan --}}
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Status Perkawinan <span class="text-adm-rose-fg">*</span>
                            </label>
                            <select name="status_perkawinan" required
                                    class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                                @foreach ([
                                'belum_kawin' => 'Belum Kawin',
                                'kawin' => 'Kawin',
                                'cerai_hidup' => 'Cerai Hidup',
                                'cerai_mati' => 'Cerai Mati'
                                ] as $value => $label)
                                <option value="{{ $value }}" @selected(old('status_perkawinan', $penduduk->status_perkawinan) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>


                        {{-- Pekerjaan --}}
                        <div class="md:col-span-2">
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Pekerjaan <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}" required
                                   class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">
                        </div>


                        {{-- Alamat Lengkap --}}
                        <div class="md:col-span-2">
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                Alamat Lengkap <span class="text-adm-rose-fg">*</span>
                            </label>
                            <textarea name="alamat" rows="3" required
                                      class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main placeholder:text-gray-400 focus:border-adm-primary focus:ring-adm-primary">{{ old('alamat', $penduduk->alamat) }}</textarea>
                        </div>


                        {{-- RT dan RW --}}
                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                RT <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input type="number" name="rt" value="{{ old('rt', $penduduk->rt) }}" required min="1"
                                   class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                        </div>

                        <div>
                            <label class="block text-[13px] font-medium text-adm-text-main mb-1.5">
                                RW <span class="text-adm-rose-fg">*</span>
                            </label>
                            <input type="number" name="rw" value="{{ old('rw', $penduduk->rw) }}" required min="1"
                                   class="block w-full rounded-[8px] border-adm-border bg-adm-input py-2 px-3 text-[13px] text-adm-text-main focus:border-adm-primary focus:ring-adm-primary">
                        </div>

                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="border-t border-adm-border bg-slate-50 px-6 py-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.penduduks.show', $penduduk) }}" class="inline-flex items-center gap-1.5 rounded-[8px] bg-white border border-adm-border px-4 py-2 text-[13px] font-medium text-adm-text-main transition hover:bg-slate-50 shadow-sm">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-[8px] bg-adm-primary px-4 py-2 text-[13px] font-semibold text-white transition hover:bg-adm-primary-hover shadow-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </div>

        </form>
    </div>

</x-app-layout>