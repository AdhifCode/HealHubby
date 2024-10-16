<template>
  <div>
    <div class="py-4 pt-0">
      <div>Username</div>
      <input
        class="input input-bordered rounded-lg"
        type="text"
        v-model="name"
        placeholder="Username"
      />
      <div>Email</div>
      <input
        class="input input-bordered rounded-lg"
        type="email"
        v-model="email"
        placeholder="Email"
      />
      <div>Password</div>
      <input
        class="input input-bordered rounded-lg pr-10"
        :type="showPassword ? 'text' : 'password'"
        v-model="password"
        placeholder="Password"
      />
      <button class="btn btn-primary mt-4 w-full rounded-lg" @click="registNow">
        Register
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      showPassword: false,
    };
  },
  methods: {
    goBack() {
      this.$emit("switchToChoose");
    },
    async registNow() {
      try {
        const response = await this.$axios.post("/register", {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password,
        });

        console.log(response);

        if (response.status === 201) {
          console.log("Register successful");
          this.$cookies.set("loginCookie", "Berhasil");
          this.$store.dispatch("users/login", response);
          console.log(response.data);
        } else {
          console.error("Register failed");
          console.error(response.data);
        }
      } catch (error) {
        console.error("An error occurred:", error);
      }
    },
  },
};
</script>
