@extends('templates.master')

@section('content')
<<<<<<< HEAD
<section class="py-24 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-screen-xl mx-auto px-6">
      {{-- Breadcrumb --}}
      <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        <a href="/" class="hover:underline">Beranda</a> ›
        <span class="text-gray-700 dark:text-gray-200">Profile</span>
      </nav>
  
      {{-- Konten Utama --}}
      <div class="grid grid-cols-1 md:grid-cols-[1fr,2fr] gap-x-8 border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-xl overflow-hidden">
        {{-- Kiri: Foto Profil --}}
        <div class="p-6 flex flex-col items-center">
            <div class="w-full aspect-square rounded-xl overflow-hidden bg-gray-200">
                @if ($user->photo)
                    <img id="profile-pic" src="{{ asset('storage/photos/' . $user->photo) }}" class="object-cover w-full h-full" alt="Profile">
                @else
                <img id="profile-pic" src="{{ asset('assets/Avatars.png') }}" class="object-cover w-full h-full" alt="Default Avatar">
                @endif
            </div>            
  
          <button onclick="document.getElementById('profile-upload').click()" class="mt-6 w-full bg-primary-500 text-white py-2 rounded-lg hover:bg-primary-600 transition text-center">
            Ubah Profile
          </button>
  
          <input id="profile-upload" type="file" class="hidden" accept="image/*" onchange="uploadProfilePicture()">
  
          <div class="mt-4 w-full bg-blue-50 text-xs text-blue-600 p-3 rounded-lg flex items-start gap-2">
            <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.5 16.5H12.5V11H11.5V16.5ZM12 9.577C12.1747 9.577 12.321 9.518 12.439 9.4C12.557 9.282 12.6157 9.13567 12.615 8.961C12.6143 8.78633 12.5553 8.64033 12.438 8.523C12.3207 8.40567 12.1747 8.34667 12 8.346C11.8253 8.34533 11.6793 8.40433 11.562 8.523C11.4447 8.64167 11.3857 8.788 11.385 8.962C11.3843 9.136 11.4433 9.282 11.562 9.4C11.6807 9.518 11.8267 9.577 12 9.577ZM12.003 21C10.7583 21 9.58833 20.764 8.493 20.292C7.39767 19.8193 6.44467 19.178 5.634 18.368C4.82333 17.558 4.18167 16.606 3.709 15.512C3.23633 14.418 3 13.2483 3 12.003C3 10.7577 3.23633 9.58767 3.709 8.493C4.181 7.39767 4.82133 6.44467 5.63 5.634C6.43867 4.82333 7.391 4.18167 8.487 3.709C9.583 3.23633 10.753 3 11.997 3C13.241 3 14.411 3.23633 15.507 3.709C16.6023 4.181 17.5553 4.82167 18.366 5.631C19.1767 6.44033 19.8183 7.39267 20.291 8.488C20.7637 9.58333 21 10.753 21 11.997C21 13.241 20.764 14.411 20.292 15.507C19.82 16.603 19.1787 17.556 18.368 18.366C17.5573 19.176 16.6053 19.8177 15.512 20.291C14.4187 20.7643 13.249 21.0007 12.003 21ZM12 20C14.2333 20 16.125 19.225 17.675 17.675C19.225 16.125 20 14.2333 20 12C20 9.76667 19.225 7.875 17.675 6.325C16.125 4.775 14.2333 4 12 4C9.76667 4 7.875 4.775 6.325 6.325C4.775 7.875 4 9.76667 4 12C4 14.2333 4.775 16.125 6.325 17.675C7.875 19.225 9.76667 20 12 20Z" fill="#2761C9"/>
            </svg>
            <span>
              Besar file: maksimum 10mb. Ekstensi yang diperbolehkan: <strong>.JPG .JPEG .PNG</strong>
            </span>
          </div>
        </div>
  
        {{-- Kanan: Biodata & Info Akun --}}
        <div class="p-8 border-l border-gray-200 dark:border-gray-700 space-y-10">
          {{-- Biodata Diri --}}
          <div>
            <h2 class="text-xl font-semibold mb-6">Biodata diri</h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
