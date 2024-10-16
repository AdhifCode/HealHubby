<template>
  <div class="lg:flex">
    <img src="../assets/img/sign_bgfix.jpg" alt="" class="w-auto h-screen" />
    <div class="container pt-8 mx-12">
      <div class="pb-8">
        <h1 class="text-3xl font-bold">Create a new account?</h1>
      </div>
      <div class="pt-8 pb-2">
        <div class="grid py-4 gap-y-4">
          <div>Username</div>
          <label class="input input-lg input-bordered flex items-center gap-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 16 16"
              fill="currentColor"
              class="h-6 w-6 opacity-70"
            >
              <path
                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z"
              />
            </svg>
            <input
              type="text"
              class="pl-2 grow"
              v-model="name"
              placeholder="Username"
            />
          </label>
          <div>Email</div>
          <label class="input input-lg input-bordered flex items-center gap-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 16 16"
              fill="currentColor"
              class="h-6 w-6 opacity-70"
            >
              <path
                d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z"
              />
              <path
                d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z"
              />
            </svg>
            <input
              type="text"
              class="grow pl-2"
              v-model="email"
              placeholder="Email"
            />
          </label>
          <div>Password</div>
          <label class="input input-lg input-bordered flex items-center gap-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 16 16"
              fill="currentColor"
              class="h-6 w-6 opacity-70"
            >
              <path
                fill-rule="evenodd"
                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                clip-rule="evenodd"
              />
            </svg>
            <input
              :type="showPassword ? 'text' : 'password'"
              v-model="password"
              class="grow pl-2"
              value="password"
            />
          </label>
          <button
            class="btn btn-primary mt-4 w-full rounded-lg"
            @click="registNow"
          >
            Register
          </button>
        </div>

        <div class="pb-4 text-center">OR</div>
        <div class="flex">
          <button
            class="btn rounded-lg mr-2 text-lg text-blue-500 border border-blue-500 px-4 py-2 w-1/2"
            @click="socialLogin('google')"
          >
            Google
          </button>
          <button
            class="btn rounded-lg text-lg text-blue-500 border border-blue-500 px-4 py-2 w-1/2"
            @click="socialLogin('github')"
          >
            <i class="mdi mdi-github mr-2"></i>Github
          </button>
        </div>
      </div>
      <p class="mt-16 mb-0">
        By joining, you agree to the Doksli
        <a href="#" class="text-blue-500">Terms of Service</a> and to
        occasionally receive emails from us. Please read our Privacy Policy to
        learn how we use your personal data.
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "IndexPage",
  data() {
    return { name: "", email: "", password: "password", showPassword: false };
  },
  methods: {
    async socialLogin(provider) {
      window.location.href = `http://localhost:8000/auth/${provider}`;
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
