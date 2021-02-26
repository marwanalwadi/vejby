<template>
  <v-app>
    <v-row>
      <v-col class="custom">
        <div class="ma-4">
          <v-text-field
            label="Name"
            v-model="form.name"
            prepend-icon="mdi-folder"
            :rules="inputRules"
          >
          </v-text-field>
          <v-text-field
            v-model="form.email"
            prepend-icon="mdi-folder"
            label="E-mail"
            :rules="inputRules"
          ></v-text-field>
          <v-text-field
            v-model="form.phone"
            label="Phone Number"
            prepend-icon="mdi-folder"
            required
          ></v-text-field>
          <v-textarea
            label="Information"
            v-model="form.msg"
            prepend-icon="mdi-pen"
            counter
            :rules="inputRules"
          >
          </v-textarea>

          <v-btn
            :loading="loading"
            text
            class="success mx-0 mt-3"
            @click="sendemail()"
            >Send Email</v-btn
          >
        </div>
        <div>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil rem
          quae sint aliquid dicta officiis, qui praesentium enim sed fugiat
          perspiciatis, modi esse dolorum fuga maiores. Facere sapiente
          aspernatur quidem?
        </div>
      </v-col>
    </v-row>
  </v-app>
</template>

<script>
import axios from "axios";
export default {
  props: ["name", "email", "phone", "msg"],
  data() {
    return {
      form: {
        name: "",
        email: "",
        phone: "",
        msg: "",
      },
      inputRules: [(v) => v.length >= 3 || "Maximum length is 3 characters"],
      dateRules: [(v) => v.length > 0 || "you have to choose a date"],
    };
  },

  methods: {
    sendemail() {
      let info = new FormData();
      info.append("name", this.form.name);
      info.append("email", this.form.email);
      info.append("phone", this.form.phone);
      info.append("msg", this.form.msg);
      axios
        .post("api/contact", info)
        .then((response) => {
          console.log(response);
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style>
.custom {
  display: grid;
  grid-template-columns: 1fr 1fr;
}
</style>
