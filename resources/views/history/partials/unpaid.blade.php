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

        <!-- Produk pertama -->
        <div class="mt-4 flex items-center">
            <div class="flex-shrink-0">
                <div class="flex h-20 w-20 items-center justify-center overflow-hidden rounded-md bg-orange-100">
                    <img class="h-16 w-16 object-cover" src="{{ asset('storage/' . $firstOrder->product->image) }}"
                        alt="Product Image" />
                </div>
            </div>

            <div class="ml-4 flex-grow">
                <div class="text-lg font-medium text-gray-800">{{ $firstOrder->product->name }}</div>
                <div class="mr-2 mt-1 inline-block rounded-[14px] bg-yellow-100 px-2 py-1 text-xs text-yellow-600">
                    Belum Bayar
                </div>
                <div class="mt-1 inline-block rounded-[14px] bg-gray-100 px-2 py-1 text-xs text-gray-600">
                    Menunggu Pembayaran
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
                <a href="{{ $firstOrder->checkout->checkout_link }}"
                    class="mt-2 inline-block rounded-[14px] bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                    Lanjutkan Pembayaran
                </a>
            </div>
        </div>

        <!-- Produk lainnya (hidden dulu) -->
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
                        <div
                            class="mr-2 mt-1 inline-block rounded-[14px] bg-yellow-100 px-2 py-1 text-xs text-yellow-600">
                            Belum Bayar
                        </div>
                        <div class="mt-1 inline-block rounded-[14px] bg-gray-100 px-2 py-1 text-xs text-gray-600">
                            Menunggu Pembayaran
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
                            Rp {{ number_format($order->product->price * $order->quantity, 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-500">x{{ $order->quantity }}</div>
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
                                class="mr-2 inline-block rounded-[14px] bg-yellow-100 px-2 py-1 text-xs text-yellow-600">
                                Belum Bayar
                            </div>
                            <div class="inline-block rounded-[14px] bg-gray-100 px-2 py-1 text-xs text-gray-600">
                                Menunggu Pembayaran
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
                        <span class="font-medium">
                            Rp
                            {{ number_format($firstOrder->checkout->price_total - $firstOrder->checkout->service, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between py-2 text-base">
                        <span class="text-gray-600">Biaya pelayanan</span>
                        <span class="font-medium">
                            Rp {{ number_format($firstOrder->checkout->service, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="my-2 border-t border-gray-200"></div>

                    <div class="flex justify-between py-2 font-semibold">
                        <span>Total Belanja</span>
                        <span>Rp {{ number_format($firstOrder->checkout->price_total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    function toggleDetails(button) {
        const detailsSection = button.closest('.mx-auto').querySelector('.detailsSection');
        const toggleText = button.querySelector('.toggleText');
        const toggleIcon = button.querySelector('.toggleIcon');

        if (detailsSection.style.display === 'none' || detailsSection.classList.contains('hidden')) {
            detailsSection.classList.remove('hidden');
            toggleText.textContent = 'Sembunyikan';
            toggleIcon.classList.add('rotate-180');
        } else {
            detailsSection.classList.add('hidden');
            toggleText.textContent = 'Lihat selengkapnya';
            toggleIcon.classList.remove('rotate-180');
        }
    }
</script>
