<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="font-semibold text-xl text-gray-800">
                    Detail Berita
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Informasi lengkap berita atau kegiatan desa.
                </p>

            </div>

            <div class="flex gap-2">

                <a
                    href="{{ route('admin.beritas.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50">
                    Kembali
                </a>

                <a
                    href="{{ route('admin.beritas.edit', $berita) }}"
                    class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                    Edit
                </a>

            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">


            {{-- Pesan Sukses --}}
            @if (session('success'))

            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">

                {{ session('success') }}

            </div>

            @endif


            {{-- Detail Berita --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">


                {{-- Header Berita --}}
                <div class="p-6 border-b border-gray-200">

                    <div class="flex justify-between items-start gap-4">

                        <div>

                            <h1 class="text-2xl font-semibold text-gray-800">
                                {{ $berita->judul }}
                            </h1>

                            <p class="text-sm text-gray-500 mt-2">
                                /berita/{{ $berita->slug }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <div class="flex-shrink-0">

                            @if ($berita->status === 'published')

                            <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                Published
                            </span>

                            @else

                            <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">
                                Draft
                            </span>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Gambar --}}
                @if ($berita->gambar)

                <div class="p-6 border-b border-gray-200">

                    <img
                        src="{{ asset('storage/' . $berita->gambar) }}"
                        alt="{{ $berita->judul }}"
                        class="w-full max-h-96 object-cover rounded-lg">

                </div>

                @endif


                {{-- Informasi Berita --}}
                <div class="p-6">

                    <h3 class="text-base font-semibold text-gray-800 mb-5">
                        Informasi Berita
                    </h3>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">


                        {{-- Penulis --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Penulis
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ $berita->user->name ?? '-' }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Status
                            </p>

                            <p class="font-medium text-gray-800 mt-1">

                                @if ($berita->status === 'published')

                                Published

                                @else

                                Draft

                                @endif

                            </p>

                        </div>


                        {{-- Slug --}}
                        <div class="md:col-span-2">

                            <p class="text-sm text-gray-500">
                                Slug
                            </p>

                            <p class="font-medium text-gray-800 mt-1 break-all">
                                {{ $berita->slug }}
                            </p>

                        </div>


                        {{-- Tanggal Publikasi --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Tanggal Publikasi
                            </p>

                            <p class="font-medium text-gray-800 mt-1">

                                @if ($berita->published_at)

                                {{ $berita->published_at->format('d/m/Y H:i') }}

                                @else

                                -

                                @endif

                            </p>

                        </div>


                        {{-- Dibuat --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Dibuat
                            </p>

                            <p class="font-medium text-gray-800 mt-1">

                                @if ($berita->created_at)

                                {{ $berita->created_at->format('d/m/Y H:i') }}

                                @else

                                -

                                @endif

                            </p>

                        </div>


                    </div>

                </div>


                {{-- Isi Berita --}}
                <div class="px-6 pb-6">

                    <h3 class="text-base font-semibold text-gray-800 mb-4">
                        Isi Berita
                    </h3>

                    <div class="text-gray-700 leading-relaxed whitespace-pre-line">

                        {{ $berita->isi }}

                    </div>

                </div>


                {{-- Footer --}}
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">

                    <a
                        href="{{ route('admin.beritas.index') }}"
                        class="text-sm text-gray-600 hover:text-gray-900">
                        ← Kembali ke daftar berita
                    </a>


                    <div class="flex items-center gap-3">

                        <a
                            href="{{ route('admin.beritas.edit', $berita) }}"
                            class="px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                            Edit Berita
                        </a>


                        <form
                            action="{{ route('admin.beritas.destroy', $berita) }}"
                            method="POST"
                            class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus berita ini?');">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="px-5 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>


            </div>

        </div>

    </div>

</x-app-layout>