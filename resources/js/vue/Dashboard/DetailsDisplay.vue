<template>
  <div class="w-100 mt-5">
    <div class="row">
      <div class="col-12 p-2">
        <div
          class="categoryBox w-100 align-items-center py-1"
          @click="selectedAll()"
        >
          <h5 class="text-center">Show All Links</h5>
        </div>
      </div>
      <div
        class="p-2 col-4"
        v-for="(category, index) in categories"
        :key="index"
      >
        <div
          class="categoryBox w-100 align-items-center py-1"
          @click="selectedCat(category.id)"
        >
          <h5 class="text-center">{{ category.categoryname }}</h5>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div
        class="p-2 col-4"
        v-for="(subcategory, index) in filterSubCategories"
        :key="index"
      >
        <div @click="selectedSubCat(subcategory.id)">
          <h6>{{ subcategory.subcategoryname }}</h6>
        </div>
      </div>
    </div>
    <div>
      <div v-for="(detail, index) in filterdetails" :key="index">
        <div class="">
          <h6 class="text-center">{{ detail.name }}</h6>
          <h6 class="text-center">{{ detail.details }}</h6>
          <h6 class="text-center">{{ detail.price }}</h6>
          <h6 class="text-center">{{ detail.famprice }}</h6>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      subcategories: [],
      details: [],
      selectedCategory: "",
      selectedSubCategory: "",
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
    getDetails() {
      axios
        .get("api/details")
        .then((response) => {
          this.details = response.data;
        })
        .catch((error) => console.log(error));
    },
    selectedAll() {
      this.selectedCategory = "";
      this.selectedSubCategory = "";
    },
    selectedCat(id) {
      this.selectedCategory = id;
      this.selectedSubCategory = "";
    },
    selectedSubCat(id) {
      this.selectedSubCategory = id;
    },
  },
  computed: {
    filterSubCategories() {
      return this.subcategories.filter(
        (item) => item.category_id == this.selectedCategory
      );
    },

    filterDetails() {
      if (this.selectedCategory === "" && this.selectedSubCategory === "") {
        return this.details;
      } else if (
        this.selectedCategory === "" &&
        this.selectedSubCategory != ""
      ) {
        return this.details.filter(
          (item) => item.subcategory_id == this.selectedSubCategory
        );
      } else if (
        this.selectedCategory != "" &&
        this.selectedSubCategory === ""
      ) {
        return this.details.filter(
          (item) => item.category_id == this.selectedCategory
        );
      } else if (
        this.selectedCategory != "" &&
        this.selectedSubCategory != ""
      ) {
        return this.details.filter(
          (item) => item.subcategory_id == this.selectedSubCategory
        );
      }
    },
  },
  mounted() {
    this.getCategories();
    this.subcategories();
    this.getDetails();
  },
};
</script>

<style lang="stylus" scoped></style>
