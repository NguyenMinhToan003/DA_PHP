/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js,php}", // Include files to scan for Tailwind classes
  ],
  theme: {
    extend: {
      colors: {
        primary: '#db4444',
      },
    },
  },

  plugins: [],
  darkMode: 'class', // Enable dark mode if needed
};
