@extends('templates.master')
@section('content')
    <section class="flex min-h-screen items-center justify-center bg-white py-4 antialiased dark:bg-gray-900">
        <div class="mx-auto max-w-2xl px-4 2xl:px-0">
            <div
                class="mx-auto mb-3.5 flex h-12 w-12 items-center justify-center rounded-full bg-green-100 p-2 dark:bg-green-900">
                <svg aria-hidden="true" class="h-8 w-8 text-green-500 dark:text-green-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Success</span>
            </div>
            <h2 class="mb-4 text-center text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Pembayaran
                Berhasil, Terimakasih Telah Memesan Di FreezeMart</h2>
            <p class="mb-6 text-gray-500 dark:text-gray-400 md:mb-8">Pesananmu <a href="#"
                    class="font-medium text-gray-900 hover:underline dark:text-white">#{{ implode('-', array_slice(explode('-', $checkout->external_id), 0, 3)) }}</a>
                Pesanan Anda akan
                diproses dalam waktu 24 jam pada hari kerja. Cek status pesananmu secara berkala.</p>
            <div
                class="mb-6 space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-500 dark:bg-gray-800 sm:space-y-2 md:mb-8">
                <dl class="items-center justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 dark:text-gray-400 sm:mb-0">Tanggal</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                        {{ \Carbon\Carbon::parse($checkout->created_at)->format('d M Y') }}</dd>
                </dl>
                <dl class="items-center justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 dark:text-gray-400 sm:mb-0">Metode Pembayaran</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                        {{ $checkout->payment_method ?? 'Tidak diketahui' }}</dd>
                </dl>
                <dl class="items-center justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 dark:text-gray-400 sm:mb-0">Nama</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                        {{ $checkout->name ?? Auth::user()->name }}</dd>
                </dl>
                <dl class="items-center justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 dark:text-gray-400 sm:mb-0">Alamat</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $checkout->user->address ?? '-' }}
                    </dd>
                </dl>
                <dl class="items-center justify-between gap-4 sm:flex">
                    <dt class="mb-1 font-normal text-gray-500 dark:text-gray-400 sm:mb-0">Nomor Telepon</dt>
                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">{{ $checkout->user->phone ?? '-' }}
                    </dd>
                </dl>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/history?status=paid"
                    class="rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-500 dark:focus:ring-primary-800">Lacak
                    Pesananmu</a>
                <a href="/products"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-500 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-white dark:focus:ring-gray-500">Kembali
                    Belanja</a>
            </div>
        </div>
    </section>
@endsection
