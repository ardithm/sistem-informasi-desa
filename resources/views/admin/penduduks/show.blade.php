<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <div>
                <h2 class="font-semibold text-xl text-gray-800">
                    Detail Penduduk
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Informasi lengkap data penduduk
                </p>
            </div>

            <div class="flex gap-2">

                {{-- Tombol Kembali --}}
                <a
                    href="{{ route('admin.penduduks.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50">
                    Kembali
                </a>

                {{-- Tombol Edit --}}
                <a
                    href="{{ route('admin.penduduks.edit', $penduduk) }}"
                    class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                    Edit
                </a>

                {{-- Tombol Nonaktifkan --}}
                @if ($penduduk->status_penduduk === 'aktif')

                <form
                    action="{{ route('admin.penduduks.deactivate', $penduduk) }}"
                    method="POST"
                    class="inline"
                    onsubmit="return confirm('Yakin ingin menonaktifkan penduduk ini?');">
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                        Nonaktifkan
                    </button>
                </form>

                @endif

            </div>

        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">


            {{-- Pesan Sukses --}}
            @if (session('success'))

            <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>

            @endif


            {{-- Pesan Error --}}
            @if (session('error'))

            <div class="mb-6 bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-md">
                {{ session('error') }}
            </div>

            @endif


            {{-- Data Penduduk --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">


                {{-- Header Card --}}
                <div class="px-6 py-5 border-b border-gray-200">

                    <div class="flex justify-between items-center">

                        <div>

                            <h3 class="text-lg font-semibold text-gray-800">
                                {{ $penduduk->nama_lengkap }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                NIK: {{ $penduduk->nik }}
                            </p>

                        </div>


                        {{-- Status --}}
                        @if ($penduduk->status_penduduk === 'aktif')

                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>

                        @else

                        <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-600">
                            Tidak Aktif
                        </span>

                        @endif

                    </div>

                </div>


                {{-- Informasi Pribadi --}}
                <div class="p-6">

                    <h4 class="text-base font-semibold text-gray-800 mb-5">
                        Informasi Pribadi
                    </h4>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">


                        {{-- NIK --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                NIK
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ $penduduk->nik }}
                            </p>

                        </div>


                        {{-- Nama --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Nama Lengkap
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ $penduduk->nama_lengkap }}
                            </p>

                        </div>


                        {{-- Tempat Lahir --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Tempat Lahir
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ $penduduk->tempat_lahir }}
                            </p>

                        </div>


                        {{-- Tanggal Lahir --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Tanggal Lahir
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ $penduduk->tanggal_lahir->format('d/m/Y') }}
                            </p>

                        </div>


                        {{-- Jenis Kelamin --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Jenis Kelamin
                            </p>

                            <p class="font-medium text-gray-800 mt-1">

                                @if ($penduduk->jenis_kelamin === 'L')
                                Laki-laki
                                @else
                                Perempuan
                                @endif

                            </p>

                        </div>


                        {{-- Status Perkawinan --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Status Perkawinan
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ ucwords(str_replace('_', ' ', $penduduk->status_perkawinan)) }}
                            </p>

                        </div>


                        {{-- Pekerjaan --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Pekerjaan
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ $penduduk->pekerjaan }}
                            </p>

                        </div>


                        {{-- Status Penduduk --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Status Penduduk
                            </p>

                            <p class="font-medium text-gray-800 mt-1">

                                @if ($penduduk->status_penduduk === 'aktif')
                                Aktif
                                @else
                                Tidak Aktif
                                @endif

                            </p>

                        </div>


                        {{-- RT --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                RT
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ $penduduk->rt }}
                            </p>

                        </div>


                        {{-- RW --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                RW
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ $penduduk->rw }}
                            </p>

                        </div>


                        {{-- Alamat --}}
                        <div class="md:col-span-2">

                            <p class="text-sm text-gray-500">
                                Alamat
                            </p>

                            <p class="font-medium text-gray-800 mt-1">
                                {{ $penduduk->alamat }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Informasi Sistem --}}
                <div class="px-6 py-5 border-t border-gray-200 bg-gray-50">

                    <h4 class="text-base font-semibold text-gray-800 mb-5">
                        Informasi Sistem
                    </h4>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                        {{-- Dibuat --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Data Dibuat
                            </p>

                            <p class="font-medium text-gray-800 mt-1">

                                @if ($penduduk->created_at)
                                {{ $penduduk->created_at->format('d/m/Y H:i') }}
                                @else
                                -
                                @endif

                            </p>

                        </div>


                        {{-- Diperbarui --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Terakhir Diperbarui
                            </p>

                            <p class="font-medium text-gray-800 mt-1">

                                @if ($penduduk->updated_at)
                                {{ $penduduk->updated_at->format('d/m/Y H:i') }}
                                @else
                                -
                                @endif

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>