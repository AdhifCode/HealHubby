<template>
  <div>
    <div class="p-4">
      <div>Email</div>
      <input
        v-model="email"
        type="email"
        class="input input-bordered rounded-lg"
      />
      <div>Password</div>
      <input
        v-model="password"
        :type="showPassword ? 'text' : 'password'"
        class="input input-bordered rounded-lg"
        @click="showPassword = !showPassword"
      />
    </div>
    <button @click="continueWithEmail" class="btn btn-primary btn-block">
      Continue
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "admin@gmail.com",
      password: "12345678",
      showPassword: false,
    };
  },
  methods: {
    goBack() {
      this.$emit("switchToChoose");
    },
    async continueWithEmail() {
      try {
        const response = await this.$axios.post("/auth/login", {
          email: this.email,
          password: this.password,
        });

        if (response.status === 200) {
          console.log("Login successful");
          this.$cookies.set("loginCookie", "Berhasil");
          this.$store.dispatch("users/login", response);
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
  computed: {
    loggedIn() {
      return this.$store.state.auth.loggedIn;
    },
    user() {
      return this.$store.state.auth.user;
    },
  },
};
</script>
