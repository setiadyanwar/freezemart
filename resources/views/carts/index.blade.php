@extends('templates.master')

@section('content')
    <section class="mt-8 bg-white py-8 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="flex items-center mb-6">
                <a href="/beranda" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Beranda</a>
                <span class="mx-2">›</span>
                <span class="text-gray-900 dark:text-white">Keranjang</span>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Keranjang Belanja</h2>

            <form action="/buy-from-cart" method="post">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <div class="mb-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox rounded text-blue-600" id="select-all">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Pilih Semua({{ $myCarts ? $myCarts->count() : 0 }})</span>
                            </label>
                        </div>

                        @php
                            // Kelompokkan produk berdasarkan ID agar tidak duplikat
                            $groupedCarts = $myCarts->groupBy('product_id');
                        @endphp

                        @foreach ($groupedCarts as $group)
                            @php
                                // Ambil produk pertama dari grup
                                $cartItem = $group->first();
                                $quantity = $group->count();
                                $totalPrice = $cartItem->product->price * $quantity;
                            @endphp

                            <div class="flex items-center mb-4 border border-gray-200 rounded-lg p-4 dark:border-gray-700">
                                <div class="flex-shrink-0 mr-3">
                                    <input type="checkbox" class="form-checkbox rounded text-blue-600 product-checkbox" 
                                           name="selected_products[]" value="{{ $cartItem->product->slug }}">
                                </div>
                                <div class="flex flex-1 items-center">
                                    <img class="w-20 h-20 object-cover rounded-lg mr-4" 
                                         src="{{ asset('storage/' . $cartItem->product->image) }}" 
                                         alt="{{ $cartItem->product->name }}">
                                    
                                    <div class="flex-1">
                                        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                            <div>
                                                <a href="/products/{{ $cartItem->product->slug }}" 
                                                   class="text-lg font-medium text-gray-900 dark:text-white hover:text-blue-600">
                                                    {{ $cartItem->product->name }}
                                                </a>
                                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                                        Fiesta
                                                    </span>
                                                </div>
                                                <p class="text-lg font-bold text-gray-900 dark:text-white mt-2">
                                                    Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            
                                            <div class="mt-3 md:mt-0 flex flex-col md:items-end">
                                                <a href="/cart-remove/{{ $cartItem->id }}" 
                                                   class="remove-product-from-cart mb-3 flex justify-end">
                                                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                                
                                                <div class="flex items-center mt-2">
                                                    <div class="flex items-center">
                                                        <button type="button" 
                                                                data-target="counter-input-{{ $cartItem->product->slug }}" 
                                                                class="decrement-qty w-8 h-8 flex items-center justify-center text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                            </svg>
                                                        </button>
                                                        
                                                        <input type="text" 
                                                               id="counter-input-{{ $cartItem->product->slug }}" 
                                                               class="quantity w-10 text-center bg-transparent border-0 text-gray-900" 
                                                               value="{{ $quantity }}" 
                                                               min="1" 
                                                               data-price="{{ $cartItem->product->price }}" 
                                                               data-slug="{{ $cartItem->product->slug }}"
                                                               required 
                                                               readonly />
                                                        
                                                        <button type="button" 
                                                                data-target="counter-input-{{ $cartItem->product->slug }}" 
                                                                class="increment-qty w-8 h-8 flex items-center justify-center text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200">
                                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Hidden inputs for products and quantities -->
                        <div id="hidden-inputs-container"></div>
                    </div>
                    
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 sticky top-40">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Ringkasan Pembelian</h3>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Total harga</span>
                                    <span class="font-medium text-gray-900 dark:text-white" id="price-total">Rp 0</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Biaya pelayanan</span>
                                    <span class="font-medium text-gray-900 dark:text-white">Rp 2.000</span>
                                </div>
                                
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                                    <div class="flex justify-between items-center">
                                        <span class="text-lg font-semibold text-gray-900 dark:text-white">Total</span>
                                        <span class="text-lg font-semibold text-gray-900 dark:text-white" id="buy-total">Rp 2.000</span>
                                    </div>
                                </div>
                                
                                <button type="submit" id="checkout-button"
                                class="flex w-full items-center justify-center rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed" disabled>Checkout</button>

                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> atau </span>
                                    <a href="/products"
                                        class="inline-flex items-center gap-2 text-sm font-medium text-primary-500 underline hover:no-underline dark:text-primary-500">
                                        Lanjutkan belanja
                                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

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

