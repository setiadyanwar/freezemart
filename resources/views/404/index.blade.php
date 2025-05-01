{{-- resources/views/404/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Halaman Tidak Ditemukan' }}</title>
    
    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Optional: Nonaktifkan dark mode Tailwind --}}
    <script>
        tailwind.config = {
            darkMode: false // atau 'class' jika ingin dark mode aktif hanya dengan class
        }
    </script>

    {{-- Lottie Player --}}
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen px-4">
    <div class="text-center max-w-md w-full">
        <dotlottie-player
            src="https://lottie.host/4ab1fd11-27c8-4b20-84f6-0db35816dd98/qmcwQk11SK.lottie"
            background="transparent"
            speed="1"
            class="mx-auto"
            style="width: 100%; max-width: 360px; height: auto"
            loop
            autoplay>
        </dotlottie-player>

        <h2 class="mt-4 text-2xl sm:text-3xl font-bold text-gray-800">Halaman Tidak Ditemukan</h2>
        <p class="mt-2 text-sm sm:text-base text-gray-600">
            Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
        </p>

        <a href="{{ url('/') }}" 
           class="mt-6 inline-block bg-blue-600 text-white px-5 py-2 sm:px-6 sm:py-3 rounded-lg hover:bg-blue-700 transition text-sm sm:text-base">
            Kembali ke Beranda
        </a>
    </div>
</body>
</html>
