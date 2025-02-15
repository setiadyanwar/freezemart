@extends('templates.master')

@section('content')

<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16 mt-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl mb-6">Daftar Pembelian</h2>

        @if(count($checkouts) > 0)
        <div id="accordion-collapse" data-accordion="collapse" class="mb-3">
            @foreach( $checkouts as $checkout )
            <h2 id="accordion-collapse-heading-{{ $loop->iteration }}" class="mt-3">
                <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3 rounded-t-lg" data-accordion-target="#accordion-collapse-body-{{ $loop->iteration }}" aria-expanded="false" aria-controls="accordion-collapse-body-{{ $loop->iteration }}">
                    <span>
                        Pembelian {{ $checkout->orders[0]->product->name }}
                        {{ count($checkout->orders) > 1 ? ' dan ' . count($checkout->orders) - 1 . ' lainnya.' : '' }}
                        ({{ $checkout->created_at->format('d F Y') }})
                    </span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
            </h2>
            <div id="accordion-collapse-body-{{ $loop->iteration }}" class="hidden rounded-b-lg mb-3" aria-labelledby="accordion-collapse-heading-{{ $loop->iteration }}">
                <div class="p-5 border border-gray-200 dark:border-gray-700 rounded-b-lg">
                    <section class="bg-white py-8 antialiased dark:bg-gray-900">
                        <div class="">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Detail Pembelian</h2>
                            <div class="mt-6 space-y-4 border-b border-t border-gray-200 py-8 dark:border-gray-700 sm:mt-8">
                                <dl>
                                    <dt class="text-base font-medium text-gray-900 dark:text-white">No. Invoice</dt>
                                    <dd class="mt-1 text-base font-normal text-gray-500 dark:text-gray-400 mb-2">{{ $checkout->external_id }}</dd>
                                    <dt class="text-base font-medium text-gray-900 dark:text-white">Tanggal Pembelian</dt>
                                    <dd class="mt-1 text-base font-normal text-gray-500 dark:text-gray-400 mb-2">{{ $checkout->created_at->format('d F Y') }}</dd>
                                    <dt class="text-base font-medium text-gray-900 dark:text-white">Status</dt>
                                    <dd class="mt-1 text-base font-normal text-gray-500 dark:text-gray-400 mb-2">{{ $checkout->status }}</dd>
                                </dl>
                                @if($checkout->status == 'PENDING' && $checkout->checkout_link)
                                    <div class="mt-4">
                                        <a href="{{ $checkout->checkout_link }}" target="_blank"
                                        class="inline-block px-5 py-2.5 text-sm font-medium text-white bg-blue-500 hover:bg-blue-700 rounded-lg">
                                            Lanjutkan Pembayaran
                                        </a>
                                    </div>
                                @endif
                            </div>


                            <div class="mt-6 sm:mt-8">
                                <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
                                    <table class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                            @foreach( $checkout->orders as $order)
                                            <tr>
                                                <td class="whitespace-nowrap py-4">
                                                    <div class="flex items-center gap-4">
                                                        <a href="#" class="flex items-center aspect-square w-10 h-10 shrink-0">
                                                        <img class="h-auto w-full max-h-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" />
                                                        </a>
                                                        <a href="#" class="hover:underline">{{ $order->product->name }}</a>
                                                    </div>
                                                </td>
                                                <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">Rp {{ number_format($order->product->price, 0, ',', '.') }} <span class="text-base font-normal text-gray-900 dark:text-white">x {{ $order->quantity }}</span></td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4 space-y-6">
                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Rincian Pembayaran</h4>

                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-gray-500 dark:text-gray-400">Total Harga Produk</dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">Rp {{ number_format($checkout->price_total - $checkout->service, 0, ',', '.') }}</dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4">
                                            <dt class="text-gray-500 dark:text-gray-400">Biaya Pelayanan</dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">Rp {{ number_format($checkout->service, 0, ',', '.') }}</dd>
                                        </dl>
                                    </div>
                                    <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                        <dt class="text-lg font-bold text-gray-900 dark:text-white">Total Belanja</dt>
                                        <dd class="text-lg font-bold text-gray-900 dark:text-white">Rp {{ number_format($checkout->price_total, 0, ',', '.') }}</dd>
                                    </dl>
                                </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-base font-normal text-gray-500 dark:text-gray-400 mb-2">Belum ada pembelian</p>
        @endif


    </div>

</section>

@endsection

