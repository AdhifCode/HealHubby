<template>
  <div>
    <NavbarProfile class="fixed" style="z-index: 100" />

    <div class="isolate bg-white">
      <div
        class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl top-[30px] sm:top-[-20rem]"
        aria-hidden="true"
      >
        <div
          class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]"
          style="
            clip-path: polygon(
              74.1% 44.1%,
              100% 61.6%,
              97.5% 26.9%,
              85.5% 0.1%,
              80.7% 2%,
              72.5% 32.5%,
              60.2% 62.4%,
              52.4% 68.1%,
              47.5% 58.3%,
              45.2% 34.5%,
              27.5% 76.7%,
              0.1% 64.9%,
              17.9% 100%,
              27.6% 76.8%,
              76.1% 97.7%,
              74.1% 44.1%
            );
          "
        />
      </div>
      <div class="container mx-auto px-20">
        <div class="text-sm breadcrumbs pt-20">
          <ul>
            <li>
              <a @click="$router.push('/')"> Home </a>
            </li>
            <li>
              <a @click="$router.push('/article')"> Articles</a>
            </li>
            <li>
              <div class="truncate max-w-[150px] overflow-hidden font-semibold">
                Profile
              </div>
            </li>
          </ul>
        </div>
        <div class="flex py-6">
          <div class="avatar">
            <div class="w-48 rounded-full">
              <img
                :src="
                  profile.image
                    ? `http://127.0.0.1:8000/storage/${profile.image}`
                    : require('@/assets/img/unknown.jpeg')
                "
              />
            </div>
          </div>
          <div class="pl-4 capitalize font-bold text-4xl pt-16">
            <p>{{ profile.name }}</p>
            <p class="text-base font-normal">{{ profile.profession?.name }}</p>
          </div>
          <div class="pl-4 capitalize font-bold text-4xl pt-16">
            <button
              class="btn btn-circle btn-outline"
              @click="$router.push('/profile/update')"
            >
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
                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                />
              </svg>
            </button>
          </div>
        </div>
        <div role="tablist" class="tabs tabs-lifted tabs-lg">
          <input
            type="radio"
            name="my_tabs_2"
            role="tab"
            class="tab"
            aria-label="My Article"
          />
          <div
            role="tabpanel"
            class="tab-content bg-base-100 border-base-300 rounded-box p-6"
          >
            <div>
              <div
                class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:mt-16 sm:pt-16 lg:pt-0 lg:mx-0 lg:max-w-7xl lg:grid-cols-3"
              >
                <article
                  v-for="post in articleUser"
                  :key="post.id"
                  class="flex rounded-box max-w-xl flex-col items-start justify-between"
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
                        @click="deletearticle(post.id)"
                        class="btn btn-ghost btn-circle"
                      >
                        <svg
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
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
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
                    <p
                      class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600"
                    >
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

          <input
            type="radio"
            name="my_tabs_2"
            role="tab"
            class="tab"
            aria-label="My Favorite"
            checked
          />
          <div
            role="tabpanel"
            class="tab-content bg-base-100 border-base-300 rounded-box p-6"
          >
            <div>
              <div
                class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:mt-16 sm:pt-16 lg:pt-0 lg:mx-0 lg:max-w-7xl lg:grid-cols-3"
              >
                <article
                  v-for="tingggg in articleFavorites"
                  :key="tingggg.id"
                  class="flex rounded-box max-w-xl flex-col items-start justify-between"
                >
                  <div class="flex items-center gap-x-4 text-xs">
                    <time :datetime="tingggg.datetime" class="text-gray-500">{{
                      tingggg.date
                    }}</time>
                    <a
                      :href="tingggg.category.href"
                      class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"
                      >{{ tingggg.category.title }}</a
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
                      <a class="capitalize" :href="tingggg.href">
                        <span class="absolute inset-0" />
                        {{ tingggg.title }}
                      </a>
                    </h3>
                    <p
                      class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600"
                    >
                      {{ tingggg.description }}
                    </p>
                  </div>
                  <div class="relative mt-8 flex items-center gap-x-4">
                    <img
                      :src="
                        tingggg.author.imageUrl
                          ? `http://127.0.0.1:8000/storage/${tingggg.author.imageUrl}`
                          : require('@/assets/img/unknown.jpeg')
                      "
                      alt=""
                      class="h-10 w-10 rounded-full bg-gray-50"
                    />
                    <div class="text-sm leading-6">
                      <p class="font-semibold text-gray-900">
                        <a class="capitalize" :href="tingggg.author.href">
                          <span class="absolute inset-0" />
                          {{ tingggg.author.name }}
                        </a>
                      </p>
                      <p class="text-gray-600">{{ tingggg.author.role }}</p>
                    </div>
                  </div>
                </article>
              </div>
            </div>
          </div>

          <input
            type="radio"
            name="my_tabs_2"
            role="tab"
            class="tab"
            aria-label="Make A New Article"
          />
          <div
            role="tabpanel"
            class="tab-content bg-base-100 border-base-300 rounded-box p-6"
          >
            <form @submit.prevent="createArticle">
              <div>
                <ul class="steps steps-vertical lg:steps-horizontal">
                  <li class="step">Title</li>
                  <li class="step">Content</li>
                  <li class="step">Image</li>
                  <li class="step step-success">Finish</li>
                </ul>
              </div>
              <div class="mb-4">
                <label
                  for="article_title"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Article Title:</label
                >
                <input
                  type="text"
                  id="article_title"
                  v-model="articleTitle"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  placeholder="Enter article title"
                />
                <p
                  v-if="errors.article_title"
                  class="text-red-500 text-xs italic"
                >
                  {{ errors.article_title }}
                </p>
              </div>

              <div class="mb-4">
                <label
                  for="article_content"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Article Content:</label
                >
                <textarea
                  id="article_content"
                  v-model="articleContent"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  placeholder="Enter article content"
                ></textarea>
                <p
                  v-if="errors.article_content"
                  class="text-red-500 text-xs italic"
                >
                  {{ errors.article_content }}
                </p>
              </div>

              <div class="mb-4">
                <div class="flex items-center justify-center w-full">
                  <label
                    for="article_image"
                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                  >
                    <div
                      class="flex flex-col items-center justify-center pt-5 pb-6"
                    >
                      <svg
                        class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 20 16"
                      >
                        <path
                          stroke="currentColor"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                        />
                      </svg>
                      <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-semibold">Click to upload</span> or
                        drag and drop
                      </p>
                      <p class="text-xs text-gray-500 dark:text-gray-400">
                        SVG, PNG, JPG or GIF (MAX. 800x400px)
                      </p>
                    </div>
                    <input
                      type="file"
                      class="hidden"
                      id="article_image"
                      ref="articleImage"
                      @change="previewImage"
                    />
                  </label>
                </div>
                <!-- <label
                for="article_image"
                class="block text-gray-700 text-sm font-bold mb-2"
                >Article Image:</label
              >
              <input
                type="file"
                id="article_image"
                ref="articleImage"
                @change="previewImage"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              />
              <p v-if="errors.article_image" class="text-red-500 text-xs italic">
                {{ errors.article_image }}
              </p> -->
              </div>
              <div class=""></div>
              <label class="block text-gray-700 text-sm font-bold mb-2"
                >Image Preview:</label
              >
              <div v-if="imagePreview" class="mb-4">
                <img
                  :src="imagePreview"
                  alt="Article Image Preview"
                  class="w-full rounded"
                />
              </div>

              <div class="flex items-center justify-between">
                <button
                  type="submit"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                  Create Article
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import NavbarProfile from "@/components/NavbarProfile";

