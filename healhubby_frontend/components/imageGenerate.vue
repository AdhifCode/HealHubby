<template>
  <div class="query-input-container">
    <textarea
      class="form-control"
      placeholder="Enter prompt for content or image generation here"
      v-model="queryInput"
    ></textarea>
    <div class="d-flex justify-content-between mt-3">
      <div class="mr-3 d-flex flex-column">
        <button
          class="btn btn-primary mb-3"
          :disabled="isLoading || !queryInput.length"
          @click="generateImage"
        >
          Generate Image
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { Configuration, OpenAIApi } from "openai";

const configuration = new Configuration({
  apiKey: process.env.OPENAI_API_KEY,
});
const openai = new OpenAIApi(configuration);

export default {
  name: "QueryInput",
  props: {
    value: {
      type: String,
    },
  },
  data() {
    return {
      isLoading: false,
      queryInput: this.value || "",
      dimension: "1024x1024",
    };
  },
  methods: {
    async generateImage() {
      if (!configuration.apiKey) {
        this.showError(
          "OpenAI API key not configured, please follow instructions in README.md"
        );
        return;
      }
      if (this.queryInput.trim().length === 0) {
        this.showError("Please enter a valid queryInput");
        return;
      }

      try {
        this.isLoading = true;
        const response = await openai.createImage({
          prompt: this.queryInput, // Menggunakan prompt langsung sebagai input
          n: 1,
          size: this.dimension,
        });
        const imageUrl = response.data.data[0]["url"];
        console.log(imageUrl);
        this.$emit("imageReceived", imageUrl);
      } catch (error) {
        console.error("Error with OpenAI API request:", error.message);
        this.showError("An error occurred during your request.");
      } finally {
        this.isLoading = false;
      }
    },

    showError(message) {
      console.error("Error:", message);
      this.$emit("error", message);
    },
  },
};
</script>
