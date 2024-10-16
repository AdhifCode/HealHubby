<template>
  <div>
    <div class="overflow-x-auto">
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Image</th>
            <th>Title</th>
            <th>Content</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(verification, index) in verifications" :key="index">
            <th>
              <label>
                <input type="checkbox" class="checkbox" />
              </label>
            </th>
            <td>
              <div class="flex items-center gap-3">
                <div class="avatar">
                  <div class="mask mask-squircle w-12 h-12">
                    <img
                      :src="
                        verification.user.image
                          ? `http://127.0.0.1:8000/storage/${verification.user.image}`
                          : require('@/assets/img/unknown.jpeg')
                      "
                    />
                  </div>
                </div>
                <div>
                  <div class="font-bold capitalize">
                    {{ verification.user.name }}
                  </div>
                  <div class="text-sm opacity-50">
                    {{ verification.user.profession.name }}
                  </div>
                </div>
              </div>
            </td>
            <td>
              <img
                class="max-h-[200px]"
                :src="
                  verification.article_image
                    ? `http://127.0.0.1:8000/storage/${verification.article_image}`
                    : require('@/assets/img/unknown.jpeg')
                "
              />
            </td>
            <td class="capitalize">{{ verification.article_title }}</td>
            <td>
              <button class="btn" onclick="content_dialog.showModal()">
                See Content
              </button>
              <dialog id="content_dialog" class="modal">
                <div class="modal-box w-11/12 max-w-5xl">
                  <h3 class="font-bold text-lg capitalize sticky">
                    {{ verification.article_title }}
                  </h3>
                  <form method="dialog">
                    <button
                      class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
                    >
                      ✕
                    </button>
                  </form>
                  <p
                    class="py-4 prose min-h-[20px] max-w-[848px] text-message flex flex-col items-start gap-3 whitespace-pre-wrap break-words [.text-message+&amp;]:mt-5"
                  >
                    {{ verification.article_content }}
                  </p>
                </div>
              </dialog>
            </td>
            <th>
              <button
                class="btn btn-ghost btn-xs"
                @click="approveVerification(verification.id)"
              >
                Approve
              </button>
              <button
                class="btn btn-ghost btn-xs"
                @click="rejectVerification(verification.id)"
              >
                Reject
              </button>
            </th>
          </tr>
        </tbody>
        <!-- foot -->
        <tfoot>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Image</th>
            <th>Title</th>
            <th>Content</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>
  
  <script>
import axios from "axios";

export default {
  layout: "Admin",
  data() {
    return {
      verifications: [],
    };
  },
  mounted() {
    this.fetchVerifications();
  },
  methods: {
    fetchVerifications() {
      axios
        .get("http://localhost:8000/api/getrequest")
        .then((response) => {
          this.verifications = response.data.verifications;
        })
        .catch((error) => {
          console.error("Error fetching verifications: ", error);
        });
    },
    approveVerification(verificationId) {
      axios
        .put(`http://localhost:8000/api/pusharticle/${verificationId}`)
        .then((response) => {
          this.fetchVerifications();
          alert("Verification approved successfully");
        })
        .catch((error) => {
          console.error("Error approving verification: ", error);
        });
    },
    rejectVerification(verificationId) {
      axios
        .delete(`http://localhost:8000/api/rejectarticle/${verificationId}`)
        .then((response) => {
          this.fetchVerifications();
          alert("Verification rejected successfully");
        })
        .catch((error) => {
          console.error("Error rejecting verification: ", error);
        });
    },
  },
};
</script>
  