<button id="userDropdownButton" data-dropdown-toggle="userDropdown" type="button" class="inline-flex items-center rounded-lg justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium leading-none text-gray-900 dark:text-white">
    <svg class="w-5 h-5 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
    </svg>
</button>

<div id="userDropdown" class="hidden z-50 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
    <ul class="p-2 text-start text-sm font-medium text-gray-900 dark:text-white">
        @can('is-admin')
        <li><a href="/admin" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Dashboard Admin </a></li>
        @endcan
        <li><a href="/profile" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Profil </a></li>
        <li><a href="/checkouts" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Pembelian </a></li>
        <li><a href="{{ route('history.index', ['status' => 'completed']) }}" class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600"> Riwayat </a></li>

    </ul>

    <div class="p-2 text-sm font-medium text-red-500 dark:text-red-400">
        <form action="/logout" method="post" class="flex px-3 py-2 rounded-lg items-center gap-2 hover:bg-gray-100 dark:hover:bg-gray-600">
            @csrf
            @method('delete')
            <svg class="w-6 h-6 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3H5.25A2.25 2.25 0 0 0 3 5.25v13.5A2.25 2.25 0 0 0 5.25 21H13.5a2.25 2.25 0 0 0 2.25-2.25V15m-4.5-3h9m0 0-3-3m3 3-3 3"/>
              </svg>
            <button type="submit" class="inline-flex w-full items-center text-sm"> Logout </button>
        </form>
    </div>
</div>
