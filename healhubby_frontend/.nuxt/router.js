import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _361ef730 = () => interopDefault(import('..\\pages\\article\\index.vue' /* webpackChunkName: "pages/article/index" */))
const _4150d188 = () => interopDefault(import('..\\pages\\contact.vue' /* webpackChunkName: "pages/contact" */))
const _df78085c = () => interopDefault(import('..\\pages\\dashboard\\index.vue' /* webpackChunkName: "pages/dashboard/index" */))
const _ad234ce6 = () => interopDefault(import('..\\pages\\divide.vue' /* webpackChunkName: "pages/divide" */))
const _ef891d4c = () => interopDefault(import('..\\pages\\hubby\\index.vue' /* webpackChunkName: "pages/hubby/index" */))
const _df1b46c6 = () => interopDefault(import('..\\pages\\profile\\index.vue' /* webpackChunkName: "pages/profile/index" */))
const _41e883d1 = () => interopDefault(import('..\\pages\\sign-in.vue' /* webpackChunkName: "pages/sign-in" */))
const _567eda47 = () => interopDefault(import('..\\pages\\sign-up.vue' /* webpackChunkName: "pages/sign-up" */))
const _6c05efce = () => interopDefault(import('..\\pages\\auth\\social-callback.vue' /* webpackChunkName: "pages/auth/social-callback" */))
const _23dc5c4c = () => interopDefault(import('..\\pages\\dashboard\\manage_article.vue' /* webpackChunkName: "pages/dashboard/manage_article" */))
const _3239c1e5 = () => interopDefault(import('..\\pages\\dashboard\\manage_user.vue' /* webpackChunkName: "pages/dashboard/manage_user" */))
const _424d6b0e = () => interopDefault(import('..\\pages\\profile\\update.vue' /* webpackChunkName: "pages/profile/update" */))
const _e1ef7824 = () => interopDefault(import('..\\pages\\index.vue' /* webpackChunkName: "pages/index" */))
const _0195c658 = () => interopDefault(import('..\\pages\\article\\_articlename.vue' /* webpackChunkName: "pages/article/_articlename" */))

const emptyFn = () => {}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: '/',
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/article",
    component: _361ef730,
    name: "article"
  }, {
    path: "/contact",
    component: _4150d188,
    name: "contact"
  }, {
    path: "/dashboard",
    component: _df78085c,
    name: "dashboard"
  }, {
    path: "/divide",
    component: _ad234ce6,
    name: "divide"
  }, {
    path: "/hubby",
    component: _ef891d4c,
    name: "hubby"
  }, {
    path: "/profile",
    component: _df1b46c6,
    name: "profile"
  }, {
    path: "/sign-in",
    component: _41e883d1,
    name: "sign-in"
  }, {
    path: "/sign-up",
    component: _567eda47,
    name: "sign-up"
  }, {
    path: "/auth/social-callback",
    component: _6c05efce,
    name: "auth-social-callback"
  }, {
    path: "/dashboard/manage_article",
    component: _23dc5c4c,
    name: "dashboard-manage_article"
  }, {
    path: "/dashboard/manage_user",
    component: _3239c1e5,
    name: "dashboard-manage_user"
  }, {
    path: "/profile/update",
    component: _424d6b0e,
    name: "profile-update"
  }, {
    path: "/",
    component: _e1ef7824,
    name: "index"
  }, {
    path: "/article/:articlename",
    component: _0195c658,
    name: "article-articlename"
  }],

  fallback: false
}

export function createRouter (ssrContext, config) {
  const base = (config._app && config._app.basePath) || routerOptions.base
  const router = new Router({ ...routerOptions, base  })

  // TODO: remove in Nuxt 3
  const originalPush = router.push
  router.push = function push (location, onComplete = emptyFn, onAbort) {
    return originalPush.call(this, location, onComplete, onAbort)
  }

  const resolve = router.resolve.bind(router)
  router.resolve = (to, current, append) => {
    if (typeof to === 'string') {
      to = normalizeURL(to)
    }
    return resolve(to, current, append)
  }

  return router
}
