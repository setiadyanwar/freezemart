<!-- Floating Chat Button -->
<button id="chatButton"
    class="border-1 hover; fixed bottom-6 right-6 z-50 rounded-full border bg-primary-50 p-4 text-white shadow-xl shadow-primary-400">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z"
            stroke="#2761C9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</button>

<!-- Chat Modal -->
<div id="chatModal"
    class="fixed bottom-24 right-6 z-50 hidden h-[550px] w-96 flex-col overflow-hidden rounded-[25px] border border-gray-200 bg-white shadow-2xl">

    <!-- Header -->
    <div
        class="flex items-center justify-between rounded-t-[25px] bg-gradient-to-r from-blue-400 to-blue-300 px-4 py-3">
        <h2 class="text-lg font-semibold text-white">FreezeChat</h2>
        <button onclick="toggleChat()" class="text-xl font-bold text-white">&times;</button>
    </div>

    <!-- Body: Load route /chats -->
    <iframe src="{{ url('/chats') }}" class="h-full w-full border-none"></iframe>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatButton = document.getElementById('chatButton');
        const chatModal = document.getElementById('chatModal');

        chatButton.addEventListener('click', () => {
            chatModal.classList.toggle('hidden');
            chatModal.classList.toggle('flex');
        });
    });

    function toggleChat() {
        const chatModal = document.getElementById('chatModal');
        chatModal.classList.add('hidden');
        chatModal.classList.remove('flex');
    }
</script>
