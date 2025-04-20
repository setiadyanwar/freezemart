<!DOCTYPE html>
<html lang="en" class="light scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
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
    <footer class="py-12 border-t bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="grid gap-8 md:grid-cols-3">
                <!-- Kolom 1: Informasi Perusahaan -->
                <div>
                    <h5 class="text-xl font-semibold text-gray-800 dark:text-white">FreezeMart</h5>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">FreezeMart adalah platform belanja online yang
                        menawarkan berbagai produk dengan harga terjangkau dan kualitas terbaik. Belanja jadi lebih
                        mudah dan menyenangkan di sini!</p>
                    <div class="flex mt-4 space-x-6">
                        <a href="#"
                            class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Kolom 2: Link Navigasi -->
                <div>
                    <h5 class="text-xl font-semibold text-gray-800">Navigasi</h5>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#"
                                class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Home</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Products</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">About
                                Us</a></li>
                        <li><a href="#"
                                class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 3: Langganan Newsletter -->
                <div>
                    <h5 class="text-xl font-semibold text-gray-800">Langganan Newsletter</h5>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Dapatkan update terbaru tentang produk dan
                        penawaran eksklusif kami.</p>
                    <form id="form-feedback" action="/" class="mt-4">
                        <div class="flex">
                            <input type="email" placeholder="Email Anda"
                                class="w-full p-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary-500 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                required />
                            <button type="submit"
                                class="p-3 text-white rounded-r-lg bg-primary-500 hover:bg-primary-600 focus:ring-2 focus:ring-primary-500">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="pt-6 mt-8 border-t border-gray-300">
                <div class="flex items-center justify-between">
                    <p class="text-gray-600 dark:text-gray-300">© 2025 FreezeMart. All rights reserved.</p>
                    <div class="space-x-4">
                        <a href="#"
                            class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Privacy
                            Policy</a>
                        <a href="#"
                            class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-white">Terms of
                            Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- end footer --}}
    <div id="toast-feedback"
        class="fixed flex items-center hidden w-full max-w-xs space-x-4 divide-x divide-gray-200 rounded-lg shadow bottom-5 right-5 dark:divide-gray-700 rtl:divide-x-reverse"
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

    @yield('js-bottom')

</body>

</html>
