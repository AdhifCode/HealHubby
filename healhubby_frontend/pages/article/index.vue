<template>
  <div>
    <NavbarArticle @search="handleSearch" class="fixed" style="z-index: 100" />

    <div class="main container mx-auto px-20 pt-20">
      <!-- <div class="h-[250px] w-full carousel rounded-box">
        <div
          class="carousel-item w-full"
          v-for="(image, index) in images"
          :key="index"
        >
          <img :src="image.src" class="w-full" :alt="image.alt" />
        </div>
      </div> -->
      <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="mx-auto max-w-2xl lg:mx-0">
            <h2
              class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
            >
              From the blog
            </h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
              Learn how to grow your business with our expert advice.
            </p>
          </div>
          <div
            class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3"
          >
            <article
              v-for="post in article"
              :key="post.id"
              class="flex max-w-xl flex-col items-start justify-between"
            >
              <div class="flex items-center gap-x-4 text-xs">
                <time :datetime="post.datetime" class="text-gray-500">{{
                  post.date
                }}</time>
                <a
                  :href="post.category.href"
                  class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"
                  >{{ post.category.title }}</a
                >
                <div class="item-end">
                  <button
                    @click="toggleFavorite"
                    class="btn btn-ghost btn-circle"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor hover:black"
                      class="w-6 h-6"
                    >
                      <path
                        d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z"
                      />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="group relative">
                <h3
                  class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600"
                >
                  <a class="capitalize" :href="post.href">
                    <span class="absolute inset-0" />
                    {{ post.title }}
                  </a>
                </h3>
                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                  {{ post.description }}
                </p>
              </div>
              <div class="relative mt-8 flex items-center gap-x-4">
                <img
                  :src="
                    post.author.imageUrl
                      ? `http://127.0.0.1:8000/storage/${post.author.imageUrl}`
                      : require('@/assets/img/unknown.jpeg')
                  "
                  alt=""
                  class="h-10 w-10 rounded-full bg-gray-50"
                />
                <div class="text-sm leading-6">
                  <p class="font-semibold text-gray-900">
                    <a class="capitalize" :href="post.author.href">
                      <span class="absolute inset-0" />
                      {{ post.author.name }}
                    </a>
                  </p>
                  <p class="text-gray-600">{{ post.author.role }}</p>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import NavbarArticle from "@/components/NavbarArticle";
import axios from "axios";

export default {
  components: { NavbarArticle },
  data() {
    return {
      article: [],
      images: [
        {
          src: "https://daisyui.com/images/stock/photo-1559703248-dcaaec9fab78.jpg",
          alt: "Tailwind CSS Carousel component",
        },
        {
          src: "https://daisyui.com/images/stock/photo-1565098772267-60af42b81ef2.jpg",
          alt: "Tailwind CSS Carousel component",
        },
        {
          src: require("~/assets/img/adolf-hitler_43.jpeg"),
          alt: "Tailwind CSS Carousel component",
        },
        {
          src: "https://daisyui.com/images/stock/photo-1494253109108-2e30c049369b.jpg",
          alt: "Tailwind CSS Carousel component",
        },
        {
          src: "https://daisyui.com/images/stock/photo-1550258987-190a2d41a8ba.jpg",
          alt: "Tailwind CSS Carousel component",
        },
        {
          src: "https://daisyui.com/images/stock/photo-1559181567-c3190ca9959b.jpg",
          alt: "Tailwind CSS Carousel component",
        },
        {
          src: "https://daisyui.com/images/stock/photo-1601004890684-d8cbf643f5f2.jpg",
          alt: "Tailwind CSS Carousel component",
        },
      ],
    };
  },
  methods: {
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

    getArticles() {
      axios
        .get("http://localhost:8000/api/getarticles")
        .then((response) => {
          this.article = response.data.Articles.map((article) => ({
            id: article.article_id,
            title: article.title,
            href: `article/${article.title}`,
            description: article.content,
            date: article.datetime,
            datetime: article.datetime,
            category: { title: article.profession.name, href: "#" },
            author: {
              name: article.author,
              role: article.profession.name,
              href: "#",
              imageUrl: article.user_image,
            },
          }));
        })
        .catch((error) => {
          console.error("Error fetching articles:", error);
        });
    },
  },

  mounted() {
    this.getArticles();
  },
};
</script>
  
  <style scoped>
/* Styling for the carousel can be added here */
</style>
  