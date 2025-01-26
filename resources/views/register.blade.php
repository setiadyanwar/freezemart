@extends('templates.auth')
@section('content')
<h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
    Daftar Akun BelanjaRia
</h1>
<form class="space-y-4 md:space-y-6" action="/register" method="POST">
    @csrf
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('name') border-red-500 dark:border-red-500 @enderror" placeholder="John" required value="{{ old('name') }}">
            @error('name')
            <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('email') border-red-500 dark:border-red-500 @enderror" placeholder="name@example.com" required value="{{ old('email') }}">
            @error('email')
            <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div>
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
        <textarea rows="5" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('address') border-red-500 dark:border-red-500 @enderror" placeholder="Jl.xxx" required value="{{ old('address') }}"></textarea>
        @error('address')
        <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('password') border-red-500 dark:border-red-500 @enderror" required>
        @error('password')
        <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password_confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi Password</label>
        <input type="password" name="password_confirm" id="password_confirm" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('password_confirm') border-red-500 dark:border-red-500 @enderror" required>
        @error('password_confirm')
        <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="w-full text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-500">Daftar</button>
    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
        Sudah punya akun? <a href="/login" class="font-medium text-primary-500 hover:underline dark:text-primary-500">Login Sekarang</a>
    </p>
</form>

@endsection

