import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js" // <-- TAMBAHKAN INI
    ],

    theme: {
        extend: {
            colors: {
                'imst-blue': '#0052cc', // Perkiraan warna biru dari logo
                'imst-red': '#e02424',   // Perkiraan warna merah dari logo
            }
        },
    },

    plugins: [
        require('flowbite/plugin') // <-- TAMBAHKAN INI
    ],
};
