<!-- Navbar -->
<nav
    class="flex flex-wrap items-center justify-between px-6 md:px-10 lg:px-20 xl:px-40 py-4 shadow-md @auth bg-[#83A7ED] @endauth">
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/pawdoct.png') }}" alt="Logo" class="h-16 w-auto" />
        <h1 class="text-2xl sm:text-3xl lg:text-[40px] font-normal tracking-wide font-marko-one">
            PAWDOCT
        </h1>
    </div>
    <div class="flex gap-4 sm:gap-6 font-medium text-sm mt-4 sm:mt-0">
        <a href="{{ route('welcome') }}" class="hover:text-indigo-600">Beranda</a>
        @auth
            <a href="{{ route('diagnosa') }}" class="hover:text-indigo-600">Diagnosa</a>
            <a href="{{ route('riwayat-diagnosa') }}" class="hover:text-indigo-600">Riwayat</a>
            <a href="{{ route('profile') }}" class="hover:text-indigo-600">Profil Saya</a>
        @else
            <a href="{{ route('login') }}" class="hover:text-indigo-600">Log in</a>
            <a href="{{ route('signup') }}" class="hover:text-indigo-600">Sign up</a>
        @endauth
    </div>
</nav>
