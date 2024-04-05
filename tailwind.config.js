/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    // Add more paths here if your project uses other types of files that contain Tailwind CSS classes
  ],
  theme: {
    extend: {
      // Extend Tailwind's default theme here if needed
    },
  },
  plugins: [
    // Add any Tailwind CSS plugins you plan to use here
  ],
}