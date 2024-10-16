<template>
  <div class="container mx-auto">
    <template v-if="showLoginChoose">
      <div class="pt-8">
        <div class="pb-0">
          <h1 class="text-3xl font-bold">Create a new account?</h1>
        </div>
        <div class="pt-0 pb-2">
          <SignInEmail />

          <div class="pt-4 pb-4 text-center">OR</div>
          <div class="flex">
            <button
              class="rounded-lg mr-2 text-lg text-blue-500 border border-blue-500 px-4 py-2 w-1/2"
              @click="socialLogin('google')"
            >
              <i class="mdi mdi-google mr-2"></i>Google
            </button>
            <button
              class="rounded-lg text-lg text-blue-500 border border-blue-500 px-4 py-2 w-1/2"
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
    </template>
  </div>
</template>

<script>
import SignInEmail from "../SignIn/SignInEmail.vue";

export default {
  components: { SignInEmail },
  name: "IndexPage",
  data() {
    return {
      showLoginChoose: true,
      showLoginPhone: false,
      showLoginEmail: false,
    };
  },
  methods: {
    async socialLogin(provider) {
      window.location.href = `http://localhost:8000/auth/${provider}`;
    },
  },
};
</script>
