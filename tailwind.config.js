module.exports = {
    theme: {
      colors: {
        gray: colors.coolGray,
        blue: colors.lightBlue,
        red: colors.rose,
        pink: colors.fuchsia,
        yellow: colors.amber
      },
      fontFamily: {
        sans: ['Helvetica Neue', 'sans-serif'],
        serif: ['Georgia', 'serif'],
      },
      extend: {
        spacing: {
          '128': '32rem',
          '144': '36rem',
        },
        borderRadius: {
          '4xl': '2rem',
        }
      }
    },
    variants: {
      extend: {
        borderColor: ['focus-visible'],
        opacity: ['disabled'],
      }
    }
  }