@extends('templates.auth')
@section('content')
    <!-- Container untuk Multi-Step Form -->
    <form id="registerForm" class="space-y-4 md:space-y-6 overflow-hidden" action="/register" method="POST" novalidate>
        @csrf

        <!-- Step 1: Data Diri -->
        <div id="step-1">
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <!-- Nama Lengkap -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" id="name" required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900
                               focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        value="{{ old('name') }}">
                    <span id="nameError" class="hidden text-sm text-red-500">Nama wajib diisi.</span>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email
                    </label>
                    <input type="email" name="email" id="email" required
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900
                               focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                        value="{{ old('email') }}">
                    <span id="emailError" class="hidden text-sm text-red-500">Email tidak valid (harus format x@x.com).</span>
                </div>
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Alamat
                </label>
                <textarea rows="5" name="address" id="address" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900
                           focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">{{ old('address') }}</textarea>
                <span id="addressError" class="hidden text-sm text-red-500">Alamat wajib diisi.</span>
            </div>

            <!-- No. HP -->
            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    No. HP
                </label>
                <input type="tel" name="phone" id="phone" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900
                           focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                    value="{{ old('phone') }}">
                <span id="phoneError" class="hidden text-sm text-red-500">
                    No. HP harus 11–13 digit angka.
                </span>
            </div>

            <!-- Tombol "Selanjutnya" -->
            <button id="nextStepButton" type="button" onclick="handleNextStep()"
                class="mt-4 w-full rounded-lg bg-primary-500 px-5 py-2.5 text-center text-sm font-medium text-white 
                       hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-500 dark:bg-primary-500 disabled:opacity-50"
                disabled>
                Selanjutnya
            </button>
        </div>

        <!-- Step 2: Password -->
        <div id="step-2" class="hidden">
            <!-- Password -->
            <div class="relative">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Password
                </label>
                <input type="password" name="password" id="password" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900
                           focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                <!-- Tombol Mata -->
                <button type="button" onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')"
                    class="absolute top-6 flex items-center justify-center w-10 h-10 text-gray-600 right-3 dark:text-gray-400">
                    <svg id="eyeClosed1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" class="hidden w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z" />
                        <line x1="4" y1="4" x2="20" y2="20" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <span id="passwordErrorLength" class="hidden text-sm text-red-500">
                    Password minimal 8 karakter.
                </span>
            </div>

            <!-- Konfirmasi Password -->
            <div class="relative mt-6">
                <label for="password_confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirm" id="password_confirm" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900
                           focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                <!-- Tombol Mata -->
                <button type="button" onclick="togglePassword('password_confirm', 'eyeOpen2', 'eyeClosed2')"
                    class="absolute top-6 flex items-center justify-center w-10 h-full text-gray-600 right-3 dark:text-gray-400">
                    <svg id="eyeClosed2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" class="hidden w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z" />
                        <line x1="4" y1="4" x2="20" y2="20" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <span id="passwordErrorMatch" class="hidden text-sm text-red-500">
                    Password dan konfirmasi tidak cocok.
                </span>
            </div>

            <!-- Tombol Kembali & Submit -->
            <div class="flex justify-between mt-4">
                <button type="button" onclick="goBack()"
                    class="p-2 mr-4 text-sm font-medium border-2 rounded-lg border-primary-500 text-primary-500">
                    Sebelumnya
                </button>
                <button id="submitButton" type="submit"
                    class="w-full rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white 
                           hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-500 dark:bg-primary-500 disabled:opacity-50"
                    disabled>
                    Daftar
                </button>
            </div>
        </div>

        <p class="text-sm font-light text-center text-gray-500 dark:text-gray-400">
            Sudah punya akun?
            <a href="/login" class="font-medium text-primary-500 hover:underline dark:text-primary-500">
                Langsung masuk Aja!!
            </a>
        </p>
    </form>

    @php
        $image = 'assets/ImageRegister.svg';
        $message = 'Masukkan data diri kamu untuk mendaftar';
    @endphp

