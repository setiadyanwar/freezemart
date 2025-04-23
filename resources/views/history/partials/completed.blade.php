<div class="w-full mx-auto bg-white rounded-lg shadow-sm border border-gray-100 p-4" x-data="{ detailsOpen: true, modalOpen: false, rating: 0 }">
    <!-- Header section with toggle button -->
    <div class="flex items-center justify-between">
        <div class="text-gray-600 text-xl">Pembelian Chicken Nugget</div>
        <div class="text-blue-600 text-sm flex items-center cursor-pointer" @click="detailsOpen = !detailsOpen">
            <span x-text="detailsOpen ? 'Sembunyikan' : 'Lihat selengkapnya'"></span>
            <svg class="w-4 h-4 ml-1 transform" :class="detailsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
    
    <!-- Product summary section -->
    <div class="flex items-center mt-4">
        <div class="flex-shrink-0">
            <div class="w-20 h-20 bg-orange-100 rounded-md overflow-hidden flex items-center justify-center">
                <img class="w-16 h-16 object-cover" src="assets/champ_img.jpg" alt="Chicken Nugget" />
            </div>
        </div>
        
        <div class="ml-4 flex-grow">
            <div class="font-medium text-gray-800 text-lg">Chicken Nugget Hotaz</div>
            <div class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-[14px] mt-1 mr-2">
                Selesai
            </div>
            <div class="flex">
                <div class="text-black text-sm mt-2">Tanggal pembelian:</div>
                <div class="text-gray-600 text-sm mt-2 ms-2">22-02-2025</div>
            </div>
        </div>
        
        <div class="text-right relative">
            <!-- Informasi Harga dan Tombol -->
            <div class="text-gray-800 font-semibold">Rp 120.000</div>
            <div class="text-gray-500 text-sm">x1</div>
            <button @click="modalOpen = true" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-[14px] text-sm">
                Beri Ulasan
            </button>
        </div>
    </div>
    
    <div class="flex mt-4 items-center">
        <div class="font-normal text-lg items-center">
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
    <div 
        x-show="modalOpen" 
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="modalOpen = false"
    >
        <div 
            class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            @click.away="modalOpen = false"
        >
            <!-- Header -->
            <div class="text-center py-4 border-b flex items-center justify-between px-6">
                <div class="w-4"></div>
                <h2 class="text-xl font-medium text-gray-800">Beri Review Produk</h2>
                <button @click="modalOpen = false" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
    
            <!-- Content -->
            <div class="px-6 py-4">
                <!-- User Profile -->
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full overflow-hidden">
                        <img src="/api/placeholder/64/64" alt="User Profile" class="w-full h-full object-cover" />
                    </div>
                    <div class="mt-2 text-center">
                        <h3 class="font-bold text-lg">setiadyanwar</h3>
                        <p class="text-gray-600">Chicken Nugget Hotaz</p>
                    </div>
                </div>
    
                <!-- Star Rating -->
                <div class="flex justify-center mt-4">
                    <div class="flex space-x-1">
                        <template x-for="i in 5" :key="i">
                            <button @click="rating = i" class="focus:outline-none">
                                <svg class="w-8 h-8" :class="i <= rating ? 'text-yellow-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </button>
                        </template>
                    </div>
                </div>
    
                <!-- Review Text Area -->
                <div class="mt-6">
                    <textarea 
                        class="w-full border border-gray-300 rounded-lg p-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        rows="4" 
                        placeholder="Berikan Ulasan Anda">
                    </textarea>
                </div>
            </div>
    
            <!-- Footer Button -->
            <div class="px-6 pb-6">
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg" @click="modalOpen = false">
                    Beri ulasan
                </button>
            </div>
        </div>
    </div>
    
    <!-- Expanded details section -->
    <div x-show="detailsOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="border-t border-gray-200 my-4"></div>
        <!-- Detail Pembelian -->
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Detail Pembelian</h3>
            
            <div class="grid grid-cols-1 gap-3">
                <div>
                    <p class="text-sm text-gray-600">Nomor invoice:</p>
                    <p class="text-sm">invoice-setiady-66077394</p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Status:</p>
                    <div class="flex items-center mt-1">
                        <div class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-[14px] mt-1 mr-2">
                            Selesai
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="border-t border-gray-200 my-4"></div>
        
        <!-- Ringkasan Pembelian -->
        <div>
            <h3 class="text-lg font-medium text-gray-800 mb-4">Ringkasan Pembelian</h3>
            
            <div>
                <div class="flex justify-between py-2 text-base">
                    <span class="text-gray-600">Total harga</span>
                    <span class="font-medium">Rp 120.000</span>
                </div>
                
                <div class="flex justify-between py-2 text-base">
                    <span class="text-gray-600">Biaya pelayanan</span>
                    <span class="font-medium">Rp 2.000</span>
                </div>
                
                <div class="border-t border-gray-200 my-2"></div>
                
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