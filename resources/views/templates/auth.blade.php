<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Livewire Styles -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="overflow-auto bg-gray-100 dark:bg-gray-900">
    <!-- Kontainer utama, beri max-width & margin auto -->
    <div class="min-h-screen px-4 py-8 mx-auto my-auto max-w-7xl">
        <!-- Flex container -->
        <div class="flex flex-col h-auto gap-14 md:flex-row">
            <!-- Bagian Kiri - Ilustrasi -->
            <div class="items-center justify-center hidden w-full md:flex md:w-1/2">
                <img src="{{ $image ?? '/assets/' }}" alt="Illustration" class="object-contain h-auto max-w-full">
            </div>

            <!-- Bagian Kanan - Form Auth -->
            <div class="flex flex-col justify-center h-full p-8 overflow-y-auto rounded-lg md:w-1/2">
                <div class="flex items-center mb-6">
                    <img src="/logo/logo.png" alt="FreezeMart Logo" class="h-10 mr-2">
                </div>
                <h2 class="mb-2 text-3xl font-semibold text-black">
                    Selamat datang di<br> FreezeMart
                </h2>
                <p class="text-base text-gray-400"><?php echo $message ?? ''; ?></p>

                <!-- Alert -->
                @if (session('status'))
                    <div class="p-4 mt-2 text-sm text-green-500 bg-green-100 rounded-lg" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 mt-2 text-sm text-red-500 bg-red-100 rounded-lg" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    @livewireScripts
</body>


<script>
    // Hanya gunakan tema dark jika ada di localStorage
    if (localStorage.getItem('color-theme') === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>

</html>
