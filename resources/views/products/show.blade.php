@extends('templates.master')

@section('content')
<section class="bg-white">
    <!-- Breadcrumb -->
    <div class="mx-auto max-w-screen-xl px-4 py-4 pt-28">
        <div class="flex items-center text-sm">
            <a href="/products" class="text-gray-500 hover:text-gray-700">Produk</a>
            <span class="mx-2 text-gray-500">></span>
            <span class="text-gray-700">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Product Detail -->
    <div class="mx-auto max-w-screen-xl px-4">
        <div class="flex flex-col lg:flex-row lg:gap-16">
            <!-- Product Image with Magnifier -->
            <div class="lg:w-3/5">
                <div class="overflow-hidden rounded-lg bg-gray-50 p-4 relative" id="img-container">
                    <img id="product-img" class="w-full" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                    <div id="magnifier-lens" class="hidden absolute pointer-events-none border-2 border-primary-500 rounded-full w-32 h-32 bg-white opacity-0 transition-opacity duration-200"></div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="mt-6 lg:mt-0 lg:w-7/12">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $product->name }}</h1>
                
                <div class="mt-2 flex items-center">
                    <div class="flex items-center text-primary-500">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="{{ $i <= round($average_rating) ? 'text-primary-500' : 'text-gray-300' }} h-5 w-5"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495
                                                            2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992
                                                            2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39
                                                            3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="ml-2 text-sm text-gray-500">
                        {{ $average_rating }} | {{ $total_reviews }} ulasan
                    </p>
                </div>

                <div class="mt-4">
                    <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="mt-6">
                    <form action="/carts/{{ $product->slug }}" method="post">
                        @csrf
                        <button type="submit"
                            class="w-full rounded-lg bg-primary-600 px-5 py-3 text-center text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-300"
                            role="button">
                            <svg class="-ms-1 me-2 inline h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>
                            Tambahkan Keranjang
                        </button>
                    </form>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900">Deskripsi Produk</h3>
                    <p class="mt-2 text-gray-600">
                        Nikmati sensasi panas yang tak tertandingi dengan Chicken Nugget Hotaz! Setiap potongan nugget yang renyah ini dibumbui dengan campuran rahasia rempah-rempah pedas kami, memberikan tendangan berani dan memuaskan yang akan membuat lidah Anda berdansa. Renyah di luar dan lembut di dalam, nugget ini sempurna untuk Anda yang menginginkan petualangan di setiap gigitan. 
                        <a href="#" class="text-primary-600 hover:underline">Selengkapnya</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="bg-white py-4 sm:py-8">
    <div class="mx-auto max-w-screen-xl px-4">
        <h2 class="mb-4 sm:mb-6 text-xl font-semibold text-gray-900">Ulasan Pembeli</h2>
        
        <div class="rounded-lg border border-gray-200 p-4 sm:p-6">
            <!-- Rating Summary -->
            <div class="flex flex-col sm:flex-row">
                <!-- Star Rating -->
                <div class="mb-4 sm:mb-0 sm:mr-8 sm:w-1/4">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 sm:h-10 sm:w-10 text-[#FFCA00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                        <span class="ml-2 text-3xl sm:text-4xl font-bold text-gray-900">4.8</span>
                        <span class="ml-1 text-gray-500">/5.0</span>
                    </div>
                    
                    <div class="mt-1 text-sm text-gray-500">
                        <span>50 ulasan • 210 rating</span>
                    </div>
                </div>
                
                <!-- Rating Bars -->
                <div class="w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 sm:gap-x-16 gap-y-2">
                        <div class="flex items-center">
                            <span class="mr-2 text-sm">5</span>
                            <svg class="h-4 w-4 text-[#FFCA00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="mx-2 h-2 w-full rounded-full bg-gray-200">
                                <div class="h-2 rounded-full bg-primary-600" style="width: 70%"></div>
                            </div>
                            <span class="text-xs text-gray-500 min-w-[30px] text-right">(120)</span>
                        </div>
                        
                        <div class="flex items-center">
                            <span class="mr-2 text-sm">4</span>
                            <svg class="h-4 w-4 text-[#FFCA00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="mx-2 h-2 w-full rounded-full bg-gray-200">
                                <div class="h-2 rounded-full bg-primary-600" style="width: 80%"></div>
                            </div>
                            <span class="text-xs text-gray-500 min-w-[30px] text-right">(200)</span>
                        </div>
                        
                        <div class="flex items-center">
                            <span class="mr-2 text-sm">3</span>
                            <svg class="h-4 w-4 text-[#FFCA00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="mx-2 h-2 w-full rounded-full bg-gray-200">
                                <div class="h-2 rounded-full bg-primary-600" style="width: 25%"></div>
                            </div>
                            <span class="text-xs text-gray-500 min-w-[30px] text-right">(10)</span>
                        </div>
                        
                        <div class="flex items-center">
                            <span class="mr-2 text-sm">2</span>
                            <svg class="h-4 w-4 text-[#FFCA00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="mx-2 h-2 w-full rounded-full bg-gray-200">
                                <div class="h-2 rounded-full bg-primary-600" style="width: 5%"></div>
                            </div>
                            <span class="text-xs text-gray-500 min-w-[30px] text-right">(1)</span>
                        </div>
                        
                        <div class="flex items-center">
                            <span class="mr-2 text-sm">1</span>
                            <svg class="h-4 w-4 text-[#FFCA00]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="mx-2 h-2 w-full rounded-full bg-gray-200">
                                <div class="h-2 rounded-full bg-primary-600" style="width: 5%"></div>
                            </div>
                            <span class="text-xs text-gray-500 min-w-[30px] text-right">(1)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reviews List -->
        <div class="w-auto my-4 sm:my-8">
            <!-- Review Item 1 -->
            <div class="mb-4 sm:mb-6 border-b border-gray-200 pb-4 sm:pb-6">
                <div class="flex">
                    <div class="mr-3 sm:mr-4 flex-shrink-0">
                        <div class="h-8 w-8 sm:h-10 sm:w-10 overflow-hidden rounded-full bg-gray-100">
                            <img src="https://via.placeholder.com/40" alt="Anton H.d" class="h-full w-full object-cover" />
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <p class="font-medium text-gray-900 text-sm sm:text-base">Anton H.d <span class="ml-1 text-xs text-gray-500">kemarin</span></p>
                            <div class="rounded-full border border-gray-200 px-2 py-1 sm:px-3 sm:py-1 text-xs">
                                <button class="flex items-center">
                                    <span>Terbaru</span>
                                    <svg class="ml-1 h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-1 flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-3 w-3 sm:h-4 sm:w-4 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="mt-2 text-gray-700 text-sm sm:text-base break-words">Sangat recomended banget, otw jadi langganan nih.</p>
                        <div class="mt-2">
                            <button class="flex items-center text-xs text-gray-500 hover:text-gray-700">
                                <span>lihat balasan</span>
                                <svg class="ml-1 h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Review Item 2 -->
            <div class="border-b border-gray-200 pb-4 sm:pb-6">
                <div class="flex">
                    <div class="mr-3 sm:mr-4 flex-shrink-0">
                        <div class="h-8 w-8 sm:h-10 sm:w-10 overflow-hidden rounded-full bg-gray-100">
                            <img src="https://via.placeholder.com/40" alt="Anton H.d" class="h-full w-full object-cover" />
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 text-sm sm:text-base">Anton H.d <span class="ml-1 text-xs text-gray-500">kemarin</span></p>
                        <div class="mt-1 flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-3 w-3 sm:h-4 sm:w-4 text-primary-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="mt-2 text-gray-700 text-sm sm:text-base break-words">Sangat recomended banget, otw jadi langganan nih.</p>
                        <div class="mt-2">
                            <button class="flex items-center text-xs text-gray-500 hover:text-gray-700">
                                <span>lihat balasan</span>
                                <svg class="ml-1 h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="mt-4 sm:mt-6 flex items-center gap-2">
                <button class="flex h-7 w-7 sm:h-8 sm:w-8 items-center justify-center rounded-full text-gray-500 hover:bg-gray-100">
                    <svg class="h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <div class="flex items-center space-x-1 sm:space-x-2">
                    <button class="flex h-7 w-7 sm:h-8 sm:w-8 items-center justify-center rounded-full bg-primary-600 text-white">1</button>
                    <button class="flex h-7 w-7 sm:h-8 sm:w-8 items-center justify-center rounded-full text-gray-500 hover:bg-gray-100">2</button>
                    <button class="flex h-7 w-7 sm:h-8 sm:w-8 items-center justify-center rounded-full text-gray-500 hover:bg-gray-100">
                        <svg class="h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@if (session('success'))
    <div id="toast-bottom-right"
        class="fixed bottom-5 right-5 z-50 flex w-auto max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow-lg dark:bg-gray-800 dark:text-gray-400"
        role="alert">
        <div class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-500 dark:bg-green-800 dark:text-green-200">
            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{ session('success') }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-bottom-right" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Magnifier functionality
        const container = document.getElementById('img-container');
        const img = document.getElementById('product-img');
        const lens = document.getElementById('magnifier-lens');
        
        if (container && img && lens) {
            // Magnification level
            const zoom = 2;
            
            // Initialize magnifier
            function initMagnifier() {
                // Show lens on mouse enter
                container.addEventListener('mouseenter', function() {
                    lens.classList.remove('hidden');
                    setTimeout(() => {
                        lens.style.opacity = '1';
                    }, 50);
                });
                
                // Hide lens on mouse leave
                container.addEventListener('mouseleave', function() {
                    lens.style.opacity = '0';
                    setTimeout(() => {
                        lens.classList.add('hidden');
                    }, 200);
                });
                
                // Move lens with mouse
                container.addEventListener('mousemove', moveMagnifier);
            }
            
            // Move magnifier function
            function moveMagnifier(e) {
                e.preventDefault();
                
                // Get cursor position
                const pos = getCursorPos(e);
                
                // Calculate lens position
                let x = pos.x - (lens.offsetWidth / 2);
                let y = pos.y - (lens.offsetHeight / 2);
                
                // Prevent lens from going outside the image
                if (x > container.offsetWidth - lens.offsetWidth) {
                    x = container.offsetWidth - lens.offsetWidth;
                }
                if (x < 0) {
                    x = 0;
                }
                if (y > container.offsetHeight - lens.offsetHeight) {
                    y = container.offsetHeight - lens.offsetHeight;
                }
                if (y < 0) {
                    y = 0;
                }
                
                // Set lens position
                lens.style.left = x + "px";
                lens.style.top = y + "px";
                
                // Calculate background position for the lens
                const bgX = x * zoom;
                const bgY = y * zoom;
                
                // Set background image and position for the lens
                lens.style.backgroundImage = `url('${img.src}')`;
                lens.style.backgroundSize = (container.offsetWidth * zoom) + "px " + (container.offsetHeight * zoom) + "px";
                lens.style.backgroundPosition = "-" + (bgX) + "px -" + (bgY) + "px";
            }
            
            // Get cursor position relative to container
            function getCursorPos(e) {
                const rect = container.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                return { x, y };
            }
            
            // Initialize magnifier if image exists
            if (img.complete) {
                initMagnifier();
            } else {
                img.onload = initMagnifier;
            }
        }
        
        // Toast notification
        if (document.getElementById('toast-bottom-right')) {
            setTimeout(() => {
                const toast = document.getElementById('toast-bottom-right');
                if (toast) {
                    toast.classList.add('opacity-0', 'translate-x-full');
                    toast.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 3000);
        }
    });
</script>
@endsection