=======
    <section class="py-24 antialiased bg-gray-50 dark:bg-gray-900">
        <div class="container px-4 mx-auto">

            <div class="relative flex justify-center mb-8">
                <!-- Wrapper untuk positioning -->
                <label for="profile-upload" class="relative w-32 h-32 cursor-pointer group">
                    <!-- Photo Profile Container -->
                    <div class="relative w-32 h-32 overflow-hidden bg-gray-200 rounded-full dark:bg-gray-700">
                        @if ($user->photo)
                            <img id="profile-pic" src="{{ asset('storage/photos/' . $user->photo) }}" alt="Profile Picture"
                                class="object-cover w-full h-full transition-opacity duration-300 group-hover:opacity-50">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="w-20 h-20 mx-auto mt-6 text-gray-500 transition-opacity duration-300 group-hover:opacity-50 dark:text-gray-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4s-4 1.79-4 4s1.79 4 4 4z" />
                            </svg>
                        @endif

                        <!-- Overlay Hover -->
                        <div
                            class="absolute inset-0 transition-opacity duration-300 bg-black opacity-0 bg-opacity-30 group-hover:opacity-100">
                        </div>
                    </div>

                    <!-- Edit Button muncul saat hover -->
                    <div
                        class="absolute p-2 transition-all duration-300 transform scale-0 rounded-full shadow-lg -bottom-1 -right-1 bg-primary-500 hover:bg-primary-600 group-hover:scale-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="white" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.232 5.232l3.536 3.536M9 19H5v-4l10.232-10.232a2.5 2.5 0 113.536 3.536L9 19z" />
                        </svg>
                    </div>
                </label>

                <!-- Hidden File Input -->
                <input type="file" id="profile-upload" class="hidden" accept="image/*" onchange="uploadProfilePicture()">
            </div>

            <!-- Profile Information -->
            <div class="max-w-lg p-6 mx-auto bg-white rounded-lg shadow-lg card dark:bg-gray-700">
                <div class="mb-4 text-2xl font-semibold text-gray-900 card-header dark:text-white">
                    Detail Pengguna
                </div>
                <div class="space-y-4 card-body">
                    @php
                        $fields = [
                            'name' => 'Nama',
                            'address' => 'Alamat Utama',
                            'email' => 'Email',
                            'phone' => 'No. Hp',
                        ]; // Ubah alamat -> address
                    @endphp

                    @foreach ($fields as $key => $label)
                        <div class="flex items-center justify-between">
                            <h5 class="text-lg font-medium text-gray-900 dark:text-white">{{ $label }}:</h5>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-700 dark:text-gray-300"
                                    id="text-{{ $key }}">{{ $user->$key }}</span>

                                @if ($key !== 'email')
                                    <input type="text" id="input-{{ $key }}" class="hidden p-1 border rounded"
                                        value="{{ $user->$key }}">
                                    <button onclick="editField('{{ $key }}')" id="edit-{{ $key }}"
                                        class="text-blue-500">Edit</button>
                                    <button onclick="saveField('{{ $key }}', {{ $user->id }})"
                                        class="hidden text-green-500" id="save-{{ $key }}">Save</button>
                                @endif
                            </div>
                        </div>
                    @endforeach

