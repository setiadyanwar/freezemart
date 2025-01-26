<button id="myCartDropdownButton" data-dropdown-toggle="myCartDropdown" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
    <span class="sr-only">
      Cart
    </span>
    <svg class="w-5 h-5 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
    </svg>
  </button>

  <div id="myCartDropdown" class="hidden z-10 mx-auto max-w-sm space-y-4 overflow-hidden rounded-lg bg-white p-4 antialiased shadow-lg dark:bg-gray-800">
    @foreach( $carts as $cart )
    <div class="grid grid-cols-2">
      <div>
        <a href="/products/{{ $cart->product->slug }}" class="truncate text-sm font-semibold leading-none text-gray-900 dark:text-white hover:underline">{{ $cart->product->name }}</a>
        <p class="mt-0.5 truncate text-sm font-normal text-gray-500 dark:text-gray-400">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
      </div>
    </div>
    @endforeach
    @if( count($carts) > 0 )
    <a href="/carts" class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-orange-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:ring-primary-800">Lihat Semua</a>
    @else
    <p class="ext-gray-800 dark:text-gray-400">Belum ada produk</p>
    @endif
  </div>
