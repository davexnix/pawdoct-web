@extends('layouts.base')

@section('title', 'Lupa Password')

@section('body')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 font-pridi">Forgot Password</h2>

            <form method="POST" action="{{ route('forgot.password') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-black font-pridi mb-2" for="email">
                        Email
                    </label>
                    <input name="email" type="email" id="email"
                        class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#7F9DF3]"
                        placeholder="hello@example.com" required />

                    @error('email')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-[#7F9DF3] hover:bg-[#5F7CEB] text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
                    Send Reset Link
                </button>

                <div class="mt-8">
                    <a href="{{ route('login') }}" class="text-sm underline">
                        Back To Login
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('status'))
        <script>
            swal("Success", "{{ session('status') }}", "success")
        </script>
    @endif
@endpush
