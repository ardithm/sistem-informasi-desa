<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>

                <h2 class="font-semibold text-xl text-gray-800">
                    Detail Pengajuan
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Informasi lengkap pengajuan layanan masyarakat.
                </p>

            </div>

            <a
                href="{{ route('admin.pengajuan.index') }}"
                class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50">

                Kembali

            </a>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">


            {{-- Informasi Pengajuan --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="text-base font-semibold text-gray-800">
                        Informasi Pengajuan
                    </h3>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- Nomor Pengajuan --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Nomor Pengajuan
                            </p>

                            <p class="mt-1 text-sm font-semibold text-gray-800">
                                {{ $pengajuan->nomor_pengajuan }}
                            </p>

                        </div>


                        {{-- Status --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Status
                            </p>

                            <div class="mt-1">

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

                                @endswitch

                            </div>

                        </div>


                        {{-- Layanan --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Layanan
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">
                                {{ $pengajuan->layanan->nama_layanan }}
                            </p>

                        </div>


                        {{-- Nomor HP --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Nomor HP
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">
                                {{ $pengajuan->no_hp }}
                            </p>

                        </div>


                        {{-- Tanggal Pengajuan --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Tanggal Pengajuan
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">
                                {{ $pengajuan->created_at->format('d/m/Y H:i') }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Data Penduduk --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="text-base font-semibold text-gray-800">
                        Data Penduduk
                    </h3>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        <div>

                            <p class="text-sm text-gray-500">
                                NIK
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">
                                {{ $pengajuan->penduduk->nik }}
                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">
                                Nama Lengkap
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">
                                {{ $pengajuan->penduduk->nama_lengkap }}
                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">
                                Tempat, Tanggal Lahir
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">

                                {{ $pengajuan->penduduk->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($pengajuan->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">
                                Jenis Kelamin
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">

                                {{ $pengajuan->penduduk->jenis_kelamin === 'L'
                                    ? 'Laki-laki'
                                    : 'Perempuan'
                                }}

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">
                                Status Perkawinan
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">

                                @switch($pengajuan->penduduk->status_perkawinan)

                                @case('belum_kawin')
                                Belum Kawin
                                @break

                                @case('kawin')
                                Kawin
                                @break

                                @case('cerai_hidup')
                                Cerai Hidup
                                @break

                                @case('cerai_mati')
                                Cerai Mati
                                @break

                                @default
                                -

                                @endswitch

                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">
                                Pekerjaan
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">
                                {{ $pengajuan->penduduk->pekerjaan }}
                            </p>

                        </div>


                        <div class="md:col-span-2">

                            <p class="text-sm text-gray-500">
                                Alamat
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">
                                {{ $pengajuan->penduduk->alamat }}
                            </p>

                        </div>


                        <div>

                            <p class="text-sm text-gray-500">
                                RT / RW
                            </p>

                            <p class="mt-1 text-sm font-medium text-gray-800">

                                RT {{ $pengajuan->penduduk->rt }}
                                /
                                RW {{ $pengajuan->penduduk->rw }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Detail Domisili --}}{{-- Detail Layanan --}}

            @if ($pengajuan->layanan->kode === 'SKD')

            {{-- Detail Domisili --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="text-base font-semibold text-gray-800">
                        Detail Domisili
                    </h3>

                </div>

                <div class="p-6 space-y-5">

                    <div>

                        <p class="text-sm text-gray-500">
                            Alamat Domisili
                        </p>

                        <p class="mt-1 text-sm text-gray-800 whitespace-pre-line">
                            {{ $pengajuan->detailDomisili->alamat_domisili }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Keperluan
                        </p>

                        <p class="mt-1 text-sm text-gray-800 whitespace-pre-line">
                            {{ $pengajuan->detailDomisili->keperluan }}
                        </p>

                    </div>

                </div>

            </div>


            @elseif ($pengajuan->layanan->kode === 'SKKK')

            {{-- Detail Pengantar KK --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="text-base font-semibold text-gray-800">
                        Detail Surat Pengantar KK
                    </h3>

                </div>

                <div class="p-6 space-y-5">

                    <div>

                        <p class="text-sm text-gray-500">
                            Nomor KK
                        </p>

                        <p class="mt-1 text-sm text-gray-800">
                            {{ $pengajuan->detailPengantarKk->nomor_kk }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Keperluan
                        </p>

                        <p class="mt-1 text-sm text-gray-800 whitespace-pre-line">
                            {{ $pengajuan->detailPengantarKk->keperluan }}
                        </p>

                    </div>

                </div>

            </div>

            @elseif ($pengajuan->layanan->kode === 'SKTP')

            {{-- Detail Pengantar KTP --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="text-base font-semibold text-gray-800">
                        Detail Surat Pengantar KTP
                    </h3>

                </div>

                <div class="p-6 space-y-5">

                    <div>

                        <p class="text-sm text-gray-500">
                            Keperluan KTP
                        </p>

                        <p class="mt-1 text-sm text-gray-800">
                            @switch($pengajuan->detailPengantarKtp->keperluan_ktp)
                            @case('pembuatan_baru')
                            Pembuatan Baru
                            @break
                            @case('hilang')
                            Hilang
                            @break
                            @case('rusak')
                            Rusak
                            @break
                            @case('perubahan_data')
                            Perubahan Data
                            @break
                            @default
                            -
                            @endswitch
                        </p>

                    </div>

                </div>

            </div>

            @elseif ($pengajuan->layanan->kode === 'SKTM')

            {{-- Detail SKTM --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="text-base font-semibold text-gray-800">
                        Detail Surat Keterangan Tidak Mampu
                    </h3>

                </div>

                <div class="p-6 space-y-5">

                    {{-- Jumlah Anggota Keluarga --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Jumlah Anggota Keluarga
                        </p>

                        <p class="mt-1 text-sm text-gray-800">
                            {{ $pengajuan->detailSktm->jumlah_anggota_keluarga }}
                            orang
                        </p>

                    </div>


                    {{-- Penghasilan --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Penghasilan Per Bulan
                        </p>

                        <p class="mt-1 text-sm text-gray-800">
                            Rp
                            {{ number_format($pengajuan->detailSktm->penghasilan_per_bulan, 0, ',', '.') }}
                        </p>

                    </div>


                    {{-- Keperluan --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Keperluan
                        </p>

                        <p class="mt-1 text-sm text-gray-800 whitespace-pre-line">
                            {{ $pengajuan->detailSktm->keperluan }}
                        </p>

                    </div>

                </div>

            </div>

            @endif


            {{-- Dokumen --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="text-base font-semibold text-gray-800">
                        Dokumen Persyaratan
                    </h3>

                </div>


                <div class="divide-y divide-gray-200">

                    @forelse ($pengajuan->dokumens as $dokumen)

                    <div class="p-6">

                        <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">


                            {{-- Informasi Dokumen --}}
                            <div>

                                <p class="text-sm font-medium text-gray-800">
                                    {{ $dokumen->jenis_dokumen }}
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $dokumen->nama_file }}
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ number_format($dokumen->ukuran_file / 1024, 0) }} KB
                                </p>


                                {{-- Status Saat Ini --}}
                                <div class="mt-3">

                                    @switch($dokumen->status_verifikasi)

                                    @case('menunggu')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Verifikasi
                                    </span>

                                    @break

                                    @case('valid')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Valid
                                    </span>

                                    @break

                                    @case('tidak_valid')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">
                                        Tidak Valid
                                    </span>

                                    @break

                                    @case('ditolak')

                                    <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>

                                    @break

                                    @endswitch

                                </div>


                                {{-- Catatan Lama --}}
                                @if ($dokumen->catatan)

                                <div class="mt-3">

                                    <p class="text-xs font-medium text-gray-500">
                                        Catatan
                                    </p>

                                    <p class="text-sm text-gray-700 mt-1 whitespace-pre-line">
                                        {{ $dokumen->catatan }}
                                    </p>

                                </div>

                                @endif

                            </div>


                            {{-- Aksi Dokumen --}}
                            <div class="w-full lg:w-96">

                                {{-- Lihat Dokumen --}}
                                <a
                                    href="{{ Storage::url($dokumen->path_file) }}"
                                    target="_blank"
                                    class="inline-flex px-3 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50">

                                    Lihat Dokumen

                                </a>


                                {{-- Form Verifikasi --}}
                                <form
                                    action="{{ route('admin.pengajuan.dokumen.verifikasi', $dokumen) }}"
                                    method="POST"
                                    class="mt-4">

                                    @csrf
                                    @method('PATCH')


                                    {{-- Status --}}
                                    <div>

                                        <label
                                            for="status_verifikasi_{{ $dokumen->id }}"
                                            class="block text-sm font-medium text-gray-700 mb-2">

                                            Status Verifikasi

                                        </label>


                                        <select
                                            id="status_verifikasi_{{ $dokumen->id }}"
                                            name="status_verifikasi"
                                            required
                                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">

                                            <option value="valid"
                                                @selected($dokumen->status_verifikasi === 'valid')>

                                                Valid

                                            </option>

                                            <option value="tidak_valid"
                                                @selected($dokumen->status_verifikasi === 'tidak_valid')>

                                                Tidak Valid

                                            </option>

                                            <option value="ditolak"
                                                @selected($dokumen->status_verifikasi === 'ditolak')>

                                                Ditolak

                                            </option>

                                        </select>

                                    </div>


                                    {{-- Catatan --}}
                                    <div class="mt-3">

                                        <label
                                            for="catatan_{{ $dokumen->id }}"
                                            class="block text-sm font-medium text-gray-700 mb-2">

                                            Catatan

                                        </label>

                                        <textarea
                                            id="catatan_{{ $dokumen->id }}"
                                            name="catatan"
                                            rows="3"
                                            maxlength="1000"
                                            placeholder="Tambahkan catatan jika diperlukan..."
                                            class="w-full border-gray-300 rounded-md focus:border-gray-500 focus:ring-gray-500">{{ $dokumen->catatan }}</textarea>

                                    </div>


                                    {{-- Simpan --}}
                                    <div class="mt-3 flex justify-end">

                                        <button
                                            type="submit"
                                            class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                                            Simpan Verifikasi

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                    @empty

                    <div class="p-6 text-center">

                        <p class="text-sm text-gray-500">
                            Tidak ada dokumen.
                        </p>

                    </div>

                    @endforelse

                </div>

            </div>

            {{-- Aksi Pengajuan --}}
            @if ($pengajuan->status === 'diverifikasi')

            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="p-6">

                    <h3 class="text-base font-semibold text-gray-800">
                        Aksi Pengajuan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 mb-4">
                        Semua dokumen telah diverifikasi. Pengajuan siap diproses.
                    </p>

                    <form
                        action="{{ route('admin.pengajuan.proses', $pengajuan) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                            Proses Pengajuan

                        </button>

                    </form>

                </div>

            </div>

            @endif

            {{-- Aksi Terbitkan Surat --}}
            @if ($pengajuan->status === 'diproses' && !$pengajuan->surat)

            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="p-6">

                    <h3 class="text-base font-semibold text-gray-800">
                        Penerbitan Surat
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 mb-4">
                        Pengajuan sudah selesai diproses dan siap diterbitkan surat.
                    </p>

                    <form
                        action="{{ route('admin.pengajuan.terbitkan-surat', $pengajuan) }}"
                        method="POST">

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">

                            Terbitkan Surat

                        </button>

                    </form>

                </div>

            </div>

            @endif


            {{-- Aksi Lihat Surat --}}
            @if ($pengajuan->status === 'selesai' && $pengajuan->surat)

            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="p-6">

                    <h3 class="text-base font-semibold text-gray-800">
                        Surat Sudah Diterbitkan
                    </h3>

                    <p class="text-sm text-gray-500 mt-1 mb-4">
                        Surat telah diterbitkan dan pengajuan telah selesai.
                    </p>

                    <a
                        href="{{ route('admin.pengajuan.surat', $pengajuan->id) }}"
                        target="_blank"
                        class="inline-block px-4 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700">

                        Lihat Surat

                    </a>

                </div>

            </div>

            @endif

            {{-- Catatan Admin --}}
            @if ($pengajuan->catatan_admin)

            <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">

                <div class="px-6 py-4 border-b border-gray-200">

                    <h3 class="text-base font-semibold text-gray-800">
                        Catatan Admin
                    </h3>

                </div>

                <div class="p-6">

                    <p class="text-sm text-gray-800 whitespace-pre-line">
                        {{ $pengajuan->catatan_admin }}
                    </p>

                </div>

            </div>

            @endif


        </div>

    </div>

</x-app-layout>