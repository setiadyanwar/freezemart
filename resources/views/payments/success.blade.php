@extends('templates.master')
@section('content')


<section class="bg-white py-4 antialiased dark:bg-gray-900 min-h-screen flex items-center justify-center">
    <div class="mx-auto max-w-2xl px-4 2xl:px-0">
        <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
            <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Success</span>
        </div>
        <h2 class="text-xl text-center font-semibold text-gray-900 dark:text-white sm:text-2xl mb-4">Pembayaran Berhasil, Terimakasih Telah Memesan Di FreezeMart</h2>
        <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Pesananmu <a href="#" class="font-medium text-gray-900 dark:text-white hover:underline">#7564804</a> Pesanan Anda akan diproses dalam waktu 24 jam pada hari kerja. Cek status pesananmu secara berkala.</p>
        <div class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-500 dark:bg-gray-800 mb-6 md:mb-8">
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Tanggal</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">14 May 2024</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Metode Pembayaran</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">JPMorgan monthly installments</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Nama</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">Flowbite Studios LLC</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Alamat</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">34 Scott Street, San Francisco, California, USA</dd>
            </dl>
            <dl class="sm:flex items-center justify-between gap-4">
                <dt class="font-normal mb-1 sm:mb-0 text-gray-500 dark:text-gray-400">Nomor Telepon</dt>
                <dd class="font-medium text-gray-900 dark:text-white sm:text-end">+(123) 456 7890</dd>
            </dl>
        </div>
        <div class="flex items-center space-x-4">
            <a href="#" class="text-white bg-primary-500 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-500 focus:outline-none dark:focus:ring-primary-800">Lacak Pesananmu</a>
            <a href="/products" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-500 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-500 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-500">Kembali Belanja</a>
        </div>
    </div>
</section>

@endsection

