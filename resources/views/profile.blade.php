@extends('templates.master')

@section('content')
    <section class="bg-gray-50 py-24 dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-6">
            {{-- Breadcrumb --}}
            <nav class="mb-6 text-sm text-gray-500 dark:text-gray-400">
                <a href="/" class="hover:underline">Beranda</a> ›
                <span class="text-gray-700 dark:text-gray-200">Profile</span>
            </nav>

            {{-- Konten Utama --}}
            <div
                class="grid grid-cols-1 gap-x-8 overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 md:grid-cols-[1fr,2fr]">
                {{-- Kiri: Foto Profil --}}
                <div class="flex flex-col items-center p-6">
                    <div class="aspect-square w-full overflow-hidden rounded-xl bg-gray-200">
                        @if ($user->photo)
                            <img id="profile-pic" src="{{ asset('storage/photos/' . $user->photo) }}"
                                class="h-full w-full object-cover" alt="Profile">
                        @else
                            <img id="profile-pic" src="{{ asset('assets/Avatars.png') }}" class="h-full w-full object-cover"
                                alt="Default Avatar">
                        @endif
                    </div>

                    <button onclick="document.getElementById('profile-upload').click()"
                        class="mt-6 w-full rounded-lg bg-primary-500 py-2 text-center text-white transition hover:bg-primary-600">
                        Ubah Profile
                    </button>

                    <input id="profile-upload" type="file" class="hidden" accept="image/*"
                        onchange="uploadProfilePicture()">

                    <div class="mt-4 flex w-full items-start gap-2 rounded-lg bg-blue-50 p-3 text-xs text-blue-600">
                        <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.5 16.5H12.5V11H11.5V16.5ZM12 9.577C12.1747 9.577 12.321 9.518 12.439 9.4C12.557 9.282 12.6157 9.13567 12.615 8.961C12.6143 8.78633 12.5553 8.64033 12.438 8.523C12.3207 8.40567 12.1747 8.34667 12 8.346C11.8253 8.34533 11.6793 8.40433 11.562 8.523C11.4447 8.64167 11.3857 8.788 11.385 8.962C11.3843 9.136 11.4433 9.282 11.562 9.4C11.6807 9.518 11.8267 9.577 12 9.577ZM12.003 21C10.7583 21 9.58833 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z"
                                fill="#2761C9" />
                        </svg>
                        <span>
                            Besar file: maksimum 10mb. Ekstensi yang diperbolehkan: <strong>.JPG .JPEG .PNG</strong>
                        </span>
                    </div>
                </div>

                {{-- Kanan: Biodata & Info Akun --}}
                <div class="space-y-10 border-l border-gray-200 p-8 dark:border-gray-700">
                    {{-- Biodata Diri --}}
                    <div>
                        <h2 class="mb-6 text-xl font-semibold">Biodata diri</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Nama</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-900">{{ $user->name }}</p>
                                    <button onclick="openNameModal()"
                                        class="text-sm text-primary-500 hover:underline">Ubah</button>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Alamat Utama</p>
                                <div class="flex items-start justify-between gap-4">
                                    <p class="w-full text-gray-900">{{ $user->address }}</p>
                                    <button onclick="openAddressModal()"
                                        class="text-sm text-primary-500 hover:underline">Ubah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Akun --}}
                    <div>
                        <h2 class="mb-6 text-xl font-semibold">Informasi akun</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-900">{{ $user->email }}</p>
                                    <button onclick="openEmailModal()"
                                        class="text-sm text-primary-500 hover:underline">Ubah</button>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">No Hp</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-gray-900">{{ $user->nohp ? $user->nohp : '-' }}</p>
                                    <button onclick="openNohpModal()"
                                        class="text-sm text-primary-500 hover:underline">Ubah</button>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal bergabung</p>
                                <p class="text-gray-900">{{ $user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Modal Ubah Nama --}}
        <div id="nameModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-xl font-semibold">Ubah Nama</h2>
                        <button onclick="closeNameModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <p class="mb-4 text-sm text-gray-500">Kamu hanya dapat mengubah nama 1 kali lagi. Pastikan nama sudah
                        benar.</p>
                    <form action="/profile/edit/name" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="mb-2 block text-sm font-bold text-gray-700">Nama</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}"
                                class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                required>
                            @error('name')
                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="closeNameModal()"
                                class="focus:shadow-outline mr-2 rounded bg-gray-300 px-4 py-2 font-semibold text-gray-800 hover:bg-gray-400 focus:outline-none">
                                Batal
                            </button>
                            <button type="submit"
                                class="focus:shadow-outline rounded bg-primary-500 px-4 py-2 font-bold text-white hover:bg-primary-700 focus:outline-none">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Ubah Email --}}
        <div id="emailModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-xl font-semibold">Ubah Email</h2>
                        <button onclick="closeEmailModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form action="/profile/edit/email" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="email" class="mb-2 block text-sm font-bold text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}"
                                class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                required>
                            @error('email')
                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="closeEmailModal()"
                                class="focus:shadow-outline mr-2 rounded bg-gray-300 px-4 py-2 font-semibold text-gray-800 hover:bg-gray-400 focus:outline-none">
                                Batal
                            </button>
                            <button type="submit"
                                class="focus:shadow-outline rounded bg-primary-500 px-4 py-2 font-bold text-white hover:bg-primary-700 focus:outline-none">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Ubah Nomor HP --}}
        <div id="nohpModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-xl font-semibold">Ubah No Hp</h2>
                        <button onclick="closeNohpModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form action="/profile/edit/nohp" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nohp" class="mb-2 block text-sm font-bold text-gray-700">No Hp</label>
                            <input type="text" id="nohp" name="nohp" value="{{ $user->nohp }}"
                                class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                            @error('nohp')
                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="closeNohpModal()"
                                class="focus:shadow-outline mr-2 rounded bg-gray-300 px-4 py-2 font-semibold text-gray-800 hover:bg-gray-400 focus:outline-none">
                                Batal
                            </button>
                            <button type="submit"
                                class="focus:shadow-outline rounded bg-primary-500 px-4 py-2 font-bold text-white hover:bg-primary-700 focus:outline-none">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal untuk Edit Alamat -->
        <div id="AddressModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50">
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800">
                    <div class="mb-4 flex items-center justify-between">
                        <h2 class="text-xl font-semibold">Edit Alamat</h2>
                        <button onclick="closeAddressModal()"
                            class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form action="/profile/edit/address" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="address" class="mb-2 block text-sm font-bold text-gray-700">Alamat</label>
                            <input type="text" id="address" name="address" value="{{ auth()->user()->address }}"
                                class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100"
                                required>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="closeAddressModal()"
                                class="focus:shadow-outline mr-2 rounded bg-gray-300 px-4 py-2 font-semibold text-gray-800 hover:bg-gray-400 focus:outline-none">
                                Batal
                            </button>
                            <button type="submit"
                                class="focus:shadow-outline rounded bg-primary-500 px-4 py-2 font-bold text-white hover:bg-primary-700 focus:outline-none">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection


<script>
    function openNameModal() {
        document.getElementById('nameModal').classList.remove('hidden');
    }

    function closeNameModal() {
        document.getElementById('nameModal').classList.add('hidden');
    }

    function openEmailModal() {
        document.getElementById('emailModal').classList.remove('hidden');
    }

    function closeEmailModal() {
        document.getElementById('emailModal').classList.add('hidden');
    }

    function openNohpModal() {
        document.getElementById('nohpModal').classList.remove('hidden');
    }

    function closeNohpModal() {
        document.getElementById('nohpModal').classList.add('hidden');
    }

    function openAddressModal() {
        document.getElementById('AddressModal').classList.remove('hidden');
    }

    function closeAddressModal() {
        document.getElementById('AddressModal').classList.add('hidden');
    }

    function editField(field) {
        window.location.href = `/profile/edit/${field}`;
    }

    function uploadProfilePicture() {
        const input = document.getElementById('profile-upload');
        const file = input.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('photo', file);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        fetch('/profile/update-photo', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    document.getElementById('profile-pic').src = data.image_url + '?t=' + new Date().getTime();
                } else {
                    alert('Upload gagal!\n' + JSON.stringify(data));
                }
            })
            .catch(error => console.error('Upload error:', error));
    }
</script>
