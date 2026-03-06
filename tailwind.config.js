/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/views/**/*.php", "./public/js/**/*.js"],
  theme: {
    extend: {
      colors: {
        "bintang-red": "#E50914",
        "bintang-dark": "#0F172A",
      },
    },
  },
  plugins: [],
};
