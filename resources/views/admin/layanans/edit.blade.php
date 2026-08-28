<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Layanan
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
                    action="{{ route('admin.layanans.update', $layanan) }}">

                    @csrf
                    @method('PUT')


                    {{-- Kode --}}
                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-1">
                            Kode Layanan
                        </label>

                        <input
                            type="text"
                            name="kode"
                            value="{{ old('kode', $layanan->kode) }}"
                            maxlength="20"
                            required
                            class="w-full border-gray-300 rounded-md uppercase">

                    </div>


                    {{-- Nama --}}
                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-1">
                            Nama Layanan
                        </label>

                        <input
                            type="text"
                            name="nama_layanan"
                            value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                            maxlength="150"
                            required
                            class="w-full border-gray-300 rounded-md">

                    </div>


                    {{-- Deskripsi --}}
                    <div class="mb-6">

                        <label class="block text-sm font-medium mb-1">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="4"
                            class="w-full border-gray-300 rounded-md">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>

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

                            <option
                                value="1"
                                @selected(old('aktif', $layanan->aktif) == 1)
                                >
                                Aktif
                            </option>

                            <option
                                value="0"
                                @selected(old('aktif', $layanan->aktif) == 0)
                                >
                                Tidak Aktif
                            </option>

                        </select>

                    </div>


                    <div class="flex justify-end gap-3">

                        <a
                            href="{{ route('admin.layanans.show', $layanan) }}"
                            class="px-5 py-2 border rounded-md">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2 bg-gray-800 text-white rounded-md">
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>