/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './node_modules/flowbite/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#171d4e',
        secondary: '#ecf9fc'
      },
    },
  },
  plugins: [require('flowbite/plugin')],
}
