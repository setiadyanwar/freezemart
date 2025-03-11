@extends('templates.auth')
@section('content')
<form class="space-y-4 md:space-y-6" action="{{ route('password.email') }}" method="POST">
    @csrf
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
        <input type="email" name="email" id="email" class=" border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@company.com" required="">
    </div>  
    <button type="submit" class="w-full text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-500">Kirim Verifikasi</button>

</form>


@php
    $image = '/assets/Imagelogin.svg';
    $message = 'Masukkan Password baru kamu';
@endphp

@endsection

