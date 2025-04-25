@extends('templates.master')

@section('content')
    <section class="py-8 mt-16 antialiased bg-white dark:bg-gray-900 md:py-16">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            {{-- Breadcrumb --}}
            <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                <a href="/" class="hover:underline">Beranda</a> ›
                <span class="text-gray-700 dark:text-gray-200">Riwayat</span>
            </nav>
            <h2 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Daftar Pembelian</h2>
            <!-- Order Status Filter Tabs -->
            <div class="flex flex-wrap gap-2 mb-8">
                <a href="{{ route('history.index', ['status' => 'unpaid']) }}"
                    class="{{ request('status') == 'unpaid' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }} rounded-full border border-primary-500 px-4 py-2 text-sm font-medium">
                    Belum dibayar
                </a>
                <a href="{{ route('history.index', ['status' => 'paid']) }}"
                    class="{{ request('status') == 'paid' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }} rounded-full border border-primary-500 px-4 py-2 text-sm font-medium">
                    Sudah dibayar
                </a>
                <a href="{{ route('history.index', ['status' => 'processing']) }}"
                    class="{{ request('status') == 'processing' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }} rounded-full border border-primary-500 px-4 py-2 text-sm font-medium">
                    Dikemas
                </a>
                <a href="{{ route('history.index', ['status' => 'shipped']) }}"
                    class="{{ request('status') == 'shipped' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }} rounded-full border border-primary-500 px-4 py-2 text-sm font-medium">
                    Dikirim
                </a>
                <a href="{{ route('history.index', ['status' => 'completed']) }}"
                    class="{{ request('status') == 'completed' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }} rounded-full border border-primary-500 px-4 py-2 text-sm font-medium">
                    Selesai
                </a>
            </div>

            @if (request('status') == 'unpaid' || (!request('status') && $status == 'unpaid'))
                @include('history.partials.unpaid')
            @elseif(request('status') == 'paid' || $status == 'paid')
                @include('history.partials.paid')
            @elseif(request('status') == 'processing' || $status == 'processing')
                @include('history.partials.processing')
            @elseif(request('status') == 'shipped' || $status == 'shipped')
                @include('history.partials.shipped')
            @elseif(request('status') == 'completed' || $status == 'completed')
                @include('history.partials.completed')
            @else
                @include('partials.no-history')
            @endif
        </div>
    </section>
@endsection
