@extends('templates.master')
@section('content')
    {{-- hero --}}
    <section class="relative bg-white pt-24 mb-6 antialiased dark:bg-gray-900">
        <!-- Background container -->
        <div class="absolute inset-0 h-[700px] w-full overflow-hidden">
            <img src="/assets/bg-white.png" class="h-[700px] w-full object-cover object-center dark:hidden"
                alt="Light background">
            <img src="/assets/bg-dark.png" class="hidden h-[700px] w-full object-cover object-center dark:block"
                alt="Dark background">
        </div>

        <div class="relative z-10 mx-auto grid max-w-screen-xl px-4 pb-8 md:mt-6 md:grid-cols-12 lg:gap-12 lg:pb-16 xl:gap-0">
            <div class="z-10 max-w-2xl content-center justify-self-start md:col-span-7 md:text-start">
                <div class="mb-2 px-4 py-1 rounded-xl border border-primary-500 justify-center items-center gap-2 inline-flex">
                    <div class="border-primary-500 text-primary-500 dark:text-white text-sm  lg:text-xl font-normal">Selamat Datang di Freezemart</div>
                    <div class="p-1 rounded-xl border border-primary-500 justify-center items-center gap-2 flex">
                    <img class="w-[26px] h-[26px]" src="/assets/emot.svg" />
                    </div>
                </div>
                <div> 
                    <h1>
                        <span class="text-dark-black dark:text-white text-5xl lg:text-6xl font-bold leading-tight">Solusi Untuk <br> Semua </span>
                        <span class="text-[#2761c9] text-5xl lg:text-6xl font-bold leading-tight">Kebutuhan <br> Beku </span>
                        <span class="text-dark-black dark:text-white text-5xl lg:text-6xl font-bold leading-tight"> Kamu </span>
                    </h1>
                </div>
                <p class="mb-4 max-w-2xl text-gray-500 dark:text-gray-400 text-lg lg:mb-8 lg:text-lg">Surganya Pecinta Makanan Beku dengan Berbagai Pilihan Lezat untuk Setiap Selera</p>
                @guest
                    <a href="/login"
                        class="inline-block rounded-lg bg-primary-500 px-4 py-3 text-center font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">
                        Belanja Sekarang</a>
                @else
                    <a href="/products"
                        class="inline-block rounded-lg bg-primary-500 px-6 py-3.5 text-center font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">Mulai
                        Belanja</a>
                @endguest
            </div>
            <div class="z-10 hidden md:col-span-5 md:mt-0 md:flex">
                <img class="dark:hidden" src="/assets/hero-shop.png" alt="hero-image" />
                <img class="hidden dark:block" src="/assets/hero-shop.png" alt="hero-image" />
            </div>
        </div>
        <div
            class="relative z-10 mx-auto grid max-w-screen-xl grid-cols-3 gap-8 px-4 text-gray-500 dark:text-gray-400 md:grid-cols-6">
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('assets/brand/fiesta.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('assets/brand/belfood.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('assets/brand/kimbo.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('assets/brand/bumifood.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('assets/brand/sibeku.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('assets/brand/amazy.png') }}"
                    alt="brand-logo">
                </img>
            </a>
        </div>
    </section>
    {{-- end hero --}}

    {{-- Banner --}}
    <section class="bg-gray-50 py-6 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <img src="/assets/banner-promo.png" alt="banner-promo" w >
        </div>
    </section>
    {{-- End Banner --}}

    {{-- category --}}
    <section class="bg-gray-50 py-6 antialiased dark:bg-gray-900 md:py-16" id="category">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mb-4 md:mb-8">
                {{-- TOP 3 Kategori --}}
                <div class="flex flex-wrap">
                    <div class="w-full mb-10 lg:w-1/2">
                        <h2 class="text-xl pb-7 font-semibold text-gray-900 dark:text-white sm:text-2xl ">Kategori Terpopuler</h2>
                        <div class="w-full justify-between flex items-center ">
                            <div>
                                <h2 class="text-primary-500 font-bold">
                                    TOP 3 Kategori<br>Terpopuler
                                </h2>
                                <img src="/assets/star-emoji.png" class="w-[32px] h-[32px]" alt="top-populer">
                            </div>
                            <div class="flex p-2 overflow-x-auto mr-8 max-w-full pb-2 gap-4">
                                @foreach($categories->take(3) as $category)
                                <a href="/products?category={{ $category->slug }}" class="flex-none">
                                    <div class="w-32 h-32 p-4 flex flex-col text-center items-center justify-center outline-[#6B7280] outline outline-1 rounded-2xl bg-white dark:bg-gray-800">
                                        {{-- Icon default atau icon dari DB --}}
                                        <img class="mb-2 h-6 w-6 shrink-0" src="{{ asset('storage/' . $category->path) }}"
                                             alt="{{ $category->name }} Icon">
                                        <span class="text-sm font-medium text-gray-800 dark:text-white truncate w-full">
                                            {{ $category->name }}
                                        </span>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="w-full mb-10 lg:w-1/2">
                        <h2 class="text-xl pb-1 font-semibold text-gray-900 dark:text-white sm:text-2xl ">Apa produk yang kamu sukai?</h2>
                        <p class="text-sm pb-2 text-[#6B7280]">*membantu kami merekomendasikan produk yang sesuai.</p>

                        <div class="container-input">
                            <div class="relative w-full outline outline-1 outline-[#6B7280] py-5 px-4 rounded-lg">
                                <div class="input mb-2">
                                    <div class="flex gap-2">
                                        <input 
                                          type="text" 
                                          placeholder="Ketikkan frozen food yang kamu suka?" 
                                          class="input-text-personalisasi flex-1 font-light text-base p-3 outline outline-1 outline-[#D8D8D8] text-[#000] placeholder:text-[#C5C6C9] rounded-2xl"
                                        />
                                        <button class="send-personalisasi bg-[#2761c9] text-white px-4 py-2 rounded-xl whitespace-nowrap">
                                          Kirim
                                        </button>
                                    </div>
                                </div>
                            
                                <div class="space-y-4">
                                    <!-- Filter harga -->
                                    <div class="flex flex-wrap gap-2">
                                        <button class="px-4 py-2 rounded-lg border border-primary-500 text-primary-500 bg-[#edf3ff] font-medium text-sm">
                                          &lt; Rp50.000
                                        </button>
                                        <button class="px-4 py-2 rounded-lg border border-[#D1D5DB] text-[#6B7280] font-medium text-sm">
                                          Rp50.000 - Rp100.000
                                        </button>
                                        <button class="px-4 py-2 rounded-lg border border-[#D1D5DB] text-[#6B7280] font-medium text-sm">
                                          &gt; Rp100.000
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                {{-- <a href="/products" title=""
                    class="flex items-center text-base font-medium text-primary-500 hover:underline">
                    Lihat semua kategori
                    <svg class="ms-1 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </a> --}}
            </div>

            <div class="mb-4 gap-4 flex p-2 overflow-x-auto mr-8 max-w-full pb-2">
                @foreach ($categories as $category)
                    @if ($loop->iteration <= 4)
                        <a href="/products?category={{ $category->slug }}"
                            class="flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img class="me-2 h-4 w-4 shrink-0" src="{{ asset('storage/' . $category->path) }}"
                                alt="{{ $category->name }} Icon">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->name }}</span>
                        </a>
                    @else
                        <a href="/products?category={{ $category->slug }}"
                            class="hidden items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 md:flex">
                            <img class="me-2 h-4 w-4 shrink-0" src="{{ asset('storage/' . $category->path) }}"
                                alt="{{ $category->name }} Icon">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->name }}</span>
                        </a>
                    @endif
                @endforeach
            </div>

            <div class="mt-6 w-full text-center">
                <a href="/products"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50 hover:text-primary-500 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-primary-500 dark:focus:ring-gray-700">Lihat
                    kategori lainnya</a>
            </div>

        </div>
    </section>
    {{-- end category --}}

    {{-- product --}}
    <section class="bg-gray-50 py-6 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Rekomendasi Produk</h2>
                    <p class="text-base text-dark-secondary">Rekomendasi produk terbaik untuk kamu</p>
                </div>
                <a href="/products" title=""
                    class="flex items-center text-base font-medium text-primary-500 hover:underline">
                    Lihat semua produk
                    <svg class="ms-1 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </a>
            </div>
            <div class="mb-4 grid grid-cols-2 gap-4 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">

                @foreach ($products as $product)
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="h-56 w-full">
                            <a href="/products/{{ $product->slug }}">
                                <img class="mx-auto h-full rounded-t" src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}" />
                            </a>
                        </div>
                        <div class="pt-6">
                            <a href="/products/{{ $product->slug }}"
                                class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $product->name }}</a>
                            <div class="mt-2 flex items-center gap-2">
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>
                                </div>

                                <p class="text-sm font-medium text-gray-900 dark:text-white">5.0</p>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">(455)</p>
                            </div>

                            <div class="mt-4 flex items-center justify-between gap-4">
                                <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>

                                <form action="/carts/{{ $product->slug }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">
                                        <svg class="me-0 ms-0 h-5 w-5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="w-full text-center">
                <a href="/products"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50 hover:text-primary-500 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-primary-500 dark:focus:ring-gray-700">Lihat
                    produk lainnya</a>
            </div>
        </div>
    </section>
    {{-- end product --}}


    {{-- TOAST --}}
    @if (session('success'))
        <div id="toast-bottom-right"
            class="fixed bottom-5 right-5 flex w-auto max-w-xs translate-x-0 transform items-center space-x-3 rounded-lg border-2 border-green-300 bg-green-50 p-4 text-green-500 transition-all duration-1000 ease-in-out dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 p-2 dark:bg-green-900">
                <svg aria-hidden="true" class="h-6 w-6 text-green-500 dark:text-green-400" fill="currentColor"
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
