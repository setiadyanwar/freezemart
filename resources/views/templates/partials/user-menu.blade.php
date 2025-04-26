<div class="relative inline-block text-left">
    <button id="userDropdownButton" type="button"
        class="inline-flex items-center justify-center gap-2 px-2 py-1 text-sm font-medium leading-none rounded-full border
               border-primary-500 bg-primary-50 text-primary-600 hover:bg-primary-100
               dark:border-primary-100 dark:bg-dark-black dark:text-white dark:hover:bg-primary-400">
        <div class="w-8 h-8 rounded-full overflow-hidden">
            @if (Auth::check() && Auth::user()->photo)
                <img src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="User Profile" class="w-full h-full object-cover">
            @else
                <img src="{{ asset('assets/Avatars.png') }}" alt="Default Profile" class="w-full h-full object-cover">
            @endif
        </div>
        <!-- Tambahkan ID untuk caret -->
        <svg id="caretIcon" class="w-5 h-5 transition-transform duration-300 ease-in-out" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div id="userDropdown" class="hidden absolute right-0 mt-2 w-56 origin-top-right rounded-md shadow-lg bg-white dark:bg-gray-700 ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
        <div class="py-1">
            @can('is-admin')
                <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">Dashboard Admin</a>
            @endcan
            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">Profil</a>
            <a href="{{ route('history.index', ['status' => 'completed']) }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">Riwayat</a>
            <a href="/faq" class="block px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600">FAQ</a>
        </div>
        <div class="border-t border-gray-100 dark:border-gray-600"></div>
        <div class="py-1">
            <form action="/logout" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-600">Logout</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const userButton = document.getElementById('userDropdownButton');
        const userDropdown = document.getElementById('userDropdown');
        const caretIcon = document.getElementById('caretIcon');

        userButton.addEventListener('click', function(event) {
            event.stopPropagation();
            const isHidden = userDropdown.classList.contains('hidden');

            userDropdown.classList.toggle('hidden');
            caretIcon.classList.toggle('rotate-180', isHidden); // rotate jika sedang akan dibuka
        });

        document.addEventListener('click', function(event) {
            if (!userButton.contains(event.target)) {
                userDropdown.classList.add('hidden');
                caretIcon.classList.remove('rotate-180');
            }
        });
    });
</script>
