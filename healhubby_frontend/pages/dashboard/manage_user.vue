<template>
  <div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Profession</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in users" :key="index">
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
                      user.image
                        ? `http://127.0.0.1:8000/storage/${user.image}`
                        : require('@/assets/img/unknown.jpeg')
                    "
                    alt="Avatar Tailwind CSS Component"
                  />
                </div>
              </div>
              <div>
                <div class="font-bold">{{ user.name }}</div>
                <div class="text-sm opacity-50">{{ user.country }}</div>
              </div>
            </div>
          </td>
          <td>{{ user.email }}</td>
          <td>{{ user.role.name }}</td>
          <td>{{ user.profession.name }}</td>
          <th>
            <button class="btn btn-ghost btn-xs" @click="deleteUser(user.id)">
              Delete
            </button>
          </th>
        </tr>
      </tbody>
      <!-- foot -->
      <tfoot>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Profession</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</template>
  
  <script>
import axios from "axios";

export default {
  middleware: ["authenticated"],
  layout: "Admin",
  data() {
    return {
      users: [],
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await this.$axios.$get(
          "http://localhost:8000/api/getusers"
        );
        this.users = response.data;
      } catch (error) {
        console.error("Error fetching users:", error);
      }
    },
    async deleteUser(userId) {
      try {
        await axios.delete(`http://localhost:8000/api/deleteuser/${userId}`);
        this.users = this.users.filter((user) => user.id !== userId);
        console.log("User deleted successfully");
      } catch (error) {
        console.error("Error deleting user:", error);
      }
    },
  },
};
</script>
  