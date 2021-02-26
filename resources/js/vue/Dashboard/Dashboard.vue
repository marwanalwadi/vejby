<template>
  <div class="back mt-16">
    <router-view></router-view>
    <v-btn dark to="/category" router>Add New Category</v-btn>
    <v-btn dark to="/subcategory" router>Add New SubCategory</v-btn>
    <v-btn dark to="/details" router>Add Detail</v-btn>
    <v-btn dark @click="logout">Logout</v-btn>

    <div>
      <v-content fill-height>
        <section id="item-menu">
          <v-container fluid>
            <v-row>
              <v-col
                cols="12"
                xs="12"
                sm="12"
                md="12"
                lg="12"
                class="d-flex justify-center mb-6"
              >
                <v-card
                  dark
                  class="d-flex align-center text-center justify-content-center ma-8 pb-4"
                  rounded="200"
                  width="100%"
                  height="50"
                  @click="selectedAll()"
                >
                  <v-card-text>
                    <div
                      class="pt-3 font-weight-bold text--accent-1 amber--text"
                      size="1.25rem"
                    >
                      Show All
                    </div>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
              <v-col
                v-for="(category, index) in categories"
                :key="index"
                cols="12"
                xs="12"
                sm="6"
                md="4"
                lg="3"
                class="d-flex justify-center mb-6"
              >
                <v-card
                  dark
                  class="d-flex align-center text-center justify-content-center ma-8 pb-4"
                  rounded="200"
                  width="200"
                  height="75"
                  @click="selectedCat(category.id)"
                >
                  <v-card-text>
                    <div
                      class="pt-3 font-weight-bold text--accent-1 amber--text"
                      size="1.25rem"
                    >
                      {{ category.categoryname }}
                    </div>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row no-gutters>
              <v-col
                v-for="(subcategory, index) in filterSubCategories"
                :key="index"
                cols="12"
                xs="12"
                sm="6"
                md="4"
                lg="3"
                class="d-flex justify-center mb-6"
              >
                <v-card
                  dark
                  class="d-flex align-center text-center justify-content-center ma-8 pb-4"
                  rounded="200"
                  width="200"
                  height="150"
                  @click="selectedSubCat(subcategory.id)"
                >
                  <v-card-text>
                    <div
                      class="pt-3 font-weight-bold text--accent-1 amber--text"
                      size="1.25rem"
                    >
                      {{ subcategory.subcategoryname }}
                    </div>
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-container fluid>
              <v-row>
                <v-col
                  v-for="(detail, index) in filterdetails"
                  :key="index"
                  cols="12"
                  xs="12"
                  sm="6"
                  md="4"
                  lg="3"
                  class="d-flex justify-center"
                >
                  <v-card
                    dark
                    class="d-flex align-center text-center justify-content-center ma-8 pb-4 pt-3"
                    rounded="200"
                    width="200"
                    height="100%"
                  >
                    <v-card-text>
                      <div
                        class="pt-4 pb-4 font-weight-bold text--accent-1 amber--text"
                        size="1.25rem"
                      >
                        <h1>{{ detail.name }}</h1>

                        <v-card-subtitle>
                          {{ detail.details }}
                        </v-card-subtitle>

                        <v-chip class="ma-2"
                          >Normal : {{ detail.price }} :-</v-chip
                        >

                        <v-chip v-if="detail.famprice"
                          >Familje : {{ detail.famprice }} :-</v-chip
                        >
                      </div>
                      <div class="pt-2">
                        <v-btn @click="toggleItem(detail.id)">Edit</v-btn>
                        <v-btn @click="deleteItem(detail.id)">Delete</v-btn>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
            </v-container>
          </v-container>
        </section>

        <v-dialog max-width="650px" v-model="showForm" persistent>
          <v-card>
            <v-toolbar flat>
              <span>ُEdit Item</span>
              <v-spacer></v-spacer>
              <v-btn icon @click="showForm = false">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-toolbar>
            <v-divider></v-divider>
            <v-form
              class="pa-4"
              ref="updateDeitelsRefs"
              v-model="updateValid"
              lazy-validation
              @submit.prevent="updateItem()"
            >
              <v-text-field
                label="price"
                type="text"
                name="price"
                v-model="price"
                :rules="rules"
              ></v-text-field>

              <v-text-field
                label="famprice"
                name="famprice"
                v-model="famprice"
                type="text"
              ></v-text-field>

              <v-btn type="submit">update</v-btn>
            </v-form>
          </v-card>
        </v-dialog>
      </v-content>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Dashboard",

  data() {
    return {
      categories: [],
      subcategories: [],
      category_id: 1,
      subcates: [],
      details: [],
      selectedCategory: "",
      selectedSubCategory: "",
      id: null,
      showForm: false,

      price: "",
      famprice: "",
      updateValid: false,
      rules: [(v) => !!v || "can,t be null"],
      currentUser: {},
      token: localStorage.getItem("token"),
    };
  },
  methods: {
    toggleItem(id) {
      this.selectedItemId = id;
      return (this.showForm = !this.showForm);
    },
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
    deleteItem(id) {
      let confirm = window.confirm("Delete This Item ? ");
      if (confirm) {
        axios
          .delete("api/details/" + id)
          .then(() => {
            this.getDetails();
          })
          .catch((error) => console.log(error));
      }
    },
    updateItem() {
      if (this.$refs.updateDeitelsRefs.validate()) {
        axios
          .put(`api/details/${this.selectedItemId}`, {
            price: this.price,
            famprice: this.famprice,
          })
          .then(() => {
            this.getDetails();
            this.showForm = false;
          })
          .catch((err) => {
            console.log(JSON.stringify(err));
          });
      }
    },
    getUser() {
      axios
        .get("api/user")
        .then((response) => {
          this.currentUser = response.data;
        })

        .finally(() => {
          setTimeout(() => {
            this.isloading = false;
          }, 2000);
        });
    },
    logout() {
      axios
        .post("api/vejbylogout")
        .then((response) => {
          localStorage.removeItem("token");
          this.$router.push("/");
          console.log(response.data);
        })
        .catch((errors) => {
          console.log(errors.response.data);
        });
    },
  },
  mounted() {
    this.getCategories();
    this.getSubCategories();
    this.getDetails();
  },
  computed: {
    filterSubCategories() {
      return this.subcategories.filter(
        (item) => item.category_id == this.selectedCategory
      );
    },
    filterdetails(id) {
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
  created() {
    axios.defaults.headers.common["Authorization"] = `Bearer ${this.token}`;
    // this.getUser();
  },
};
</script>

<style  scoped>
.back {
  background: #fff !important;
}
</style>
