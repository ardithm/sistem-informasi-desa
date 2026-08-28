<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Penduduk
        </h2>
    </x-slot>


    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                @if ($errors->any())

                <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-md">

                    <ul class="list-disc list-inside text-sm">

                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('admin.penduduks.store') }}">

                    @csrf


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- NIK --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                NIK
                            </label>

                            <input
                                type="text"
                                name="nik"
                                value="{{ old('nik') }}"
                                maxlength="16"
                                required
                                class="w-full border-gray-300 rounded-md">

                            @error('nik')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>


                        {{-- Nama --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="nama_lengkap"
                                value="{{ old('nama_lengkap') }}"
                                required
                                class="w-full border-gray-300 rounded-md">

                            @error('nama_lengkap')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>


                        {{-- Tempat Lahir --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Tempat Lahir
                            </label>

                            <input
                                type="text"
                                name="tempat_lahir"
                                value="{{ old('tempat_lahir') }}"
                                required
                                class="w-full border-gray-300 rounded-md">
                        </div>


                        {{-- Tanggal Lahir --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}"
                                required
                                class="w-full border-gray-300 rounded-md">
                        </div>


                        {{-- Jenis Kelamin --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Jenis Kelamin
                            </label>

                            <select
                                name="jenis_kelamin"
                                required
                                class="w-full border-gray-300 rounded-md">

                                <option value="">
                                    Pilih jenis kelamin
                                </option>

                                <option
                                    value="L"
                                    @selected(old('jenis_kelamin')==='L' )>
                                    Laki-laki
                                </option>

                                <option
                                    value="P"
                                    @selected(old('jenis_kelamin')==='P' )>
                                    Perempuan
                                </option>

                            </select>
                        </div>


                        {{-- Status Perkawinan --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Status Perkawinan
                            </label>

                            <select
                                name="status_perkawinan"
                                required
                                class="w-full border-gray-300 rounded-md">

                                <option value="">
                                    Pilih status
                                </option>

                                <option value="belum_kawin">
                                    Belum Kawin
                                </option>

                                <option value="kawin">
                                    Kawin
                                </option>

                                <option value="cerai_hidup">
                                    Cerai Hidup
                                </option>

                                <option value="cerai_mati">
                                    Cerai Mati
                                </option>

                            </select>
                        </div>


                        {{-- Pekerjaan --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Pekerjaan
                            </label>

                            <input
                                type="text"
                                name="pekerjaan"
                                value="{{ old('pekerjaan') }}"
                                required
                                class="w-full border-gray-300 rounded-md">
                        </div>


                        {{-- RT --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                RT
                            </label>

                            <input
                                type="text"
                                name="rt"
                                value="{{ old('rt') }}"
                                maxlength="3"
                                required
                                class="w-full border-gray-300 rounded-md">
                        </div>


                        {{-- RW --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                RW
                            </label>

                            <input
                                type="text"
                                name="rw"
                                value="{{ old('rw') }}"
                                maxlength="3"
                                required
                                class="w-full border-gray-300 rounded-md">
                        </div>


                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-medium mb-1">
                                Status Penduduk
                            </label>

                            <select
                                name="status_penduduk"
                                required
                                class="w-full border-gray-300 rounded-md">

                                <option value="aktif">
                                    Aktif
                                </option>

                                <option value="tidak_aktif">
                                    Tidak Aktif
                                </option>

                            </select>
                        </div>


                        {{-- Alamat --}}
                        <div class="md:col-span-2">

                            <label class="block text-sm font-medium mb-1">
                                Alamat
                            </label>

                            <textarea
                                name="alamat"
                                rows="4"
                                required
                                class="w-full border-gray-300 rounded-md">{{ old('alamat') }}</textarea>

                        </div>

                    </div>


                    <div class="flex justify-end gap-3 mt-6">

                        <a
                            href="{{ route('admin.penduduks.index') }}"
                            class="px-5 py-2 border rounded-md">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-gray-800 text-white rounded-md">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>