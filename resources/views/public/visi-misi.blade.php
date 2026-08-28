@extends('layouts.public')

@section('title', 'Visi & Misi')

@section('content')

<section class="py-16">

    <div class="max-w-5xl mx-auto px-6">

        <h1 class="text-4xl font-bold">
            Visi & Misi Desa
        </h1>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

            <div class="bg-white border rounded-lg p-8">

                <h2 class="text-2xl font-semibold">
                    Visi
                </h2>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    Visi desa akan diisi berdasarkan dokumen
                    resmi pemerintah desa.
                </p>

            </div>


            <div class="bg-white border rounded-lg p-8">

                <h2 class="text-2xl font-semibold">
                    Misi
                </h2>

                <p class="text-gray-600 mt-4 leading-relaxed">
                    Misi desa akan diisi berdasarkan dokumen
                    resmi pemerintah desa.
                </p>

            </div>

        </div>

    </div>

</section>

@endsection