import dotenv from "dotenv";
require("dotenv").config();
export default {
  darkMode: "class",
  target: "server",

  server: {},
  head: {
    title: "HealHubby",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      {
        hid: "description",
        name: "description",
        content:
          " Nuxt 2 OpenAI Integration: Seamlessly integrate the power of OpenAI's natural language processing capabilities into your Nuxt.js 2 applications. This comprehensive package provides a simple and efficient way to leverage OpenAI's cutting-edge language models, enabling you to build intelligent and dynamic applications that can generate human-like text, perform language translation, sentiment analysis, and much more. Accelerate your development process and unlock the full potential of Nuxt.js and OpenAI with this feature-rich integration.",
      },
      { hid: "keywords", name: "keywords", content: "Vue.js, Nuxt.js" },
    ],
    link: [
      {
        rel: "stylesheet",
        href: "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css",
        integrity:
          "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm",
        crossorigin: "anonymous",
      },
    ],
  },

  /*
   ** Global CSS
   */
  css: ["~/assets/css/main.css"],

  /*
   ** Plugins to load before mounting the App
   */
  plugins: [],
  build: {},
  /*
   ** Nuxt.js dev-modules
   */
  buildModules: ["@nuxtjs/tailwindcss", "@nuxtjs/google-fonts"],
  /*
   ** Nuxt.js modules
   */
  modules: ["@nuxtjs/dotenv", "@nuxtjs/axios", "cookie-universal-nuxt"],

  axios: {
    baseURL: "http://localhost:8000/api",
  },

  env: {
    baseUrl: process.env.BASE_API_URL || "http://localhost:8000/api/",
  },

  router: {},
  generate: {
    routes: function () {},
  },

  env: {
    NODE_ENV: process.env.NODE_ENV,
  },

  privateRuntimeConfig: {
    axios: {
      baseURL: process.env.BACKEND_API,
    },
  },

  moment: {
    defaultTimezone: "Indonesia/Jakarta",
  },

  googleFonts: {
    families: {
      "Plus Jakarta Sans": [100, 300, 400, 700, 900],
    },
    display: "swap",
    prefetch: true,
    preconnect: true,
  },
};
