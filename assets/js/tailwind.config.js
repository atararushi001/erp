/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {
      margin: {
        "nav-margin": "4.6rem",
      },
      colors: {
        "custom-blue": "#031A61",
      },
    },
  },
  plugins: [],
};
