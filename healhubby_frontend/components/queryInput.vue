<template>
  <div class="flex justify-center items-center bg-white">
    <div class="w-full max-w-lg">
      <div class="query-input-container">
        <div
          class="w-full pt-2 md:pt-0 dark:border-white/20 md:border-transparent md:dark:border-transparent md:w-[calc(100%-.5rem)]"
        >
          <form
            class="stretch mx-2 flex flex-row gap-3 last:mb-2 md:mx-4 md:last:mb-6 lg:mx-auto lg:max-w-2xl xl:max-w-3xl"
          >
            <div class="relative flex h-full flex-1 items-stretch md:flex-col">
              <div class="flex w-full items-center">
                <div
                  class="text-current overflow-hidden [&amp;:has(textarea:focus)]:border-token-border-xheavy [&amp;:has(textarea:focus)]:shadow-[0_2px_6px_rgba(0,0,0,.05)] flex flex-col w-full flex-grow relative border border-token-border-heavy rounded-2xl bg-token-main-surface-primary"
                >
                  <textarea
                    id="prompt-textarea"
                    tabindex="0"
                    rows="1"
                    v-model="queryInput"
                    @error="content = $event"
                    @content="content = $event"
                    placeholder="Message Hubby…"
                    class="m-0 w-full text-current resize-none border-0 bg-transparent focus:ring-0 focus-visible:ring-0 dark:bg-transparent max-h-25 py-[10px] pr-10 md:py-3.5 md:pr-12 placeholder-black/50 pl-3 md:pl-4"
                    style="height: 52px; overflow-y: hidden"
                  ></textarea>
                  <button
                    :disabled="isLoading || !queryInput.length"
                    @click="generate"
                    class="absolute bottom-1.5 right-2 rounded-lg border border-black bg-black p-0.5 text-white transition-colors enabled:bg-black disabled:text-gray-400 disabled:opacity-10 dark:border-white dark:bg-white dark:hover:bg-white md:bottom-3 md:right-3"
                    data-testid="send-button"
                  >
                    <span class="" data-state="closed">
                      <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        class="text-white dark:text-black"
                      >
                        <path
                          d="M7 11L12 6L17 11M12 18V7"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        ></path>
                      </svg>
                    </span>
                  </button>
                </div>
              </div>
            </div>
          </form>
          <div
            class="relative px-2 py-2 text-center text-xs text-token-text-secondary md:px-[60px]"
          >
            <span
              >Hubby can make mistakes. Consider checking important
              information.</span
            >
          </div>
        </div>
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
  name: "queryInput",
  props: {
    value: {
      type: String,
    },
    max_tokens: {
      type: Number,
      default: 1000,
    },
    articleContent: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      isLoading: false,
      content: "",
      queryInput: this.value,
      maxTokens: this.max_tokens,
      articleContent: this.articleContent,
      conversationHistory: [],
    };
  },
  methods: {
    async generate() {
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
        this.conversationHistory.push({
          role: "ai",
          content: this.articleContent,
        });

        this.conversationHistory.push({
          role: "user",
          content: this.queryInput,
        });

        this.$emit("contentReceived", this.queryInput, "You");

        this.isLoading = true;
        this.$emit("isLoading", true);

        const completion = await openai.createChatCompletion({
          model: "gpt-3.5-turbo",
          messages: this.conversationHistory.map((msg) => ({
            ...msg,
            role: msg.role === "ai" ? "assistant" : msg.role,
          })),
          max_tokens: this.$props.max_tokens,
        });
        this.queryInput = "";

        this.conversationHistory.push({
          role: "ai",
          content: completion.data.choices[0].message.content,
        });

        this.$emit(
          "contentReceived",
          completion.data.choices[0].message.content,
          "Hubby"
        );

        this.isLoading = false;
        this.$emit("isLoading", false);
      } catch (error) {
        console.error("Error with OpenAI API request:", error.message);
        this.showError("An error occurred during your request.");
      }
    },

    showError(message) {
      this.isLoading = false;
      console.log("showError");
      console.log(message);
      this.content = `<p>Error: ${message}</p>`;
      this.$emit("error", this.content);
    },
  },
};
</script>
