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
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                dark:{
                    black:'#313131'
                },
                primary:{
                    50: '#E9EFFA',
                    100: '#BCCEEE',
                    200: '#9CB6E6',
                    300: '#6E95DB',
                    400: '#5281D4',
                    500: '#2761C9',
                    600: '#2358B7',
                    700: '#1C458F',
                    800: '#15356F',
                    900: '#102954',
                }
            },
        },
    },
    plugins: [
        require('flowbite/plugin'),
        laravel([
            'resources/js/landing.js',
            'resources/css/app.css',
            'resources/js/app.js', 
        ]),
    ],
    
};
