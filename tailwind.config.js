import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import { all } from 'axios';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        'rotate-180',
        'sidebar-collapsed',
        '-translate-x-full',
        'col-span-2',
        'row-span-2',
        // Class Tom Select (agar Tailwind tidak menghapus saat purge)
        'ts-wrapper',
        'ts-control',
        'ts-dropdown',
        'item',
        'remove-button',
        'option',
        'multi',
        'focus',
    ],

    theme: {
        extend: {
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        // Blockquote
                        blockquote: {
                            fontWeight: 'normal',
                            fontStyle: 'normal',
                            borderLeftColor: theme('colors.yellow.400'),
                            quotes: 'none',
                        },
                    },
                },
            }),

            fontFamily: {
                inter: ['Inter', 'sans-serif'],
            },
            colors: {
                primary: {
                    DEFAULT: '#4A90E2',
                    light: '#EAF2FD',
                    dark: '#357ABD',
                },
                secondary: '#50E3C2',
                maroon: '#800000',
                text: {
                    dark: '#2C3E50',
                    light: '#8A92A6',
                    DEFAULT: '#5A6A7B', // Menambahkan default text color
                },
                background: '#F7F8FC',
                surface: '#FFFFFF',
                border: '#E9ECEF',
                danger: '#E53E3E', // Menambahkan warna bahaya
            },
            boxShadow: {
                'soft': '0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05)',
                'medium': '0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07)',
            }
        },
    },

    plugins: [
        forms,
        typography,
    ],
};
