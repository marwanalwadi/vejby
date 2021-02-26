<template>
  <v-app>
    <v-content fill-height fluid>
      <section id="item-menu">
        <v-parallax
          :height="$vuetify.breakpoint.smAndDown ? 2500 : 1500"
          src="img/pizza.jpg"
        >
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
                <v-hover v-slot="{ hover }" open-delay="100">
                  <v-card
                    :elevation="hover ? 16 : 2"
                    :class="{ 'on-hover': hover }"
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
                </v-hover>
              </v-col>
            </v-row>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Praesentium ipsam, expedita ab doloribus minus voluptatem amet vitae
            ad beatae debitis, exercitationem porro voluptates! Nulla iusto
            debitis architecto dolore ipsa necessitatibus!
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
                <v-hover v-slot="{ hover }" open-delay="100">
                  <v-card
                    :elevation="hover ? 16 : 2"
                    :class="{ 'on-hover': hover }"
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
                </v-hover>
              </v-col>
            </v-row>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus
            nisi saepe esse officia consectetur, totam excepturi iusto
            asperiores eligendi rem ab quis reiciendis accusantium cupiditate
            perspiciatis sequi est. Reiciendis, accusantium.
            <v-row>
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
                <v-hover v-slot="{ hover }" open-delay="100">
                  <v-card
                    :elevation="hover ? 16 : 2"
                    :class="{ 'on-hover': hover }"
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
                </v-hover>
              </v-col>
            </v-row>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique
            hic veritatis odio sunt unde tempora est! Aperiam aut ullam
            reprehenderit. Dolor facere natus ipsum, fugiat quidem impedit enim
            est sapiente.
            <v-row>
              <v-col
                v-for="(detail, index) in filterdetails"
                :key="index"
                cols="12"
                xs="12"
                sm="6"
                md="4"
                lg="3"
                class="d-flex justify-center mb-6"
              >
                <v-hover v-slot="{ hover }" open-delay="100">
                  <v-card
                    :elevation="hover ? 16 : 2"
                    :class="{ 'on-hover': hover }"
                    dark
                    class="d-flex align-center text-center justify-content-center ma-8 pb-4 pt-3"
                    rounded="200"
                    width="200"
                    height="200"
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
                    </v-card-text>
                  </v-card>
                </v-hover>
              </v-col>
            </v-row>
          </v-container>
        </v-parallax>
      </section>
    </v-content>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      subcategories: [],
      //   category_id: 1,
      //   subcates: [],
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
    filterdetails() {
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
    this.getSubCategories();
    this.getDetails();
  },
};
</script>

<style lang="stylus" scoped></style>
