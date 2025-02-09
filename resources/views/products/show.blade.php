@extends('templates.master')

@section('content')
    <section class="mt-16 bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div class="mx-auto max-w-md shrink-0 lg:max-w-lg">
                    <img class="w-full rounded" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">{{ $product->name }}</h1>
                    <div class="mt-4 sm:flex sm:items-center sm:gap-4">
                        <p class="text-2xl font-extrabold text-gray-900 dark:text-white sm:text-3xl">Rp
                            {{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="mt-2 flex items-center gap-2 sm:mt-0">
                            <div class="flex items-center gap-1">
                                <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                <svg class="h-4 w-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                                (5.0)
                            </p>
                            <a href="#"
                                class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
                                345 Reviews
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 sm:mt-8 sm:flex sm:items-center sm:gap-4">
                        <form action="/carts/{{ $product->slug }}" method="post">
                            @csrf
                            <button type="submit"
                                class="mt-4 flex items-center justify-center rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-500 sm:mt-0"
                                role="button">
                                <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                </svg>
                                Tambah ke keranjang
                            </button>
                        </form>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-800 md:my-8" />

                    <p class="mb-6 text-gray-500 dark:text-gray-400">{{ $product->description }}</p>
                </div>
            </div>
        </div>
    </section>


    {{-- Start Comment --}}
    <section class="bg-white py-8 antialiased dark:bg-gray-900 lg:py-16">
        <div class="mx-auto max-w-4xl px-4">
            <div class="mb-6 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white lg:text-2xl">
                    Komentar ({{ $comments->count() }})
                </h2>
            </div>

            {{-- Form komentar --}}
            <form class="mb-6" action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div
                    class="mb-4 rounded-lg border border-gray-200 bg-white px-4 py-2 dark:border-gray-700 dark:bg-gray-800">
                    <label for="comment_text" class="sr-only">Tulis komentarmu...</label>
                    <textarea id="comment_text" rows="6"
                        class="w-full border-0 px-0 text-sm text-gray-900 focus:outline-none focus:ring-0 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400"
                        placeholder="Tulis komentarmu..." required name="comment_text"></textarea>
                </div>
                <button type="submit"
                    class="mt-4 flex items-center justify-center rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-500 sm:mt-0">
                    Post komentar
                </button>
            </form>

            {{-- Loop Komentar Utama (Tanpa Parent) --}}
            @foreach ($comments->where('parent_id', null) as $index => $comment)
                <article
                    class="@if ($comments->count() > 1 && !$loop->last) border-b border-gray-200 dark:border-gray-700 @endif rounded-lg bg-white p-6 text-base dark:bg-gray-900">

                    <footer class="mb-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="mr-3 h-8 w-8 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&color=fff"
                                alt="{{ $comment->user->name }}">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $comment->user->name }}
                                <span class="text-xs text-gray-600 dark:text-gray-400">•
                                    {{ $comment->created_at->diffInHours() < 24 ? $comment->created_at->diffForHumans() : $comment->created_at->translatedFormat('d M Y') }}
                                </span>
                            </p>
                        </div>
                    </footer>

                    <p class="text-gray-500 dark:text-gray-400">
                        {{ $comment->comment_text }}
                    </p>

                    {{-- Tombol Balas --}}
                    <button onclick="toggleReplyForm({{ $comment->id }})"
                        class="mt-4 flex items-center text-sm font-medium text-gray-500 hover:underline dark:text-gray-400">
                        <svg class="mr-1.5 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                        </svg>
                        Balas
                    </button>

                    {{-- Form Reply (Hidden by Default) --}}
                    <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.store') }}" method="POST"
                        class="ml-6 mt-4 hidden">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <div
                            class="mb-4 rounded-lg border border-gray-200 bg-white px-4 py-2 dark:border-gray-700 dark:bg-gray-800">
                            <textarea name="comment_text" rows="3"
                                class="w-full border-0 px-0 text-sm text-gray-900 focus:outline-none focus:ring-0 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400"
                                placeholder="Tulis balasan..." required></textarea>
                        </div>
                        <button type="submit"
                            class="rounded-lg bg-primary-500 px-4 py-2 text-sm font-medium text-white hover:bg-primary-600">
                            Balas
                        </button>
                    </form>

                    {{-- Tampilkan Reply Secara Hierarki --}}
                    @foreach ($comment->replies as $reply)
                        <div class="ml-6 mt-4 border-l-2 border-gray-300 pl-4">
                            <div class="flex items-center">
                                <img class="mr-3 h-6 w-6 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->name) }}&background=random&color=fff"
                                    alt="{{ $reply->user->name }}">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $reply->user->name }}
                                    <span class="text-xs text-gray-500">•
                                        {{ $comment->created_at->diffInHours() < 24 ? $comment->created_at->diffForHumans() : $comment->created_at->translatedFormat('d M Y') }}
                                    </span>
                                </p>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400">{{ $reply->comment_text }}</p>
                        </div>
                    @endforeach
                </article>
            @endforeach

        </div>
    </section>
    {{-- End Comment --}}


    {{-- releated --}}
    <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 pt-5 2xl:px-0">

            <!-- Heading & Filters -->
            <div class="mb-4 mt-8 items-end justify-start space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Produk Terkait</h2>
            </div>

            <div class="mb-4 grid grid-cols-2 gap-4 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">

                @foreach ($products as $product)
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="h-56 w-full">
                            <a href="/products/{{ $product->slug }}">
                                <img class="mx-auto h-full rounded-t" src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}" />
                            </a>
                        </div>
                        <div class="pt-6">
                            <a href="/products/{{ $product->slug }}"
                                class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $product->name }}</a>
                            <div class="mt-2 flex items-center gap-2">
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>
                                </div>

                                <p class="text-sm font-medium text-gray-900 dark:text-white">5.0</p>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">(455)</p>
                            </div>

                            <div class="mt-4 flex items-center justify-between gap-4">
                                <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>

                                <form action="/carts/{{ $product->slug }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">
                                        <svg class="me-0 ms-0 h-5 w-5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- end releated --}}

    {{-- TOAST --}}
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

<script>
    function toggleReplyForm(commentId) {
        let form = document.getElementById(`reply-form-${commentId}`);
        form.classList.toggle("hidden");
    }
</script>
