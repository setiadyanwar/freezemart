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
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 overflow-hidden">
        <!-- Kontainer utama, beri max-width & margin auto -->
        <div class="max-w-7xl min-h-screen my-auto mx-auto px-4 py-8">
            <!-- Flex container -->
            <div class="h-auto gap-14 flex flex-col md:flex-row">
                <!-- Bagian Kiri - Ilustrasi -->
                <div class="hidden md:flex items-center justify-center w-full md:w-1/2">
                    <img 
                        src="{{ $image ?? '/assets/' }}" 
                        alt="Illustration" 
                        class="max-w-full h-auto object-contain"
                    >
                </div>
    
                <!-- Bagian Kanan - Form Auth -->
                <div class="md:w-1/2 p-8 flex flex-col justify-center rounded-lg h-full overflow-y-auto">
                    <div class="flex items-center mb-6">
                        <img src="/logo/logo.png" alt="FreezeMart Logo" class="h-10 mr-2">
                    </div>
                    <h2 class="text-black text-3xl font-semibold mb-2">
                        Selamat datang di<br> FreezeMart
                    </h2>
                    <p class="text-base text-gray-400"><?php echo $message ?? ''?></p>
                    
                    <!-- Alert -->
                    @if (session('status'))
                        <div class="mt-2 p-4 text-sm text-green-500 bg-green-100 rounded-lg" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mt-2 p-4 text-sm text-red-500 bg-red-100 rounded-lg" role="alert">
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
