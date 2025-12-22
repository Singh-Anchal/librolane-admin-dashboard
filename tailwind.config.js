/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      // Your custom Velzon Theme Colors
      colors: {
        "v-dark": "#0a1832",        // Velzon Dark Sidebar
        "v-primary": "#405189",     // Velzon Primary Blue
        "v-secondary": "#3577f1",   // Velzon Secondary Blue
        "v-bg": "#f3f3f9",          // Velzon Background
      },
      // Your custom Font
      fontFamily: { 
        "display": ["Lexend", "sans-serif"] 
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/container-queries'),
  ],
}