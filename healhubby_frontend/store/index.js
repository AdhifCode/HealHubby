import Cookies from 'cookie-universal-nuxt'
import axios from 'axios'

export const state = () => ({
  auth: {
    loggedIn: null,
    user: null,
    token: null,
  },
})

export const mutations = {
  SET_AUTH(state, payload) {
    state.auth.loggedIn = payload
  },
  RESET_AUTH(state) {
    state.auth.loggedIn = false
    state.auth.user = null
    state.auth.token = null
  },
}

export const actions = {
  async login({ commit }, { email, password }) {
    try {
      const response = await this.$axios.post('/login', { email, password })

      commit('SET_AUTH', {
        loggedIn: true,
        user: response.data.data.user,
        token: response.data.token,
      })
      const cookies = new Cookies()
      cookies.set('authToken', response.data.token)

      return response
    } catch (error) {
      throw error
    }
  },

  async register({ commit }, { name, email, password }) {
    try {
      const response = await this.$axios.post('/register', {
        name,
        email,
        password,
      })

      commit('SET_AUTH', {
        loggedIn: true,
        user: response.data.data.user,
        token: response.data.token,
      })
      const cookies = new Cookies()
      cookies.set('authToken', response.data.token)

      return response
    } catch (error) {
      throw error
    }
  },

  async logout({ commit }) {
    try {
      const response = await this.$axios.post('/logout')

      commit('RESET_AUTH')
      const cookies = new Cookies()
      cookies.remove('authToken')

      return response
    } catch (error) {
      throw error
    }
  },
}
