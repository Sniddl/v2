const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require('tailwindcss/plugin')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            strokeWidth: {
                'inherit': 'inherit',
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        // plugin(function({ matchUtilities, theme, addComponents }) {
        //     console.log(theme('colors'))
        //     // matchUtilities(
        //     //   {
        //     //     tab: (value) => ({
        //     //       tabSize: value
        //     //     }),
        //     //   },
        //     //   { values: theme('tabSize') }
        //     // )
        // })
    ],
};