export default {
  middleware: ["authenticated"],
  components: { NavbarProfile },

  data() {
    return {
      // Article User
      articleUser: [],

      // Article Favorite
      articleFavorites: [],

      // Create Article Data
      articleTitle: "",
      articleContent: "",
      user_id: "",
      errors: {},
      successMessage: "",
      errorMessage: "",
      imagePreview: null,

      // Profile Edit Data
      editMode: false,
      showIcon: false,
      preview: null,
      profile: {},
      user_id: "",
      emailRule: [
        (v) => !!v || "Email is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
    };
  },
  methods: {
    // Profile Edit Methods

    handleImageChange() {
      this.$refs.imageInput.click();
    },

    onFileInputChange(event) {
      let files = event.target.files[0];
      this.datafoto = files;
      let fotobaru = event.name;

      this.preview = URL.createObjectURL(files);
      this.tampungfoto = fotobaru;
    },

    saveChanges() {
      if (!this.profile.valid) {
        this.alertPhoneNotValid = true;
      } else {
        const formData = new FormData();
        formData.append("name", this.profile.name);
        formData.append("email", this.profile.email);
        formData.append("phone", this.profile.phone);

        if (this.datafoto) {
          formData.append("image", this.datafoto);
        }

        axios
          .post(
            `http://localhost:8000/api/updateuser/${this.user_id}`,
            formData
          )
          .then((response) => {
            const data = response.data;

            if (data.success) {
              this.profile = data.data;

              this.editMode = false;
            } else {
              console.error("Failed to update profile:", data.message);
            }
          })
          .catch((error) => {
            console.error("Error updating profile:", error);
          });
      }
    },

    async getUserData() {
      try {
        const response = await axios.get(
          `http://localhost:8000/api/users/${this.user_id}`
        );
        this.profile = response.data?.data;
      } catch (error) {
        console.error("Error fetching user data:", error);
      }
    },

    // Create Article Data
    async createArticle() {
      try {
        this.errors = {};
        const formData = new FormData();
        formData.append("article_title", this.articleTitle);
        formData.append("article_content", this.articleContent);
        formData.append("article_image", this.$refs.articleImage.files[0]);
        formData.append("user_id", this.user_id);
        const response = await axios.post(
          "http://localhost:8000/api/requestarticle",
          formData
        );
        this.successMessage = response.data.message;
        this.articleTitle = "";
        this.articleContent = "";
        this.user_id = "";
        this.imagePreview = null;
        window.location.reload();
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.errors = error.response.data.errors;
        } else {
          this.errorMessage = "An error occurred while creating the article.";
        }
      }
    },
    previewImage(event) {
      const file = event.target.files[0];
      if (file) {
        this.imagePreview = URL.createObjectURL(file);
      }
    },

    // My Favorite Article
    // getFavoriteArticle() {
    //   axios
    //     .get(`http://localhost:8000/api/userfavorite?user_id=${this.user_id}`)
    //     .then((response) => {
    //       this.favoriteRooms = response.data.favorites;
    //     })
    //     .catch((error) => {
    //       console.error("Error fetching favorite rooms:", error);
    //     });
    // },
    toconsult(favorite) {
      this.$router.push(`../article/${favorite.content}`);
    },

    // UserFavorites

    getUserFavorites() {
      axios
        .get(`http://localhost:8000/api/userfavorite?user_id=${this.user_id}`)
        .then((response) => {
          const duar = response.data.favorites;
          console.log(duar);

          this.articleFavorites = response.data.favorites.map((article) => ({
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

    // User Articles

    getUserArticles() {
      axios
        .get(`http://localhost:8000/api/userarticle?user_id=${this.user_id}`)
        .then((response) => {
          const articles = response.data.articles;

          this.articleUser = response.data.articles.map((article) => ({
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
          console.log("ini1", this.articleUser);
        })
        .catch((error) => {
          console.error("Error fetching articles:", error);
        });
    },

    async deletearticle(articleId) {
      try {
        const response = await axios.delete(
          `http://localhost:8000/api/deletemyarticle/${articleId}`
        );
        if (response.status === 200) {
          console.log("Article deleted successfully");
          window.location.reload();
        }
      } catch (error) {
        console.error("Error deleting article:", error.response.data.error);
      }
    },
  },
  async mounted() {
    await this.getUserData();
    this.getUserFavorites();
    this.getUserArticles();
  },
  created() {
    const usid = this.$cookies.get("loginCookie");
    if (usid) {
      this.user_id = usid.data?.data.id;
    } else {
      this.user_id = null;
    }
  },
};
</script>