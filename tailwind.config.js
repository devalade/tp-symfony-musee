module.exports = {
  mode: 'jit',
  purge: {
    layers: ['components', 'utilities'],
    content: [
    './vendor/symfony/twig-bridge/Resources/views/Form/tailwind_2_layout.html.twig',
    './templates/**/*.html.twig',
    './assets/**/*.js',
    ]
  },
  darkMode: true, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
