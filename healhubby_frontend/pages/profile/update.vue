<template>
  <div>
    <h1>Update User</h1>
    <form @submit.prevent="updateUser" v-if="user.name">
      <label for="name">Name:</label>
      <input type="text" v-model="user.name" required />
      <br />
      <label for="email">Email:</label>
      <input type="email" v-model="user.email" required />
      <br />
      <select v-model="user.role_id" name="role_id">
        <option v-for="role in roles" :key="role.role_id" :value="role.role_id">
          {{ role.name }}
        </option>
      </select>

      <select v-model="user.profession_id" name="profession_id">
        <option
          v-for="profession in professions"
          :key="profession.profession_id"
          :value="profession.profession_id"
        >
          {{ profession.name }}
        </option>
      </select>

      <br />
      <label for="image">Image:</label>
      <input type="file" @change="onFileChange" />
      <br />
      <button type="submit">Update</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        role_id: null,
        profession_id: null,
        image: null,
      },
      user_id: "",
      roles: [],
      professions: [],
    };
  },
  created() {
    const usid = this.$cookies.get("loginCookie");
    if (usid) {
      this.user_id = usid.data?.data.id;
      this.fetchUser(); // Fetch user data after setting user_id
    } else {
      this.user_id = null;
    }
    this.fetchRoles();
    this.fetchProfessions();
  },

  methods: {
    async fetchUser() {
      try {
        const response = await axios.get(
          `http://localhost:8000/api/users/${this.user_id}`
        );
        this.user = response.data.data;
      } catch (error) {
        console.error("Error fetching user:", error);
      }
    },
    async fetchRoles() {
      try {
        const response = await axios.get("http://localhost:8000/api/getrole");
        this.roles = response.data.data;
      } catch (error) {
        console.error("Error fetching roles:", error);
      }
    },
    async fetchProfessions() {
      try {
        const response = await axios.get(
          "http://localhost:8000/api/getprofession"
        );
        this.professions = response.data.data;
      } catch (error) {
        console.error("Error fetching professions:", error);
      }
    },
    onFileChange(event) {
      this.user.image = event.target.files[0];
    },
    async updateUser() {
      try {
        // Check if roles and professions are loaded
        if (this.roles.length === 0 || this.professions.length === 0) {
          // Fetch roles and professions before updating
          await this.fetchRoles();
          await this.fetchProfessions();
        }

        const formData = new FormData();
        formData.append("name", this.user.name);
        formData.append("email", this.user.email);
        formData.append("role_id", this.user.role_id);
        formData.append("profession_id", this.user.profession_id);
        formData.append("image", this.user.image);

        await axios.post(
          `http://localhost:8000/api/updateuser/${this.user_id}`,
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );

        this.$router.push("/profile");
      } catch (error) {
        console.error("Error updating user:", error);
      }
    },
  },
};
</script>
