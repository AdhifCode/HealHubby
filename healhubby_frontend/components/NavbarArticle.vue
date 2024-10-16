<template>
  <div class="navbar bg-base-100">
    <div class="container mx-auto px-16">
      <div class="flex-1">
        <a class="btn btn-ghost text-xl">HealHubby</a>
      </div>
      <div class="flex gap-2">
        <input
          type="text"
          placeholder="Search on article.."
          clearable
          class="input input-bordered w-24 md:w-auto"
          v-model="searchQuery"
          @input="handleSearch"
        />
        <div v-if="!hasCookie">
          <button
            @click="$router.push('/sign-in')"
            for="login_modal"
            class="btn btn-ghost m-0"
          >
            Login
          </button>

          <button @click="$router.push('/sign-up')" class="btn m-0 bg-current">
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
            </svg>
          </button>
        </div>
        <div v-else class="dropdown dropdown-end">
          <div
            tabindex="0"
            role="button"
            class="btn btn-ghost btn-circle avatar"
          >
            <div class="w-10 rounded-full">
              <img
                alt="Tailwind CSS Navbar component"
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
            class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52"
          >
            <li>
              <a @click="$router.push('/profile')" class="justify-between"
                >Profile
              </a>
            </li>
            <div class="divider p-0 m-0"></div>
            <li><a @click="logout()">Logout</a></li>
          </ul>
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
      profile: [],
      searchQuery: "",
      user_id: null,
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

    handleSearch() {
      this.$emit("search", this.searchQuery);
    },
    logout() {
      this.$store.dispatch("users/logout");
    },
  },
  computed: {
    hasCookie() {
      if (process.client) {
        return document.cookie.includes("loginCookie=");
      }
      return false;
    },
  },
  mounted() {
    this.fetchUser();
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
};
</script>