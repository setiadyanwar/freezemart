<div class="w-full p-4 mx-auto bg-white border border-gray-100 rounded-lg shadow-sm" x-data="{ detailsOpen: true, modalOpen: false, rating: 0 }">
    <!-- Header section with toggle button -->
    <div class="flex items-center justify-between">
        <div class="text-xl text-gray-600">Pembelian Chicken Nugget</div>
        <div class="flex items-center text-sm text-blue-600 cursor-pointer" @click="detailsOpen = !detailsOpen">
            <span x-text="detailsOpen ? 'Sembunyikan' : 'Lihat selengkapnya'"></span>
            <svg class="w-4 h-4 ml-1 transform" :class="detailsOpen ? 'rotate-180' : ''" fill="none"
                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>

    <!-- Product summary section -->
    <div class="flex items-center mt-4">
        <div class="flex-shrink-0">
            <div class="flex items-center justify-center w-20 h-20 overflow-hidden bg-orange-100 rounded-md">
                <img class="object-cover w-16 h-16" src="assets/champ_img.jpg" alt="Chicken Nugget" />
            </div>
        </div>

        <div class="flex-grow ml-4">
            <div class="text-lg font-medium text-gray-800">Chicken Nugget Hotaz</div>
            <div class="mr-2 mt-1 inline-block rounded-[14px] bg-gray-100 px-2 py-1 text-xs text-gray-600">
                Selesai
            </div>
            <div class="flex">
                <div class="mt-2 text-sm text-black">Tanggal pembelian:</div>
                <div class="mt-2 text-sm text-gray-600 ms-2">22-02-2025</div>
            </div>
        </div>

        <div class="relative text-right">
            <!-- Informasi Harga dan Tombol -->
            <div class="font-semibold text-gray-800">Rp 120.000</div>
            <div class="text-sm text-gray-500">x1</div>
            <button @click="modalOpen = true"
                class="mt-2 rounded-[14px] bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                Beri Ulasan
            </button>
        </div>
    </div>

    <div class="flex items-center mt-4">
        <div class="items-center text-lg font-normal">
            4.0
        </div>
        <div class="flex gap-1 ms-2">
            <img src="assets/star-solid.svg" alt="Star" class="w-4 h-4" />
            <img src="assets/star-solid.svg" alt="Star" class="w-4 h-4" />
            <img src="assets/star-solid.svg" alt="Star" class="w-4 h-4" />
            <img src="assets/star-solid.svg" alt="Star" class="w-4 h-4" />
            <img src="assets/star.svg" alt="Star" class="w-4 h-4" />
        </div>
    </div>

    <!-- Modal -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.self="modalOpen = false">
        <div class="w-full max-w-md mx-4 bg-white rounded-lg shadow-lg"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95" @click.away="modalOpen = false">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 text-center border-b">
                <div class="w-4"></div>
                <h2 class="text-xl font-medium text-gray-800">Beri Review Produk</h2>
                <button @click="modalOpen = false" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="px-6 py-4">
                <!-- User Profile -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 overflow-hidden bg-blue-100 rounded-full">
                        <img src="/api/placeholder/64/64" alt="User Profile" class="object-cover w-full h-full" />
                    </div>
                    <div class="mt-2 text-center">
                        <h3 class="text-lg font-bold">setiadyanwar</h3>
                        <p class="text-gray-600">Chicken Nugget Hotaz</p>
                    </div>
                </div>

                <!-- Star Rating -->
                <div class="flex justify-center mt-4">
                    <div class="flex space-x-1">
                        <template x-for="i in 5" :key="i">
                            <button @click="rating = i" class="focus:outline-none">
                                <svg class="w-8 h-8" :class="i <= rating ? 'text-yellow-400' : 'text-gray-300'"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Review Text Area -->
                <div class="mt-6">
                    <textarea id="message" rows="4"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        placeholder="Berikan Ulasan Anda"></textarea>
                </div>
            </div>

            <!-- Footer Button -->
            <div class="px-6 pb-6">
                <button class="w-full py-3 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                    @click="modalOpen = false">
                    Beri ulasan
                </button>
            </div>
        </div>
    </div>

    <!-- Expanded details section -->
    <div x-show="detailsOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="my-4 border-t border-gray-200"></div>
        <!-- Detail Pembelian -->
        <div class="mb-6">
            <h3 class="mb-4 text-lg font-medium text-gray-800">Detail Pembelian</h3>

            <div class="grid grid-cols-1 gap-3">
                <div>
                    <p class="text-sm text-gray-600">Nomor invoice:</p>
                    <p class="text-sm">invoice-setiady-66077394</p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Status:</p>
                    <div class="flex items-center mt-1">
                        <div class="mr-2 mt-1 inline-block rounded-[14px] bg-gray-100 px-2 py-1 text-xs text-gray-600">
                            Selesai
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="my-4 border-t border-gray-200"></div>

        <!-- Ringkasan Pembelian -->
        <div>
            <h3 class="mb-4 text-lg font-medium text-gray-800">Ringkasan Pembelian</h3>

            <div>
                <div class="flex justify-between py-2 text-base">
                    <span class="text-gray-600">Total harga</span>
                    <span class="font-medium">Rp 120.000</span>
                </div>

                <div class="flex justify-between py-2 text-base">
                    <span class="text-gray-600">Biaya pelayanan</span>
                    <span class="font-medium">Rp 2.000</span>
                </div>

                <div class="my-2 border-t border-gray-200"></div>

                <div class="flex justify-between py-2 font-semibold">
                    <span>Total Belanja</span>
                    <span>Rp 122.000</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alpine.js CDN -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
