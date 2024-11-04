import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {

        extend: {
            fontFamily: {
                sans: ['ibm-plex-sans', ...defaultTheme.fontFamily.sans],
                serif: ['ibm-plex-serif']
            },
            colors: {
                main: '#310881',
                mainHover: '#310999',
                bodyBackground: '#EFEEE9',
                author: '#9864FF',
                authorHover: '#9864FF80'
            },
        },
    },

    plugins: [forms],
};
