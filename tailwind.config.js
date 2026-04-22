import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                'primary': '#922225',
                'primary-container': '#b33a3a',
                'secondary': '#8f4c2a',
                'secondary-container': '#fda77d',
                'secondary-fixed': '#ffdbcc',
                'background': '#fef8f3',
                'surface': '#fef8f3',
                'surface-container': '#f2ede8',
                'surface-container-low': '#f8f3ee',
                'surface-container-high': '#ece7e2',
                'surface-container-highest': '#e6e2dd',
                'surface-container-lowest': '#ffffff',
                'on-surface': '#1d1b19',
                'on-surface-variant': '#584140',
                'outline': '#8b716f',
                'outline-variant': '#dfbfbd',
                'on-primary': '#ffffff',
                'on-secondary': '#ffffff',
                'on-secondary-container': '#773a19',
                'on-secondary-fixed': '#351000',
                'inverse-on-surface': '#f5f0eb',
            },
            fontFamily: {
                'headline': ['Playfair Display', 'serif'],
                'body': ['Source Sans 3', 'sans-serif'],
                'news': ['Newsreader', 'serif'],
                'label': ['Source Sans 3', 'sans-serif'],
            },
            borderRadius: {
                'DEFAULT': '0.25rem',
                'lg': '0.5rem',
                'xl': '0.75rem',
                'full': '9999px',
            },
        },
    },
    plugins: [],
};