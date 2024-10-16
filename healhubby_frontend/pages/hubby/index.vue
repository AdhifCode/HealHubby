<template>
  <div role="presentation" class="light flex h-full flex-col bg-teal-300">
    <div class="flex-1 overflow-hidden">
      <div class="h-screen">
        <div class="react-scroll-to-bottom--css-zwjpy-1n7m0yu">
          <div class="flex flex-col pb-9 text-sm">
            <div
              class="sticky top-0 mb-1.5 flex items-center justify-between z-10 h-14 p-2 font-semibold bg-token-main-surface-primary"
            >
              <div class="absolute left-1/2 -translate-x-1/2"></div>
              <div class="flex items-center gap-2">
                <div
                  class="group flex cursor-pointer items-center gap-1 rounded-xl py-2 px-3 text-lg font-medium hover:bg-token-main-surface-secondary radix-state-open:bg-token-main-surface-secondary"
                  type="button"
                  id="radix-:r90:"
                  aria-haspopup="menu"
                  aria-expanded="false"
                  data-state="closed"
                >
                  <div class="text-white">HealHubby</div>
                </div>
              </div>
              <div class="flex gap-2 pr-1">
                <button
                  @click="cek()"
                  class="btn relative btn-neutral btn-small flex h-9 w-9 items-center justify-center whitespace-nowrap rounded-lg"
                >
                  <div class="flex w-full gap-2 items-center justify-center">
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      class="icon-md"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M11.2929 2.29289C11.6834 1.90237 12.3166 1.90237 12.7071 2.29289L16.7071 6.29289C17.0976 6.68342 17.0976 7.31658 16.7071 7.70711C16.3166 8.09763 15.6834 8.09763 15.2929 7.70711L13 5.41421V14C13 14.5523 12.5523 15 12 15C11.4477 15 11 14.5523 11 14V5.41421L8.70711 7.70711C8.31658 8.09763 7.68342 8.09763 7.29289 7.70711C6.90237 7.31658 6.90237 6.68342 7.29289 6.29289L11.2929 2.29289ZM4 13C4.55228 13 5 13.4477 5 14V18C5 18.5523 5.44772 19 6 19H18C18.5523 19 19 18.5523 19 18V14C19 13.4477 19.4477 13 20 13C20.5523 13 21 13.4477 21 14V18C21 19.6569 19.6569 21 18 21H6C4.34315 21 3 19.6569 3 18V14C3 13.4477 3.44772 13 4 13Z"
                        fill="currentColor"
                      ></path>
                    </svg>
                  </div>
                </button>
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
                  <div class="grow">
                    <div
                      class="absolute bottom-full left-0 mb-4 flex w-full grow gap-2 px-1 pb-1 sm:px-2 sm:pb-0 md:static md:mb-0 md:max-w-none"
                    >
                      <div
                        class="grid w-full grid-flow-row grid-cols-[repeat(auto-fit,minmax(250px,1fr))] gap-2"
                      >
                        <div class="flex flex-col gap-2">
                          <span style="opacity: 1; transform: none"
                            ><button
                              class="glass btn relative btn-neutral group w-full whitespace-nowrap rounded-xl px-4 py-3 text-left text-token-text-primary md:whitespace-normal"
                              as="button"
                            >
                              <div
                                class="flex w-full gap-2 items-center justify-center"
                              >
                                <div
                                  class="flex w-full items-center justify-between"
                                >
                                  <div class="flex flex-col overflow-hidden">
                                    <div class="truncate">
                                      Design a database schema
                                    </div>
                                    <div
                                      class="truncate font-normal opacity-50"
                                    >
                                      for an online merch store
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
                              </div></button></span
                          ><span style="opacity: 1; transform: none"
                            ><button
                              class="glass btn relative btn-neutral group w-full whitespace-nowrap rounded-xl px-4 py-3 text-left text-token-text-primary md:whitespace-normal"
                              as="button"
                            >
                              <div
                                class="flex w-full gap-2 items-center justify-center"
                              >
                                <div
                                  class="flex w-full items-center justify-between"
                                >
                                  <div class="flex flex-col overflow-hidden">
                                    <div class="truncate">Plan a trip</div>
                                    <div
                                      class="truncate font-normal opacity-50"
                                    >
                                      to explore the Madagascar wildlife on a
                                      budget
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
                        <div class="flex flex-col gap-2">
                          <span style="opacity: 1; transform: none"
                            ><button
                              class="glass btn relative btn-neutral group w-full whitespace-nowrap rounded-xl px-4 py-3 text-left text-token-text-primary md:whitespace-normal"
                              as="button"
                            >
                              <div
                                class="flex w-full gap-2 items-center justify-center"
                              >
                                <div
                                  class="flex w-full items-center justify-between"
                                >
                                  <div class="flex flex-col overflow-hidden">
                                    <div class="truncate">
                                      Compare marketing strategies
                                    </div>
                                    <div
                                      class="truncate font-normal opacity-50"
                                    >
                                      for sunglasses for Gen Z and Millennials
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
                              </div></button></span
                          ><span style="opacity: 1; transform: none"
                            ><button
                              class="glass btn relative btn-neutral group w-full whitespace-nowrap rounded-xl px-4 py-3 text-left text-token-text-primary md:whitespace-normal"
                              as="button"
                            >
                              <div
                                class="flex w-full gap-2 items-center justify-center"
                              >
                                <div
                                  class="flex w-full items-center justify-between"
                                >
                                  <div class="flex flex-col overflow-hidden">
                                    <div class="truncate">
                                      Suggest some codenames
                                    </div>
                                    <div
                                      class="truncate font-normal opacity-50"
                                    >
                                      for a project introducing flexible work
                                      arrangements
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
              v-for="(message, index) in chatHistory"
              :key="index"
              :class="{
                'chat chat-end': message.sender === 'You',
                'chat chat-start': message.sender === 'Hubby',
              }"
            >
              <div class="chat-image avatar">
                <div class="w-10 rounded-full">
                  <img alt="Avatar" src="~/assets/img/LogoPJBL.png" />
                </div>
              </div>
              <div class="chat-header">
                {{ message.sender }}
                <time class="text-xs opacity-50">{{ message.timestamp }}</time>
              </div>
              <div
                class="chat-bubble min-h-[20px] text-message flex flex-col items-start gap-3 whitespace-pre-wrap break-words [.text-message+&amp;]:mt-5"
              >
                <div class="message-content" v-html="message.content"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="fixed bottom-0 left-0 w-full bg-gray-900">
        <query-input
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
</template>

<script>
import queryInput from "@/components/queryInput";
import { Configuration, OpenAIApi } from "openai";

const configuration = new Configuration({
  apiKey: process.env.OPENAI_API_KEY,
});
const openai = new OpenAIApi(configuration);

export default {
  components: { queryInput },
  middleware: ["authenticated"],
  data() {
    return {
      outputKey: 1,
      isLoading: false,
      content: "",
      AIImage: null,
      queryInput: "",
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