@extends('layouts.base')

@section('title', 'PAWDOCT')

@section('body')
    @include('partials.navbar')

    <section
        class="container mx-auto flex flex-col-reverse md:flex-row items-center justify-between px-4 md:px-20 py-10 gap-10">
        <!-- Text Content -->
        <div class="max-w-xl text-center md:text-left">
            <h2 class="text-indigo-600 text-base md:text-lg font-semibold mb-2">
                Halo, Selamat Datang
            </h2>
            <h1 class="text-3xl md:text-4xl font-extrabold leading-tight mb-4">
                Cari tahu apa keluhan <br />kucing kesayangan mu
            </h1>
            <p class="text-gray-600 mb-6">
                Kucing Sehat, Pemilik Bahagia. Yuk cek gejala kucing
                anda disini!
            </p>
            <a href="{{ route('diagnosa') }}"
                class="inline-block bg-indigo-600 text-white font-semibold px-6 py-2 rounded-2xl shadow hover:bg-indigo-700 transition">
                Mulai
            </a>
        </div>

        <!-- Image -->
        <div class="w-full md:w-1/2 text-end">
            <img src="{{ asset('images/kucing.png') }}" alt="Cute Cat Illustration" class="w-full h-auto object-contain" />
        </div>
    </section>
@endsection
