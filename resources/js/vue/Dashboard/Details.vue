<template>
  <v-app class="mt-16">
    <div>
      <v-btn dark router to="/dashboard">Go To Dashboard</v-btn>
      <v-select
        :items="categories"
        item-text="categoryname"
        single-line
        label="Select Category"
        item-value="id"
        v-model="form.category_id"
      >
      </v-select>
      <v-select
        :items="subcategories"
        item-text="subcategoryname"
        single-line
        label="Select SubCategory"
        item-value="id"
        v-model="form.subcategory_id"
      >
      </v-select>
      <div>
        <v-text-field
          label="Name of Item"
          type="text"
          name="name"
          v-model="form.name"
        >
        </v-text-field>
      </div>
      <div>
        <v-text-field
          label="Description"
          type="text"
          name="details"
          v-model="form.details"
        >
        </v-text-field>
      </div>
      <div>
        <v-text-field
          label="Price"
          type="text"
          name="price"
          v-model="form.price"
        >
        </v-text-field>
      </div>
      <div>
        <v-text-field
          label="Family Price"
          type="text"
          name="famprice"
          v-model="form.famprice"
        >
        </v-text-field>
        <v-btn @click="submitDetails">Submit</v-btn>
      </div>
    </div>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      subcategories: [],
      form: {
        name: "",
        details: "",
        price: "",
        famprice: "",
        category_id: 1,
        subcategory_id: "",
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
    getSubCategories() {
      axios
        .get("api/subcategory")
        .then((response) => {
          this.subcategories = response.data;
        })
        .catch((error) => console.log(error));
    },
    submitDetails() {
      let data = new FormData();
      data.append("name", this.form.name);
      data.append("details", this.form.details);
      data.append("price", this.form.price);
      data.append("famprice", this.form.famprice);
      data.append("category_id", this.form.category_id);
      data.append("subcategory_id", this.form.subcategory_id);

      axios
        .post("api/details", data)
        .then(() => {
          this.form.name = "";
        })
        .catch((error) => console.log(error));
    },
  },
  computed: {
    filteredSubCategory() {
      return this.subcategories.filter(
        (item) => item.category_id == this.form.category_id
      );
    },
  },
  mounted() {
    this.getCategories();
    this.getSubCategories();
  },
};
</script>

<style lang="stylus" scoped></style>
