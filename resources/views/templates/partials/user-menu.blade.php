<button id="userDropdownButton" data-dropdown-toggle="userDropdown" type="button"
    class="inline-flex items-center justify-center gap-2 px-2 py-1 text-sm font-medium leading-none rounded-full border
           border-primary-500 bg-primary-50 text-primary-600 hover:bg-primary-100
           dark:border-primary-100 dark:bg-dark-black dark:text-white dark:hover:bg-primary-400">
    <div class="w-8 h-8 rounded-full overflow-hidden">
        <!-- Tampilkan gambar profil pengguna -->
        @if (Auth::check() && Auth::user()->photo)
            <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="User Profile" class="w-full h-full object-cover">
        @else
            <!-- Tampilkan gambar default jika pengguna tidak memiliki foto profil -->
            <img src="{{ asset('assets/Avatars.png') }}" alt="Default Profile" class="w-full h-full object-cover">
        @endif
    </div>
    <!-- Ikon dropdown -->
    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-width="2" d="m19 9-7 7-7-7"></path>
    </svg>
</button>

<div id="userDropdown"
    class="z-50 hidden w-56 overflow-hidden overflow-y-auto antialiased bg-white divide-y divide-gray-100 rounded-lg shadow dark:divide-gray-600 dark:bg-gray-700">
    <ul class="p-2 text-sm font-medium text-gray-900 text-start dark:text-white">
        @can('is-admin')
            <li><a href="/admin"
                    class="inline-flex items-center w-full gap-2 px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                    Dashboard Admin </a></li>
        @endcan
        <li><a href="/profile"
                class="inline-flex items-center w-full gap-2 px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                Profil </a></li>
        <li><a href="{{ route('history.index', ['status' => 'completed']) }}"
                class="inline-flex items-center w-full gap-2 px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                Riwayat </a></li>
        <li><a href="/checkouts"
                class="inline-flex items-center w-full gap-2 px-3 py-2 text-sm rounded-md hover:bg-gray-100 dark:hover:bg-gray-600">
                FAQ </a></li>
    </ul>

    <div class="p-2 text-sm font-medium text-red-500 dark:text-red-400">
        <form action="/logout" method="post"
            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600">
            @csrf
            @method('delete')
            <svg class="xmlns= h-6 w-6"http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3H5.25A2.25 2.25 0 0 0 3 5.25v13.5A2.25 2.25 0 0 0 5.25 21H13.5a2.25 2.25 0 0 0 2.25-2.25V15m-4.5-3h9m0 0-3-3m3 3-3 3" />
            </svg>
            <button type="submit" class="inline-flex items-center w-full text-sm"> Logout </button>
        </form>
    </div>
</div>
