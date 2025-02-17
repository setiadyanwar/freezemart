@extends('templates.master')

@section('content')
    <section class="bg-gray-50 py-24 antialiased dark:bg-gray-900">
        <div class="container mx-auto px-4">

            <div class="relative mb-8 flex justify-center">
                <!-- Wrapper untuk positioning -->
                <label for="profile-upload" class="group relative h-32 w-32 cursor-pointer">
                    <!-- Photo Profile Container -->
                    <div class="relative h-32 w-32 overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                        @if ($user->photo)
                            <img id="profile-pic" src="{{ asset('storage/photos/' . $user->photo) }}" alt="Profile Picture"
                                class="h-full w-full object-cover transition-opacity duration-300 group-hover:opacity-50">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="mx-auto mt-6 h-20 w-20 text-gray-500 transition-opacity duration-300 group-hover:opacity-50 dark:text-gray-300">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4s-4 1.79-4 4s1.79 4 4 4z" />
                            </svg>
                        @endif

                        <!-- Overlay Hover -->
                        <div
                            class="absolute inset-0 bg-black bg-opacity-30 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                        </div>
                    </div>

                    <!-- Edit Button muncul saat hover -->
                    <div
                        class="absolute -bottom-1 -right-1 scale-0 transform rounded-full bg-primary-500 p-2 shadow-lg transition-all duration-300 hover:bg-primary-600 group-hover:scale-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="white" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.232 5.232l3.536 3.536M9 19H5v-4l10.232-10.232a2.5 2.5 0 113.536 3.536L9 19z" />
                        </svg>
                    </div>
                </label>

                <!-- Hidden File Input -->
                <input type="file" id="profile-upload" class="hidden" accept="image/*" onchange="uploadProfilePicture()">
            </div>

            <!-- Profile Information -->
            <div class="card mx-auto max-w-lg rounded-lg bg-white p-6 shadow-lg dark:bg-gray-700">
                <div class="card-header mb-4 text-2xl font-semibold text-gray-900 dark:text-white">
                    Detail Pengguna
                </div>
                <div class="card-body space-y-4">
                    @php
                        $fields = ['name' => 'Nama', 'email' => 'Email', 'nohp' => 'No. Hp'];
                    @endphp

                    @foreach ($fields as $key => $label)
                        <div class="flex items-center justify-between">
                            <h5 class="text-lg font-medium text-gray-900 dark:text-white">{{ $label }}:</h5>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-700 dark:text-gray-300"
                                    id="text-{{ $key }}">{{ $user->$key }}</span>

                                @if ($key !== 'email')
                                    <input type="{{ $key === 'nohp' ? 'number' : 'text' }}" id="input-{{ $key }}"
                                        class="hidden rounded border p-1" value="{{ $user->$key }}">
                                    <button onclick="editField('{{ $key }}')" id="edit-{{ $key }}"
                                        class="text-blue-500">Edit</button>
                                    <button onclick="saveField('{{ $key }}', {{ $user->id }})"
                                        class="hidden text-green-500" id="save-{{ $key }}">Save</button>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="flex items-center justify-between">
                        <h5 class="text-lg font-medium text-gray-900 dark:text-white">Tanggal Bergabung:</h5>
                        <p class="text-gray-700 dark:text-gray-300">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Tambahin CSRF Token buat AJAX -->
            <meta name="csrf-token" content="{{ csrf_token() }}">


        </div>
    </section>
@endsection

<script>
    function editField(field) {
        document.getElementById('text-' + field).classList.add('hidden'); // Hide teks
        document.getElementById('input-' + field).classList.remove('hidden'); // Show input
        document.getElementById('save-' + field).classList.remove('hidden'); // Show save button
        document.getElementById('edit-' + field).classList.add('hidden'); // Hide edit button
    }

    function saveField(field, userId) {
        let value = document.getElementById('input-' + field).value;
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/profile/${userId}`, {
                method: 'PUT', // Sesuai resource
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    field: field,
                    value: value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('text-' + field).textContent = value;
                    document.getElementById('text-' + field).classList.remove('hidden'); // Show teks
                    document.getElementById('input-' + field).classList.add('hidden'); // Hide input
                    document.getElementById('save-' + field).classList.add('hidden'); // Hide save button
                    document.getElementById('edit-' + field).classList.remove('hidden'); // Show edit button
                } else {
                    alert('Gagal update data');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function uploadProfilePicture() {
        let fileInput = document.getElementById('profile-upload');
        let file = fileInput.files[0];

        if (!file) return;

        let formData = new FormData();
        formData.append('photo', file);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        fetch('/profile/update-photo', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('profile-pic').src = data.image_url; // Update gambar langsung
                } else {
                    alert('Gagal upload gambar.');
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
