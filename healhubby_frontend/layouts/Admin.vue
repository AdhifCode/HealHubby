<template>
  <div>
    <LoadSpinner v-if="loading" />
    <div class="flex h-dvh">
      <div class="w-2/12 bg-blue-500 pb-0 pr-0">
        <div class="pt-8">
          <div class="flex flex-col items-center">
            <img
              :src="require('~/assets/img/LogoPJBL.png')"
              class="mb-8 w-24 lg:w-24"
              alt="Logo"
            />
            <div class="flex flex-col items-center">
              <div
                class="rounded-full overflow-hidden border-4 border-white w-24 h-24"
              >
                <img
                  :src="
                    dataprofil.image
                      ? `http://127.0.0.1:8000/storage/${dataprofil.image}`
                      : require('@/assets/img/unknown.jpeg')
                  "
                  class="w-24 h-24"
                  alt="Profile Picture"
                />
              </div>
              <p class="text-white text-lg mt-4">{{ dataprofil.name }}</p>
              <p class="text-white font-normal">
                {{ displayRole(dataprofil.role_id) }}
              </p>
            </div>
            <div v-for="(rute, i) in routersku" :key="i">
              <button
                @click="$router.push(rute.rt)"
                class="text-left font-medium my-4 py-2 capitalize w-full focus:outline-none"
                :class="{
                  'text-white': isaktif(rute.rt),
                  'text-gray-300': !isaktif(rute.rt),
                }"
              >
                {{ rute.nama }}
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="w-10/12">
        <nuxt />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showMenu: false,
      menu: false,
      dataprofil: {
        name: null,
        email: null,
        phone: null,
      },
      userid: null,
      loading: true,
      routersku: [
        {
          nama: "Dashboard",
          rt: "/dashboard",
        },
        {
          nama: "User",
          rt: "/dashboard/manage_user",
        },
        {
          nama: "Article Request",
          rt: "/dashboard/manage_article",
        },
      ],
      menus: [
        {
          title: "Profile",
          icon: "mdi-account",
        },
        {
          title: "Log Out",
          icon: "mdi-logout",
        },
      ],
    };
  },

  computed: {
    hasCookie() {
      if (process.client) {
        return document.cookie.includes("loginCookie=");
      }
      return false;
    },
  },

  methods: {
    displayRole(roleId) {
      if (roleId === 1) {
        return "Admin";
      } else if (roleId === 2) {
        return "Operator";
      } else {
        return "Unknown Role";
      }
    },
    logout() {
      this.$store.dispatch("users/logout");
    },
    isaktif(pathh) {
      return this.$route.path === pathh;
    },
    handleMenuClick(menu) {
      if (menu.title === "Log Out") {
        this.logout();
      } else {
        window.location.replace("/MainPage/action/profile");
      }
    },
    logout() {
      this.$store.dispatch("users/logout");
    },
  },
  created() {
    const usid = this.$cookies.get("loginCookie");
    this.userid = usid.data?.data.id;
    this.dataprofil = usid.data?.data;
  },
  mounted() {
    setTimeout(() => {
      this.loading = false;
    }, 2000);
  },
};
</script>
