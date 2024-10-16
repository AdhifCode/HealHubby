<template>
  <div>
    <LoadSpinner v-if="showHideSpinner" />
  </div>
</template>

<script>
import LoadSpinner from "@/components/LoadSpinner.vue";

import axios from "axios";
export default {
  components: { LoadSpinner },

  data() {
    return {
      token: null,
      provider: "",
      showHideSpinner: true,
    };
  },
  methods: {
    async socialLogin(provider, token) {
      try {
        const email = this.$route.query.email ? this.$route.query.email : "";
        const rememberToken = this.$route.query.remember_token
          ? this.$route.query.remember_token
          : "";

        const response = await axios.post(
          `http://127.0.0.1:8000/api/auth/loginSocialite`,
          {
            token: token,
            email: email,
            remember_token: rememberToken,
          }
        );

        if (response.status === 200) {
          console.log("Login successful");
          this.$cookies.set("loginCookie", "Berhasil");
          this.$store.dispatch("users/login", response);
          this.showHideSpinner = false;
          console.log(response.data);
        } else {
          console.error("Login failed");
          console.error(response.data);
        }
      } catch (error) {
        console.error("An error occurred:", error);
      }
    },
  },
  mounted() {
    this.token = this.$route.query.token ? this.$route.query.token : null;
    this.provider = this.$route.query.provider
      ? this.$route.query.provider
      : null;

    if (this.provider && this.token) {
      this.socialLogin(this.provider, this.token);
    }
  },
};
</script>


// async handleLogin() {
  //   try {
  //     const response = await this.$auth.loginWithToken(this.token)
  //     if (response.status === 200) {
  //       console.log('Login successful')
  //       this.$cookies.set('loginCookie', 'Berhasil')
  //       this.$store.dispatch('users/login', response)
  //       console.log(response.data)
  //     } else {
  //       console.error('Login failed')
  //       console.error(response.data)
  //     }
  //   } catch (error) {
  //     return this.$router.push(
  //       '/?error=Your token appeared to be invalid, please try again'
  //     )
  //   }
  // },