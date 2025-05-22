@extends('layouts.base')

@section('title', 'Login')

@section('body')
    @include('partials.navbar-auth')

    <!-- Main Content -->
    <section class="flex flex-col md:flex-row items-center justify-center px-8 md:px-40 py-12 md:py-20 gap-12">
        <!-- Registration Form -->
        <div class="bg-white border border-gray-300 shadow-lg rounded-2xl p-10 w-full max-w-lg">
            <h2 class="text-3xl font-bold mb-6">Login</h2>

            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
                @csrf
                <div>
                    <label class="block mb-1 font-medium">Username</label>
                    <input type="text" placeholder="johndoe" name="username" value="{{ old('username') }}"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-0 focus:ring-2 focus:ring-[#83A7ED]" />
                    @error('username')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Password</label>
                    <input type="password" placeholder="********" name="password"
                        class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-0 focus:ring-2 focus:ring-[#83A7ED]" />
                    @error('password')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-between text-sm text-gray-500">
                    <span>Forgot Password?</span>
                    <a href="{{ route('forgot.password') }}" class="text-[#83A7ED] hover:underline">Reset it</a>
                </div>

                <button type="submit"
                    class="bg-[#6C63FF] text-white py-2 rounded font-semibold hover:bg-[#574edd] transition">
                    Login
                </button>

                <div class="flex items-center my-2 text-gray-500">
                    <hr class="flex-grow border-t" />
                    <span class="px-2 text-sm">Or</span>
                    <hr class="flex-grow border-t" />
                </div>


                <a href="{{ route('signup') }}"
                    class="border border-gray-400 py-2 rounded text-center font-semibold hover:bg-gray-100 transition">
                    Sign Up
                </a>
            </form>
        </div>

        <!-- Image and Invitation Text -->
        <div class="flex flex-col items-center gap-6 text-center md:text-left">
            <img src="{{ asset('images/kucing2.png') }}" alt="Cute Cat" class="w-[361px] h-auto" />
            <p class="text-[22px] text-center md:text-[28px] font-pridi leading-relaxed">
                Rawat Kucing mu dengan login akun Pawdoct maka masalah
                penyakit kucingmu teratasi.
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    @if (session('register'))
        <script>
            swal("Success", "{{ session('register') }}", "success")
        </script>
    @endif

    @if (session('reset-password'))
        <script>
            swal("Success", "{{ session('reset-password') }}", "success")
        </script>
    @endif
@endpush
