@extends('templates.master')

@section('content')

<section class="py-8 mt-16 antialiased bg-white dark:bg-gray-900 md:py-16">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        {{-- Breadcrumb --}}
      <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="/" class="hover:underline">Beranda</a>
        <span class="text-gray-700 dark:text-gray-200">Faq</span>
      </nav>
        <h2 class="mb-6 text-2xl font-semibold text-gray-900 dark:text-white">FAQ</h2>

        @if (count($faqs) > 0)
            <div x-data="{ selected: 1 }" class="space-y-4 max-w-screen-lg mx-auto">
                @foreach ($faqs as $faq)
                    <div class="transition-all duration-300 rounded-xl"
                        :class="selected === @json($loop->iteration) ?
                            'border-2 border-blue-500 shadow-md bg-white dark:bg-gray-800' :
                            'border border-gray-200 shadow-sm bg-white dark:bg-gray-800'">
                        <button
                            @click="selected === @json($loop->iteration) ? selected = null : selected = @json($loop->iteration)"
                            class="flex items-center justify-between w-full px-6 py-5 text-left transition-colors duration-200 rounded-xl focus:outline-none"
                            :class="selected === @json($loop->iteration) ?
                                'text-blue-600 dark:text-blue-400 font-semibold' :
                                'text-gray-700 dark:text-gray-200 font-medium'">
                            <span>{{ $faq->pertanyaan }}</span>
                            <svg class="w-5 h-5 transition-transform duration-300 transform"
                                :class="selected === @json($loop->iteration) ? 'rotate-180 text-blue-600 dark:text-blue-400' :
                                    'rotate-0 text-gray-400 dark:text-gray-500'"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="selected === @json($loop->iteration)" x-collapse class="px-6 pb-5 text-gray-600 dark:text-gray-300">
                            <p>{{ $faq->jawaban }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">Belum ada FAQ</p>
        @endif
    </div>
</section>

@endsection

<script src="//unpkg.com/alpinejs" defer></script>