<template>
  <div class="max-w-screen-md mx-auto">
    <button @click="goBack" class="btn btn-default">
      <i class="icon icon-arrow-left"></i>Back
    </button>
    <h1 class="text-2xl font-bold">Continue with your phone</h1>
    <div>
      <div>Your username</div>
      <input
        v-model="emailOrUsername"
        class="input input-bordered rounded-lg"
        type="text"
        placeholder="Your username"
      />
      <div>Phone</div>
      <vue-tel-input-vuetify
        block
        class="input input-bordered rounded-lg"
        v-model="myPhone"
        clearable
        outlined
        solo
        @input="onInput"
        :valid-characters-only="true"
        :max-len="getMaxLenForCountry()"
        defaultCountry="ID"
        :onlyCountries="['ID', 'MY', 'SG']"
        label=""
        placeholder=""
      ></vue-tel-input-vuetify>
      <button
        :disabled="!myPhone"
        @click="continueWithEmail"
        class="btn btn-primary btn-block mt-4"
      >
        Continue
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      myPhone: "",
      phone: {
        number: "",
        valid: false,
        country: undefined,
      },
      phoneInputAttrs: {
        inputmode: "numeric",
      },
      numberRule: (val) => {
        if (val < 0) return "Please enter a positive number";
        return true;
      },
    };
  },
  methods: {
    goBack() {
      this.$emit("switchToChoose");
    },
    onInput(formattedNumber, { number, valid, country }) {
      this.phone.number = number.international;
      this.phone.valid = valid;
      this.phone.country = country && country.name;
    },
    getMaxLenForCountry() {
      const selectedCountry = this.phone.country;
      if (selectedCountry === "Indonesia") {
        return 14;
      } else if (selectedCountry === "Malaysia") {
        return 10;
      } else if (selectedCountry === "Singapore") {
        return 8;
      }
      return 15;
    },
  },
};
</script>
