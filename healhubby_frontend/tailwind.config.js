/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [],
  theme: {
    container: {
      center: true,
    },
    extend: {
      fontFamily: {
        "plus-jakarta-sans": ["Plus Jakarta Sans", "sans-serif"],
      },
    },
  },
  plugins: [
    require("@tailwindcss/typography"),
    require("daisyui"),
    "prettier-plugin-tailwindcss",
  ],

  daisyui: {
    themes: ["light"], // false: only light + dark | true: all themes | array: specific themes like this ["light", "dark", "cupcake"]
    // darkTheme: "dark",
    base: true, // applies background color and foreground color for root element by default
    styled: true, // include daisyUI colors and design decisions for all components
    utils: true, // adds responsive and modifier utility classes
    prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
    logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
    themeRoot: ":root", // The element that receives theme color CSS variables
  },
  jit: true,
};
