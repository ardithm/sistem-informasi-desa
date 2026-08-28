<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>
                <h2 class="font-semibold text-xl text-gray-800">
                    Berita Desa
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola berita dan kegiatan desa.
                </p>
            </div>

            <a
                href="{{ route('admin.beritas.create') }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                + Tambah Berita
            </a>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan sukses --}}
            @if (session('success'))

            <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>

            @endif


            {{-- Pesan error --}}
            @if (session('error'))

            <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-md">
                {{ session('error') }}
            </div>

            @endif


            {{-- Filter --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">

                <form
                    method="GET"
                    action="{{ route('admin.beritas.index') }}">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div class="md:col-span-2">

                            <label
                                for="search"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Cari Berita
                            </label>

                            <input
                                id="search"
                                type="text"
                                name="search"
                                value="{{ $search ?? '' }}"
                                placeholder="Masukkan judul berita..."
                                class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                        </div>


                        <div>

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                                <option value="">
                                    Semua Status
                                </option>

                                <option
                                    value="draft"
                                    @selected(($status ?? '' )==='draft' )>
                                    Draft
                                </option>

                                <option
                                    value="published"
                                    @selected(($status ?? '' )==='published' )>
                                    Published
                                </option>

                            </select>

                        </div>

                    </div>


                    <div class="flex gap-2 mt-4">

                        <button
                            type="submit"
                            class="px-5 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                            Cari
                        </button>

                        @if (($search ?? '') || ($status ?? ''))

                        <a
                            href="{{ route('admin.beritas.index') }}"
                            class="px-5 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50">
                            Reset
                        </a>

                        @endif

                    </div>

                </form>

            </div>


            {{-- Tabel --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Berita
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Penulis
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Publikasi
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse ($beritas as $berita)

                            <tr class="hover:bg-gray-50">

                                {{-- Berita --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-4">

                                        @if ($berita->gambar)

                                        <img
                                            src="{{ asset('storage/' . $berita->gambar) }}"
                                            alt="{{ $berita->judul }}"
                                            class="w-20 h-14 object-cover rounded-md">

                                        @else

                                        <div class="w-20 h-14 bg-gray-100 rounded-md flex items-center justify-center">

                                            <span class="text-xs text-gray-400">
                                                No Image
                                            </span>

                                        </div>

                                        @endif


                                        <div>

                                            <div class="font-medium text-gray-800">
                                                {{ \Illuminate\Support\Str::limit($berita->judul, 60) }}
                                            </div>

                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $berita->slug }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Penulis --}}
                                <td class="px-6 py-4 text-sm text-gray-700">

                                    {{ $berita->user->name ?? '-' }}

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4">

                                    @if ($berita->status === 'published')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>

                                    @else

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        Draft
                                    </span>

                                    @endif

                                </td>


                                {{-- Publikasi --}}
                                <td class="px-6 py-4 text-sm text-gray-600">

                                    @if ($berita->published_at)

                                    {{ $berita->published_at->format('d/m/Y H:i') }}

                                    @else

                                    -

                                    @endif

                                </td>


                                {{-- Aksi --}}
                                <td class="px-6 py-4 text-right text-sm whitespace-nowrap">

                                    <a
                                        href="{{ route('admin.beritas.show', $berita) }}"
                                        class="text-blue-600 hover:underline mr-3">
                                        Detail
                                    </a>

                                    <a
                                        href="{{ route('admin.beritas.edit', $berita) }}"
                                        class="text-indigo-600 hover:underline mr-3">
                                        Edit
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
                                            class="text-red-600 hover:underline">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-12 text-center">

                                    <p class="font-medium text-gray-700">
                                        Belum ada berita.
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Silakan tambahkan berita pertama.
                                    </p>

                                    <a
                                        href="{{ route('admin.beritas.create') }}"
                                        class="inline-block mt-4 text-sm text-blue-600 hover:underline">
                                        + Tambah Berita
                                    </a>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                @if ($beritas->hasPages())

                <div class="px-6 py-4 border-t border-gray-200">

                    {{ $beritas->links() }}

                </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>