<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="font-semibold text-xl text-gray-800">
                    Data Pengajuan
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola pengajuan layanan surat dari masyarakat.
                </p>

            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- Pesan sukses --}}
            @if (session('success'))

            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">

                {{ session('success') }}

            </div>

            @endif


            {{-- Card --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">


                {{-- Header tabel --}}
                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="text-base font-semibold text-gray-800">
                        Daftar Pengajuan
                    </h3>

                </div>


                {{-- Tabel --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50">

                            <tr>

                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nomor Pengajuan
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pemohon
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Layanan
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>

                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="bg-white divide-y divide-gray-200">

                            @forelse ($pengajuans as $index => $pengajuan)

                            <tr class="hover:bg-gray-50">


                                {{-- Nomor --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                    {{ $pengajuans->firstItem() + $index }}

                                </td>


                                {{-- Nomor Pengajuan --}}
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="text-sm font-medium text-gray-800">
                                        {{ $pengajuan->nomor_pengajuan }}
                                    </div>

                                </td>


                                {{-- Pemohon --}}
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="text-sm font-medium text-gray-800">
                                        {{ $pengajuan->penduduk->nama_lengkap }}
                                    </div>

                                    <div class="text-xs text-gray-500">
                                        {{ $pengajuan->penduduk->nik }}
                                    </div>

                                </td>


                                {{-- Layanan --}}
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="text-sm text-gray-800">
                                        {{ $pengajuan->layanan->nama_layanan }}
                                    </div>

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap">

                                    @switch($pengajuan->status)

                                    @case('menunggu')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>

                                    @break

                                    @case('diverifikasi')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        Diverifikasi
                                    </span>

                                    @break

                                    @case('perlu_perbaikan')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">
                                        Perlu Perbaikan
                                    </span>

                                    @break

                                    @case('diproses')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800">
                                        Diproses
                                    </span>

                                    @break

                                    @case('selesai')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>

                                    @break

                                    @case('ditolak')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>

                                    @break

                                    @default

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                        {{ ucfirst($pengajuan->status) }}
                                    </span>

                                    @endswitch

                                </td>


                                {{-- Tanggal --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                    {{ $pengajuan->created_at->format('d/m/Y H:i') }}

                                </td>


                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right">

                                    <a
                                        href="{{ route('admin.pengajuan.show', $pengajuan) }}"
                                        class="text-sm font-medium text-gray-700 hover:text-gray-900">

                                        Detail

                                    </a>

                                </td>


                            </tr>

                            @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="px-6 py-10 text-center">

                                    <p class="text-sm text-gray-500">
                                        Belum ada pengajuan.
                                    </p>

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if ($pengajuans->hasPages())

                <div class="px-6 py-4 border-t border-gray-200">

                    {{ $pengajuans->links() }}

                </div>

                @endif


            </div>

        </div>

    </div>

</x-app-layout>