@extends('templates.master')

@section('content')
<section class="bg-gray-50 antialiased dark:bg-gray-900 py-24">
    <div class="container mx-auto px-4">
        <div class="flex justify-center mb-8">
            <!-- Photo Profile -->
            <div class="flex items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700 w-32 h-32">
                <!-- Jika user punya foto -->
                @if ($user->photo)
                    <img src="{{ asset('storage/photos/'.$user->photo) }}" alt="Profile Picture" class="rounded-full w-full h-full object-cover">
                @else
                    <!-- Jika tidak ada foto, tampilkan icon default -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-20 h-20 text-gray-500 dark:text-gray-300">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4s-4 1.79-4 4s1.79 4 4 4z" />
                    </svg>
                @endif
            </div>
        </div>

        <!-- Profile Information -->
        <div class="card bg-white dark:bg-gray-700 shadow-lg rounded-lg max-w-lg mx-auto p-6">
            <div class="card-header text-gray-900 dark:text-white text-2xl font-semibold mb-4">
                Detail Pengguna
            </div>
            <div class="card-body space-y-4">
                <div class="flex items-center justify-between">
                    <h5 class="text-lg font-medium text-gray-900 dark:text-white">Nama:</h5>
                    <p class="text-gray-700 dark:text-gray-300">{{ $user->name }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <h5 class="text-lg font-medium text-gray-900 dark:text-white">Email:</h5>
                    <p class="text-gray-700 dark:text-gray-300">{{ $user->email }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <h5 class="text-lg font-medium text-gray-900 dark:text-white">Role:</h5>
                    <p class="text-gray-700 dark:text-gray-300">{{ $user->role }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <h5 class="text-lg font-medium text-gray-900 dark:text-white">Tanggal Bergabung:</h5>
                    <p class="text-gray-700 dark:text-gray-300">{{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