>>>>>>> e43244627e266d274630925dd1b148a63e8b217f
                    <div class="flex items-center justify-between">
                        <p class="text-gray-900">{{ $user->name }}</p>
                        <button onclick="openNameModal()" class="text-sm text-primary-500 hover:underline">Ubah</button>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Alamat Utama</p>
                    <div class="flex items-start justify-between gap-4">
                        <p class="text-gray-900 w-full">{{ $user->address }}</p>
                        <button onclick="openAddressModal()" class="text-sm text-primary-500 hover:underline">Ubah</button>
                    </div>
                </div>
            </div>
          </div>

          {{-- Informasi Akun --}}
          <div>
            <h2 class="text-xl font-semibold mb-6">Informasi akun</h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <div class="flex items-center justify-between">
                        <p class="text-gray-900">{{ $user->email }}</p>
                        <button onclick="openEmailModal()" class="text-sm text-primary-500 hover:underline">Ubah</button>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">No Hp</p>
                    <div class="flex items-center justify-between">
                        <p class="text-gray-900">{{ $user->nohp ? $user->nohp : '-' }}</p>
                        <button onclick="openNohpModal()" class="text-sm text-primary-500 hover:underline">Ubah</button>
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
    <div id="nameModal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-900 bg-opacity-50">
      <div class="flex items-center justify-center min-h-screen p-4">
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-md">
              <div class="flex justify-between items-center mb-4">
                  <h2 class="text-xl font-semibold">Ubah Nama</h2>
                  <button onclick="closeNameModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>
              </div>
              <p class="text-sm text-gray-500 mb-4">Kamu hanya dapat mengubah nama 1 kali lagi. Pastikan nama sudah benar.</p>
              <form action="/profile/edit/name" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="mb-4">
                      <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                      <input type="text" id="name" name="name" value="{{ $user->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                      @error('name')
                          <p class="text-red-500 text-xs italic">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="flex justify-end">
                      <button type="button" onclick="closeNameModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                          Batal
                      </button>
                      <button type="submit" class="bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                          Simpan
                      </button>
                  </div>
              </form>
          </div>
      </div>
    </div>

    {{-- Modal Ubah Email --}}
    <div id="emailModal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-900 bg-opacity-50">
      <div class="flex items-center justify-center min-h-screen p-4">
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-md">
              <div class="flex justify-between items-center mb-4">
                  <h2 class="text-xl font-semibold">Ubah Email</h2>
                  <button onclick="closeEmailModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>
              </div>
              <form action="/profile/edit/email" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="mb-4">
                      <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                      <input type="email" id="email" name="email" value="{{ $user->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                      @error('email')
                          <p class="text-red-500 text-xs italic">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="flex justify-end">
                      <button type="button" onclick="closeEmailModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                          Batal
                      </button>
                      <button type="submit" class="bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                          Simpan
                      </button>
                  </div>
              </form>
          </div>
      </div>
    </div>

    {{-- Modal Ubah Nomor HP --}}
    <div id="nohpModal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-900 bg-opacity-50">
      <div class="flex items-center justify-center min-h-screen p-4">
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-md">
              <div class="flex justify-between items-center mb-4">
                  <h2 class="text-xl font-semibold">Ubah No Hp</h2>
                  <button onclick="closeNohpModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>
              </div>
              <form action="/profile/edit/nohp" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="mb-4">
                      <label for="nohp" class="block text-gray-700 text-sm font-bold mb-2">No Hp</label>
                      <input type="text" id="nohp" name="nohp" value="{{ $user->nohp }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
                      @error('nohp')
                          <p class="text-red-500 text-xs italic">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="flex justify-end">
                      <button type="button" onclick="closeNohpModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                          Batal
                      </button>
                      <button type="submit" class="bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                          Simpan
                      </button>
                  </div>
              </form>
          </div>
      </div>
    </div>

    <!-- Modal untuk Edit Alamat -->
    <div id="AddressModal" class="fixed z-10 inset-0 overflow-y-auto hidden bg-gray-900 bg-opacity-50">
      <div class="flex items-center justify-center min-h-screen p-4">
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-md">
              <div class="flex justify-between items-center mb-4">
                  <h2 class="text-xl font-semibold">Edit Alamat</h2>
                  <button onclick="closeAddressModal()" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>
              </div>
              <form action="/profile/edit/address" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="mb-4">
                      <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                      <input type="text" id="address" name="address" value="{{ auth()->user()->address }}"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                  </div>
                  <div class="flex justify-end">
                      <button type="button" onclick="closeAddressModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                          Batal
                      </button>
                      <button type="submit" class="bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
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
      if(data.success) {
        document.getElementById('profile-pic').src = data.image_url + '?t=' + new Date().getTime();
      } else {
        alert('Upload gagal!\n' + JSON.stringify(data));
      }
    })
    .catch(error => console.error('Upload error:', error));
  }
</script>
