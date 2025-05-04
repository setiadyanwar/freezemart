@auth
<!-- Floating Chat Button -->
<button id="chatButton" class="fixed bottom-6 right-6 bg-primary-50 border border-1 p-4 rounded-full shadow-xl shadow-primary-400 z-50 hover; text-white">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z" stroke="#2761C9" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>        
</button>

<!-- Chat Modal -->
<div id="chatModal" class="hidden fixed bottom-24 right-6 w-96 h-[550px] bg-white rounded-[25px] shadow-2xl z-50 flex-col border border-gray-200 overflow-hidden">

    <!-- Header -->
    <div class="flex justify-between items-center px-4 py-3 bg-gradient-to-r from-blue-400 to-blue-300 rounded-t-[25px]">
        <h2 class="text-white text-lg font-semibold">FreezeChat</h2>
        <button onclick="toggleChat()" class="text-white text-xl font-bold">&times;</button>
    </div>

    <!-- Body: Load route /chats -->
    <iframe src="{{ url('/chats') }}" class="w-full h-full border-none"></iframe>

</div>
@endauth

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
