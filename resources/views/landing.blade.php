@extends('templates.master')
@section('content')
    {{-- hero --}}
    <section class="relative pt-24 antialiased bg-white dark:bg-gray-900">
        {{-- Floating chat --}}
        @if (Auth::check())
            @include('components.floating-chat')
        @endif

        <!-- Background container -->
        <div class="absolute inset-0 w-full h-auto overflow-hidden">
            <img src="/assets/bg-white.png" class="h-[700px] w-full object-cover object-center dark:hidden"
                alt="Light background">
            <img src="/assets/bg-dark.png" class="hidden h-[700px] w-full object-cover object-center dark:block"
                alt="Dark background">
        </div>

        <div
            class="relative z-10 grid max-w-screen-xl px-4 pb-8 mx-auto md:mt-6 md:grid-cols-12 lg:gap-12 lg:pb-16 xl:gap-0">
            <div class="z-10 content-center max-w-2xl justify-self-start md:col-span-7 md:text-start" data-aos="fade-right"
                data-aos-duration="1000" once="true">
                <div
                    class="inline-flex items-center justify-center gap-2 px-4 py-1 mb-2 border rounded-xl border-primary-500">
                    <div class="text-sm font-normal border-primary-500 text-primary-500 dark:text-white lg:text-xl">Selamat
                        Datang di Freezemart</div>
                    <div class="flex items-center justify-center gap-2 p-1 border rounded-xl border-primary-500">
                        <img class="h-[26px] w-[26px]" src="/assets/emot.svg" />
                    </div>
                </div>
                <div>
                    <h1>
                        <span class="text-5xl font-bold leading-tight text-dark-black dark:text-white lg:text-6xl">Solusi
                            Untuk <br> Semua </span>
                        <span class="text-5xl font-bold leading-tight text-[#2761c9] lg:text-6xl">Kebutuhan <br> Beku
                        </span>
                        <span class="text-5xl font-bold leading-tight text-dark-black dark:text-white lg:text-6xl"> Kamu
                        </span>
                    </h1>
                </div>
                <p class="max-w-2xl mb-4 text-lg text-gray-500 dark:text-gray-400 lg:mb-8 lg:text-lg">Surganya Pecinta
                    Makanan Beku dengan Berbagai Pilihan Lezat untuk Setiap Selera</p>
                @guest
                    <a href="/login"
                        class="inline-block px-4 py-3 font-medium text-center text-white rounded-lg bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">
                        Belanja Sekarang</a>
                @else
                    <a href="/products"
                        class="inline-block rounded-lg bg-primary-500 px-6 py-3.5 text-center font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">Mulai
                        Belanja</a>
                @endguest
            </div>
            <div class="z-10 hidden md:col-span-5 md:mt-0 md:flex" data-aos="fade-left" data-aos-duration="1000"
                once="true">
                <img class="animate-float-medium dark:hidden" src="/assets/hero-shop.png" alt="hero-image" />
                <img class="hidden animate-float-medium dark:block" src="/assets/hero-shop.png" alt="hero-image" />
            </div>
        </div>
        <div class="relative z-10 grid max-w-screen-xl grid-cols-3 gap-8 px-4 pb-4 mx-auto text-gray-500 dark:text-gray-400 md:grid-cols-6"
            data-aos="fade-up" data-aos-duration="1000" once="true">
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0" src="{{ asset('assets/brand/fiesta.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0" src="{{ asset('assets/brand/belfood.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0" src="{{ asset('assets/brand/kimbo.png') }}" alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0" src="{{ asset('assets/brand/bumifood.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0" src="{{ asset('assets/brand/sibeku.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0" src="{{ asset('assets/brand/amazy.png') }}" alt="brand-logo">
                </img>
            </a>
        </div>
    </section>
    {{-- end hero --}}

    {{-- Banner --}}
    <section class="py-6 antialiased bg-gray-50 dark:bg-gray-900 md:py-16">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <img src="/assets/banner-promo.png" alt="banner-promo" data-aos="fade-up">
        </div>
    </section>
    {{-- End Banner --}}

    {{-- category --}}
    <section class="py-5 antialiased bg-gray-50 dark:bg-gray-900 md:py-4" id="category">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="mb-4 md:mb-8">
                {{-- TOP 3 Kategori --}}
                <div class="flex flex-wrap">
                    <div class="w-full mb-10 lg:w-1/2" data-aos="fade-up" data-aos-duration="1000" once="true">
                        <h2 class="text-xl font-semibold text-gray-900 pb-7 dark:text-white sm:text-2xl">Kategori Terpopuler
                        </h2>
                        <div class="flex items-center justify-between w-full">
                            <div>
                                <h2 class="font-bold text-primary-500">
                                    TOP 3 Kategori<br>Terpopuler
                                </h2>
                                <img src="/assets/star-emoji.png" class="h-[32px] w-[32px]" alt="top-populer">
                            </div>
                            <div class="flex max-w-full gap-4 p-2 pb-2 mr-8 overflow-x-auto scrollbar-hide">
                                @foreach ($categories->take(3) as $category)
                                    <a href="/products?category={{ $category->slug }}" class="flex-none">
                                        <div
                                            class="flex h-32 w-32 flex-col items-center justify-center rounded-2xl bg-white p-4 text-center outline outline-1 outline-[#6B7280] scrollbar-hide dark:bg-gray-800">
                                            {{-- Icon default atau icon dari DB --}}
                                            <img class="w-6 h-6 mb-2 shrink-0"
                                                src="{{ asset('storage/' . $category->path) }}"
                                                alt="{{ $category->name }} Icon">
                                            <span class="w-full text-sm font-medium text-gray-800 truncate dark:text-white">
                                                {{ $category->name }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Form Personalization --}}
                    {{-- <form action="{{ url('/personalize') }}" method="POST">
                        @csrf
                        <input type="text" name="input" placeholder="Ketikkan frozen food yang kamu suka?" required
                            class="...">

                        <div class="space-y-4">
                            <div id="price-filters" class="flex flex-wrap gap-2">
                                <button type="submit" name="price" value="lt50" class="filter-btn ...">&lt;
                                    Rp50.000</button>
                                <button type="submit" name="price" value="50to100" class="filter-btn ...">Rp50.000 -
                                    Rp100.000</button>
                                <button type="submit" name="price" value="gt100" class="filter-btn ...">&gt;
                                    Rp100.000</button>
                            </div>
                        </div>
                    </form> --}}
                    {{-- End Form Personalization --}}

                    {{-- Form Personalization --}}
                    <div x-data="{ input: '', price: '' }" class="w-full mb-10 lg:w-1/2" data-aos="fade-up" data-aos-duration="1000"
                        once="true">
                        <h2 class="pb-1 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Apa produk yang
                            kamu sukai?</h2>
                        <p class="pb-2 text-sm text-[#6B7280]">*membantu kami merekomendasikan produk yang sesuai.</p>

                        <form action="{{ url('/personalize') }}" method="GET">
                            @csrf
                            <input type="hidden" name="price" :value="price">
                            <input type="hidden" name="input" :value="input">

                            <div class="container-input">
                                <div class="relative w-full rounded-lg px-4 py-5 outline outline-1 outline-[#6B7280]">
                                    <div class="mb-4 input">
                                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                                            <input x-model="input" type="text"
                                                placeholder="Ketikkan frozen food yang kamu suka?" required
                                                class="input-text-personalisasi w-full flex-1 rounded-2xl p-3 text-sm font-light text-[#000] outline outline-1 outline-[#D8D8D8] placeholder:text-[#C5C6C9] dark:bg-gray-800 dark:text-gray-300 sm:text-base" />
                                            <button type="submit"
                                                class="send-personalisasi w-full whitespace-nowrap rounded-xl bg-[#2761c9] px-4 py-3 text-sm text-white sm:w-auto sm:text-base">
                                                Kirim
                                            </button>
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <!-- Filter harga -->
                                        <div id="price-filters" class="flex flex-wrap gap-2">
                                            <button type="button" @click="price = 'lt50'"
                                                :class="price === 'lt50' ?
                                                    'border-primary-500 bg-[#edf3ff] text-primary-500 dark:border-primary-400 dark:bg-gray-700 dark:text-primary-400' :
                                                    'border-gray-300 bg-white text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300'"
                                                class="px-4 py-2 text-sm font-medium border rounded-lg filter-btn">
                                                &lt; Rp50.000
                                            </button>
                                            <button type="button" @click="price = '50to100'"
                                                :class="price === '50to100' ?
                                                    'border-primary-500 bg-[#edf3ff] text-primary-500 dark:border-primary-400 dark:bg-gray-700 dark:text-primary-400' :
                                                    'border-gray-300 bg-white text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300'"
                                                class="px-4 py-2 text-sm font-medium border rounded-lg filter-btn">
                                                Rp50.000 - Rp100.000
                                            </button>
                                            <button type="button" @click="price = 'gt100'"
                                                :class="price === 'gt100' ?
                                                    'border-primary-500 bg-[#edf3ff] text-primary-500 dark:border-primary-400 dark:bg-gray-700 dark:text-primary-400' :
                                                    'border-gray-300 bg-white text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300'"
                                                class="px-4 py-2 text-sm font-medium border rounded-lg filter-btn">
                                                &gt; Rp100.000
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- End Form Personalization --}}

                </div>
            </div>

            <div class="flex items-center max-w-full gap-4 pb-2 pl-2 pr-4 mb-4 overflow-x-auto scrollbar-hide"
                data-aos="fade-up" data-aos-duration="1000" once="true">
                {{-- Semua Kategori --}}
                <a href="/products"
                    class="{{ request('category') ? 'border-gray-200 bg-white text-gray-900 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700' : 'border-primary-500 bg-primary-50 text-primary-600' }} flex items-center gap-2 rounded-xl border px-4 py-2 dark:bg-gray-800"
                    title="Semua Kategori">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.416 10.8335C20.2109 10.8335 21.666 9.37842 21.666 7.5835C21.666 5.78857 20.2109 4.3335 18.416 4.3335C16.6211 4.3335 15.166 5.78857 15.166 7.5835C15.166 9.37842 16.6211 10.8335 18.416 10.8335Z"
                            stroke="#2761C9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M7.58301 21.6669C9.37793 21.6669 10.833 20.2118 10.833 18.4169C10.833 16.6219 9.37793 15.1669 7.58301 15.1669C5.78808 15.1669 4.33301 16.6219 4.33301 18.4169C4.33301 20.2118 5.78808 21.6669 7.58301 21.6669Z"
                            stroke="#2761C9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M15.1663 15.1668H21.6663V20.5835C21.6663 20.8708 21.5522 21.1464 21.349 21.3495C21.1459 21.5527 20.8703 21.6668 20.583 21.6668H16.2497C15.9624 21.6668 15.6868 21.5527 15.4836 21.3495C15.2805 21.1464 15.1663 20.8708 15.1663 20.5835V15.1668ZM4.33301 4.3335H10.833V9.75016C10.833 10.0375 10.7189 10.313 10.5157 10.5162C10.3125 10.7194 10.037 10.8335 9.74967 10.8335H5.41634C5.12902 10.8335 4.85347 10.7194 4.65031 10.5162C4.44714 10.313 4.33301 10.0375 4.33301 9.75016V4.3335Z"
                            stroke="#2761C9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="text-sm font-medium whitespace-nowrap">Semua Kategori</p>
                </a>

                {{-- List Kategori --}}
                @foreach ($categories as $category)
                    <a href="/products?category={{ $category->slug }}"
                        class="{{ request('category') === $category->slug ? 'border-dark-black text-gray-900 dark:text-white dark:border-gray-700' : 'border-gray-200 text-gray-900 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700' }} flex items-center gap-2 rounded-xl border px-4 py-2">
                        <img class="w-4 h-4 shrink-0" src="{{ asset('storage/' . $category->path) }}"
                            alt="{{ $category->name }} Icon">
                        <p class="min-w-0 text-sm font-medium truncate">{{ $category->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    {{-- end category --}}


    {{-- product --}}
    @if (!empty($recommended) && count($recommended) > 0)
        <section class="py-6 antialiased bg-gray-50 dark:bg-gray-900 md:py-8" data-aos="fade-up" data-aos-duration="1000"
            once="true">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">

                <div class="flex items-center justify-between gap-4 mb-4 md:mb-8">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Rekomendasi Produk</h2>
                        <p class="text-base text-dark-secondary">Rekomendasi produk terbaik untuk kamu</p>
                    </div>
                    <a href="/products"
                        class="flex items-center px-4 py-2 text-base font-medium border rounded-xl border-primary-500 text-primary-500 hover:bg-primary-50 dark:border-primary-500 dark:bg-primary-500 dark:text-white dark:hover:bg-primary-600">
                        Lihat semua
                        <svg class="w-5 h-5 ms-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 12H5m14 0-4 4m4-4-4-4" />
                        </svg>
                    </a>
                </div>



                <div class="grid grid-cols-2 gap-4 mb-4 md:mb-8 lg:grid-cols-3 xl:grid-cols-5">
                    @foreach ($recommended as $product)
                        <div
                            class="group rounded-xl border border-gray-200 bg-white shadow-md transition-transform hover:scale-[1.02] hover:shadow-lg dark:border-gray-700 dark:bg-gray-800">
                            <a href="/products/{{ $product->slug }}" class="block overflow-hidden rounded-t-xl">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="object-cover w-full transition duration-300 aspect-square group-hover:scale-105" />
                            </a>
                            <div class="p-4 space-y-3">
                                <a href="/products/{{ $product->slug }}"
                                    class="block overflow-hidden text-base font-semibold text-left text-gray-900 truncate whitespace-nowrap hover:text-primary-600 dark:text-white dark:hover:text-primary-400 md:text-lg">
                                    {{ $product->name }}
                                </a>

                                <div
                                    class="flex items-center space-x-2 text-xs text-gray-600 dark:text-gray-300 md:text-sm">
                                    <div
                                        class="{{ $product->comments->count() > 0 ? 'text-yellow-400' : 'text-gray-300' }} flex items-center">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                        </svg>
                                        <p class="ml-1 font-medium leading-none">
                                            {{ number_format($product->comments->avg('rating') ?? 0, 1) }}
                                        </p>
                                    </div>
                                    <span class="text-gray-400 dark:text-gray-500">| Terjual</span>
                                    <span
                                        class="text-gray-400 dark:text-gray-500">({{ $product->comments->count() }})</span>
                                </div>

                                <div class="flex flex-col gap-2 pt-2 md:flex-row md:items-center md:justify-between">
                                    <p class="text-lg font-bold text-gray-900 dark:text-white md:text-xl">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>

                                    <form action="/carts/{{ $product->slug }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-3 py-2 text-xs text-white transition rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800 md:px-4 md:text-sm">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 4h1.5L8 16h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    {{-- end product --}}


    {{-- TOAST --}}
    @if (session('success'))
        <div id="toast-bottom-right"
            class="fixed flex items-center w-auto max-w-xs p-4 space-x-3 text-green-500 transition-all duration-1000 ease-in-out transform translate-x-0 border-2 border-green-300 rounded-lg bottom-5 right-5 bg-green-50 dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <div class="flex items-center justify-center w-8 h-8 p-2 bg-green-100 rounded-full dark:bg-green-900">
                <svg aria-hidden="true" class="w-6 h-6 text-green-500 dark:text-green-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="text-sm font-normal">
                {{ session('success') }}
            </div>
        </div>
        <script>
            // Hilangkan toast setelah 3 detik (3000 ms)
            setTimeout(() => {
                const toast = document.getElementById('toast-bottom-right');
                if (toast) {
                    toast.classList.add('translate-x-full', 'opacity-0'); // Geser ke kanan & fade out
                    setTimeout(() => toast.remove(), 1000); // Hapus elemen setelah animasi selesai
                }
            }, 3000);
        </script>
    @endif
@endsection
