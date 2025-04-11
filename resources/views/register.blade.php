@extends('templates.auth')
@section('content')

<!-- Container untuk Multi-Step Form -->
<form class="space-y-4 md:space-y-6" action="/register" method="POST">
    @csrf

    <!-- Step 1: Data Diri -->
    <div id="step-1">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                <input type="text" name="name" id="name" required 
                       class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                       value="{{ old('name') }}">
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" id="email" required 
                       class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                       value="{{ old('email') }}">
            </div>
            <span id="emailError" class="text-red-500 text-sm hidden"></span>
        </div>
        <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <textarea rows="5" name="address" id="address" required 
                      class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('address') }}</textarea>
        </div>
        <!-- Tombol "Selanjutnya" -->
        <button id="nextStepButton" type="button" onclick="nextStep()" 
            class="w-full mt-4 text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-500">
            Selanjutnya
        </button>
    </div>

    <!-- Step 2: Password -->
    <div id="step-2" class="hidden">
        <div class="relative">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password" required 
                   class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <!-- Tombol Mata -->
            <button type="button" onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')" class="absolute inset-y-0 right-3 flex items-center justify-center w-10 h-full text-gray-600 dark:text-gray-400">
                <!-- Ikon Mata Terbuka -->
                <svg id="eyeClosed1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-6 hidden">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z"/>
                    <circle cx="12" cy="12" r="3" />
                </svg>
        
                <!-- Ikon Mata Tertutup (Hidden Default) -->
                <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4l16 16"/>
                </svg>
            </button>
        </div>
        <span id="passwordAlert" class="text-red-500 text-sm hidden"></span>

        <div class="relative mt-6">
            <label for="password_confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password</label>
            <input type="password" name="password_confirm" id="password_confirm" required oninput="validatePassword()"
                   class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                  
            <!-- Tombol Mata -->
            <button type="button" onclick="togglePassword('password_confirm', 'eyeOpen2', 'eyeClosed2')" class="absolute inset-y-0 right-3 flex items-center justify-center w-10 h-full text-gray-600 dark:text-gray-400">
                <!-- Ikon Mata Terbuka -->
                <svg id="eyeClosed2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-6 hidden">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z"/>
                    <circle cx="12" cy="12" r="3" />
                </svg>
        
                <!-- Ikon Mata Tertutup (Hidden Default) -->
                <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12s3-7 9-7 9 7 9 7-3 7-9 7-9-7-9-7z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4l16 16"/>
                </svg>
            </button>
        </div>
        <span id="passwordError" class="text-red-500 text-sm hidden">Password tidak cocok!</span>

        <!-- Tombol Kembali & Submit -->
        <div class="flex justify-between mt-4">
            <button type="button" onclick="prevStep()" 
                    class="text-primary-500 text-sm font-medium mr-4 border-2 p-2 border-primary-500 rounded-lg">Sebelumnya
            </button>
            <button id="submitButton" type="submit" 
                    class="w-full text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-500 font-medium rounded-lg text-sm px-5 py-2.5">
                Daftar
            </button>
        </div>
    </div>
    <p class="text-sm font-light text-center text-gray-500 dark:text-gray-400">Sudah punya akun? <a href="/login" class="font-medium text-primary-500 hover:underline dark:text-primary-500">Langsung masuk Aja!!</a>
    </p>
</form>

@php
    $image = 'assets/ImageRegister.svg';
    $message = 'Masukkan data diri kamu untuk mendaftar';
@endphp

<script>
    function nextStep() {
        document.getElementById('step-1').classList.add('hidden');
        document.getElementById('step-2').classList.remove('hidden');
    }

    function prevStep() {
        document.getElementById('step-2').classList.add('hidden');
        document.getElementById('step-1').classList.remove('hidden');
    }
    function togglePassword(inputId, eyeOpenId, eyeClosedId) {
        let passwordInput = document.getElementById(inputId);
        let eyeOpen = document.getElementById(eyeOpenId);
        let eyeClosed = document.getElementById(eyeClosedId);

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

    function validatePassword() {
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("password_confirm").value;
        let errorText = document.getElementById("passwordError");

        if (confirmPassword.length > 0 && password !== confirmPassword) {
            errorText.classList.remove("hidden");
        } else {
            errorText.classList.add("hidden");
        }
    }

    // Validasi panjang password
    function validatePasswordInput() {
    let passwordField = document.getElementById("password");
    let password = passwordField.value;
    let submitButton = document.getElementById("submitButton");
    let alertSpan = document.getElementById("passwordAlert");

    // Cek apakah password memiliki minimal 8 karakter
    if (password.length < 8) {
        alertSpan.innerText = "Password harus minimal 8 karakter.";
        alertSpan.classList.remove("hidden");
        submitButton.disabled = true;
        return;
    }
    
    // Aturan regex untuk karakter yang diizinkan (sesuaikan jika perlu)
    let allowedPattern = /^[A-Za-z0-9!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]+$/;
    if (!allowedPattern.test(password)) {
        alertSpan.innerText = "Password mengandung karakter yang tidak diizinkan.";
        alertSpan.classList.remove("hidden");
        submitButton.disabled = true;
        return;
    }
    
    // Jika validasi terpenuhi, sembunyikan alert dan aktifkan tombol submit
    alertSpan.innerText = "";
    alertSpan.classList.add("hidden");
    submitButton.disabled = false;
    }

    // Pasang event listener pada field password agar validasi berjalan saat mengetik
    document.getElementById("password").addEventListener("input", validatePasswordInput);

    function validateStep1() {
    const nameField = document.getElementById('name');
    const emailField = document.getElementById('email');
    const addressField = document.getElementById('address');
    const nextButton = document.getElementById('nextStepButton');

    // Periksa apakah semua field terisi dan email valid (mengandung '@')
    if (
        nameField.value.trim() === '' ||
        emailField.value.trim() === '' ||
        addressField.value.trim() === '' ||
        !emailField.value.includes('@')
    ) {
        nextButton.disabled = true;
        nextButton.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        nextButton.disabled = false;
        nextButton.classList.remove('opacity-50', 'cursor-not-allowed');
    }
}

    // Pasang event listener untuk memantau input di semua field step 1
    document.getElementById('name').addEventListener('input', validateStep1);
    document.getElementById('email').addEventListener('input', validateStep1);
    document.getElementById('address').addEventListener('input', validateStep1);
    document.addEventListener('DOMContentLoaded', validateStep1);


</script>

@if ($errors->has('password') || $errors->has('password_confirm'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            nextStep();
        });
    </script>
@endif

@endsection
