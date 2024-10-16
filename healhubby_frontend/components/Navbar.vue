<template>
  <div>
    <div class="fixed pt-6 w-screen z-50 grid place-items-center">
      <div class="navbar glass rounded-lg w-96 lg:w-[600px]">
        <div class="awal">
          <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h7"
                />
              </svg>
            </div>
            <ul
              tabindex="0"
              class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52"
            >
              <li><a href="#about">About</a></li>
              <li><a href="#portfolio">Portfolio</a></li>
              <li>
                <a href="#testimonial">Testimoni</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="tengah">
          <a class="btn btn-ghost text-xl">HealHubby</a>
        </div>
        <div class="terakhir">
          <div v-if="!hasCookie">
            <NuxtLink to="/sign-in">
              <button for="login_modal" class="btn btn-ghost m-0">
                Login
              </button></NuxtLink
            >

            <NuxtLink to="/sign-up"
              ><button class="btn m-0 bg-current">
                <p class="text-white">Sign up free</p>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="white"
                  class="w-6 h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                  />
                </svg></button
            ></NuxtLink>
          </div>
          <div v-else class="dropdown dropdown-end">
            <div
              tabindex="0"
              role="button"
              class="avatar btn btn-ghost btn-circle w-12"
            >
              <div class="w-12 rounded-full">
                <img
                  :src="
                    profile.image
                      ? `http://127.0.0.1:8000/storage/${profile.image}`
                      : require('@/assets/img/unknown.jpeg')
                  "
                />
              </div>
            </div>
            <ul
              tabindex="0"
              class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 mt-3"
            >
              <NuxtLink to="/profile">
                <li>
                  <a
                    ><svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-6 h-6"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                      />
                    </svg>
                    Profile</a
                  >
                </li>
              </NuxtLink>
              <li>
                <a @click="logout()"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"
                    />
                  </svg>
                  Log Out</a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      user_id: null, // Inisialisasi user_id
      profile: {},
    };
  },
  methods: {
    async fetchUser() {
      try {
        const response = await axios.get(
          `http://localhost:8000/api/users/${this.user_id}`
        );
        this.profile = response.data.data;
        console.log("tes", this.profile);
      } catch (error) {
        console.error("Error fetching user:", error);
      }
    },

    logout() {
      this.$store.dispatch("users/logout");
    },
  },
  created() {
    const usid = this.$cookies.get("loginCookie");
    if (usid) {
      this.user_id = usid.data?.data.id;
      this.dataprofil = usid.data?.data;
      console.log(usid);
    } else {
      this.user_id = null;
    }
  },
  mounted() {
    this.fetchUser();
  },
  computed: {
    hasCookie() {
      if (process.client) {
        return document.cookie.includes("loginCookie=");
      }
      return false;
    },
  },
};
</script>