import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        "./node_modules/flowbite/**/*.js",
        './vendor/namu/wirechat/resources/views/**/*.blade.php',
'       ./vendor/namu/wirechat/src/Livewire/**/*.php',
        
    ],
    safelist: [
        'hidden',
        'block',
        'bg-white',
        'shadow-md',
        'dark:bg-gray-800',
        'backdrop-blur-md',
      ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                dark:{
                    black:'#313131',
                    secondary:'#808080',
                    tertiary:'#9C9C9C',
                    accent:'#D9D9D9',
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
            keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-10px)' },
        },
      },
      animation: {
        'float-slow': 'float 6s ease-in-out infinite',
        'float-medium': 'float 4s ease-in-out infinite',
        'float-fast': 'float 2s ease-in-out infinite',
      },
        },
    },
    plugins: [
        require('flowbite/plugin'),
        require('tailwind-scrollbar-hide'),
    ],
    
};
