<button id="myCartDropdownButton" data-dropdown-toggle="myCartDropdown" type="button"
    class="relative inline-flex items-center rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-700">
    <span class="sr-only">Cart</span>
    <!-- SVG Icon Cart -->
    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        title="Keranjang">
        <path stroke-linecap="round" class="text-gray-800 dark:text-white" stroke-linejoin="round" stroke-width="2"
            d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
    </svg>
    @if (isset($cartCount) && $cartCount > 0)
        <span
            class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-xs font-bold text-white">
            {{ $cartCount }}
        </span>
    @endif
</button>

<!-- Dropdown Cart -->
<div id="myCartDropdown"
    class="z-10 mx-auto hidden max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 shadow-lg dark:bg-gray-800">
    @foreach ($carts->take(5) as $cart)
        <div class="flex items-center space-x-4">
            <img src="{{ $cart->product->image }}" alt="{{ $cart->product->name }}"
                class="h-10 w-10 rounded-lg object-cover">
            <div>
                <a href="/products/{{ $cart->product->slug }}" class="truncate text-sm font-semibold hover:underline">
                    {{ $cart->product->name }}
                </a>
                <p class="mt-0.5 truncate text-sm text-gray-500">
                    Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                </p>
            </div>
        </div>
    @endforeach

    @if (count($carts) > 0)
        <a href="/carts"
            class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">Lihat
            Semua ({{ $cartCount }})</a>
    @else
        <p class="text-gray-800 dark:text-gray-400">Belum ada produk</p>
    @endif
</div>
