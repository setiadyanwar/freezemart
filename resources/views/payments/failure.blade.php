@extends('templates.master')
@section('content')

<section class="min-h-[80vh] flex items-center justify-center">
    <div class="text-center">
        <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900 p-2 flex items-center justify-center mx-auto mb-3.5">
            <svg aria-hidden="true" class="w-8 h-8 text-red-500 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Failure</span>
        </div>
        <p class="text-2xl font-semibold text-gray-900 dark:text-white">Yahh, Pembayaran Kamu Gagal Nih!</p>
        <p class="mb-4 text-gray-800 dark:text-gray-400">Coba pastikan lagi pembayarannya dengan benar ya🤗.</p>
        <a href="/" type="button" class="py-2 px-3 text-sm font-medium text-center text-white rounded-lg bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-500 dark:focus:ring-primary-500">Kembali ke beranda</a>
    </div>
</section>


@endsection

