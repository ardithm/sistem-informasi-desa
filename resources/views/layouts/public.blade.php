<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Desa')
    </title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>


<body class="bg-gray-50 text-gray-800">


    {{-- Navbar --}}
    <header class="bg-white border-b">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between h-16">


                {{-- Logo / Nama Desa --}}
                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3">

                    <div class="w-10 h-10 bg-gray-800 text-white rounded-full flex items-center justify-center font-bold">
                        D
                    </div>

                    <div>

                        <div class="font-bold text-gray-800">
                            Desa Kita
                        </div>

                        <div class="text-xs text-gray-500">
                            Kecamatan • Kabupaten
                        </div>

                    </div>

                </a>


                {{-- Navigation --}}
                <nav class="hidden md:flex items-center gap-6">

                    <a
                        href="{{ route('home') }}"
                        class="text-sm text-gray-700 hover:text-gray-900">
                        Beranda
                    </a>

                    <a
                        href="{{ route('profil') }}"
                        class="text-sm text-gray-700 hover:text-gray-900">
                        Profil Desa
                    </a>

                    <a
                        href="{{ route('sejarah') }}"
                        class="text-sm text-gray-700 hover:text-gray-900">
                        Sejarah
                    </a>

                    <a
                        href="{{ route('visi-misi') }}"
                        class="text-sm text-gray-700 hover:text-gray-900">
                        Visi & Misi
                    </a>

                    <a
                        href="{{ route('berita') }}"
                        class="text-sm text-gray-700 hover:text-gray-900">
                        Berita
                    </a>

                    <a
                        href="{{ route('layanan') }}"
                        class="text-sm text-gray-700 hover:text-gray-900">
                        Layanan
                    </a>

                    <a
                        href="{{ route('kontak') }}"
                        class="text-sm text-gray-700 hover:text-gray-900">
                        Kontak
                    </a>

                </nav>


                {{-- Mobile menu button --}}
                <button
                    type="button"
                    class="md:hidden p-2 text-gray-600">
                    ☰
                </button>

            </div>

        </div>

    </header>


    {{-- Content --}}
    <main>

        @yield('content')

    </main>


    {{-- Footer --}}
    <footer class="bg-gray-900 text-white mt-16">

        <div class="max-w-7xl mx-auto px-6 py-10">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">


                {{-- Identitas --}}
                <div>

                    <h3 class="font-bold text-lg mb-3">
                        Desa Kita
                    </h3>

                    <p class="text-gray-400 text-sm leading-relaxed">
                        Website resmi Desa Kita sebagai media
                        informasi dan pelayanan administrasi
                        masyarakat desa.
                    </p>

                </div>


                {{-- Navigasi --}}
                <div>

                    <h3 class="font-semibold mb-3">
                        Navigasi
                    </h3>

                    <ul class="space-y-2 text-sm text-gray-400">

                        <li>
                            <a
                                href="{{ route('profil') }}"
                                class="hover:text-white">
                                Profil Desa
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('berita') }}"
                                class="hover:text-white">
                                Berita
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('layanan') }}"
                                class="hover:text-white">
                                Layanan Masyarakat
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('kontak') }}"
                                class="hover:text-white">
                                Kontak
                            </a>
                        </li>

                    </ul>

                </div>


                {{-- Kontak --}}
                <div>

                    <h3 class="font-semibold mb-3">
                        Kontak Desa
                    </h3>

                    <div class="space-y-2 text-sm text-gray-400">

                        <p>
                            📍 Alamat Kantor Desa
                        </p>

                        <p>
                            ☎ 08xx-xxxx-xxxx
                        </p>

                        <p>
                            ✉ desa@example.com
                        </p>

                    </div>

                </div>

            </div>


            <div class="border-t border-gray-700 mt-8 pt-6 text-sm text-gray-500 text-center">

                © {{ date('Y') }} Pemerintah Desa Kita.
                Semua hak dilindungi.

            </div>

        </div>

    </footer>


</body>

</html>