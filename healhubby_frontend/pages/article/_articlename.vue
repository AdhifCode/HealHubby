  <template>
  <div>
    <NavbarArticle @search="handleSearch" class="fixed" style="z-index: 100" />

    <div class="grid grid-rows-3 grid-flow-col gap-4 pt-16">
      <div class="row-span-3 container mx-auto px-20 pt-6">
        <div class="text-sm breadcrumbs">
          <ul>
            <li>
              <a @click="$router.push('/')"> Home</a>
            </li>
            <li>
              <div
                class="hover:font-semibold transition ease-in-out delay-150 duration-300"
              >
                <a @click="$router.push('/article')">Articles</a>
              </div>
            </li>
            <li>
              <div class="truncate max-w-[150px] overflow-hidden font-semibold">
                {{ topic.title }}
              </div>
            </li>
          </ul>
        </div>
        <p class="topic-title text-center">{{ topic.title }}</p>
        <div class="text-sm flex align-center justify-center py-6">
          <ul class="flex">
            <li>
              <a class="font-bold capitalize">By {{ topic.author?.name }}</a>
            </li>
            <li><a class="px-2">/</a></li>
            <li>
              <a>{{ topic.datetime }}</a>
            </li>
            <li><a class="px-2">/</a></li>
            <li class="flex justify-center align-center">
              {{ topic.total_favorites }}
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-4 h-4"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                />
              </svg>
            </li>
          </ul>
        </div>

        <div class="pb-6 w-full h-auto grid place-items-center">
          <!-- <video
            src="https://eerxwqmlhlankokqjvwv.supabase.co/storage/v1/object/public/image/landing.mp4"
            autoplay=""
            loop=""
            muted=""
            playsinline=""
            preload="metadata"
            class="w-auto h-[630] px-4"
          ></video> -->
          <img
            :src="
              topic.article_image
                ? `http://127.0.0.1:8000/storage/${topic.article_image}`
                : require('@/assets/img/unknown.jpeg')
            "
            alt=""
            class="w-auto h-[630] px-4"
          />
        </div>
        <div
          class="container mx-auto px-4 prose min-h-[20px] text-message flex flex-col items-start gap-3 whitespace-pre-wrap break-words [.text-message+&amp;]:mt-5"
        >
          <p
            class="topic-content drop-cap"
            v-html="highlightKeywords(topic.content)"
          >
            {{ topic.content }}
          </p>
        </div>
        <div class="grid place-items-center py-6">
          <div class="flex gap-2">
            <button
              @click="toggleFavorite"
              class="btn rounded-3xl text-white bg-black"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="w-6 h-6"
              >
                <path
                  d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z"
                />
              </svg>

              <p class="uppercase">Favorite</p>
            </button>
            <div>
              <button
                @click="toggleHubby"
                class="btn btn-circle btn-outline btn-info"
              >
                <img
                  :src="require('@/assets/img/LogoPJBL.png')"
                  alt=""
                  class="w-8 h-auto"
                  style="padding-bottom: 4px"
                />
              </button>
            </div>
          </div>
          <div class="avatar mt-4">
            <div class="w-16 rounded-full">
              <img
                :src="
                  topic.author?.image
                    ? `http://127.0.0.1:8000/storage/${topic.author?.image}`
                    : require('@/assets/img/unknown.jpeg')
                "
              />
            </div>
          </div>
        </div>
      </div>
      <div
        v-if="showHubby"
        class="toggle-hubby col-span-3 pt-16 h-dvh sticky top-0 min-w-full"
      >
        <HubbyAI :articleContent="topic.content" />
      </div>
    </div>
  </div>
</template>

  <script>
import Footer from "@/components/Footer";
import NavbarArticle from "@/components/NavbarArticle";
import HubbyAI from "@/components/HubbyAI";
import axios from "axios";

export default {
  components: { Footer, NavbarArticle, HubbyAI },
  // middleware: ["authenticated"],
  data() {
    return {
      outputKey: 1,
      isLoading: false,
      showHubby: false,
      searchQuery: "",
      articlename: "halo",
      topic: {},

      queryInput: "",
      chatHistory: [],
      room_name: this.$route.params.articlename,
      question: [
        "Apa saja makanan yang disarankan untuk dikonsumsi guna mendukung kesehatan jantung?",
        "Bagaimana pola makan yang seimbang dapat membantu dalam mempertahankan berat badan yang sehat?",
        "Mengapa penting untuk menghindari makanan tinggi gula atau lemak jenuh untuk menjaga energi dan produktivitas?",
        "Bagaimana hubungan antara pola makan yang sehat dengan kesehatan mental yang baik?",
      ],
    };
  },
  methods: {
    toggleHubby() {
      this.showHubby = !this.showHubby;
    },
    handleSearch(query) {
      this.searchQuery = query;
    },
    highlightKeywords(text) {
      if (!this.searchQuery) return text;
      const keywords = this.searchQuery.split(" ");
      return text.replace(
        new RegExp(`(${keywords.join("|")})`, "gi"),
        '<span class="bg-black text-white">$1</span>'
      );
    },
    async toggleFavorite() {
      try {
        const response = await axios.post(
          "http://localhost:8000/api/favorite/" + this.topic.article_id,
          {
            user_id: this.userId,
          }
        );
        const { message, is_favorite: isFavorite } = response.data;
        console.log(message);
        console.log(isFavorite);
      } catch (error) {
        console.error("Error toggling favorite:", error);
      }
    },
    async getArticleContent() {
      try {
        const response = await this.$axios.get(
          `http://localhost:8000/api/getarticlebyname/${this.room_name}`
        );
        this.topic = response.data.Article;
        console.log(this.topic);
      } catch (error) {
        console.error("Error Getting Content:", error);
      }
    },
  },
  mounted() {
    this.getArticleContent();
    console.log(this.topic);
  },
  created() {
    const usid = this.$cookies.get("loginCookie");
    if (usid) {
      this.userId = usid.data?.data.id;
      console.log(usid);
    } else {
      this.userId = null;
    }
  },
};
</script>

  <style scoped>
.drop-cap {
  font-size: 1.2em;
  line-height: 1.5;
}

.drop-cap::first-letter {
  text-transform: uppercase;
  float: left;
  font-size: 3.5em;
  line-height: 0.8;
  margin-right: 0.05em;
}

.topic-title {
  font-size: 2.5rem;
  font-weight: bold;
  line-height: 1.2;
  text-align: center;
}

.topic-content {
  font-size: 1.2rem;
  line-height: 1.6;
}
</style>
