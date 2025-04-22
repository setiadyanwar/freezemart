@extends('templates.master')

@section('content')
    <section class="mt-16 bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Riwayat Pembelian</h2>
            <!-- Order Status Filter Tabs -->
            <div class="flex flex-wrap gap-2 mb-8">
                <a href="{{ route('history.index', ['status' => 'unpaid']) }}" 
                   class="rounded-full border border-primary-500 px-4 py-2 text-sm font-medium  {{ request('status') == 'unpaid' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }}">
                    Belum dibayar
                </a>
                <a href="{{ route('history.index', ['status' => 'paid']) }}" 
                   class="rounded-full border border-primary-500 px-4 py-2 text-sm font-medium  {{ request('status') == 'paid' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }}">
                    Sudah dibayar
                </a>
                <a href="{{ route('history.index', ['status' => 'processing']) }}" 
                   class="rounded-full border border-primary-500 px-4 py-2 text-sm font-medium  {{ request('status') == 'processing' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }}">
                    Dikemas
                </a>
                <a href="{{ route('history.index', ['status' => 'shipped']) }}" 
                   class="rounded-full border border-primary-500 px-4 py-2 text-sm font-medium  {{ request('status') == 'shipped' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }}">
                    Dikirim
                </a>
                <a href="{{ route('history.index', ['status' => 'completed']) }}" 
                   class="rounded-full border border-primary-500 px-4 py-2 text-sm font-medium  {{ request('status') == 'completed' ? 'bg-primary-500 text-white dark:bg-primary-500 dark:text-white' : 'text-primary-700 hover:bg-primary-50 dark:border-primary-400 dark:text-primary-400 dark:hover:bg-gray-800' }}">
                    Selesai
                </a>
            </div>

            @if(request('status') == 'unpaid' || (!request('status') && $status == 'unpaid'))
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
                <div class="rounded-lg border border-gray-200 bg-white p-6 text-center shadow dark:border-gray-700 dark:bg-gray-800">
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada riwayat pembelian</p>
                </div>
            @endif
        </div>
    </section>
@endsection