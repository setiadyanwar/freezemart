@foreach ($groupedOrders as $groupTime => $orders)
    @php
        $firstOrder = $orders->first();
    @endphp
    <div class="mx-auto mb-6 w-full rounded-lg border border-gray-100 bg-white p-4 shadow-sm">
        <!-- Header section with toggle button -->
        <div class="flex items-center justify-between">
            @php
                $firstProductName = $firstOrder->product->name;
                $totalProducts = $orders->count();
            @endphp

            <div class="text-xl text-gray-600">
                Pembelian {{ $firstProductName }}
                @if ($totalProducts > 1)
                    dan {{ $totalProducts - 1 }} lainnya
                @endif
            </div>
            <div class="flex cursor-pointer items-center text-sm text-blue-600" onclick="toggleDetails(this)">
                <span class="toggleText">Lihat selengkapnya</span>
                <svg class="toggleIcon ml-1 h-4 w-4 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>

        <!-- Produk pertama (langsung kelihatan) -->
        <div class="mt-4 flex items-center">
            <div class="flex-shrink-0">
                <div class="flex h-20 w-20 items-center justify-center overflow-hidden rounded-md bg-orange-100">
                    <img class="h-16 w-16 object-cover" src="{{ asset('storage/' . $firstOrder->product->image) }}"
                        alt="Product Image" />
                </div>
            </div>

            <div class="ml-4 flex-grow">
                <div class="text-lg font-medium text-gray-800">{{ $firstOrder->product->name }}</div>
                <div class="mr-2 mt-1 inline-block rounded-[14px] bg-gray-100 px-2 py-1 text-xs text-gray-600">
                    Completed
                </div>
                <div class="flex">
                    <div class="mt-2 text-sm text-black">Tanggal pembelian:</div>
                    <div class="ms-2 mt-2 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($firstOrder->checkout->created_at)->format('d M Y') }}
                    </div>
                </div>
            </div>

            <div class="text-right">
                <div class="font-semibold text-gray-800">
                    Rp {{ number_format($firstOrder->product->price * $firstOrder->quantity, 0, ',', '.') }}
                </div>
                <div class="text-sm text-gray-500">x{{ $firstOrder->quantity }}</div>

                @php
                    $hasReviewed = $firstOrder->product->comments->isNotEmpty();
                @endphp

                <button {{ $hasReviewed ? 'disabled' : '' }} data-modal-target="authentication-modal"
                    data-modal-toggle="authentication-modal" data-product-name="{{ $firstOrder->product->name }}"
                    data-product-id="{{ $firstOrder->product->id }}" data-total-products="{{ $totalProducts }}"
                    class="btn-review mt-2 block w-full rounded-lg bg-blue-700 px-3 py-2 text-center text-xs font-medium text-white hover:bg-blue-800 disabled:bg-gray-400"
                    type="button">
                    {{ $hasReviewed ? 'Sudah diulas' : 'Beri ulasan' }}
                </button>

            </div>
        </div>

        <!-- Produk lainnya (disembunyikan dulu, tampil setelah klik "Lihat Selengkapnya") -->
        <div class="detailsSection hidden">
            @foreach ($orders->skip(1) as $order)
                <div class="mt-4 flex items-center border-t pt-4">
                    <div class="flex-shrink-0">
                        <div
                            class="flex h-20 w-20 items-center justify-center overflow-hidden rounded-md bg-orange-100">
                            <img class="h-16 w-16 object-cover" src="{{ asset('storage/' . $order->product->image) }}"
                                alt="Product Image" />
                        </div>
                    </div>

                    <div class="ml-4 flex-grow">
                        <div class="text-lg font-medium text-gray-800">{{ $order->product->name }}</div>
                        <div class="mr-2 mt-1 inline-block rounded-[14px] bg-gray-100 px-2 py-1 text-xs text-gray-600">
                            Completed
                        </div>
                        <div class="flex">
                            <div class="mt-2 text-sm text-black">Tanggal pembelian:</div>
                            <div class="ms-2 mt-2 text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($order->checkout->created_at)->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="font-semibold text-gray-800">
                            Rp {{ number_format($order->price * $order->quantity, 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-500">x{{ $order->quantity }}</div>

                        <!-- Tambahin button "Beri Ulasan" juga di sini -->
                        @php
                            $hasReviewed = $order->product->comments->isNotEmpty();
                        @endphp

                        <button {{ $hasReviewed ? 'disabled' : '' }} data-modal-target="authentication-modal"
                            data-modal-toggle="authentication-modal" data-product-name="{{ $order->product->name }}"
                            data-product-id="{{ $order->product->id }}" data-total-products="{{ $totalProducts }}"
                            class="btn-review mt-2 block w-full rounded-lg bg-blue-700 px-3 py-2 text-center text-xs font-medium text-white hover:bg-blue-800 disabled:bg-gray-400"
                            type="button">
                            {{ $hasReviewed ? 'Sudah diulas' : 'Beri ulasan' }}
                        </button>

                    </div>
                </div>
            @endforeach


            <!-- Divider -->
            <div class="my-4 border-t border-gray-200"></div>

            <!-- Detail Pembelian -->
            <div class="mb-6">
                <h3 class="mb-4 text-lg font-medium text-gray-800">Detail Pembelian</h3>

                <div class="grid grid-cols-1 gap-3">
                    <div>
                        <p class="text-sm text-gray-600">Nomor invoice:</p>
                        <p class="text-sm">
                            {{ implode('-', array_slice(explode('-', $firstOrder->checkout->external_id), 0, 3)) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Status:</p>
                        <div class="mt-1 flex items-center">
                            <div
                                class="mr-2 mt-1 inline-block rounded-[14px] bg-gray-100 px-2 py-1 text-xs text-gray-600">
                                Completed
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="my-4 border-t border-gray-200"></div>

            <!-- Ringkasan Pembelian -->
            <div class="my-6">
                <h3 class="mb-4 text-lg font-medium text-gray-800">Ringkasan Pembelian</h3>
                <div>
                    <div class="flex justify-between py-2 text-base">
                        <span class="text-gray-600">Total harga</span>
                        <span class="font-medium">
                            Rp
                            {{ number_format($firstOrder->checkout->price_total - $firstOrder->checkout->service, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between py-2 text-base">
                        <span class="text-gray-600">Biaya pelayanan</span>
                        <span class="font-medium">
                            {{ number_format($firstOrder->checkout->service, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="my-2 border-t border-gray-200"></div>
                    <div class="flex justify-between py-2 font-semibold">
                        <span>Total Belanja</span>
                        <span>
                            Rp {{ number_format($firstOrder->checkout->price_total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>



        <!-- Expanded details section -->
        <div class="detailsSection hidden">
            <div class="my-4 border-t border-gray-200"></div>

            <!-- Detail Pembelian -->
            <div class="mb-6">
                <h3 class="mb-4 text-lg font-medium text-gray-800">Detail Pembelian</h3>
                <div class="grid grid-cols-1 gap-3">
                    <div>
                        <p class="text-sm text-gray-600">Nomor Invoice:</p>
                        <p class="text-sm">
                            {{ implode('-', array_slice(explode('-', $firstOrder->checkout->external_id), 0, 3)) }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status:</p>
                        <div class="mt-1 flex items-center">
                            <div class="mr-2 inline-block rounded-[14px] bg-[#DEFFCA] px-2 py-1 text-xs text-[#67A544]">
                                Compeleted
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
                        <span class="font-medium">Rp
                            {{ number_format($orders->sum('checkout.price_total') - $orders->sum('checkout.service'), 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between py-2 text-base">
                        <span class="text-gray-600">Biaya pelayanan</span>
                        <span class="font-medium">Rp
                            {{ number_format($orders->sum('checkout.service'), 0, ',', '.') }}</span>
                    </div>

                    <div class="my-2 border-t border-gray-200"></div>

                    <div class="flex justify-between py-2 font-semibold">
                        <span>Total Belanja</span>
                        <span>Rp {{ number_format($orders->sum('checkout.price_total'), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
    <div class="relative max-h-full w-full max-w-md p-4">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-600 md:p-5">
                <div class="flex-1 text-center">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Beri Review Produk
                    </h3>
                </div>
            </div>

            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="mb-4 flex justify-center">
                    <img id="profile-pic"
                        src="{{ $firstOrder->user && $firstOrder->user->photo ? asset('storage/photos/' . $firstOrder->user->photo) : asset('assets/Avatars.png') }}"
                        class="h-24 w-24 object-cover" alt="Default Avatar">
                </div>
                <div class="flex justify-center">
                    <h4 class="text-xl font-semibold">{{ Auth::user()->name }}</h4>
                </div>
                <div class="mb-2 flex justify-center">
                    <p class="text-base text-gray-500" id="product-name-text">
                    </p>
                </div>
                <form class="space-y-4" action="{{ route('comments.store') }}" method="post">
                    @csrf

                    <!-- Hidden Input for Product ID -->
                    <input type="hidden" name="product_id" id="product-id-input">

                    <!-- Rating Section -->
                    <div class="flex justify-center space-x-1">
                        <span class="star cursor-pointer text-3xl text-gray-400" data-value="1">&#9733;</span>
                        <span class="star cursor-pointer text-3xl text-gray-400" data-value="2">&#9733;</span>
                        <span class="star cursor-pointer text-3xl text-gray-400" data-value="3">&#9733;</span>
                        <span class="star cursor-pointer text-3xl text-gray-400" data-value="4">&#9733;</span>
                        <span class="star cursor-pointer text-3xl text-gray-400" data-value="5">&#9733;</span>
                    </div>

                    <input type="hidden" id="rating" name="rating" value="0">

                    <div class="col-span-2">
                        <textarea name="description" id="description" rows="4"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
                            placeholder="Berikan ulasan Anda"></textarea>
                    </div>
                    <button type="submit"
                        class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Berikan Ulasan Anda
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>








<script>
    function toggleDetails(button) {
        const detailsSection = button.closest('.mx-auto').querySelector('.detailsSection');
        const toggleText = button.querySelector('.toggleText');
        const toggleIcon = button.querySelector('.toggleIcon');

        if (detailsSection.style.display === 'none') {
            detailsSection.style.display = 'block';
            toggleText.textContent = 'Sembunyikan';
            toggleIcon.classList.add('rotate-180');
        } else {
            detailsSection.style.display = 'none';
            toggleText.textContent = 'Lihat selengkapnya';
            toggleIcon.classList.remove('rotate-180');
        }
    }

    // Initialize the expanded view on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Uncomment the line below if you want it to start collapsed
        // document.getElementById('detailsSection').style.display = 'none';
    });

    // Ambil semua elemen star
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    // Tambahkan event click ke setiap star
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const selectedRating = this.getAttribute('data-value');
            ratingInput.value = selectedRating;

            updateStars(selectedRating);
        });
    });

    // Fungsi buat update warna bintang
    function updateStars(rating) {
        stars.forEach(star => {
            const starValue = star.getAttribute('data-value');

            if (starValue <= rating) {
                star.classList.add('text-yellow-300');
                star.classList.remove('text-gray-400');
            } else {
                star.classList.add('text-gray-400');
                star.classList.remove('text-yellow-300');
            }
        });
    }




    document.addEventListener('DOMContentLoaded', function() {
        const reviewButtons = document.querySelectorAll('.btn-review');
        const productNameText = document.getElementById('product-name-text');
        const productIdInput = document.getElementById('product-id-input');

        reviewButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productName = this.getAttribute('data-product-name');
                const productId = this.getAttribute('data-product-id');

                // Set nama produk
                productNameText.innerHTML = productName;

                // Set ID produk di hidden input
                productIdInput.value = productId;
            });
        });
    });
</script>
