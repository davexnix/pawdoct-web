@extends('layouts.base')

@section('title', 'Reset Password')

@section('body')
    <div class="flex flex-col md:flex-row items-center justify-center min-h-screen bg-gray-100 px-4 py-10 gap-8">

        <!-- Form Reset Password (Sebelah kiri) -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold text-black mb-3">
                Buat Kata Sandi yang Kuat
            </h2>
            <p class="text-gray-500 mb-6 text-sm">
                Kata Sandi Anda minimal harus 8 karakter dan berisi kombinasi angka, huruf, dan karakter (!@$%^&*).
            </p>

            <form method="POST" action="{{ route('reset-password.update') }}">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-black mb-1">Kata Sandi Baru</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required
                            class="w-full p-2 pr-10 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#7F9DF3]"
                            placeholder="Masukkan kata sandi baru" />
                        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer"
                            onclick="togglePassword('password', this)">
                            <img src="{{ asset('images/eye-off.png') }}" alt="Tampilkan" class="w-5 h-5" />
                        </span>
                    </div>
                    @error('password')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-6">
                    <label class="block text-black mb-1">Ulang Kata Sandi</label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full p-2 pr-10 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#7F9DF3]"
                            placeholder="Ulangi kata sandi baru" />
                        <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer"
                            onclick="togglePassword('password_confirmation', this)">
                            <img src="{{ asset('images/eye-off.png') }}" alt="Tampilkan" class="w-5 h-5" />
                        </span>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#7F9DF3] hover:bg-[#5F7CEB] text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
                    Atur Ulang Kata Sandi
                </button>
            </form>
        </div>

        <!-- Gambar dan Teks Motivasi (Sebelah kanan) -->
        <div class="w-full md:w-1/2 flex flex-col items-center">
            <img src="/images/kucing2.png" alt="Kucing Imut" class="w-48 h-auto mb-4" />
            <p class="text-center font-pridi text-black text-lg">
                Jika kamu lupa kata sandi maka memerlukan pemulihan kata sandi yang tepat dan baik.
            </p>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        function togglePassword(id, el) {
            const input = document.getElementById(id);
            const icon = el.querySelector("img");

            if (input.type === "password") {
                input.type = "text";
                icon.src = "{{ asset('images/eye.png') }}";
                icon.alt = "Sembunyikan";
            } else {
                input.type = "password";
                icon.src = "{{ asset('images/eye-off.png') }}";
                icon.alt = "Tampilkan";
            }
        }
    </script>
@endpush
