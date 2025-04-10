@extends('templates.master')
@section('content')
    {{-- hero --}}
    <section class="relative bg-white pt-24 mb-6 antialiased dark:bg-gray-900">
        <!-- Background container -->
        <div class="absolute inset-0 h-[700px] w-full overflow-hidden">
            <img src="/assets/bg-white.png" class="h-[700px] w-full object-cover object-center dark:hidden"
                alt="Light background">
            <img src="/assets/bg-dark.png" class="hidden h-[700px] w-full object-cover object-center dark:block"
                alt="Dark background">
        </div>

        <div class="relative z-10 mx-auto grid max-w-screen-xl px-4 pb-8 md:mt-6 md:grid-cols-12 lg:gap-12 lg:pb-16 xl:gap-0">
            <div class="z-10 max-w-2xl content-center justify-self-start md:col-span-7 md:text-start">
                <div class="mb-2 px-4 py-1 rounded-xl border border-primary-500 justify-center items-center gap-2 inline-flex">
                    <div class="border-primary-500 text-primary-500 dark:text-white text-sm  lg:text-xl font-normal">Selamat Datang di Freezemart</div>
                    <div class="p-1 rounded-xl border border-primary-500 justify-center items-center gap-2 flex">
                    <img class="w-[26px] h-[26px]" src="/assets/emot.svg" />
                    </div>
                </div>
                <div> 
                    <h1>
                        <span class="text-dark-black dark:text-white text-5xl lg:text-6xl font-bold leading-tight">Solusi Untuk <br> Semua </span>
                        <span class="text-[#2761c9] text-5xl lg:text-6xl font-bold leading-tight">Kebutuhan <br> Beku </span>
                        <span class="text-dark-black dark:text-white text-5xl lg:text-6xl font-bold leading-tight"> Kamu </span>
                    </h1>
                </div>
                <p class="mb-4 max-w-2xl text-gray-500 dark:text-gray-400 text-lg lg:mb-8 lg:text-lg">Surganya Pecinta Makanan Beku dengan Berbagai Pilihan Lezat untuk Setiap Selera</p>
                @guest
                    <a href="/login"
                        class="inline-block rounded-lg bg-primary-500 px-4 py-3 text-center font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">
                        Belanja Sekarang</a>
                @else
                    <a href="/products"
                        class="inline-block rounded-lg bg-primary-500 px-6 py-3.5 text-center font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">Mulai
                        Belanja</a>
                @endguest
            </div>
            <div class="z-10 hidden md:col-span-5 md:mt-0 md:flex">
                <img class="dark:hidden" src="/assets/hero-shop.png" alt="hero-image" />
                <img class="hidden dark:block" src="/assets/hero-shop.png" alt="hero-image" />
            </div>
        </div>
        <div
            class="relative z-10 mx-auto grid max-w-screen-xl grid-cols-3 gap-8 px-4 text-gray-500 dark:text-gray-400 md:grid-cols-6">
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('storage/brand/fiesta.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('storage/brand/belfood.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('storage/brand/kimbo.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('storage/brand/bumifood.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('storage/brand/sibeku.png') }}"
                    alt="brand-logo">
                </img>
            </a>
            <a href="#" class="flex items-center md:justify-center">
                <img class="w-3/4 grayscale hover:grayscale-0 " src="{{ asset('storage/brand/amazy.png') }}"
                    alt="brand-logo">
                </img>
            </a>
        </div>
    </section>
    {{-- end hero --}}

    {{-- Banner --}}
    <section class="bg-gray-50 py-6 antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <img src="/assets/banner-promo.png" alt="banner-promo" w >
        </div>
    </section>
    {{-- End Banner --}}

    {{-- category --}}
    <section class="bg-gray-50 py-6 antialiased dark:bg-gray-900 md:py-16" id="category">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mb-4 md:mb-8">
                <div class="flex flex-wrap">
                    <div class="w-full mb-10 lg:w-1/2">
                        <h2 class="text-xl pb-7 font-semibold text-gray-900 dark:text-white sm:text-2xl ">Kategori Terpopuler</h2>
                        <div class="flex gap-4">
                            <div>
                                <h2 class="text-primary-500 font-bold">
                                    TOP 3 Kategori<br>Terpopuler
                                </h2>
                                <img src="/assets/star-emoji.png" class="w-[32px] h-[32px]" alt="top-populer">
                            </div>
                            <div class="flex gap-8">
                                <div class="p-4 flex flex-col text-center items-center justify-center outline-[#6B7280] outline outline-1 rounded-2xl">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_232_11729)">
                                        <path d="M2.06113 29.2522L2.78557 29.9766L1.71141 31.7253L0.3125 30.3264L2.06113 29.2522Z" fill="#E64A19"/>
                                        <path d="M1.7108 31.9751C1.63586 31.9751 1.5859 31.9501 1.53594 31.9001L0.112051 30.4762C0.0620899 30.4263 0.0371094 30.3513 0.0371094 30.2764C0.0371094 30.2015 0.0870703 30.1265 0.162012 30.1015L1.81072 29.0773C1.93563 29.0024 2.08551 29.0524 2.16045 29.1523C2.23539 29.2772 2.18543 29.4271 2.08551 29.502L0.686602 30.3513L1.66084 31.3256L2.53516 29.9017C2.6101 29.7768 2.75998 29.7518 2.88488 29.8268C3.00979 29.9017 3.03477 30.0516 2.95983 30.1765L1.93563 31.8752C1.88567 31.9501 1.8357 31.9751 1.76076 32.0001C1.73578 31.9751 1.73578 31.9751 1.7108 31.9751Z" fill="black"/>
                                        <path d="M30.3388 0.299805L31.7377 1.69871L29.9891 2.77287L29.2646 2.04844L30.3388 0.299805Z" fill="#E64A19"/>
                                        <path d="M29.9891 3.02264C29.9141 3.02264 29.8142 2.97268 29.7642 2.89774C29.6893 2.77283 29.7392 2.62295 29.8392 2.54801L31.313 1.64871L30.3388 0.674473L29.4395 2.14832C29.3645 2.27322 29.2147 2.2982 29.0898 2.22326C28.9648 2.14832 28.9399 1.99844 29.0148 1.87354L30.089 0.124902C30.1389 0.049961 30.1889 0.0249805 30.2638 0C30.3388 0 30.4137 0.0249805 30.4637 0.0749415L31.8876 1.49883C31.9375 1.54879 31.9625 1.62373 31.9625 1.69867C31.9625 1.77361 31.9125 1.84856 31.8376 1.87354L30.089 2.9477C30.089 3.02264 30.039 3.02264 29.9891 3.02264Z" fill="black"/>
                                        <path d="M29.6141 2.42306C31.8624 4.67131 31.8624 8.29348 29.6141 10.5417L10.529 29.6268C8.28081 31.8751 4.58369 31.8751 2.33545 29.6268C0.0872062 27.3786 0.0122647 23.7564 2.26051 21.5082L21.3956 2.44804H21.4455C23.7187 0.17482 27.3909 0.17482 29.6141 2.42306Z" fill="#FFAB91"/>
                                        <path d="M6.432 31.5504C4.80826 31.5504 3.30944 30.9258 2.18531 29.8017C1.03621 28.6526 0.386719 27.1038 0.386719 25.5051C0.386719 23.9313 0.98625 22.4575 2.08539 21.3583L2.11037 21.3333L21.3204 2.24825C23.6435 -0.0749368 27.4406 -0.0749368 29.7887 2.24825C32.1119 4.57143 32.1119 8.39345 29.7887 10.7166L10.6787 29.8017C9.55456 30.9258 8.05573 31.5504 6.432 31.5504ZM2.48508 21.6581C1.46088 22.6823 0.886328 24.0562 0.886328 25.4801C0.886328 26.9789 1.46088 28.3778 2.53504 29.427C3.58422 30.4762 4.95815 31.0258 6.432 31.0258C7.90584 31.0258 9.30475 30.4512 10.329 29.427L29.439 10.3419C31.5873 8.1936 31.5873 4.72132 29.439 2.57299C27.3157 0.449653 23.8434 0.424673 21.6951 2.54801C21.6951 2.57299 21.6701 2.57299 21.6701 2.57299L2.48508 21.6581Z" fill="black"/>
                                        <path d="M28.7397 3.2974C30.4883 5.04604 30.4883 7.89381 28.7397 9.64245L9.65457 28.7275C7.90593 30.4762 5.05816 30.4762 3.30952 28.7275C1.56089 26.9789 1.56089 24.1311 3.30952 22.3825L20.646 5.04604L22.3946 3.2974C22.3946 3.2974 22.3946 3.2974 22.4196 3.27242C24.1432 1.54877 26.991 1.54877 28.7397 3.2974Z" fill="#E64A19"/>
                                        <path d="M6.48283 30.3013C5.25878 30.3013 4.05972 29.8516 3.13544 28.9273C1.28688 27.0788 1.28688 24.0811 3.13544 22.2326C3.23536 22.1327 3.38525 22.1327 3.48517 22.2326C3.58509 22.3325 3.58509 22.4824 3.48517 22.5823C1.83646 24.231 1.83646 26.9289 3.48517 28.5776C5.13388 30.2263 7.83177 30.2263 9.48048 28.5776L28.5656 9.49252C30.2143 7.84381 30.2143 5.14592 28.5656 3.49721C26.9169 1.8485 24.2439 1.8485 22.5952 3.47223L22.5703 3.49721C22.4703 3.59713 22.3205 3.59713 22.2205 3.49721C22.1206 3.39729 22.1206 3.2474 22.2205 3.14748L22.2455 3.1225C24.0941 1.27395 27.1167 1.27395 28.9403 3.1225C30.7888 4.97106 30.7888 7.96871 28.9403 9.81727L9.85519 28.9024C8.90593 29.8266 7.70687 30.3013 6.48283 30.3013Z" fill="black"/>
                                        <path d="M3.31035 22.6323C3.23541 22.6323 3.18545 22.6073 3.13549 22.5574C3.03557 22.4575 3.03557 22.3076 3.13549 22.2077L20.4719 4.87121C20.5719 4.77128 20.7217 4.77128 20.8217 4.87121C20.9216 4.97113 20.9216 5.12101 20.8217 5.22093L3.48521 22.5574C3.43525 22.6073 3.36031 22.6323 3.31035 22.6323Z" fill="black"/>
                                        <path d="M17.0744 6.8446L23.4445 13.1896L13.2025 23.4316L6.85742 17.0616L17.0744 6.8446Z" fill="#FAFAFA"/>
                                        <path d="M13.2019 23.6815C13.1269 23.6815 13.077 23.6565 13.027 23.6066L6.65697 17.2365C6.55705 17.1366 6.55705 16.9867 6.65697 16.8868C6.75689 16.7869 6.90678 16.7869 7.0067 16.8868L13.2019 23.082L23.0692 13.2147L16.899 7.01952C16.7991 6.91959 16.7991 6.76971 16.899 6.66979C16.9989 6.56987 17.1488 6.56987 17.2487 6.66979L23.6187 13.0398C23.7186 13.1397 23.7186 13.2896 23.6187 13.3895L13.4017 23.6066C13.3268 23.6565 13.2768 23.6815 13.2019 23.6815Z" fill="black"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_232_11729">
                                        <rect width="32" height="32" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>                                    
                                    kategori 1
                                </div>
                                <div class="p-4 flex flex-col text-center items-center justify-center outline-[#6B7280] outline outline-1 rounded-2xl">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_232_11743)">
                                        <path d="M12.4591 9.21606L7.26447 4.02139C7.63249 3.58241 7.82288 3.02159 7.79821 2.44928C7.77353 1.87698 7.53557 1.33463 7.13114 0.928949C6.69942 0.497419 6.114 0.255005 5.50359 0.255005C4.89318 0.255005 4.30775 0.497419 3.87603 0.928949C3.6145 1.19084 3.42014 1.51205 3.30948 1.86522C3.19882 2.2184 3.17515 2.59309 3.24047 2.95739C2.87618 2.89207 2.50149 2.91574 2.14831 3.0264C1.79513 3.13706 1.47392 3.33142 1.21203 3.59295C0.7805 4.02467 0.538086 4.61009 0.538086 5.2205C0.538086 5.83091 0.7805 6.41634 1.21203 6.84806C1.61771 7.25249 2.16006 7.49045 2.73237 7.51513C3.30467 7.5398 3.86549 7.3494 4.30447 6.98139L9.49914 12.1761L12.4591 9.21606ZM23.0529 19.8107L28.2485 25.0054C28.6875 24.6374 29.2483 24.447 29.8206 24.4717C30.3929 24.4963 30.9352 24.7343 31.3409 25.1387C31.6872 25.4847 31.914 25.9321 31.9884 26.4159C32.0628 26.8996 31.9809 27.3945 31.7546 27.8285C31.5284 28.2625 31.1695 28.613 30.7303 28.829C30.291 29.045 29.7944 29.1152 29.3125 29.0294C29.398 29.5112 29.3276 30.0077 29.1116 30.4468C28.8955 30.8858 28.545 31.2445 28.1111 31.4707C27.6771 31.6968 27.1823 31.7786 26.6987 31.7042C26.215 31.6298 25.7677 31.4031 25.4218 31.0569C25.0175 30.6512 24.7797 30.1087 24.7552 29.5364C24.7307 28.9641 24.9212 28.4034 25.2894 27.9645L20.0938 22.7698L23.0529 19.8107Z" fill="#FFD983"/>
                                        <path d="M26.6858 14.1147C25.2351 12.6632 23.0298 12.7432 21.1445 10.8569C19.2591 8.97161 19.3383 6.76628 17.8867 5.31472C14.7623 2.19028 11.6485 4.01072 7.8307 7.82939C4.01204 11.6481 2.19248 14.7618 5.31604 17.8854C6.76759 19.3369 8.97293 19.2578 10.8583 21.1432C12.7445 23.0285 12.6645 25.2347 14.116 26.6845C17.2405 29.8089 20.3543 27.9894 24.1729 24.1707C27.9916 20.3521 29.8094 17.2392 26.6858 14.1147Z" fill="#C1694F"/>
                                        <path d="M12.8885 20.8931C12.7476 20.893 12.6088 20.8595 12.4834 20.7952C12.3581 20.7309 12.2498 20.6378 12.1675 20.5235C12.0852 20.4091 12.0312 20.2769 12.0101 20.1376C11.9889 19.9983 12.0012 19.856 12.0458 19.7224C13.0316 16.7642 16.7614 13.0353 19.7187 12.0495C19.8299 12.0108 19.9477 11.9945 20.0652 12.0016C20.1827 12.0088 20.2976 12.0392 20.4032 12.0911C20.5089 12.143 20.6032 12.2154 20.6806 12.3041C20.7581 12.3927 20.8172 12.4959 20.8544 12.6075C20.8917 12.7192 20.9064 12.8372 20.8977 12.9546C20.889 13.072 20.8571 13.1865 20.8038 13.2914C20.7505 13.3964 20.6768 13.4897 20.5872 13.566C20.4975 13.6422 20.3936 13.6999 20.2814 13.7357C17.8938 14.5313 14.5276 17.8975 13.7321 20.2851C13.6076 20.6575 13.261 20.8931 12.8885 20.8931Z" fill="#662113"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_232_11743">
                                        <rect width="32" height="32" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>                                    
                                    kategori 2
                                </div>
                                <div class="p-4 flex flex-col text-center items-center justify-center outline-[#6B7280] outline outline-1 rounded-2xl">
                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_232_11749)">
                                        <path d="M25.0514 18.0543L21.4014 24.3459L19.4469 31.9999H12.8787L10.6074 24.3628L6.94824 18.0543H12.5541L13.0577 19.0303L13.5619 20.0062L15.3101 23.3901H16.9101L18.5438 20.0062L19.0148 19.0303L19.4859 18.0543H25.0514Z" fill="#008040"/>
                                        <path d="M25.0513 18.0543L21.4013 24.3459L19.4468 31.9999H16.0361V23.3901H16.9099L18.5437 20.0062L19.0147 19.0303L19.4858 18.0543H25.0513Z" fill="#00743A"/>
                                        <path d="M31.7529 12.1974C31.7529 14.5748 29.8186 16.5084 27.4419 16.5084C27.1725 16.5084 26.9044 16.4831 26.6409 16.4329C25.9532 18.7023 23.8367 20.3439 21.374 20.3439C20.4163 20.3439 19.4937 20.1006 18.6726 19.636C17.8522 20.07 16.9394 20.2977 15.9992 20.2977H15.994C15.0558 20.2971 14.1455 20.0699 13.327 19.6366C12.5059 20.1012 11.584 20.3439 10.6269 20.3439C8.1643 20.3439 6.0478 18.7023 5.36005 16.4329C5.09655 16.4831 4.82848 16.5084 4.55911 16.5084C2.18236 16.5084 0.248047 14.5747 0.248047 12.1974C0.248047 10.1492 1.68398 8.43025 3.60205 7.99363C3.83042 5.27856 6.11348 3.13925 8.88648 3.13925C9.36211 3.13925 9.82667 3.20044 10.2762 3.32275C10.7603 2.47369 11.4279 1.74237 12.2418 1.17631C13.3465 0.407937 14.6439 0.0013125 15.994 0H15.9992C17.3512 0 18.6505 0.406625 19.7572 1.177C20.5705 1.74306 21.2387 2.47438 21.7222 3.32344C22.1724 3.20112 22.6382 3.13931 23.1145 3.13931C25.8875 3.13931 28.1706 5.27856 28.399 7.99369C30.317 8.43025 31.7529 10.1492 31.7529 12.1974Z" fill="#00C379"/>
                                        <path d="M31.7521 12.1974C31.7521 14.5748 29.8178 16.5084 27.441 16.5084C27.1717 16.5084 26.9036 16.4831 26.6401 16.4329C25.9524 18.7023 23.8359 20.3439 21.3732 20.3439C20.4155 20.3439 19.4929 20.1006 18.6718 19.636C17.8514 20.07 16.9385 20.2977 15.9984 20.2977H15.9932V0H15.9984C17.3504 0 18.6497 0.406625 19.7564 1.177C20.5697 1.74306 21.2379 2.47438 21.7214 3.32344C22.1716 3.20112 22.6374 3.13931 23.1137 3.13931C25.8867 3.13931 28.1698 5.27856 28.3982 7.99369C30.3162 8.43025 31.7521 10.1492 31.7521 12.1974Z" fill="#00A653"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_232_11749">
                                        <rect width="32" height="32" fill="white"/>
                                        </clipPath>
                                        </defs>
                                    </svg>
                                    <p>kategori 3</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mb-10 lg:w-1/2">
                        <h2 class="text-xl pb-1 font-semibold text-gray-900 dark:text-white sm:text-2xl ">Apa produk yang kamu sukai?</h2>
                        <p class="text-sm pb-2 text-[#6B7280]">*membantu kami merekomendasikan produk yang sesuai.</p>

                        <div class="container-input">
                            <div class="relative w-full outline outline-1 outline-[#6B7280] py-3 px-4 rounded-lg">
                                <div class="input mb-2">
                                    <input 
                                      type="text" 
                                      placeholder="Ketikkan frozen food yang kamu suka?" 
                                      class="input-text-personalisasi w-full font-light text-base p-3 outline outline-1 outline-[#D8D8D8] text-[#000] placeholder:text-[#C5C6C9] rounded-2xl"
                                    />
                                    <button class="send-personalisasi absolute right-5 top-1/3 -translate-y-1/2 bg-[#2761c9] text-white px-4 py-2 rounded-xl">
                                      Kirim
                                    </button>
                                </div>
                                <div class="space-y-4">
                                    <!-- Filter harga -->
                                    <div class="flex flex-wrap gap-2">
                                      <button class="px-4 py-2 rounded-lg border border-primary-500 text-primary-500 bg-[#edf3ff] font-medium text-sm">
                                        &lt; Rp50.000
                                      </button>
                                      <button class="px-4 py-2 rounded-lg border border-[#D1D5DB] text-[#6B7280] font-medium text-sm">
                                        Rp50.000 - Rp100.000
                                      </button>
                                      <button class="px-4 py-2 rounded-lg border border-[#D1D5DB] text-[#6B7280] font-medium text-sm">
                                        &gt; Rp100.000
                                      </button>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                

                {{-- <a href="/products" title=""
                    class="flex items-center text-base font-medium text-primary-500 hover:underline">
                    Lihat semua kategori
                    <svg class="ms-1 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </a> --}}
            </div>

            <div class="mb-4 grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($categories as $category)
                    @if ($loop->iteration <= 4)
                        <a href="/products?category={{ $category->slug }}"
                            class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <img class="me-2 h-4 w-4 shrink-0" src="{{ asset('storage/' . $category->path) }}"
                                alt="{{ $category->name }} Icon">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->name }}</span>
                        </a>
                    @else
                        <a href="/products?category={{ $category->slug }}"
                            class="hidden items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 md:flex">
                            <img class="me-2 h-4 w-4 shrink-0" src="{{ asset('storage/' . $category->path) }}"
                                alt="{{ $category->name }} Icon">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->name }}</span>
                        </a>
                    @endif
                @endforeach
            </div>

            <div class="mt-6 w-full text-center">
                <a href="/products"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50 hover:text-primary-500 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-primary-500 dark:focus:ring-gray-700">Lihat
                    kategori lainnya</a>
            </div>

        </div>
    </section>
    {{-- end category --}}

    {{-- product --}}
    <section class="bg-gray-50 py-6 antialiased dark:bg-gray-900 md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Produk</h2>
                <a href="/products" title=""
                    class="flex items-center text-base font-medium text-primary-500 hover:underline">
                    Lihat semua produk
                    <svg class="ms-1 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                </a>
            </div>
            <div class="mb-4 grid grid-cols-2 gap-4 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">

                @foreach ($products as $product)
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="h-56 w-full">
                            <a href="/products/{{ $product->slug }}">
                                <img class="mx-auto h-full rounded-t" src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}" />
                            </a>
                        </div>
                        <div class="pt-6">
                            <a href="/products/{{ $product->slug }}"
                                class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $product->name }}</a>
                            <div class="mt-2 flex items-center gap-2">
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>

                                    <svg class="h-4 w-4 text-yellow-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                    </svg>
                                </div>

                                <p class="text-sm font-medium text-gray-900 dark:text-white">5.0</p>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">(455)</p>
                            </div>

                            <div class="mt-4 flex items-center justify-between gap-4">
                                <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">Rp
                                    {{ number_format($product->price, 0, ',', '.') }}</p>

                                <form action="/carts/{{ $product->slug }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center rounded-lg bg-primary-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-800">
                                        <svg class="me-0 ms-0 h-5 w-5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="w-full text-center">
                <a href="/products"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-50 hover:text-primary-500 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-primary-500 dark:focus:ring-gray-700">Lihat
                    produk lainnya</a>
            </div>
        </div>
    </section>
    {{-- end product --}}


    {{-- TOAST --}}
    @if (session('success'))
        <div id="toast-bottom-right"
            class="fixed bottom-5 right-5 flex w-auto max-w-xs translate-x-0 transform items-center space-x-3 rounded-lg border-2 border-green-300 bg-green-50 p-4 text-green-500 transition-all duration-1000 ease-in-out dark:border-green-800 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 p-2 dark:bg-green-900">
                <svg aria-hidden="true" class="h-6 w-6 text-green-500 dark:text-green-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="text-sm font-normal">
                {{ session('success') }}
            </div>
        </div>

        <script>
            // Hilangkan toast setelah 3 detik (3000 ms)
            setTimeout(() => {
                const toast = document.getElementById('toast-bottom-right');
                if (toast) {
                    toast.classList.add('translate-x-full', 'opacity-0'); // Geser ke kanan & fade out
                    setTimeout(() => toast.remove(), 1000); // Hapus elemen setelah animasi selesai
                }
            }, 3000);
        </script>
    @endif
@endsection
