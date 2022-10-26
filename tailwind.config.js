/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [ "./resources/**/*.blade.php", ],
  theme: {
    extend: {
      colors: {
        'LightBlue':'#ADD8E6',
        'Navy':'#000080',
        'Gold':'#FFD700',
        'MidnightBlue':'#191970',
        'BlanchedAlmond':'#FFEBCD',
        'BurlyWood':'#DEB887',
        'Gray':'#808080',
        'MediumBlue':'#0000CD',
      },		
    },
  },
  plugins: [],
}
