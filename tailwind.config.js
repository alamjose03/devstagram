/** @type {import('tailwindcss').Config} */
export default {
  content: [
    //Archivos donde se agregará los estilos tailwind
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

