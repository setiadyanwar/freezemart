document.addEventListener('DOMContentLoaded', () => {
    const themeToggle = document.getElementById('theme-toggle');
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');
    const htmlElement = document.documentElement;

    // Fungsi untuk mengatur mode
    function setDarkMode(isDark) {
        if (isDark) {
            htmlElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
        } else {
            htmlElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
            lightIcon.classList.remove('hidden');
            darkIcon.classList.add('hidden');
        }
    }

    // Inisialisasi tema saat halaman dimuat
    const userTheme = localStorage.getItem('theme');
    const isSystemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    // Default ke light mode jika belum ada preferensi
    if (!userTheme) {
        setDarkMode(false); // Set ke light mode secara default
    } else {
        setDarkMode(userTheme === 'dark');
    }

    // Event listener untuk tombol toggle
    themeToggle?.addEventListener('click', () => {
        const isDark = htmlElement.classList.contains('dark');
        setDarkMode(!isDark);
    });
});

// Add cart dropdown initialization
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all dropdowns with data-dropdown-toggle attribute
    const dropdownButtons = document.querySelectorAll('[data-dropdown-toggle]');
    
    dropdownButtons.forEach(button => {
        const targetId = button.getAttribute('data-dropdown-toggle');
        const targetEl = document.getElementById(targetId);
        
        if (targetEl) {
            button.addEventListener('click', function() {
                targetEl.classList.toggle('hidden');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!button.contains(event.target) && !targetEl.contains(event.target)) {
                    targetEl.classList.add('hidden');
                }
            });
        }
    });
});