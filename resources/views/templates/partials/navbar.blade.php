{{-- navbar --}}
@vite(['resources/js/app.js', 'resources/js/costum.js'])
<nav class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
      <div class="flex items-center justify-between">

        <div class="flex items-center space-x-8">
          <div class="shrink-0">
            <a href="#" class="">
              <img class="block w-auto h-8 dark:hidden" src="/logo/logo.png" alt="">
              <img class="hidden w-auto h-8 dark:block" src="/logo/logo.png" alt="">
            </a>
          </div>

          <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
            <li>
              <a href="/" class="flex text-sm font-medium {{ request()->is('/') ? 'text-primary-500 dark:text-primary-500' : 'text-gray-900 dark:text-white' }} hover:text-primary-500">
                Home
              </a>
            </li>
            <li class="shrink-0">
              <a href="/#category" class="flex text-sm font-medium text-gray-900 hover:text-primary-500 dark:text-white">
                Kategori
              </a>
            </li>
            <li class="shrink-0">
              <a href="/products" class="flex text-sm font-medium  {{ request()->is('products*') ? 'text-primary-500 dark:text-primary-500' : 'text-gray-900 dark:text-white' }} hover:text-primary-500">
                Produk
              </a>
            </li>
          </ul>
        </div>

        <div class="flex items-center lg:space-x-2">
          
      </div>

        <div class="flex items-center lg:space-x-2">
          {{-- Toggle Dark/Light Mode dan login button --}}
          <button id="theme-toggle" class="p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700">
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
              <path d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z"
                  fill="#4B5563">
              </path>
          </svg>
            <svg id="theme-toggle-dark-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" clip-rule="evenodd"></path>
            </svg>
        </button>
        @auth
        @include('templates.partials.cart-menu')
        @include('templates.partials.user-menu')
        @else
        <a href="/login" class="text-gray-500 dark:text-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">Login</a>
        @endauth

        <button type="button" data-collapse-toggle="ecommerce-navbar-menu-1" aria-controls="ecommerce-navbar-menu-1" aria-expanded="false" class="inline-flex lg:hidden items-center justify-center hover:bg-gray-100 rounded-md dark:hover:bg-gray-700 p-2 text-gray-900 dark:text-white">
            <span class="sr-only">
            Open Menu
            </span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
            </svg>
        </button>
        </div>
      </div>

      <div id="ecommerce-navbar-menu-1" class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 border border-gray-200 rounded-lg py-3 hidden px-4 mt-4">
        <ul class="text-gray-900 dark:text-white text-sm font-medium dark:text-white space-y-3">
          <li>
            <a href="/" class="{{ request()->is('/') ? 'text-primary-500' : '' }} hover:text-primary-500">Home</a>
          </li>
          <li>
            <a href="/#category" class="hover:text-primary-500">Kategori</a>
          </li>
          <li>
            <a href="/products" class="{{ request()->is('products*') ? 'text-primary-500' : '' }} hover:text-primary-500">Produk</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
{{-- end navbar --}}

