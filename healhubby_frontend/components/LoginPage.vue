<template>
  <div class="card card-side glass" style="height: 645px; width: 875px">
    <figure class="col-span-6">
      <img
        :src="require('@/assets/img/LoginPage_img.jpeg')"
        alt="Login Image"
        class="h-auto w-full rounded-l-3xl"
      />
    </figure>
    <div class="col-span-6">
      <template v-if="!showSignIn">
        <LoginChoose @activateSignIn="activateSignIn" />
      </template>
      <template v-else>
        <SignInChoose @nonActiveSignIn="nonActiveSignIn" />
      </template>
    </div>
  </div>
</template>

<script>
import LoginChoose from "./Login/LoginChoose.vue";
import SignInChoose from "./SignIn/SignInChoose.vue";

export default {
  components: { LoginChoose, SignInChoose },
  name: "IndexPage",
  data() {
    return {
      showSignIn: false,
    };
  },
  methods: {
    activateSignIn() {
      this.showSignIn = true;
    },
    nonActiveSignIn() {
      this.showSignIn = false;
    },
  },
};
</script>

<style scoped>
</style>