@section('js-bottom')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    // 1) Ambil elemen, cek eksistensi
    const selectAllCheckbox    = document.getElementById('select-all');
    const productCheckboxes    = document.querySelectorAll('.product-checkbox');
    const decrementButtons     = document.querySelectorAll('button.decrement-qty');
    const incrementButtons     = document.querySelectorAll('button.increment-qty');
    const priceTotalElement    = document.getElementById('price-total');
    const buyTotalElement      = document.getElementById('buy-total');
    const checkoutButton       = document.getElementById('checkout-button');
    const hiddenInputsContainer= document.getElementById('hidden-inputs-container');

    console.log({ selectAllCheckbox, productCheckboxes, priceTotalElement, buyTotalElement, checkoutButton, hiddenInputsContainer });

    // abort jika elemen inti tidak ditemukan
    if (!priceTotalElement || !buyTotalElement || !hiddenInputsContainer) {
      console.warn('❗️ Elemen inti tidak ditemukan, script dibatalkan');
      return;
    }

    // Jika tidak ada produk di keranjang
    if (productCheckboxes.length === 0) {
      priceTotalElement.textContent = 'Rp 0';
      buyTotalElement.textContent = 'Rp 2.000';
      if (checkoutButton) {
        checkoutButton.disabled = true;
        checkoutButton.textContent = 'Checkout (0) Produk';
      }
      return;
    }

    // helper: rebuild hidden inputs
    function updateHiddenFields() {
      hiddenInputsContainer.innerHTML = '';
      productCheckboxes.forEach((cb, i) => {
        if (cb.checked) {
          const inputQty = document.querySelectorAll('input.quantity')[i];
          const slug     = inputQty?.dataset.slug;
          const qty      = inputQty?.value;
          if (slug && qty) {
            hiddenInputsContainer.insertAdjacentHTML('beforeend',
              `<input type="hidden" name="products[]" value="${slug}">
               <input type="hidden" name="quantities[]" value="${qty}">`);
          }
        }
      });
    }

    // helper: hitung & update harga
    function calculateTotalPrice() {
      let total = 0, count = 0;
      document.querySelectorAll('input.quantity').forEach((input, i) => {
        if (productCheckboxes[i].checked) {
          const price = parseInt(input.dataset.price, 10) || 0;
          const qty   = parseInt(input.value, 10) || 0;
          total += price * qty;
          count++;
        }
      });
      priceTotalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
      buyTotalElement.textContent   = `Rp ${(total + 2000).toLocaleString('id-ID')}`;
      
      if (checkoutButton) {
        checkoutButton.textContent = `Checkout (${count}) Produk`;
        // Disable checkout button if no products selected
        checkoutButton.disabled = count === 0;
      }
      
      updateHiddenFields();
    }

    // event: select all
    if (selectAllCheckbox) {
      selectAllCheckbox.addEventListener('change', () => {
        productCheckboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
        calculateTotalPrice();
      });
    }

    // event: per-item checkbox
    productCheckboxes.forEach(cb => cb.addEventListener('change', () => {
      calculateTotalPrice();
      if (selectAllCheckbox) {
        selectAllCheckbox.checked = [...productCheckboxes].every(x => x.checked);
      }
    }));

    // event: qty buttons
    decrementButtons.forEach(btn => btn.addEventListener('click', () => {
      const input = document.getElementById(btn.dataset.target);
      if (input && parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        calculateTotalPrice();
      }
    }));
    
    incrementButtons.forEach(btn => btn.addEventListener('click', () => {
      const input = document.getElementById(btn.dataset.target);
      if (input) {
        input.value = parseInt(input.value) + 1;
        calculateTotalPrice();
      }
    }));

    // default: cek 1 item pertama dan hitung sekali
    if (productCheckboxes.length) {
      productCheckboxes[0].checked = true;
      calculateTotalPrice();
    } else {
      // Jika tidak ada produk, pastikan total harga 0
      priceTotalElement.textContent = 'Rp 0';
      buyTotalElement.textContent = 'Rp 2.000';
      if (checkoutButton) {
        checkoutButton.disabled = true;
      }
    }
  });
</script>
@endsection
