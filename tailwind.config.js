/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Filament/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        drex: {
          950: '#020d0a',
          900: '#051b14',
          800: '#09291f',
          700: '#0d3d2f',
          600: '#115e48',
          accent: '#10b981',
          light: '#f7f4ea',
        }
      }
    },
  },
  plugins: [],
}