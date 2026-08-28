<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-tight">
                    Dashboard Admin Desa
                </h2>
                <p class="text-sm text-gray-500 mt-2 font-medium">
                    Ringkasan sistem pelayanan administrasi desa
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Statistik Utama --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Penduduk --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 hover:shadow-md transition-all duration-300 relative group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-1">Penduduk Aktif</p>
                                <p class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $totalPenduduk }}</p>
                            </div>
                            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:scale-110 group-hover:bg-blue-100 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 w-full bg-blue-500 absolute bottom-0 left-0 opacity-80"></div>
                </div>

                {{-- Total Pengajuan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 hover:shadow-md transition-all duration-300 relative group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-1">Total Pengajuan</p>
                                <p class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $totalPengajuan }}</p>
                            </div>
                            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl group-hover:scale-110 group-hover:bg-indigo-100 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 w-full bg-indigo-500 absolute bottom-0 left-0 opacity-80"></div>
                </div>

                {{-- Selesai --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 hover:shadow-md transition-all duration-300 relative group">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-1">Pengajuan Selesai</p>
                                <p class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ $pengajuanSelesai }}</p>
                            </div>
                            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:scale-110 group-hover:bg-emerald-100 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="h-1 w-full bg-emerald-500 absolute bottom-0 left-0 opacity-80"></div>
                </div>
            </div>

            {{-- Statistik Status --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:border-amber-300 transition-colors duration-300 flex items-center space-x-4">
                    <div class="p-3 bg-amber-50 text-amber-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Menunggu</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pengajuanMenunggu }}</p>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:border-rose-300 transition-colors duration-300 flex items-center space-x-4">
                    <div class="p-3 bg-rose-50 text-rose-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Perbaikan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pengajuanPerluPerbaikan }}</p>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:border-blue-300 transition-colors duration-300 flex items-center space-x-4">
                    <div class="p-3 bg-blue-50 text-blue-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Diproses</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pengajuanDiproses }}</p>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:border-red-300 transition-colors duration-300 flex items-center space-x-4">
                    <div class="p-3 bg-red-50 text-red-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Ditolak</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pengajuanDitolak }}</p>
                    </div>
                </div>
            </div>

            {{-- Pengajuan Terbaru --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Pengajuan Terbaru
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                10 pengajuan terakhir yang masuk ke sistem
                            </p>
                        </div>
                        <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition-colors">
                            Lihat Semua
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nomor</th>
                                <th class="py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pemohon</th>
                                <th class="py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Layanan</th>
                                <th class="py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($pengajuanTerbaru as $pengajuan)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="py-4 px-6">
                                    <span class="text-sm font-semibold text-gray-900">{{ $pengajuan->nomor_pengajuan }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs mr-3">
                                            {{ substr($pengajuan->penduduk->nama_lengkap, 0, 1) }}
                                        </div>
                                        <span class="text-sm text-gray-700 font-medium">{{ $pengajuan->penduduk->nama_lengkap }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="text-sm text-gray-600">{{ $pengajuan->layanan->nama_layanan }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    @php
                                        $statusClass = match($pengajuan->status) {
                                            'menunggu' => 'bg-amber-50 text-amber-700 ring-1 ring-amber-600/20',
                                            'diproses' => 'bg-blue-50 text-blue-700 ring-1 ring-blue-600/20',
                                            'selesai' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-600/20',
                                            'ditolak' => 'bg-red-50 text-red-700 ring-1 ring-red-600/20',
                                            'perlu_perbaikan' => 'bg-rose-50 text-rose-700 ring-1 ring-rose-600/20',
                                            default => 'bg-gray-50 text-gray-700 ring-1 ring-gray-600/20'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                        {{ str_replace('_', ' ', ucfirst($pengajuan->status)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <span class="text-sm text-gray-500">{{ $pengajuan->created_at->format('d/m/Y') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pengajuan</h3>
                                        <p class="mt-1 text-sm text-gray-500">Data pengajuan terbaru akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>