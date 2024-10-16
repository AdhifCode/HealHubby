<template>
  <div class="main">
    <div class="video-section shadow-inner relative">
      <NavbarArticle class="navbarArticle" />
      <figure class="video-container">
        <video
          ref="videoPlayer"
          src="https://eerxwqmlhlankokqjvwv.supabase.co/storage/v1/object/public/image/landing.mp4"
          autoplay=""
          loop=""
          muted=""
          playsinline=""
          preload="metadata"
          class="lg:h-auto lg:w-dvh h-dvh w-screen"
        ></video>
      </figure>
      <div
        class="overlay absolute inset-0 flex items-center justify-center"
        style="flex-direction: column"
      >
        <p class="text-base lg:text-4xl text-white font-semibold">
          The best healthcare article website
        </p>
        <form role="search" autocomplete="off" class="mt-8">
          <div class="flex">
            <label
              class="input input-bordered input-sm max-w-sm lg:input-lg w-full lg:max-w-lg flex items-center gap-2"
              ><div class="flex grow items-center pr-4">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-4 h-4 lg:w-6 lg:h-6"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                  />
                </svg>
                <span class="pl-2 text-sm lg:text-base">Articles</span>
              </div>

              <input
                type="text"
                class="grow w-12 lg:w-96"
                placeholder="Search for free articles.."
              />
              <button class="sm:btn-sm md:btn-md lg:btn-lg p-0">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 16 16"
                  fill="currentColor"
                  class="w-4 h-4 lg:w-6 lg:h-6 opacity-70"
                >
                  <path
                    fill-rule="evenodd"
                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                    clip-rule="evenodd"
                  />
                </svg>
              </button>
            </label>
          </div>
        </form>
      </div>
    </div>
    <section id="#about">
      <div class="grid place-items-center">
        <div
          class="stats stats-vertical lg:stats-horizontal shadow lg:absolute"
        >
          <div v-for="(stat, index) in statsData" :key="index" class="stat">
            <div class="stat-figure text-secondary">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                class="inline-block w-8 h-8 stroke-current"
              >
                <path
                  :d="stat.iconPath"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                ></path>
              </svg>
            </div>
            <div class="stat-title">{{ stat.title }}</div>
            <div class="stat-value">{{ stat.value }}</div>
          </div>
        </div>
      </div>
      <div class="about container mx-auto px-60">
        <div
          class="lg:flex gap-20 font-bold text-xl"
          style="padding-top: 200px"
        >
          <img src="../assets/img/join.png" alt="" class="w-[420px] h-auto" />
          <div>
            <P
              >Kami percaya dalam memperlakukan klien kami dengan bermartabat,
              hormat, dan empati, menumbuhkan rasa percaya dan memastikan
              kenyamanan dan kebahagiaan mereka.
            </P>
            <button @click="$router.push('/article')" class="btn">
              Lihat Article
            </button>
          </div>
        </div>
      </div>
    </section>

    <div class="w-screen carousel">
      <div
        v-for="(item, index) in carouselItems"
        :key="index"
        class="carousel-item w-full grid place-items-center"
      >
        <section
          class="relative isolate overflow-hidden bg-white px-6 py-24 sm:py-32 lg:px-8"
        >
          <div
            class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.indigo.100),white)] opacity-20"
          />
          <div
            class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-white shadow-xl shadow-indigo-600/10 ring-1 ring-indigo-50 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center"
          />
          <div class="mx-auto max-w-2xl lg:max-w-4xl">
            <figure class="mt-10">
              <blockquote
                class="text-center text-xl font-semibold leading-8 text-gray-900 sm:text-2xl sm:leading-9"
              >
                <p>
                  {{ item.quote }}
                </p>
              </blockquote>
              <figcaption class="mt-10">
                <img
                  class="mx-auto h-10 w-10 rounded-full"
                  src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                  alt=""
                />
                <div
                  class="mt-4 flex items-center justify-center space-x-3 text-base"
                >
                  <div class="font-semibold text-gray-900">
                    {{ item.author }}
                  </div>
                  <svg
                    viewBox="0 0 2 2"
                    width="3"
                    height="3"
                    aria-hidden="true"
                    class="fill-gray-900"
                  >
                    <circle cx="1" cy="1" r="1" />
                  </svg>
                  <div class="text-gray-600">{{ item.position }}</div>
                </div>
              </figcaption>
            </figure>
          </div>
        </section>
      </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import NavbarArticle from "../components/Navbar.vue";
import Footer from "../components/Footer.vue";
import LoginPage from "../components/LoginPage.vue";
import axios from "axios";

export default {
  components: { NavbarArticle, LoginPage, Footer },
  data() {
    return {
      currentIndex: 0,
      intervalId: null,
      intervalDuration: 2000,
      carouselItems: [
        {
          id: 1,
          quote:
            "Kami bertujuan untuk membantu anda mendapatkan informasi tentang kesehatan",
          author: "Nadhifal AA",
          position: "CEO of HealHubby",
          imageUrl:
            "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        },
        {
          id: 2,
          quote: "GK tau ",
          author: "Destha R",
          position: "CEO of HealHubby",
          imageUrl:
            "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        },
        {
          id: 3,
          quote: "Semoga membantu masyarakat yang jauh dari layanan kesehatan",
          author: "Galuh E",
          position: "CEO of HealHubby",
          imageUrl:
            "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
        },
      ],
      statsData: [
        {
          title: "Articles",
          value: null,
          iconPath:
            "M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25",
        },
        {
          title: "Users",
          value: null,
          iconPath:
            "M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4",
        },
        {
          title: "Writers",
          value: null,
          iconPath:
            "M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4",
        },
      ],
      testimonials: [
        {
          name: "Adhif",
          text: "Why is Tailwind removing the default styles on my <code>h1</code> elements? How do I disable this? What do you mean I lose all the other base styles too?",
          title: "CEO",
        },
        {
          name: "Adhif",
          text: "Why is Tailwind removing the default styles on my <code>h1</code> elements? How do I disable this? What do you mean I lose all the other base styles too?",
          title: "CEO",
        },
        {
          name: "Adhif",
          text: "Why is Tailwind removing the default styles on my <code>h1</code> elements? How do I disable this? What do you mean I lose all the other base styles too?",
          title: "CEO",
        },
      ],
    };
  },
  mounted() {
    this.startAutoSlide();
    this.fetchStatistics();
  },
  beforeDestroy() {
    this.stopAutoSlide();
  },
  methods: {
    fetchStatistics() {
      axios
        .get("http://localhost:8000/api/getstat") // Replace '/api/getstat' with your actual API endpoint
        .then((response) => {
          // Mengatur statsData.value dengan nilai dari respons API
          this.statsData[0].value = response.data.total_articles;
          this.statsData[1].value = response.data.total_users;
          this.statsData[2].value = response.data.users_with_articles;
        })
        .catch((error) => {
          console.error("Error fetching statistics:", error);
        });
    },
    toggleVideo() {
      const videoPlayer = this.$refs.videoPlayer;
      if (videoPlayer.paused) {
        videoPlayer.play();
      } else {
        videoPlayer.pause();
      }
    },
    startAutoSlide() {
      this.intervalId = setInterval(this.nextSlide, this.intervalDuration);
    },
    stopAutoSlide() {
      clearInterval(this.intervalId);
    },
    nextSlide() {
      this.currentIndex = (this.currentIndex + 1) % this.carouselItems.length;
    },
    logout() {
      this.$store.dispatch("users/logout");
    },
  },
};
</script>

<style>
.video-container {
  position: relative;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10;
}

.overlay-content {
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  padding: 20px;
}
</style>
