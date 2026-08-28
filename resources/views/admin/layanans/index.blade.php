@php
use Illuminate\Support\Str;
@endphp

<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>
                <h2 class="font-semibold text-xl text-gray-800">
                    Data Layanan
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola layanan administrasi desa
                </p>
            </div>

            <a
                href="{{ route('admin.layanans.create') }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm">
                + Tambah Layanan
            </a>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success --}}
            @if (session('success'))

            <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>

            @endif

            @if (session('error'))

            <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-md">
                {{ session('error') }}
            </div>

            @endif


            {{-- Search --}}
            <div class="bg-white shadow-sm rounded-lg p-6 mb-6">

                <form
                    method="GET"
                    action="{{ route('admin.layanans.index') }}"
                    class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari kode atau nama layanan..."
                        class="w-full border-gray-300 rounded-md">

                    <button
                        type="submit"
                        class="px-5 py-2 bg-gray-800 text-white rounded-md">
                        Cari
                    </button>

                    @if ($search)

                    <a
                        href="{{ route('admin.layanans.index') }}"
                        class="px-5 py-2 border rounded-md">
                        Reset
                    </a>

                    @endif

                </form>

            </div>


            {{-- Table --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Kode
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Nama Layanan
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Deskripsi
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y">

                            @forelse ($layanans as $layanan)

                            <tr>

                                <td class="px-6 py-4 text-sm font-medium">
                                    {{ $layanan->kode }}
                                </td>

                                <td class="px-6 py-4 text-sm">
                                    {{ $layanan->nama_layanan }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ Str::limit($layanan->deskripsi, 60) }}
                                </td>

                                <td class="px-6 py-4 text-sm">

                                    @if ($layanan->aktif)

                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">
                                        Aktif
                                    </span>

                                    @else

                                    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">
                                        Tidak Aktif
                                    </span>

                                    @endif

                                </td>

                                <td class="px-6 py-4 text-sm text-right">

                                    <a
                                        href="{{ route('admin.layanans.show', $layanan) }}"
                                        class="text-blue-600 hover:underline mr-3">
                                        Detail
                                    </a>

                                    <a
                                        href="{{ route('admin.layanans.edit', $layanan) }}"
                                        class="text-indigo-600 hover:underline mr-3">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.layanans.destroy', $layanan) }}"
                                        method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus layanan {{ $layanan->nama_layanan }}? Layanan yang sudah memiliki pengajuan tidak dapat dihapus.');">
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
                                    class="px-6 py-10 text-center text-gray-500">
                                    Belum ada data layanan.
                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="p-6 border-t">
                    {{ $layanans->links() }}
                </div>

            </div>

        </div>

    </div>

</x-app-layout>