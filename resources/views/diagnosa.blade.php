@extends('layouts.base')

@section('title', 'Diagnosa')

@section('body')
    @include('partials.navbar')

    <!-- Main Content -->
    <section class="flex justify-center items-center flex-col p-10">
        <h2 class="text-2xl md:text-3xl font-bold text-[#3D3D3D] mb-8 font-pridi">
            Konsultasi Sekarang Yuk
        </h2>

        <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-xl">
            <form method="POST" action="{{ route('diagnosa') }}" class="flex flex-col gap-5">
                @csrf
                <div>
                    <label class="block mb-1 font-medium text-[#3D3D3D]">Nama Kucing:</label>
                    <input name="pet_name" type="text" placeholder="Masukkan nama kucing" value="{{ old('pet_name') }}"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]"
                        required />
                    @error('pet_name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium text-[#3D3D3D]">Jenis Kelamin:</label>
                    <select name="pet_gender"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option {{ old('pet_gender') == 'jantan' ? 'selected' : '' }} value="jantan">Jantan</option>
                        <option {{ old('pet_gender') == 'betina' ? 'selected' : '' }} value="betina">Betina</option>
                    </select>
                    @error('pet_gender')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-3 font-medium text-[#3D3D3D]">Pilih Gejala:</label>
                    @error('features')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                    <div class="flex flex-col gap-3 border border-gray-300 rounded-lg p-3 h-60 overflow-y-auto">
                        @foreach ($features as $feature)
                            <label
                                class="flex items-center justify-between bg-[#9CB9F2] text-black px-4 py-2 rounded-md shadow w-full mb-2 cursor-pointer hover:bg-[#b3cbf6] transition">
                                <span class="font-medium">{{ Str::title($feature) }}</span>
                                <input type="checkbox" name="features[]" value="{{ $feature }}"
                                    class="accent-blue-600 w-4 h-4"
                                    {{ in_array($feature, old('features', [])) ? 'checked' : '' }} />
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit"
                    class="bg-[#5141C3] text-white py-2 rounded font-semibold hover:bg-[#3e33a7] transition">
                    Diagnosa
                </button>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
    @error('result')
        <script>
            swal("Oops", "{{ $message }}", "error")
        </script>
    @enderror
@endpush
