/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js,php}", // Add PHP files here to be scanned by Tailwind
  ],
  theme: {
    extend: {},
  },
  plugins: [],
  darkMode: 'selector',
};
