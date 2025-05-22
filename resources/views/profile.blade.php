@extends('layouts.base')

@section('title', 'Profile')

@section('body')
    @include('partials.navbar')

    <!-- Main Content -->
    <section class="flex justify-center items-center flex-col p-10">
        <div class="bg-white p-10 rounded-lg shadow-md w-full max-w-2xl">
            <h2 class="text-2xl font-semibold text-[#3D3D3D] mb-8 text-center font-pridi">
                PROFIL ANDA
            </h2>

            <form method="POST" action="{{ route('profile') }}" id="formProfile"
                class="flex flex-col gap-4 text-black font-pridi">
                @csrf

                <div>
                    <label class="block mb-1 font-medium">Nama</label>
                    <input type="text" placeholder="Masukkan minimal 3 karakter untuk Nama" name="name"
                        value="{{ old('name', $profile->name) }}"
                        class="w-full profile-input px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]"
                        readonly />
                    @error('name')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Username</label>
                    <input type="text" placeholder="Masukkan minimal 6 karakter untuk Username" name="username"
                        value="{{ old('username', $profile->username) }}"
                        class="w-full profile-input px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]"
                        readonly />
                    @error('username')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Jenis Kelamin</label>
                    <select name="gender"
                        class="w-full profile-input px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]"
                        disabled>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }} value="male">Pria
                        </option>
                        <option {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }} value="female">Wanita
                        </option>
                    </select>
                    @error('gender')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>


                <div>
                    <label class="block mb-1 font-medium">Alamat</label>
                    <input type="text" placeholder="Masukkan minimal 5 karakter untuk Alamat" name="address"
                        value="{{ old('address', $profile->address) }}"
                        class="w-full profile-input px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]"
                        readonly />
                    @error('address')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Nomor Telepon</label>
                    <input type="tel" placeholder="Masukan nomor telepon aktif (10-15 digit)." name="phone"
                        value="{{ old('phone', $profile->phone) }}"
                        class="w-full profile-input px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]"
                        readonly />
                    @error('phone')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" placeholder="Masukan email yang aktif dan valid" name="email"
                        value="{{ old('email', $profile->email) }}"
                        class="w-full profile-input px-3 py-2 rounded border border-gray-300 focus:ring-2 focus:ring-[#83A7ED]"
                        readonly />
                    @error('email')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex gap-4 justify-center mt-6">
                    <button type="button" id="editButton"
                        class="px-6 py-2 bg-[#4B43EF] hover:bg-[#3e38d1] text-white rounded-md font-semibold">
                        Edit
                    </button>
                    <button type="button" id="logoutButton"
                        class="px-6 py-2 bg-[#EB5757] hover:bg-[#d04545] text-white rounded-md font-semibold">
                        Logout
                    </button>
                </div>
            </form>
        </div>
    </section>

    <form method="POST" action="{{ route('logout') }}" id="formLogout">
        @csrf
    </form>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            swal("Success", "{{ session('success') }}", "success")
        </script>
    @endif

    <script>
        const editBtn = document.querySelector("#editButton");
        const logoutBtn = document.querySelector("#logoutButton");
        const logoutForm = document.querySelector("#formLogout");
        const inputs = document.querySelectorAll(".profile-input");
        const formProfile = document.querySelector("#formProfile");

        let isEditing = false;

        logoutBtn?.addEventListener("click", () => {
            swal({
                title: 'Yakin ingin logout?',
                icon: 'warning',
                buttons: ["Batal", "Ya, logout!"],
                dangerMode: true,
            }).then((logout) => {
                if (logout) {
                    logoutForm?.submit();
                }
            });
        });

        editBtn?.addEventListener("click", () => {
            if (!isEditing) {
                inputs.forEach((input) => {
                    if (input.hasAttribute("disabled")) {
                        input.removeAttribute("disabled");
                    } else {
                        input.removeAttribute("readonly")
                    }
                });

                editBtn.textContent = "Simpan";
                editBtn.classList.remove("bg-[#4B43EF]");
                editBtn.classList.add("bg-green-500", "hover:bg-green-600");
                isEditing = true;
            } else {
                // Validasi
                let valid = true;
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add("ring-2", "ring-red-400");
                        valid = false;
                    } else {
                        input.classList.remove("ring-2", "ring-red-400");
                    }
                });

                if (!valid) {
                    swal('Form tidak lengkap', 'Harap lengkapi semua kolom sebelum menyimpan.', 'error');
                    return;
                }

                // Submit form
                formProfile.submit();
            }
        });
    </script>
@endpush
