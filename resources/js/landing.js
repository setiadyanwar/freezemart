document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('myCartDropdownButton').click();
});

document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('#price-filters .filter-btn');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(b => {
                b.classList.remove(
                    'border-primary-500', 'text-primary-500', 'bg-[#edf3ff]',
                    'dark:border-primary-400', 'dark:text-primary-400', 'dark:bg-gray-700'
                );
                b.classList.add(
                    'border-gray-300', 'text-gray-600', 'bg-white',
                    'dark:border-gray-700', 'dark:text-gray-300', 'dark:bg-gray-800'
                );
            });

            button.classList.remove(
                'border-gray-300', 'text-gray-600', 'bg-white',
                'dark:border-gray-700', 'dark:text-gray-300', 'dark:bg-gray-800'
            );
            button.classList.add(
                'border-primary-500', 'text-primary-500', 'bg-[#edf3ff]',
                'dark:border-primary-400', 'dark:text-primary-400', 'dark:bg-gray-700'
            );

            // Optional: value terpilih
            const selectedValue = button.getAttribute('data-value');
            console.log('Filter dipilih:', selectedValue);
        });
    });
});