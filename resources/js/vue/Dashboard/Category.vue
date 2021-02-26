<template>
  <v-app class="mt-16">
    <v-main>
      <template>
        <v-btn dark to="/dashboard" router>Go To Dashboard</v-btn>
        <v-card>
          <v-card-title>Add New Category</v-card-title>

          <v-text-field label="add" v-model="category"></v-text-field>
          <v-card-actions>
            <v-btn @click="saveCategory">Save</v-btn>
          </v-card-actions>
        </v-card>
      </template>
    </v-main>
  </v-app>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      category: "",
    };
  },
  methods: {
    saveCategory() {
      axios
        .post("api/category", {
          categoryname: this.category,
        })
        .then(() => {
          this.category = "";
        })
        .catch((erorr) => console.log(error));
    },
  },
};
</script>

<style lang="stylus" scoped></style>
