<!DOCTYPE html>
<html lang="en" class="light scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">


    @wirechatStyles
    <style>
        :root {
            --wc-light-primary: #ffffff; /* Warna latar belakang utama untuk mode terang */
            --wc-light-secondary: #f3f4f6; /* Warna latar belakang sekunder */
            --wc-light-accent: #e5e7eb; /* Warna aksen */
            --wc-light-border: #d1d5db; /* Warna border */
            --wc-dark-primary: #1f2937; /* Warna latar belakang utama untuk mode gelap */
            --wc-dark-secondary: #374151; /* Warna latar belakang sekunder */
            --wc-dark-accent: #4b5563; /* Warna aksen */
            --wc-dark-border: #6b7280; /* Warna border */
        }
    </style>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/landing.js'])
    @yield('js')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50 dark:bg-gray-800 overflow-x-hidden">

    @include('templates.partials.navbar')

    @yield('content')


    {{-- footer --}}
    <footer class="py-12 text-white bg-primary-500 dark:bg-gray-800">
        <div class="grid max-w-screen-xl grid-cols-1 gap-8 px-4 mx-auto md:grid-cols-2">
            <!-- Kolom 1: Deskripsi dan Sosmed -->
            <div class="max-w-sm">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('/logo/logo.png') }}" alt="FreezeMart" class="h-10">
                    </div>
                    <div class="flex space-x-4 text-lg text-white">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
    
                <p class="mt-4 text-sm leading-relaxed">
                    Freezemart adalah solusi utama untuk semua kebutuhan makanan beku Anda. Kami menawarkan berbagai pilihan makanan beku berkualitas tinggi, mulai dari sayuran segar hingga hidangan siap saji, yang praktis dan lezat.
                </p>
            </div>
    
            <!-- Kolom 2, 3, 4: Alamat, Menu, Tautan -->
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3">
                <!-- Kolom 2: Alamat -->
                <div>
                    <h4 class="mb-4 text-lg font-semibold">Alamat</h4>
                    <p class="text-sm leading-relaxed">
                        Gedung Wisma Mulia 2 <br>
                        Gatot Soebroto Jakarta Selatan
                    </p>
                    <p class="mt-2 text-sm">
                        <i class="mr-2 fa-solid fa-envelope"></i> contact@freezemart.id
                    </p>
                    <p class="text-sm">
                        <i class="mr-2 fas fa-phone"></i> +62 00000000
                    </p>
                </div>
    
                <!-- Kolom 3: Menu -->
                <div>
                    <h4 class="mb-4 text-lg font-semibold">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:underline">Beranda</a></li>
                        <li><a href="#" class="hover:underline">Kategori Produk</a></li>
                        <li><a href="#" class="hover:underline">Produk</a></li>
                    </ul>
                </div>
    
                <!-- Kolom 4: Tautan -->
                <div>
                    <h4 class="mb-4 text-lg font-semibold">Tautan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:underline">Tentang Kami</a></li>
                        <li><a href="#" class="hover:underline">Kontak</a></li>
                        <li><a href="#" class="hover:underline">Help Center</a></li>
                        <li><a href="#" class="hover:underline">Testimonial</a></li>
                    </ul>
                </div>
            </div>
        </div>
    
        <!-- Copyright -->
        <div class="pt-6 mt-12 border-t border-white/20">
            <div class="flex flex-col items-center justify-between max-w-screen-xl px-4 mx-auto text-sm text-white md:flex-row">
                <p>© 2025 FreezeMart. Hak Cipta Dilindungi.</p>
                <div class="mt-2 space-x-4 md:mt-0">
                    <a href="#" class="hover:underline">FAQ</a>
                    <a href="#" class="hover:underline">Privacy Policy</a>
                    <a href="#" class="hover:underline">Term of Service</a>
                </div>
            </div>
        </div>
    </footer>
    
    
    {{-- end footer --}}

    {{-- Toast --}}
    <div id="toast-feedback"
        class="fixed items-center hidden w-full max-w-xs space-x-4 divide-x divide-gray-200 rounded-lg shadow bottom-5 right-5 dark:divide-gray-700 rtl:divide-x-reverse"
        role="alert">
        <div id="toast-default"
            class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:bg-gray-700 dark:text-white"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg text-primary-500 dark:bg-primary-500 dark:text-white">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.147 15.085a7.159 7.159 0 0 1-6.189 3.307A6.713 6.713 0 0 1 3.1 15.444c-2.679-4.513.287-8.737.888-9.548A4.373 4.373 0 0 0 5 1.608c1.287.953 6.445 3.218 5.537 10.5 1.5-1.122 2.706-3.01 2.853-6.14 1.433 1.049 3.993 5.395 1.757 9.117Z" />
                </svg>
                <span class="sr-only">Fire icon</span>
            </div>
            <div class="text-sm font-normal ms-3">Terimakasih sudah berlangganan.</div>
            <button type="button"
                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-white hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-700 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    </div>
    {{-- end toast --}}

    {{-- Toast Status --}}
    {{-- Jika ada session status, tampilkan toast --}}
    @if (session('status'))
        <div class="fixed flex items-center w-full max-w-xs space-x-4 divide-x divide-gray-200 rounded-lg shadow bottom-5 right-5 dark:divide-gray-700 rtl:divide-x-reverse"
            role="alert">
            <div id="toast-status"
                class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:bg-gray-700 dark:text-white"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg text-primary-500 dark:bg-primary-500 dark:text-white">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.147 15.085a7.159 7.159 0 0 1-6.189 3.307A6.713 6.713 0 0 1 3.1 15.444c-2.679-4.513.287-8.737.888-9.548A4.373 4.373 0 0 0 5 1.608c1.287.953 6.445 3.218 5.537 10.5 1.5-1.122 2.706-3.01 2.853-6.14 1.433 1.049 3.993 5.395 1.757 9.117Z" />
                    </svg>
                    <span class="sr-only">Fire icon</span>
                </div>
                <div class="text-sm font-normal ms-3">{{ session('status') }}</div>
                <button type="button"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-white hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-700 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                    data-dismiss-target="#toast-status" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div> @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formFeedback = document.getElementById('form-feedback');
            const toastFeedback = document.getElementById('toast-feedback');

            formFeedback.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form dikirim secara default
                toastFeedback.classList.remove('hidden'); // Menampilkan toast

                setTimeout(function() {
                    toastFeedback.classList.add('hidden'); // Menyembunyikan toast setelah 3 detik
                }, 3000);

                return false; // Mencegah tindakan default form
            });
        });
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @yield('js-bottom')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>  
</body>

</html>
