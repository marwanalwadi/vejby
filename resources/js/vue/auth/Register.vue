<template>
  <v-app id="inspire">
    <v-main class="ma-10">
      <v-container class="fill-height">
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12" :loading="isLoading">
              <v-toolbar dark>
                <v-toolbar-title> Register Form </v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form ref="form" lazy-validation>
                  <v-text-field
                    label="Name"
                    prepend-icon="mdi-account"
                    type="text"
                    v-model="form.name"
                    :error-messages="errors.name"
                  >
                  </v-text-field>
                  <v-text-field
                    label="Email"
                    prepend-icon="mdi-email"
                    type="text"
                    v-model="form.email"
                    :error-messages="errors.email"
                  >
                  </v-text-field>
                  <v-text-field
                    label="Password"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="form.password"
                    :error-messages="errors.password"
                  >
                  </v-text-field>
                  <v-text-field
                    label="Password Confirmation"
                    name="password"
                    id="password"
                    prepend-icon="mdi-lock-question"
                    type="password"
                    v-model="form.password_confirmation"
                    :error-messages="errors.password_confirmation"
                  >
                  </v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <router-link to="/login" class="ml-3"
                  >Sign in Instead ?</router-link
                >
                <v-spacer></v-spacer>
                <v-btn @click="doRegister">Register</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
    <v-snackbar v-model="snackbar" top color="success" timeout="-1">
      Register Success
      <template v-slot:action="{ attrs }">
        <v-btn v-bind="attrs" color="primary" @click="goLogin">
          Sign in Now !</v-btn
        >
      </template>
    </v-snackbar>
  </v-app>
</template>

<script>
import axios from "axios";
export default {
  name: "Register",
  data() {
    return {
      isLoading: true,
      snackbar: false,
      form: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      errors: {},
    };
  },
  methods: {
    doRegister() {
      this.isLoading = "red";
      axios
        .post("api/vejbyregister", this.form)
        .then((response) => {
          this.snackbar = true;
          console.log(response.data);
          this.$refs.form.reset();
          this.$refs.form.resetValidation();
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
          console.log(errors.response.data.errors);
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    goLogin() {
      this.snackbar = false;
      setTimeout(() => {
        this.$router.push("/vejbylogin");
      }, 3000);
    },
  },
};
</script>

<style lang="stylus" scoped></style>
