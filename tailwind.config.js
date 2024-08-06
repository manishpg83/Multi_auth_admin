import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'green-500': '#48bb78',
                'green-600': '#38a169',
                'red-500': '#f56565',
                'red-600': '#e53e3e',
                'blue-600': '#2563eb',
                'blue-700': '#1d4ed8',
                'gray-200': '#edf2f7',
                'gray-300': '#e2e8f0',
            },
            spacing: {
                '1': '0.25rem',
                '2': '0.5rem',
                '3': '0.75rem',
                '4': '1rem',
            },
            borderRadius: {
                'md': '0.375rem',
                'lg': '0.5rem',
            },
            fontSize: {
                'sm': '0.875rem',
            },
        },
    },

    plugins: [forms],
};
