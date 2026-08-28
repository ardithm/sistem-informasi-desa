<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800">
                Detail Layanan
            </h2>

            <div class="flex gap-2">

                <a
                    href="{{ route('admin.layanans.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50">
                    Kembali
                </a>

                <a
                    href="{{ route('admin.layanans.edit', $layanan) }}"
                    class="px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">
                    Edit
                </a>

                @if ($layanan->aktif)

                <form
                    action="{{ route('admin.layanans.deactivate', $layanan) }}"
                    method="POST"
                    class="inline"
                    onsubmit="return confirm('Yakin ingin menonaktifkan layanan ini?');">
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

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))

            <div class="mb-6 bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-md">
                {{ session('success') }}
            </div>

            @endif


            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="space-y-6">

                    <div>

                        <p class="text-sm text-gray-500">
                            Kode Layanan
                        </p>

                        <p class="font-medium mt-1">
                            {{ $layanan->kode }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Nama Layanan
                        </p>

                        <p class="font-medium mt-1">
                            {{ $layanan->nama_layanan }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Deskripsi
                        </p>

                        <p class="mt-1">
                            {{ $layanan->deskripsi ?: '-' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Status
                        </p>

                        <p class="mt-1">

                            @if ($layanan->aktif)

                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">
                                Aktif
                            </span>

                            @else

                            <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">
                                Tidak Aktif
                            </span>

                            @endif

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>