<script>
    // Objek untuk melacak field yang sudah di-focus/diinput
    const touched = {
        name: false,
        email: false,
        address: false,
        phone: false,
        password: false,
        password_confirm: false,
    };

    // Tandai field sebagai touched saat user mulai interaksi
    function markTouched(field) {
        touched[field] = true;
    }

    // Toggle show/hide password
    function togglePassword(inputId, eyeOpenId, eyeClosedId) {
        const input = document.getElementById(inputId);
        const eyeOpen = document.getElementById(eyeOpenId);
        const eyeClosed = document.getElementById(eyeClosedId);
        if (input.type === "password") {
            input.type = "text";
            eyeOpen.classList.add("hidden");
            eyeClosed.classList.remove("hidden");
        } else {
            input.type = "password";
            eyeOpen.classList.remove("hidden");
            eyeClosed.classList.add("hidden");
        }
    }

    // Validasi Step 1 dengan memperhatikan touched flags
    function validateStep1() {
        const fields = ['name','email','address','phone'];
        let valid = true;

        // Nama
        const name = document.getElementById("name").value.trim();
        if (touched.name && !name) {
            document.getElementById("nameError").classList.remove("hidden");
            valid = false;
        } else {
            document.getElementById("nameError").classList.add("hidden");
        }

        // Email
        const email = document.getElementById("email").value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (touched.email && !emailPattern.test(email)) {
            document.getElementById("emailError").classList.remove("hidden");
            valid = false;
        } else {
            document.getElementById("emailError").classList.add("hidden");
        }

        // Alamat
        const address = document.getElementById("address").value.trim();
        if (touched.address && !address) {
            document.getElementById("addressError").classList.remove("hidden");
            valid = false;
        } else {
            document.getElementById("addressError").classList.add("hidden");
        }

        // Phone
        const phone = document.getElementById("phone").value.trim();
        const phonePattern = /^\d{11,13}$/;
        if (touched.phone && !phonePattern.test(phone)) {
            document.getElementById("phoneError").classList.remove("hidden");
            valid = false;
        } else {
            document.getElementById("phoneError").classList.add("hidden");
        }

        // Enable/disable tombol Next
        document.getElementById("nextStepButton").disabled = !valid;
    }

    // Pindah ke Step 2
    function handleNextStep() {
        // Pastikan kita men-set semua touched jadi true,
        // sehingga jika user langsung klik tombol, error akan muncul:
        ['name','email','address','phone'].forEach(f => touched[f] = true);
        validateStep1();
        if (!document.getElementById("nextStepButton").disabled) {
            document.getElementById("step-1").classList.add("hidden");
            document.getElementById("step-2").classList.remove("hidden");
        }
    }

    // Kembali ke Step 1
    function goBack() {
        document.getElementById("step-2").classList.add("hidden");
        document.getElementById("step-1").classList.remove("hidden");
    }

    // Validasi Step 2 dengan touched
    function validateStep2() {
        let valid = true;
        const pwd     = document.getElementById("password").value;
        const confirm = document.getElementById("password_confirm").value;

        // Panjang password
        if (touched.password && pwd.length < 8) {
            document.getElementById("passwordErrorLength").classList.remove("hidden");
            valid = false;
        } else {
            document.getElementById("passwordErrorLength").classList.add("hidden");
        }

        // Kecocokan password
        if (touched.password_confirm && pwd !== confirm) {
            document.getElementById("passwordErrorMatch").classList.remove("hidden");
            valid = false;
        } else {
            document.getElementById("passwordErrorMatch").classList.add("hidden");
        }

        document.getElementById("submitButton").disabled = !valid;
    }

    // Pasang event listener pada semua field
    document.addEventListener("DOMContentLoaded", function() {
        // Step 1 fields
        ['name','email','address','phone'].forEach(id => {
            const el = document.getElementById(id);
            el.addEventListener("focus", () => markTouched(id));
            el.addEventListener("input", () => {
                if (id === 'phone') {
                    // Hapus karakter non-digit langsung saat input
                    el.value = el.value.replace(/\D/g, '');
                }
                validateStep1();
            });
        });

        // Step 2 fields
        ['password','password_confirm'].forEach(id => {
            const el = document.getElementById(id);
            el.addEventListener("focus", () => markTouched(id));
            el.addEventListener("input", validateStep2);
        });

        // Inisialisasi state tombol
        validateStep1();
        validateStep2();
    });
</script>

@endsection
