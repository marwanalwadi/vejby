<template>
  <v-app id="inspire">
    <v-main class="ma-10">
      <v-container class="fill-height">
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12" :loading="isLoading">
              <v-toolbar dark flat>
                <v-toolbar-title> Login Form </v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-form>
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
                </v-form>
              </v-card-text>
              <v-card-actions>
                <router-link to="/register" class="ml-3">Register</router-link>
                <v-spacer></v-spacer>
                <v-btn @click="doLogin">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      isLoading: true,
      form: {
        email: "",
        password: "",
        device_name: "browser",
      },
      errors: {},
    };
  },
  methods: {
    doLogin() {
      this.isLoading = "red";
      axios
        .post("api/vejbylogin", this.form)
        .then((response) => {
          localStorage.setItem("token", response.data);
          this.$router.push("/dashboard");
          // console.log(response);
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>

<style lang="stylus" scoped></style>
