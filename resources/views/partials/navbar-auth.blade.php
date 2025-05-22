<!-- Navbar Auth -->
<nav class="bg-[#83A7ED] shadow-md">
    <div class="container mx-auto flex items-center justify-between px-4 md:px-20 py-4">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/pawdoct.png') }}" alt="Pawdoct Logo" class="h-16 md:h-20 w-auto" />
            <h1 class="text-2xl md:text-4xl font-normal tracking-wide text-black font-marko-one">
                PAWDOCT
            </h1>
        </div>
        <div class="flex flex-row items-center gap-4 md:gap-10">
            <a href="{{ route('login') }}" class="text-white hover:text-[#bbd2ff] font-medium text-sm">
                Login
            </a>
            <a href="{{ route('signup') }}" class="text-white hover:text-[#bbd2ff] font-medium text-sm">
                Sign Up
            </a>
        </div>
    </div>
</nav>
