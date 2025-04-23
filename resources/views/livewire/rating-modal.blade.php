<div x-show="open" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-full max-w-md mx-4">
        <!-- Header -->
        <div class="text-center py-4 border-b">
            <h2 class="text-xl font-medium text-gray-800">Beri Review Produk</h2>
        </div>

        <!-- Content -->
        <div class="px-6 py-4">
            <!-- User Profile -->
            <div class="flex flex-col items-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full overflow-hidden">
                    <img src="/api/placeholder/64/64" alt="User Profile" class="w-full h-full object-cover" />
                </div>
                <div class="mt-2 text-center">
                    <h3 class="font-bold text-lg">setiadyanwar</h3>
                    <p class="text-gray-600">Chicken Nugget Hotaz</p>
                </div>
            </div>

            <!-- Star Rating -->
            <div class="flex justify-center mt-4">
                <div class="flex space-x-1">
                    <!-- ⭐ Stars here (same as before) -->
                    <!-- ... -->
                </div>
            </div>

            <!-- Review Text Area -->
            <div class="mt-6">
                <textarea 
                    class="w-full border border-gray-300 rounded-lg p-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    rows="4" 
                    placeholder="Berikan Ulasan Anda">
                </textarea>
            </div>
        </div>

        <!-- Footer Button -->
        <div class="px-6 pb-6">
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg" @click="open = false">
                Beri ulasan
            </button>
        </div>
    </div>
</div>
