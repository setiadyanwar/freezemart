<div class="w-full  mx-auto bg-white rounded-lg shadow-sm border border-gray-100 p-4">
    <!-- Header section with toggle button -->
    <div class="flex items-center justify-between">
        <div class="text-gray-600 text-xl">Pembelian Chicken Nugget</div>
        <div class="text-blue-600 text-sm flex items-center cursor-pointer" onclick="toggleDetails()">
            <span id="toggleText">Sembunyikan</span>
            <svg id="toggleIcon" class="w-4 h-4 ml-1 transform rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
    
    <!-- Product summary section -->
    <div class="flex items-center mt-4">
        <div class="flex-shrink-0">
            <div class="w-20 h-20 bg-orange-100 rounded-md overflow-hidden flex items-center justify-center">
                <img class="w-16 h-16 object-cover" src="assets/champ_img.jpg" alt="Chicken Nugget" />
            </div>
        </div>
        
        <div class="ml-4 flex-grow">
            <div class="font-medium text-gray-800 text-lg">Chicken Nugget Hotaz</div>
            <div class="inline-block bg-[#DEFFCA] text-[#67A544] text-xs px-2 py-1 rounded-[14px] mt-1 mr-2">
                Paid
            </div>
            <div class="flex">
                <div class="text-black text-sm mt-2">Tanggal pembelian:</div>
                <div class="text-gray-600 text-sm mt-2 ms-2">22-02-2025</div>
            </div>
            
        </div>
        
        <div class="text-right">
            <div class="text-gray-800 font-semibold">Rp 120.000</div>
            <div class="text-gray-500 text-sm">x1</div>
        </div>
    </div>
    
    
    
    <!-- Expanded details section -->
    <div id="detailsSection">
        <div class="border-t border-gray-200 my-4"></div>
        <!-- Detail Pembelian -->
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Detail Pembelian</h3>
            
            <div class="grid grid-cols-1 gap-3">
                <div>
                    <p class="text-sm text-gray-600">Nomor invoice:</p>
                    <p class="text-sm">invoice-setiady-66077394</p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Status:</p>
                    <div class="flex items-center mt-1">
                        <div class="inline-block bg-[#DEFFCA] text-[#67A544] text-xs px-2 py-1 rounded-[14px] mr-2">
                            Paid
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Divider -->
        <div class="border-t border-gray-200 my-4"></div>
        
        <!-- Ringkasan Pembelian -->
        <div>
            <h3 class="text-lg font-medium text-gray-800 mb-4">Ringkasan Pembelian</h3>
            
            <div>
                <div class="flex justify-between py-2 text-base">
                    <span class="text-gray-600">Total harga</span>
                    <span class="font-medium">Rp 120.000</span>
                </div>
                
                <div class="flex justify-between py-2 text-base">
                    <span class="text-gray-600">Biaya pelayanan</span>
                    <span class="font-medium">Rp 2.000</span>
                </div>
                
                <div class="border-t border-gray-200 my-2"></div>
                
                <div class="flex justify-between py-2 font-semibold">
                    <span>Total Belanja</span>
                    <span>Rp 122.000</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDetails() {
        const detailsSection = document.getElementById('detailsSection');
        const toggleText = document.getElementById('toggleText');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (detailsSection.style.display === 'none') {
            detailsSection.style.display = 'block';
            toggleText.textContent = 'Sembunyikan';
            toggleIcon.classList.add('rotate-180');
        } else {
            detailsSection.style.display = 'none';
            toggleText.textContent = 'Lihat selengkapnya';
            toggleIcon.classList.remove('rotate-180');
        }
    }
    
    // Initialize the expanded view on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Uncomment the line below if you want it to start collapsed
        // document.getElementById('detailsSection').style.display = 'none';
    });
</script>