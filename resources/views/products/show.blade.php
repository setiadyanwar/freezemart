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
                    <div class="relative overflow-hidden rounded-lg bg-gray-50 p-4" id="img-container">
                        <img id="product-img" class="h-auto max-h-[400px] w-full object-contain"
                            src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                        <div id="magnifier-lens"
                            class="pointer-events-none absolute hidden h-32 w-32 rounded-full border-2 border-primary-500 bg-white opacity-0 transition-opacity duration-200">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="mt-6 lg:mt-0 lg:w-7/12">
                    <h1 class="text-2xl font-semibold text-gray-900">{{ $product->name }}</h1>

                    <div class="mt-2 flex items-center">
                        <div class="items-cente flex">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="{{ $i <= round($average_rating) ? 'text-[#FFCA00]' : 'text-gray-300' }} h-5 w-5"
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

                    <div x-data="{ expanded: false }" class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900">Deskripsi Produk</h3>
                        <p class="mt-2 text-gray-600">
                            <span x-show="!expanded">
                                {{ \Illuminate\Support\Str::limit($product->description, 150) }}
                                <span x-show="{{ strlen($product->description) > 150 ? 'true' : 'false' }}">
                                    ...
                                    <a href="#" @click.prevent="expanded = true"
                                        class="text-primary-600 hover:underline">Selengkapnya</a>
                                </span>
                            </span>
                            <span x-show="expanded" x-cloak>
                                {{ $product->description }}
                                <a href="#" @click.prevent="expanded = false"
                                    class="text-primary-600 hover:underline">Tampilkan lebih sedikit</a>
                            </span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="bg-white py-4 sm:py-8">
        <div class="mx-auto max-w-screen-xl px-4">
            <h2 class="mb-4 text-xl font-semibold text-gray-900 sm:mb-6">Ulasan Pembeli</h2>

            <div class="rounded-lg border border-gray-200 p-4 sm:p-6">
                <!-- Rating Summary -->
                <div class="flex flex-col sm:flex-row">
                    <!-- Star Rating -->
                    <div class="mb-4 sm:mb-0 sm:mr-8 sm:w-1/4">
                        <div class="flex items-center">
                            <svg class="h-8 w-8 text-[#FFCA00] sm:h-10 sm:w-10" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <span
                                class="ml-2 text-3xl font-bold text-gray-900 sm:text-4xl">{{ number_format($product->comments->avg('rating'), 1) }}</span>
                            <span class="ml-1 text-gray-500">/5.0</span>
                        </div>

                        <div class="mt-1 text-sm text-gray-500">
                            <span>{{ $total_reviews }} ulasan • {{ number_format($product->comments->avg('rating'), 1) }}
                                rating</span>
                        </div>
                    </div>

                    <!-- Rating Bars -->
                    <div class="w-full">
                        <div class="grid grid-cols-1 gap-x-4 gap-y-2 sm:grid-cols-2 sm:gap-x-16">
                            @foreach ($ratingBars as $star => $info)
                                <div class="flex items-center">
                                    <span class="mr-2 text-sm">{{ $star }}</span>
                                    <svg class="h-4 w-4 text-[#FFCA00]" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                    </svg>
                                    <div class="mx-2 h-2 w-full rounded-full bg-gray-200">
                                        <div class="h-2 rounded-full bg-primary-600"
                                            style="width: {{ $info['percentage'] }}%"></div>
                                    </div>
                                    <span
                                        class="min-w-[30px] text-right text-xs text-gray-500">({{ $info['count'] }})</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>


            <!-- Reviews List -->
            <div class="my-4 w-auto sm:my-8">
                @forelse ($product->comments as $comment)
                    <div class="mb-4 border-b border-gray-200 pb-4 sm:mb-6 sm:pb-6">
                        <div class="flex">
                            <div class="mr-3 flex-shrink-0 sm:mr-4">
                                <div class="h-8 w-8 overflow-hidden rounded-full bg-gray-100 sm:h-10 sm:w-10">
                                    <img src="{{ $comment->user && $comment->user->photo ? asset('storage/photos/' . $comment->user->photo) : asset('assets/Avatars.png') }}"
                                        alt="{{ $comment->user->name ?? 'User' }}" class="h-full w-full object-cover" />
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center justify-between gap-2">
                                    <p class="text-sm font-medium text-gray-900 sm:text-base">
                                        {{ $comment->user->name ?? '-' }}
                                        <span
                                            class="ml-1 text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>

                                <!-- Stars -->
                                <div class="mt-1 flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="{{ $i <= $comment->rating ? 'text-[#FFCA00]' : 'text-gray-300' }} h-3 w-3 sm:h-4 sm:w-4"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                    @endfor
                                </div>

                                <!-- Comment Content -->
                                <p class="mt-2 break-words text-sm text-gray-700 sm:text-base">
                                    {{ $comment->content }}
                                </p>

                                <!-- Reply Toggle -->
                                <div x-data="{ open: false }" class="mt-2">
                                    <button @click="open = !open"
                                        class="flex items-center text-xs text-gray-500 hover:text-gray-700 focus:outline-none">
                                        <span x-text="open ? 'sembunyikan balasan' : 'lihat balasan'"></span>
                                        <svg class="ml-1 h-3 w-3 sm:h-4 sm:w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <!-- Admin Feedback -->
                                    <div x-show="open" x-transition
                                        class="mt-2 rounded-md bg-gray-100 p-3 text-sm text-gray-700">
                                        @if ($comment->admin_feedback)
                                            <p><span class="font-semibold">Balasan Admin:</span>
                                                {{ $comment->admin_feedback }}</p>
                                        @else
                                            <p class="italic text-gray-400">Belum ada balasan dari admin.</p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada ulasan untuk produk ini.</p>
                @endforelse

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $comments->links() }}
                </div>
            </div>

        </div>
    </section>

    @if (session('success'))
        <div id="toast-bottom-right"
            class="fixed bottom-5 right-5 z-50 flex w-auto max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow-lg dark:bg-gray-800 dark:text-gray-400"
            role="alert">
            <div
                class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-500 dark:bg-green-800 dark:text-green-200">
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">{{ session('success') }}</div>
            <button type="button"
                class="-mx-1.5 -my-1.5 ml-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300 dark:bg-gray-800 dark:text-gray-500 dark:hover:bg-gray-700 dark:hover:text-white"
                data-dismiss-target="#toast-bottom-right" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                    lens.style.backgroundSize = (container.offsetWidth * zoom) + "px " + (container.offsetHeight *
                        zoom) + "px";
                    lens.style.backgroundPosition = "-" + (bgX) + "px -" + (bgY) + "px";
                }

                // Get cursor position relative to container
                function getCursorPos(e) {
                    const rect = container.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    return {
                        x,
                        y
                    };
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

    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
