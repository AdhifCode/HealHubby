<template>
  <div style="width: 400px">
    <v-btn plain @click="goBack"
      ><v-icon left> mdi-arrow-left </v-icon>Back</v-btn
    >
    <div>Phone</div>
    <vue-tel-input-vuetify
      block
      class="rounded-lg"
      v-model="myPhone"
      clearable
      outlined
      solo
      @input="onInput"
      :valid-characters-only="true"
      defaultCountry="ID"
      :onlyCountries="['ID', 'MY', 'SG']"
      label=""
      placeholder=""
    ></vue-tel-input-vuetify>
    <!-- <div><strong>Nilai Phone:</strong> {{ phone }}</div> -->
    <v-btn
      disabled
      height="50"
      class="rounded-lg text-capitalize white--text"
      block
      color="#0C8CE9"
      depressed
      @click="continueWithEmail"
      >Continue</v-btn
    >
  </div>
</template>

<script>
export default {
  data() {
    return {
      phone: '',
    }
  },
  methods: {
    goBack() {
      this.$emit('switchToChoose')
    },
  },
}
</script>
