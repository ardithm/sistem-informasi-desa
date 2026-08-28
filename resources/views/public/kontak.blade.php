@extends('layouts.public')

@section('title', 'Kontak & Lokasi')

@section('content')

<section class="py-16">

    <div class="max-w-6xl mx-auto px-6">

        <div class="mb-10">

            <p class="text-sm text-gray-500 uppercase tracking-wider">
                Hubungi Kami
            </p>

            <h1 class="text-4xl font-bold mt-2">
                Kontak & Lokasi Desa
            </h1>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">


            <div class="bg-white border rounded-lg p-8">

                <h2 class="text-xl font-semibold mb-6">
                    Kantor Desa
                </h2>

                <div class="space-y-4 text-gray-600">

                    <p>
                        <strong>Alamat:</strong><br>
                        Alamat kantor desa
                    </p>

                    <p>
                        <strong>Telepon:</strong><br>
                        08xx-xxxx-xxxx
                    </p>

                    <p>
                        <strong>Email:</strong><br>
                        desa@example.com
                    </p>

                    <p>
                        <strong>Jam Pelayanan:</strong><br>
                        Senin - Jumat
                    </p>

                </div>

            </div>


            <div class="bg-gray-100 rounded-lg min-h-80 flex items-center justify-center">

                <span class="text-gray-400">
                    Peta Lokasi Desa
                </span>

            </div>


        </div>

    </div>

</section>

@endsection