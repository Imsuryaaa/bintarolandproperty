/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                brand: {
                    50:  '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                    950: '#451a03',
                },
                navy: {
                    50:  '#f0f4ff',
                    100: '#dde6ff',
                    200: '#c3d0fe',
                    300: '#9db0fb',
                    400: '#7585f5',
                    500: '#5461eb',
                    600: '#3d42df',
                    700: '#3234c4',
                    800: '#2a2e9e',
                    900: '#282c7d',
                    950: '#1a1d4f',
                },
                charcoal: {
                    50:  '#f7f7f8',
                    100: '#eeeef0',
                    200: '#d9d9de',
                    300: '#b8b8c1',
                    400: '#91919f',
                    500: '#747484',
                    600: '#5e5e6d',
                    700: '#4c4c59',
                    800: '#41414d',
                    900: '#393944',
                    950: '#18181f',
                },
            },
            fontFamily: {
                sans:  ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                serif: ['"Playfair Display"', 'Georgia', 'serif'],
            },
            boxShadow: {
                'card':   '0 1px 3px 0 rgba(0,0,0,.06), 0 4px 16px 0 rgba(0,0,0,.06)',
                'card-hover': '0 4px 6px -1px rgba(0,0,0,.08), 0 12px 30px -5px rgba(0,0,0,.12)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};
