import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
      "./node_modules/flowbite/**/*.js"
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                primary:{
                    400: '#3c6ff6',
                    500: '#2254c5',
                    600: '#1c46a6',
                    700: '#153882',
                    800: '#0e2760',
                    900: '#081740',
                }
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
