@extends('templates.master')

@section('content')

<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16 mt-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Keranjang Belanja</h2>

        <form action="/buy-from-cart" method="post">
            @csrf
            <div class="mt-6 sm:mt-8 grid grid-cols-3 gap-4">
                <div class="col-span-3 sm:col-span-2">

                    @foreach( $myCarts as $cart )
                    <input type="hidden" name="products[]" value="{{ $cart->product->slug }}">
                    <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full dark:border-gray-700 dark:bg-gray-800 mb-3">
                        <img class="object-cover w-full rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-s-lg shadow-sm" src="{{ asset('storage/' . $cart->product->photo) }}" alt="{{ $cart->product->name }}">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <a href="/products/{{ $cart->product->slug }}" class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white">{{ $cart->product->name }}</a>
                            <p class="text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                            <div class="w-full min-w-0 flex-1 md:order-2 md:max-w-md px-3">

                                <div class="flex items-center">
                                    <button type="button" data-target="counter-input-{{ $cart->product->slug }}" class="decrement-qty inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                        <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                        </svg>
                                    </button>
                                    <input type="text" id="counter-input-{{ $cart->product->slug }}" class="quantity w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="1" min="1" data-price="{{ $cart->product->price }}" required readonly name="quantities[]"/>
                                    <button type="button" data-target="counter-input-{{ $cart->product->slug }}" class="increment-qty inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                        <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                        </svg>
                                    </button>
                                </div>
                                <a href="/cart-remove/{{ $cart->id }}" class="remove-product-from-cart inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                    <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                    </svg>
                                    Remove
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="col-span-3 sm:col-span-1">
                    <div class="w-full space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan Pembelian</p>

                        <div class="space-y-4">
                            <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Total Harga</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white" id="price-total">Rp 0</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Biaya Pelayanan</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">Rp 2.000</dd>
                            </dl>
                            </div>

                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white" id="buy-total">Rp. 0</dd>
                            </dl>
                        </div>

                        <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-500">Checkout</button>

                        <div class="flex items-center justify-center gap-2">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> atau </span>
                            <a href="/products" class="inline-flex items-center gap-2 text-sm font-medium text-primary-500 underline hover:no-underline dark:text-primary-500">
                            Lanjutkan belanja
                            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</section>

@if (session('success'))
<div id="toast-bottom-right"
    class="fixed flex items-center w-auto max-w-xs p-4 space-x-3 text-green-500 border-2 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800 rounded-lg right-5 bottom-5 transition-all duration-1000 ease-in-out transform translate-x-0 "
    role="alert">
    <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center">
        <svg aria-hidden="true" class="w-6 h-6 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
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
    document.addEventListener('DOMContentLoaded', function () {
    // Select all quantity inputs
    const quantityInputs = document.querySelectorAll('input.quantity');
    const decrementQty = document.querySelectorAll('button.decrement-qty');
    const incrementQty = document.querySelectorAll('button.increment-qty');
    const priceTotalElement = document.getElementById('price-total');
    const buyTotalElement = document.getElementById('buy-total');

    // Function to calculate total price
    function calculateTotalPrice() {
        const quantityInputs = document.querySelectorAll('input.quantity');
        let totalPrice = 0;

        quantityInputs.forEach(input => {
            const quantity = parseInt(input.value, 10) || 0;
            const price = parseInt(input.dataset.price, 10) || 0;
            totalPrice += quantity * price;
        });

        // Update the total price element
        const priceTotalElement = document.getElementById('price-total');
        priceTotalElement.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        buyTotalElement.textContent = `Rp ${(totalPrice + 2000).toLocaleString('id-ID')}`;
    }

    // Add event listener to decrement buttons
    decrementQty.forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);

            let quantity = parseInt(input.value, 10) || 0;
            if (quantity > 1) {
                input.value = quantity - 1; // Decrease value by 1
                calculateTotalPrice(); // Recalculate total price
            }
        });
    });

    // Add event listener to increment buttons
    incrementQty.forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);

            let quantity = parseInt(input.value, 10) || 0;
            input.value = quantity + 1; // Increase value by 1
            calculateTotalPrice(); // Recalculate total price
        });
    });

    calculateTotalPrice();

});

</script>

@endsection
