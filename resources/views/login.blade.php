@extends('templates.auth')
@section('content')
    <form class="space-y-4 md:space-y-6" action="/login" method="POST">
        @csrf
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" name="email" id="email"
                class="block w-full rounded-lg border border-gray-300 p-2.5 text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                placeholder="name@company.com" required="">
        </div>
        <div class="relative">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukkan Password Kamu"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pr-12 text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                required>

            <!-- Tombol Mata -->
            <button type="button" onclick="togglePassword()"
                class="absolute inset-y-0 flex items-center justify-center w-10 h-full text-gray-600 right-3 dark:text-gray-400">
                <!-- Ikon Mata Terbuka -->
                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="hidden w-6 h-6 mt-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>

                <!-- Ikon Mata Tertutup (Hidden Default) -->
                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mt-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4l16 16" />
                </svg>
            </button>
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember"
                    class="border-gray-300 rounded text-primary-500 focus:ring-primary-500 dark:focus:ring-primary-500">
                <label for="remember" class="ml-2 text-sm text-gray-500 dark:text-gray-400">Ingat saya</label>
            </div>
            <a href="/forgot-password" class="text-sm text-red-500 hover:underline dark:text-red-500">Lupa Password?</a>
        </div>
        <button type="submit"
            class="w-full rounded-lg bg-primary-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-500 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-500">Login</button>
        <p class="text-sm font-light text-center text-gray-500 dark:text-gray-400">Belum punya akun? <a href="/register"
                class="font-medium text-primary-500 hover:underline dark:text-primary-500">Daftar Yuk!!</a>
        </p>
    </form>

    @php
        $image = '/assets/Imagelogin.svg';
        $message = 'Masukkan nama pengguna dan kata sandi kamu';
    @endphp

    <script>
        function togglePassword() {
            let passwordInput = document.getElementById("password");
            let eyeOpen = document.getElementById("eyeOpen");
            let eyeClosed = document.getElementById("eyeClosed");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClosed.classList.remove("hidden");
            } else {
                passwordInput.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClosed.classList.add("hidden");
            }
        }
    </script>
@endsection
