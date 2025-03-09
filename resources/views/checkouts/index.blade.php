@extends('templates.master')

@section('content')

    <section class="mt-16 bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">

            <h2 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Daftar Pembelian</h2>

            @if (count($checkouts) > 0)
                <div id="accordion-collapse" data-accordion="collapse" class="mb-3">
                    @foreach ($checkouts as $checkout)
                        <h2 id="accordion-collapse-heading-{{ $loop->iteration }}" class="mt-3">
                            <button type="button"
                                class="flex w-full items-center justify-between gap-3 rounded-t-lg border border-b-0 border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-800 rtl:text-right"
                                data-accordion-target="#accordion-collapse-body-{{ $loop->iteration }}"
                                aria-expanded="false" aria-controls="accordion-collapse-body-{{ $loop->iteration }}">
                                <span>
                                    Pembelian {{ $checkout->orders[0]->product->name }}
                                    {{ count($checkout->orders) > 1 ? ' dan ' . count($checkout->orders) - 1 . ' lainnya.' : '' }}
                                    ({{ $checkout->created_at->format('d-m-Y') }})
                                </span>
                                <svg data-accordion-icon class="h-3 w-3 shrink-0 rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{ $loop->iteration }}" class="mb-3 hidden rounded-b-lg"
                            aria-labelledby="accordion-collapse-heading-{{ $loop->iteration }}">
                            <div class="rounded-b-lg border border-gray-200 p-5 dark:border-gray-700">
                                <section class="bg-white py-8 antialiased dark:bg-gray-900">
                                    <div class="">
                                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Detail
                                            Pembelian</h2>
                                        <div
                                            class="mt-6 space-y-4 border-b border-t border-gray-200 py-8 dark:border-gray-700 sm:mt-8">
                                            <dl>
                                                <dt class="text-base font-medium text-gray-900 dark:text-white">No. Invoice
                                                </dt>
                                                <dd
                                                    class="mb-2 mt-1 text-base font-normal text-gray-500 dark:text-gray-400">
                                                    {{ $checkout->external_id }}</dd>
                                                <dt class="text-base font-medium text-gray-900 dark:text-white">Tanggal
                                                    Pembelian</dt>
                                                <dd
                                                    class="mb-2 mt-1 text-base font-normal text-gray-500 dark:text-gray-400">
                                                    {{ $checkout->created_at->format('d-m-Y') }}</dd>
                                                <dt class="text-base font-medium text-gray-900 dark:text-white">Status</dt>
                                                <dd
                                                    class="mb-2 mt-1 flex gap-2 text-base font-normal text-gray-500 dark:text-gray-400">
                                                    <span>{{ $checkout->status }}</span>
                                                    <span>Dikemas</span>
                                                </dd>
                                            </dl>
                                            @if ($checkout->status == 'PENDING' && $checkout->checkout_link)
                                                <div class="mt-4">
                                                    <a href="{{ $checkout->checkout_link }}" target="_blank"
                                                        class="inline-block rounded-lg bg-blue-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
                                                        Lanjutkan Pembayaran
                                                    </a>
                                                </div>
                                            @endif
                                        </div>


                                        <div class="mt-6 sm:mt-8">
                                            <div
                                                class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
                                                <table
                                                    class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
                                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                                        @foreach ($checkout->orders as $order)
                                                            <tr>
                                                                <td class="whitespace-nowrap py-4">
                                                                    <div class="flex items-center gap-4">
                                                                        <a href="#"
                                                                            class="flex aspect-square h-10 w-10 shrink-0 items-center">
                                                                            <img class="h-auto max-h-full w-full"
                                                                                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg"
                                                                                alt="imac image" />
                                                                        </a>
                                                                        <a href="#"
                                                                            class="hover:underline">{{ $order->product->name }}</a>
                                                                    </div>
                                                                </td>
                                                                <td
                                                                    class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">
                                                                    Rp
                                                                    {{ number_format($order->product->price, 0, ',', '.') }}
                                                                    <span
                                                                        class="text-base font-normal text-gray-900 dark:text-white">x
                                                                        {{ $order->quantity }}</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mt-4 space-y-6">
                                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Rincian
                                                    Pembayaran</h4>

                                                <div class="space-y-4">
                                                    <div class="space-y-2">
                                                        <dl class="flex items-center justify-between gap-4">
                                                            <dt class="text-gray-500 dark:text-gray-400">Total Harga Produk
                                                            </dt>
                                                            <dd class="text-base font-medium text-gray-900 dark:text-white">
                                                                Rp
                                                                {{ number_format($checkout->price_total - $checkout->service, 0, ',', '.') }}
                                                            </dd>
                                                        </dl>

                                                        <dl class="flex items-center justify-between gap-4">
                                                            <dt class="text-gray-500 dark:text-gray-400">Biaya Pelayanan
                                                            </dt>
                                                            <dd class="text-base font-medium text-gray-900 dark:text-white">
                                                                Rp {{ number_format($checkout->service, 0, ',', '.') }}
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                    <dl
                                                        class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                                        <dt class="text-lg font-bold text-gray-900 dark:text-white">Total
                                                            Belanja</dt>
                                                        <dd class="text-lg font-bold text-gray-900 dark:text-white">Rp
                                                            {{ number_format($checkout->price_total, 0, ',', '.') }}</dd>
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
                <p class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">Belum ada pembelian</p>
            @endif


        </div>

    </section>

@endsection
