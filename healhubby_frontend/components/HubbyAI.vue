<template>
  <div role="presentation" class="light flex h-dvh flex-col bg-white">
    <div class="flex-1 overflow-hidden">
      <div class="">
        <div class="flex flex-col text-sm">
          <div
            class="sticky top-0 mb-1.5 flex items-center justify-between h-14 p-2 font-semibold bg-token-main-surface-primary"
          >
            <div class="absolute left-1/2 -translate-x-1/2"></div>
            <div class="flex items-center gap-2">
              <div
                class="group flex cursor-pointer items-center gap-1 rounded-xl py-2 px-3 text-lg font-medium hover:bg-token-main-surface-secondary radix-state-open:bg-token-main-surface-secondary"
                type="button"
              >
                <div class="text-current font-semibold">Hubby</div>
              </div>
            </div>
          </div>
          <div
            v-if="chatHistory.length === 0"
            class="suggestion h-full flex ml-1 md:w-full md:m-auto md:mb-4 gap-0 md:gap-2 justify-center"
          >
            <div class="w-full text-token-text-primary">
              <div
                class="flex flex-1 mx-auto gap-3 md:px-5 lg:px-1 xl:px-5 md:max-w-3xl lg:max-w-[40rem] xl:max-w-[48rem]"
              >
                <div class="grow w-[369px]">
                  <div
                    class="absolute bottom-full left-0 mb-4 flex w-full grow gap-2 px-1 pb-1 sm:px-2 sm:pb-0 md:static md:mb-0 md:max-w-none"
                  >
                    <div
                      class="grid w-full grid-flow-row grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-2"
                    >
                      <div
                        v-for="(item, index) in suggestion"
                        :key="index"
                        class="flex flex-col gap-2"
                      >
                        <span style="opacity: 1; transform: none"
                          ><button
                            class="btn-outline btn relative btn-neutral group w-full whitespace-nowrap rounded-xl px-4 py-3 text-left text-token-text-primary md:whitespace-normal"
                            as="button"
                          >
                            <div
                              class="flex w-full gap-2 items-center justify-center"
                            >
                              <div
                                class="flex w-full items-center justify-between"
                              >
                                <div class="flex flex-col overflow-hidden">
                                  <div class="truncate w-[270px]">
                                    {{ item.question }}
                                  </div>
                                </div>
                                <div
                                  class="absolute bottom-0 right-0 top-0 flex items-center rounded-xl bg-gradient-to-l from-token-main-surface-secondary pl-6 pr-4 text-token-text-secondary opacity-0 group-hover:opacity-100"
                                >
                                  <span class="" data-state="closed"
                                    ><div
                                      class="rounded-lg bg-token-main-surface-primary p-1 shadow-xxs dark:shadow-none"
                                    >
                                      <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        class="icon-sm text-token-text-primary"
                                      >
                                        <path
                                          d="M7 11L12 6L17 11M12 18V7"
                                          stroke="currentColor"
                                          stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                        ></path>
                                      </svg></div
                                  ></span>
                                </div>
                              </div>
                            </div></button
                        ></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            v-else
            class="chat-class"
            style="min-width: 409px; padding-bottom: 80px"
          >
            <div
              v-for="(message, index) in chatHistory"
              :key="index"
              :class="{
                'chat chat-end': message.sender === 'You',
                'chat chat-start': message.sender === 'Hubby',
              }"
              style="outline: 20px; outline-color: aqua"
            >
              <div class="chat-image avatar">
                <div class="w-10 rounded-full">
                  <img
                    alt="Avatar"
                    src="~/assets/img/LogoPJBL.png"
                    class="h-[2px] w-auto"
                    style="padding-bottom: 4px"
                  />
                </div>
              </div>
              <div class="chat-header">
                {{ message.sender }}
                <time class="text-xs opacity-50">{{ message.timestamp }}</time>
              </div>
              <div
                class="chat-bubble bg-slate-800 text-white min-h-[20px] max-w-[250px] text-message flex flex-col items-start gap-3 whitespace-pre-wrap break-words [.text-message+&amp;]:mt-5"
              >
                <div class="message-content" v-html="message.content"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-10 w-full absolute bottom-0">
          <query-input
            :articleContent="articleContent"
            v-model="queryInput"
            @isLoading="
              isLoading = $event;
              $event == true ? (content = AIImage = null) : outputKey++;
            "
            @contentReceived="handleContentReceived"
          />
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
import queryInput from "@/components/queryInput";

export default {
  components: { queryInput },
  props: {
    articleContent: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      outputKey: 1,
      isLoading: false,
      content: "",
      queryInput: "",
      suggestion: [
        {
          question:
            "Bagaimana Cara agar terhindar dari pola makan yang tidak sehat?",
        },
        {
          question:
            "Bagaimana Cara agar bugar di usia tua?",
        },
      ],
      chatHistory: [],
    };
  },
  methods: {
    cek() {
      console.log(this.chatHistory);
    },
    async handleContentReceived(content, sender) {
      this.chatHistory.push({
        content,
        sender,
        timestamp: new Date().toLocaleTimeString(),
      });
    },
  },
};
</script>

<style scoped>
.chat-class {
  max-height: calc(100vh - 200px);
  overflow-y: auto;
}
</style>