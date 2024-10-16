// import Cookies from 'cookie-universal-nuxt'
import axios from "axios";
export const state = () => {
  return {
    authenticated: null,
    cekuser: null,
    datauserlogin: null,
  };
};

export const mutations = {
  SETCOOKIE(state, payload) {
    state.authenticated = payload;
  },
  GETUSERLOGIN(state, payload) {
    state.datauserlogin = payload;
  },
  SETCOOKIESUSER(state, payload) {
    state.cekuser = payload;
  },
};
export const actions = {
  getuserlogin({ commit }) {
    const usid = this.$cookies.get("loginCookie");
    const userid = usid.data.id;
    axios.get("http://127.0.0.1:8000/api/users/" + userid).then((respon) => {
      commit("GETUSERLOGIN", respon.data?.data);
    });
  },
  setcookie({ commit }) {
    console.log("setcookie action called");
    const loginCookie = this.$cookies.get("loginCookie");
    console.log("cookie value:", loginCookie);
    commit("SETCOOKIE", loginCookie);
  },

  login({ commit, $router }, payload) {
    this.$cookies.set("loginCookie", payload);
    commit("SETCOOKIE", payload);
    window.location.replace("/article");
  },

  logout({ commit }) {
    window.location.replace("/");
    this.$cookies.remove("loginCookie");
    this.$cookies.remove("XSRF-TOKEN");
    this.$toast.success("Berhasil logout");
    commit("SETCOOKIE");
  },

  // logincekuser({ commit }, payload) {
  //   this.$cookies.set('cekuserlogin', payload)
  //   commit('SETCOOKIESUSER')
  //   // return redirect('/')
  // },
  // resetlogincekuser({ commit }) {
  //   this.$cookies.remove('cekuserlogin')
  //   commit('SETCOOKIESUSER')
  //   // return redirect('/')
  // },
};
