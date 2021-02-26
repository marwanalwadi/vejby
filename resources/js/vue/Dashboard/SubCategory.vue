<template>
  <v-app class="mt-16">
    <v-main>
      <template>
        <v-btn dark to="/dashboard" router>Go To Dashboard</v-btn>
        <v-card>
          <v-card-title>Add New subCategory</v-card-title>
          <v-select
            :items="categories"
            item-text="categoryname"
            label="Select Category"
            single-line
            item-value="id"
            v-model="form.category_id"
          ></v-select>
          <v-text-field label="add" v-model="form.subcategories"></v-text-field>
          <v-card-actions>
            <v-btn @click="saveSubCategory">Save</v-btn>
          </v-card-actions>
        </v-card>
      </template>
    </v-main>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      form: {
        subcategories: [],
        category_id: 1,
      },
    };
  },
  methods: {
    getCategories() {
      axios
        .get("api/category")
        .then((response) => {
          this.categories = response.data;
        })
        .catch((error) => console.log(error));
    },
    saveSubCategory() {
      let fd = new FormData();
      fd.append("subcategoryname", this.form.subcategories);
      fd.append("category_id", this.form.category_id);

      axios
        .post("api/subcategory", fd)
        .then(() => {
          this.form.subcategories = "";
        })
        .catch((erorr) => console.log(error));
    },
  },
  //   mounted() {
  //     this.saveSubCategory();
  //   },
  created() {
    this.getCategories();
  },
};
</script>

<style lang="stylus" scoped></style>
