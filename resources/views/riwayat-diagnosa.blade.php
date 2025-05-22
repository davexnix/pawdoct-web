@extends('layouts.base')

@section('title', 'Riwayat Diagnosa')

@section('body')
    @include('partials.navbar')

    <!-- Main Content -->
    <section class="p-4 md:p-10">
        <div class="flex justify-center items-center flex-col">
            <h2 class="text-2xl md:text-3xl font-bold text-[#3D3D3D] mb-6 md:mb-8 font-pridi text-center">
                Riwayat Diagnosa Anda
            </h2>

            <div class="bg-white p-4 md:p-5 rounded-lg shadow-md w-full max-w-4xl overflow-x-auto">
                <!-- Added overflow-x-auto for mobile scrolling -->
                <table class="w-full text-center border-collapse font-pridi min-w-[300px]">
                    <!-- Added min-width to prevent squeezing -->
                    <thead class="bg-[#9CB9F2] text-white">
                        <tr>
                            <th class="p-2 md:p-3 border text-sm md:text-base">Nama Kucing</th>
                            <th class="p-2 md:p-3 border text-sm md:text-base">Diagnosa Penyakit</th>
                            <th class="p-2 md:p-3 border text-sm md:text-base hidden sm:table-cell">Tanggal</th>
                            <!-- Hide on small screens -->
                            <th class="p-2 md:p-3 border text-sm md:text-base">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diagnosa as $row)
                            <tr class="bg-white text-black hover:bg-gray-50">
                                <!-- Added hover effect -->
                                <td class="p-2 md:p-3 border text-sm md:text-base">
                                    {{ $row->pet_name }}
                                </td>
                                <td class="p-2 md:p-3 border text-sm md:text-base">
                                    {{ $row->prediksi }}
                                </td>
                                <td class="p-2 md:p-3 border text-sm md:text-base hidden sm:table-cell">
                                    {{ $row->created_at->translatedFormat('d F Y') }}
                                </td>
                                <!-- Hide on small screens -->
                                <td class="p-2 md:p-3 border">
                                    <a href="{{ route('diagnosa.result', ['id' => $row->id, 'show' => 'd']) }}"
                                        class="bg-[#9CB9F2] hover:bg-[#7a9bdf] text-white px-3 py-1 md:px-4 md:py-1 rounded text-sm md:text-base inline-block">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ route('welcome') }}"
                class="mt-6 md:mt-10 bg-[#9CB9F2] hover:bg-[#7a9bdf] text-white px-5 py-2 md:px-6 md:py-2 rounded font-pridi font-semibold text-sm md:text-base transition-colors">
                Kembali Ke Beranda
            </a>
        </div>
    </section>
@endsection

@push('scripts')
    @if (session('diagnosa'))
        <script>
            swal("Success", "{{ session('diagnosa') }}", "success")
        </script>
    @endif
@endpush
