<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Tambah Layanan
        </h2>
    </x-slot>


    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

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
                    action="{{ route('admin.layanans.store') }}">

                    @csrf


                    {{-- Kode --}}
                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-1">
                            Kode Layanan
                        </label>

                        <input
                            type="text"
                            name="kode"
                            value="{{ old('kode') }}"
                            maxlength="20"
                            required
                            placeholder="Contoh: SKD"
                            class="w-full border-gray-300 rounded-md uppercase">

                        @error('kode')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Nama --}}
                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-1">
                            Nama Layanan
                        </label>

                        <input
                            type="text"
                            name="nama_layanan"
                            value="{{ old('nama_layanan') }}"
                            maxlength="150"
                            required
                            placeholder="Contoh: Surat Keterangan Domisili"
                            class="w-full border-gray-300 rounded-md">

                        @error('nama_layanan')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Deskripsi --}}
                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-1">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="4"
                            placeholder="Deskripsi layanan..."
                            class="w-full border-gray-300 rounded-md">{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-1">
                            Status
                        </label>

                        <select
                            name="aktif"
                            required
                            class="w-full border-gray-300 rounded-md">

                            <option value="1">
                                Aktif
                            </option>

                            <option value="0">
                                Tidak Aktif
                            </option>

                        </select>

                    </div>


                    {{-- Button --}}
                    <div class="flex justify-end gap-3">

                        <a
                            href="{{ route('admin.layanans.index') }}"
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