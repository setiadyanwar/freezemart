<!DOCTYPE html>
<html lang="en" class="light scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">


    <link rel="icon" type="image/x-icon" href="{{ asset('/assets/favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/landing.js'])
    @yield('js')
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-800">

    @include('templates.partials.navbar')

    @yield('content')


    {{-- footer --}}
    <footer class="bg-primary-500 text-white py-12">
        <div class="max-w-screen-xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom 1: Deskripsi dan Sosmed -->
            <div class="max-w-sm">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('/logo/logo.png') }}" alt="FreezeMart" class="h-10">
                    </div>
                    <div class="flex space-x-4 text-white text-lg">
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
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <!-- Kolom 2: Alamat -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Alamat</h4>
                    <p class="text-sm leading-relaxed">
                        Gedung Wisma Mulia 2 <br>
                        Gatot Soebroto Jakarta Selatan
                    </p>
                    <p class="mt-2 text-sm">
                        <i class="fa-solid fa-envelope mr-2"></i> contact@freezemart.id
                    </p>
                    <p class="text-sm">
                        <i class="fas fa-phone mr-2"></i> +62 00000000
                    </p>
                </div>
    
                <!-- Kolom 3: Menu -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:underline">Beranda</a></li>
                        <li><a href="#" class="hover:underline">Kategori Produk</a></li>
                        <li><a href="#" class="hover:underline">Produk</a></li>
                    </ul>
                </div>
    
                <!-- Kolom 4: Tautan -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan</h4>
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
        <div class="border-t border-white/20 mt-12 pt-6">
            <div class="max-w-screen-xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm text-white">
                <p>© 2025 FreezeMart. Hak Cipta Dilindungi.</p>
                <div class="space-x-4 mt-2 md:mt-0">
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
        class="fixed bottom-5 right-5 hidden w-full max-w-xs items-center space-x-4 divide-x divide-gray-200 rounded-lg shadow dark:divide-gray-700 rtl:divide-x-reverse"
        role="alert">
        <div id="toast-default"
            class="flex w-full max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow dark:bg-gray-700 dark:text-white"
            role="alert">
            <div
                class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-gray-100 text-primary-500 dark:bg-primary-500 dark:text-white">
                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.147 15.085a7.159 7.159 0 0 1-6.189 3.307A6.713 6.713 0 0 1 3.1 15.444c-2.679-4.513.287-8.737.888-9.548A4.373 4.373 0 0 0 5 1.608c1.287.953 6.445 3.218 5.537 10.5 1.5-1.122 2.706-3.01 2.853-6.14 1.433 1.049 3.993 5.395 1.757 9.117Z" />
                </svg>
                <span class="sr-only">Fire icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">Terimakasih sudah berlangganan.</div>
            <button type="button"
                class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-white hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-700 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                data-dismiss-target="#toast-default" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
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
        <div class="fixed bottom-5 right-5 flex w-full max-w-xs items-center space-x-4 divide-x divide-gray-200 rounded-lg shadow dark:divide-gray-700 rtl:divide-x-reverse"
            role="alert">
            <div id="toast-status"
                class="flex w-full max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow dark:bg-gray-700 dark:text-white"
                role="alert">
                <div
                    class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-gray-100 text-primary-500 dark:bg-primary-500 dark:text-white">
                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.147 15.085a7.159 7.159 0 0 1-6.189 3.307A6.713 6.713 0 0 1 3.1 15.444c-2.679-4.513.287-8.737.888-9.548A4.373 4.373 0 0 0 5 1.608c1.287.953 6.445 3.218 5.537 10.5 1.5-1.122 2.706-3.01 2.853-6.14 1.433 1.049 3.993 5.395 1.757 9.117Z" />
                    </svg>
                    <span class="sr-only">Fire icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('status') }}</div>
                <button type="button"
                    class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-white hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-700 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                    data-dismiss-target="#toast-status" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
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

</body>

</html>
