@extends('layouts.base')

@section('title', 'Hasil Diagnosa')

@section('body')
    <section class="flex flex-col items-center px-4 md:px-10 py-10 gap-10 bg-[#f9f9fb] min-h-screen">

        <!-- Judul dan Prediksi -->
        <div class="text-center font-pridi text-[#3D3D3D]">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">HASIL DIAGNOSA:</h2>
            <div class="text-4xl md:text-5xl font-semibold shadow-md rounded-full px-10 py-4 inline-block bg-white">
                {{ number_format($percentages[$prediksi] ?? 0, 1) }}%
            </div>
            <p class="mt-3 text-lg md:text-xl">
                Terindikasi: <span class="font-bold">{{ Str::title($prediksi) }}</span>
            </p>
        </div>

        <!-- Grid Gejala & Detail Perhitungan -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 w-full max-w-5xl">

            <!-- Gejala -->
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition w-full">
                <h3 class="font-pridi text-xl font-semibold text-[#7F9DF3] mb-4">
                    Gejala yang Dipilih
                </h3>
                <ul class="list-disc pl-5 space-y-1 text-gray-700 font-pridi text-base">
                    @foreach ($gejalaDipilih as $gejala => $v)
                        <li>{{ Str::title($gejala) }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Detail Perhitungan -->
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg border border-purple-300 transition w-full">
                <h3 class="font-pridi text-xl font-semibold text-[#7F9DF3] mb-4">
                    Detail Perhitungan
                </h3>
                <div class="font-pridi text-gray-700 space-y-2">
                    @foreach ($percentages as $k => $v)
                        <div class="flex justify-between border-b border-gray-200 pb-1">
                            <span>{{ Str::title($k) }}</span>
                            <span>{{ number_format($v, 2) }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- Solusi -->
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-md w-full max-w-5xl font-pridi">
            <h4 class="font-semibold text-[#7F9DF3] text-xl mb-4">
                Solusi untuk Penyakit Terindikasi
            </h4>
            <p class="mb-3 text-gray-700">
                Halo Pawrents, jangan panik ya apabila kucing Anda terdeteksi menderita
                <span class="font-semibold">{{ Str::title($prediksi) }}</span>. Ikuti prosedur penanganan yang tepat sebelum
                terlambat, seperti:
            </p>
            <ul class="list-disc pl-6 space-y-2 text-gray-700">
                @foreach ($suggestions as $s)
                    <li>{{ $s }}</li>
                @endforeach
            </ul>
        </div>

        <div class="flex flex-row items-center gap-4">
            <a href="{{ route('riwayat-diagnosa') }}" class="px-3 py-2 bg-[#7F9DF3] text-white rounded-sm">
                Riwayat Diagnosa
            </a>
            @if (request()->query('show') === 'd')
                <form id="deleteForm" action="{{ route('riwayat-diagnosa.delete', ['id' => $id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" id="deleteButton" class="px-3 py-2 bg-red-500 text-white rounded-sm">
                        Hapus Riwayat
                    </button>
                </form>
            @endif
        </div>

    </section>
@endsection

@push('scripts')
    @if (session('diagnosa'))
        <script>
            swal("Success", "{{ session('diagnosa') }}", "success")
        </script>
    @endif

    <script>
        document.getElementById('deleteButton')?.addEventListener('click', function(e) {
            swal({
                title: "Yakin ingin menghapus?",
                text: "Riwayat diagnosa akan dihapus permanen!",
                icon: "warning",
                buttons: ["Batal", "Ya, hapus!"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    document.getElementById('deleteForm').submit();
                }
            });
        });
    </script>
@endpush
