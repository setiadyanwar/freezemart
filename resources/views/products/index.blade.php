@extends('templates.master')

@section('content')
<section class="bg-gray-50 py-12 mt-14 antialiased dark:bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0 text-center">

        <!-- Heading -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white md:text-4xl">
                Jelajahi Produk <span class="text-primary-500">Frozen Food</span><br>
                Berkualitas hanya di FreezeMart
            </h1>
            <p class="mt-3 text-gray-500 dark:text-gray-400 md:text-lg">
                Cintai keluargamu dengan makanan sehat dan bergizi
            </p>
        </div>

        <!-- Search -->
        <form action="/products" method="get" class="mx-auto mb-8 flex max-w-2xl items-center gap-2">
            <input
                type="text" id="search" name="search"
                class="flex-1 rounded-full border border-gray-300 bg-white px-5 py-3 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                placeholder="Ketikkan frozen food yang kamu suka?" />
            <button type="submit"
                class="rounded-full bg-primary-500 px-6 py-3 text-sm font-semibold text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-500">
                Cari
            </button>
        </form>

        <section class="bg-gray-50 py-5 mb-10 antialiased dark:bg-gray-900 md:py-4" id="category">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="relative flex items-center justify-between overflow-x-auto scrollbar-hide max-w-full">
                    <!-- List Kategori -->
                    <div class="relative flex items-center gap-4 overflow-x-auto scrollbar-hide max-w-[88%] [mask-image:linear-gradient(to_right,black_90%,transparent)]">
                        <!-- Semua Kategori -->
                        <a href="/products"
                            class="flex items-center gap-2 rounded-xl border px-4 py-2 dark:bg-gray-800
                                {{ request('category') ? 'border-gray-200 bg-white text-gray-900 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700' : 'border-primary-500 bg-primary-50 text-primary-600' }}"
                            title="Semua Kategori">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.416 10.8335C20.2109 10.8335 21.666 9.37842 21.666 7.5835C21.666 5.78857 20.2109 4.3335 18.416 4.3335C16.6211 4.3335 15.166 5.78857 15.166 7.5835C15.166 9.37842 16.6211 10.8335 18.416 10.8335Z"
                                    stroke="#2761C9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M7.58301 21.6669C9.37793 21.6669 10.833 20.2118 10.833 18.4169C10.833 16.6219 9.37793 15.1669 7.58301 15.1669C5.78808 15.1669 4.33301 16.6219 4.33301 18.4169C4.33301 20.2118 5.78808 21.6669 7.58301 21.6669Z"
                                    stroke="#2761C9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.1663 15.1668H21.6663V20.5835C21.6663 20.8708 21.5522 21.1464 21.349 21.3495C21.1459 21.5527 20.8703 21.6668 20.583 21.6668H16.2497C15.9624 21.6668 15.6868 21.5527 15.4836 21.3495C15.2805 21.1464 15.1663 20.8708 15.1663 20.5835V15.1668ZM4.33301 4.3335H10.833V9.75016C10.833 10.0375 10.7189 10.313 10.5157 10.5162C10.3125 10.7194 10.037 10.8335 9.74967 10.8335H5.41634C5.12902 10.8335 4.85347 10.7194 4.65031 10.5162C4.44714 10.313 4.33301 10.0375 4.33301 9.75016V4.3335Z"
                                    stroke="#2761C9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-sm font-medium whitespace-nowrap">Semua Kategori</p>
                        </a>
                        @foreach ($categories as $category)
                            <a href="/products?category={{ $category->slug }}"
                                class="flex items-center gap-2 rounded-xl border px-4 py-2
                                    {{ request('category') === $category->slug ? 'border-dark-black text-gray-900 dark:text-white dark:border-gray-700' : 'border-gray-200 text-gray-900 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700' }}">
                                <img class="h-4 w-4 shrink-0" src="{{ asset('storage/' . $category->path) }}" alt="{{ $category->name }} Icon">
                                <p class="text-sm min-w-0 truncate font-medium">{{ $category->name }}</p>
                            </a>
                        @endforeach
                    </div>
        
                    {{-- Filter Button --}}
                    <button  data-modal-target="filterModal" data-modal-toggle="filterModal" type="button" type="button"
                        class="flex items-center gap-2 rounded-xl border px-4 py-2 border-gray-300 bg-white text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.625 7.3125H24.375M5.6875 13H20.3125M10.5625 18.6875H15.4375" stroke="#313131" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Filter
                    </button>
                </div>
            </div>
        </section>

        {{-- Modal Filter --}}
        <div id="filterModal" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/50 hidden">
            <div class="relative w-full max-w-md p-4">
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                    <div class="flex items-start justify-between p-4 border-b dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Filter & Urutkan</h3>
                        <!-- Tombol Close -->
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 
                        hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 
                        dark:hover:text-white" data-modal-hide="filterModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" 
                            xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" 
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 
                            1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 
                            1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 
                            10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="p-4 space-y-4">
                        <!-- Filter Content di sini kalau mau -->
                        <div>
                            <label for="sort" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Urutkan</label>
                            <select id="sort" name="sort" class="block w-full rounded-lg border border-primary-500 bg-gray-50 p-2.5 text-sm text-gray-900 dark:bg-gray-700 dark:text-white">
                                <option value="">Pilih urutan</option>
                                <option value="oldest">Terlama</option>
                                <option value="newest">Terbaru</option>
                                <option value="cheapest">Termurah</option>
                                <option value="expensive">Termahal</option>
                            </select>
                        </div>
                        <!-- Kamu bisa tambahkan filter tambahan di sini -->
                    </div>
                    <div class="flex justify-end p-4 border-t dark:border-gray-700">
                        <button type="button" class="px-4 py-2 text-white bg-primary-500 rounded-lg hover:bg-primary-600" data-modal-hide="filterModal">
                            Terapkan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="mb-4 grid grid-cols-2 gap-4 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($products as $product)
                <div class="group rounded-xl border border-gray-200 bg-white shadow-md transition-transform hover:shadow-lg hover:scale-[1.02] dark:border-gray-700 dark:bg-gray-800">
                    <a href="/products/{{ $product->slug }}" class="block overflow-hidden rounded-t-xl">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="aspect-square w-full object-cover transition duration-300 group-hover:scale-105" />
                    </a>
                    <div class="p-4 space-y-3">
                        <a href="/products/{{ $product->slug }}" 
                            title="{{ $product->name }}"
                            class="block text-base md:text-lg font-semibold text-gray-900 hover:text-primary-600 dark:text-white dark:hover:text-primary-400 text-left truncate whitespace-nowrap overflow-hidden">
                            {{ $product->name }}
                        </a>

                        <div class="flex items-center space-x-2 text-xs md:text-sm text-gray-600 dark:text-gray-300">
                            <div class="flex items-center text-yellow-400">
                                <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                </svg>
                                <p class="ml-1 font-medium leading-none">5.0</p>
                            </div>
                            <span class="text-gray-400 dark:text-gray-500">|Terjual</span>
                            <span class="text-gray-400 dark:text-gray-500">(455)</span>
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 pt-2">
                            <div class="flex flex-col justify-between md:flex-row w-full">
                                <p class="text-lg text-start md:text-xl font-bold text-gray-900 dark:text-white">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                        
                                <form action="/carts/{{ $product->slug }}" method="post" class="inline-flex m-0">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center justify-center rounded-lg bg-primary-600 px-3 md:px-4 py-2 mt-2 text-xs md:text-sm text-white transition hover:bg-primary-700 focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4h1.5L8 16h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center col-span-full">
                    <p class="text-gray-500 dark:text-gray-400">Produk tidak ditemukan</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>

        
    </div>

    </section>
    {{-- end product --}}
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sortSelect = document.getElementById("sort");

        sortSelect.addEventListener("change", function() {
            const selectedValue = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set("sort_by", selectedValue);
            window.location.href = url.toString();
        });
    });

    // Menangani tombol buka modal
    document.querySelector('[data-modal-toggle="filterModal"]').addEventListener('click', function() {
        document.getElementById('filterModal').classList.remove('hidden');
    });

    // Menangani tombol tutup modal
    document.querySelector('[data-modal-hide="filterModal"]').addEventListener('click', function() {
        document.getElementById('filterModal').classList.add('hidden');
    });
</script>
