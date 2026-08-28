<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="font-semibold text-xl text-gray-800">
                    Edit Berita
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi berita atau kegiatan desa.
                </p>

            </div>

            <a
                href="{{ route('admin.beritas.show', $berita) }}"
                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50">
                Kembali
            </a>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">


            {{-- Pesan Error Validasi --}}
            @if ($errors->any())

            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md">

                <p class="font-medium mb-2">
                    Terdapat kesalahan:
                </p>

                <ul class="list-disc list-inside text-sm space-y-1">

                    @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                    @endforeach

                </ul>

            </div>

            @endif


            {{-- Form Edit Berita --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                <form
                    action="{{ route('admin.beritas.update', $berita) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')


                    <div class="p-6 space-y-6">


                        {{-- Judul Berita --}}
                        <div>

                            <label
                                for="judul"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Berita
                                <span class="text-red-600">*</span>
                            </label>

                            <input
                                id="judul"
                                type="text"
                                name="judul"
                                value="{{ old('judul', $berita->judul) }}"
                                maxlength="200"
                                required
                                autofocus
                                class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                            @error('judul')

                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        {{-- Gambar Lama --}}
                        @if ($berita->gambar)

                        <div>

                            <label
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Gambar Saat Ini
                            </label>

                            <div class="border border-gray-200 rounded-md p-3">

                                <img
                                    src="{{ asset('storage/' . $berita->gambar) }}"
                                    alt="{{ $berita->judul }}"
                                    class="w-full max-h-80 object-cover rounded-md">

                            </div>

                        </div>

                        @endif


                        {{-- Gambar Baru --}}
                        <div>

                            <label
                                for="gambar"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Ganti Gambar
                            </label>

                            <input
                                id="gambar"
                                type="file"
                                name="gambar"
                                accept=".jpg,.jpeg,.png,.webp"
                                class="block w-full text-sm text-gray-600 border border-gray-300 rounded-md cursor-pointer">

                            <p class="text-xs text-gray-500 mt-2">
                                Kosongkan jika tidak ingin mengganti gambar.
                                Format: JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                            </p>

                            @error('gambar')

                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        {{-- Isi Berita --}}
                        <div>

                            <label
                                for="isi"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Isi Berita
                                <span class="text-red-600">*</span>
                            </label>

                            <textarea
                                id="isi"
                                name="isi"
                                rows="12"
                                required
                                placeholder="Tulis isi berita di sini..."
                                class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">{{ old('isi', $berita->isi) }}</textarea>

                            @error('isi')

                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        {{-- Status --}}
                        <div>

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                                <span class="text-red-600">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                                <option
                                    value="draft"
                                    @selected(old('status', $berita->status) === 'draft')>
                                    Draft
                                </option>

                                <option
                                    value="published"
                                    @selected(old('status', $berita->status) === 'published')>
                                    Published
                                </option>

                            </select>

                            <p class="text-xs text-gray-500 mt-2">
                                Draft tidak akan ditampilkan kepada masyarakat.
                            </p>

                            @error('status')

                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        {{-- Tanggal & Waktu Publikasi --}}
                        <div>

                            <label
                                for="published_at"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal & Waktu Publikasi
                            </label>

                            <input
                                id="published_at"
                                type="datetime-local"
                                name="published_at"
                                value="{{ old(
                                    'published_at',
                                    $berita->published_at
                                        ? $berita->published_at->format('Y-m-d\TH:i')
                                        : ''
                                ) }}"
                                class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                            <p class="text-xs text-gray-500 mt-2">
                                Jika dikosongkan saat status Published,
                                sistem akan menggunakan waktu publikasi sebelumnya
                                atau waktu sekarang.
                            </p>

                            @error('published_at')

                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                    </div>


                    {{-- Footer Form --}}
                    <div class="px-6 py-4 bg-gray-50 border-t flex justify-between items-center">

                        <a
                            href="{{ route('admin.beritas.show', $berita) }}"
                            class="text-sm text-gray-600 hover:text-gray-900">
                            ← Kembali ke detail
                        </a>


                        <div class="flex gap-3">

                            <a
                                href="{{ route('admin.beritas.index') }}"
                                class="px-5 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-white">
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                                Simpan Perubahan
                            </button>

                        </div>

                    </div>


                </form>

            </div>

        </div>

    </div>

</x-app-layout>