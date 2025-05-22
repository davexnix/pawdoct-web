@extends('layouts.base')

@section('title', 'Sign Up')

@section('body')
    @include('partials.navbar-auth')

    <!-- Main Content -->
    <section class="flex flex-col md:flex-row items-center justify-center px-8 md:px-40 py-12 md:py-20 gap-12">
        <!-- Registration Form -->
        <div class="bg-white border border-gray-300 shadow-lg rounded-2xl p-10 w-full max-w-lg">
            <h2 class="text-3xl font-bold mb-6">Registrasi</h2>

            <form method="POST" action="{{ route('signup') }}" class="flex flex-col gap-5">
                @csrf
                <div>
                    <label class="block mb-1 font-medium">Nama</label>
                    <input type="text" placeholder="Masukkan minimal 3 karakter untuk Nama" name="name"
                        value="{{ old('name') }}"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]" />
                    @error('name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Username</label>
                    <input type="text" placeholder="Masukkan minimal 6 karakter untuk Username" name="username"
                        value="{{ old('username') }}"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]" />
                    @error('username')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" placeholder="Masukan email yang aktif dan valid" name="email"
                        value="{{ old('email') }}"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]" />
                    @error('email')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Kata Sandi</label>
                    <input type="password" placeholder="Minimal 8 karakter, huruf, angka & karakter spesial."
                        name="password"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]" />
                    @error('password')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Konfirmasi Kata Sandi</label>
                    <input type="password" placeholder="Pastikan Kata Sandi sama dengan yang di atas."
                        name="password_confirmation"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]" />
                    @error('password_confirmation')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Nomor Telepon</label>
                    <input type="tel" placeholder="Masukan nomor telepon aktif (10-15 digit)." name="phone"
                        value="{{ old('phone') }}"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]" />
                    @error('phone')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Jenis Kelamin</label>
                    <select name="gender"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option {{ old('gender') == 'male' ? 'selected' : '' }} value="male">Pria</option>
                        <option {{ old('gender') == 'female' ? 'selected' : '' }} value="female">Wanita</option>
                    </select>
                    @error('gender')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-[#6C63FF] text-white py-2 rounded font-semibold hover:bg-[#574edd] transition">
                    Daftar
                </button>
            </form>
        </div>

        <!-- Image and Invitation Text -->
        <div class="flex flex-col items-center gap-6 text-center md:text-left">
            <img src="/images/kucing2.png" alt="Cute Cat" class="w-[361px] h-auto" />
            <p class="text-[22px] text-center md:text-[28px] font-pridi leading-relaxed">
                Ayo Register, mudah kok tinggal isi formulir di samping. Yuk, untuk
                hewan kesayanganmu!
            </p>
        </div>
    </section>
@endsection
