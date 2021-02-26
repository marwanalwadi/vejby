<template>
  <div id="homePage">
    <v-container fluid dark class="back" style="height: 100%">
      <v-snackbar v-model="snackbar" :timeout="4000" top dark>
        <span>Awesome! You added a new project</span>
        <v-btn text color="white" @click="snackbar = false">Close</v-btn>
      </v-snackbar>
      <!-- Header Section -->
      <section id="hero">
        <v-row no-gutters>
          <v-img
            :min-height="'calc(50vh - ' + $vuetify.application.top + 'px)'"
            src="img/1.jpg"
            gradient="to top right, rgba(0,0,0,0.2), rgba(0,0,0,0.7)"
          >
            <v-theme-provider dark>
              <v-container fill-height class="">
                <v-row
                  align="center"
                  class="white--text mx-auto"
                  justify="center"
                >
                  <v-col class="white--text text-center" cols="12" tag="h1">
                    <span class="fontClass"> Välkommen </span>
                    <br />

                    <span
                      :class="[
                        $vuetify.breakpoint.smAndDown
                          ? 'display-3'
                          : 'display-4',
                      ]"
                      class="mt-9"
                    >
                      <div>
                        <span class="heroslog">Listen to your palate </span>
                      </div>
                    </span>
                  </v-col>

                  <v-btn
                    class="align-self-end"
                    fab
                    outlined
                    @click="$vuetify.goTo('#item-menu')"
                  >
                    <v-icon>mdi-chevron-double-down</v-icon>
                  </v-btn>
                </v-row>
              </v-container>
            </v-theme-provider>
          </v-img>
        </v-row>
      </section>
      <!-- Item Menu and parallax -->

      <section id="item-menu">
        <v-layout fill-height>
          <v-flex grow>
            <v-parallax
              :height="$vuetify.breakpoint.smAndDown ? 2500 : 1500"
              src="img/para.jpg"
            >
              <v-container fluid fill-height fit-content>
                <v-row>
                  <v-col
                    cols="12"
                    xs="12"
                    sm="12"
                    md="12"
                    lg="12"
                    class="d-flex justify-center mb-3"
                  >
                    <v-card
                      dark
                      class="d-flex align-center text-center justify-content-center ma-4 pb-4 back"
                      rounded="200"
                      width="100%"
                      height="50"
                      @click="selectedAll()"
                    >
                      <v-card-text>
                        <div
                          class="pt-3 font-weight-bold text--accent-1 display-1"
                          size="1.25rem"
                        >
                          Show All
                        </div>
                      </v-card-text>
                    </v-card>
                  </v-col>
                </v-row>

                <v-row>
                  <v-col
                    v-for="(category, index) in categories"
                    :key="index"
                    cols="12"
                    xs="12"
                    sm="6"
                    md="4"
                    lg="3"
                    class="d-flex justify-center mb-3"
                  >
                    <v-card
                      dark
                      class="d-flex align-center text-center justify-content-center ma-4 pb-4 back"
                      rounded="200"
                      width="200"
                      height="75"
                      @click="selectedCat(category.id)"
                    >
                      <v-card-text>
                        <div
                          class="pt-3 font-weight-bold display-1"
                          size="1.25rem"
                        >
                          {{ category.categoryname }}
                        </div>
                      </v-card-text>
                    </v-card>
                  </v-col>
                </v-row>

                <v-row>
                  <v-col
                    v-for="(subcategory, index) in filterSubCategories"
                    :key="index"
                    cols="12"
                    xs="12"
                    sm="6"
                    md="4"
                    lg="3"
                    class="d-flex justify-center mb-3"
                  >
                    <v-slide-x-transition>
                      <v-card
                        dark
                        class="d-flex align-center text-center justify-content-center ma-8 pb-4 back"
                        rounded="200"
                        width="200"
                        height="150"
                        @click="selectedSubCat(subcategory.id)"
                      >
                        <v-card-text>
                          <div
                            class="pt-3 font-weight-bold text--accent-1"
                            size="1.25rem"
                          >
                            {{ subcategory.subcategoryname }}
                          </div>
                        </v-card-text>
                      </v-card>
                    </v-slide-x-transition>
                  </v-col>
                </v-row>
              </v-container>
            </v-parallax>
          </v-flex>
        </v-layout>
      </section>

      <!-- Contact Section -->
      <section id="contact" class="">
        <div class="py-12"></div>
        <v-container class="text-center">
          <h2 class="display-2 font-weight-bold mb-3">Contact Info</h2>
          <v-responsive
            class="mx-auto font-weight-light mb-8 justify-content-between d-flex"
            max-width="1000"
          >
            <v-row>
              <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                <div>
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Quaerat sed nobis pariatur sunt, neque veniam laudantium
                  tempore delectus ratione et iure blanditiis reiciendis natus
                  sequi libero enim, minima maiores? Consequuntur!
                </div>
              </v-col>
              <v-col cols="12" xs="12" sm="12" md="6" lg="6" xl="6">
                <v-card
                  elevation="10"
                  class="pa-3 ma-5 w-100 transparent"
                  :loading="isLoading"
                >
                  <template slot="progress">
                    <v-progress-linear
                      color="#dcb562"
                      indeterminate
                    ></v-progress-linear>
                  </template>
                  <v-text-field
                    label="Name"
                    v-model="form.name"
                    append-icon="mdi-folder"
                    color="#dcb562"
                    :rules="inputRules"
                  >
                  </v-text-field>
                  <v-text-field
                    v-model="form.email"
                    append-icon="mdi-folder"
                    type="email"
                    label="E-mail"
                    color="#dcb562"
                    :rules="inputRules"
                  ></v-text-field>
                  <v-text-field
                    v-model="form.phone"
                    label="Phone Number"
                    color="#dcb562"
                    append-icon="mdi-folder"
                    required
                    :rules="inputRules"
                  ></v-text-field>
                  <v-textarea
                    label="Information"
                    v-model="form.msg"
                    append-icon="mdi-pen"
                    counter
                    no-resize
                    color="#dcb562"
                    :rules="inputRules"
                  >
                  </v-textarea>

                  <v-btn
                    block
                    depressed
                    large
                    dark
                    color="black"
                    class="mx-0 mt-3"
                    @click="sendemail()"
                    >Send Email</v-btn
                  >
                </v-card>
              </v-col>
            </v-row>
          </v-responsive>
        </v-container>
      </section>
    </v-container>

    <div>
      <VueSlickCarousel v-bind="settings" :arrows="true" :dots="false">
        <!-- <v-card
                      v-for="(detail, index) in filterdetails"
                      :key="index"
                      dark
                      class="d-flex align-center text-center justify-content-center ma-8 pb-4 pt-3 back"
                      rounded="200"
                      width="200"
                      height="200"
                    >
                      <v-card-text>
                        <div
                          class="pt-4 pb-4 font-weight-bold text--accent-1"
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
                    </v-card> -->
        <div class="primary">
          <h1>Hello</h1>
        </div>

        <div class="primary">
          <h1>Hello</h1>
        </div>

        <div class="primary">
          <h1>Hello</h1>
        </div>

        <div class="primary">
          <h1>Hello</h1>
        </div>

        <div class="primary">
          <h1>Hello</h1>
        </div>

        <div class="primary">
          <h1>Hello</h1>
        </div>
      </VueSlickCarousel>
    </div>
  </div>
</template>


<script>
import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
export default {
  components: { VueSlickCarousel },
  data() {
    return {
      snackbar: false,
      settings: {
        centerMode: true,
        centerPadding: "20px",
        focusOnSelect: true,
        infinite: true,
        slidesToShow: 3,
        speed: 500,
      },
      isLoading: false,
      categories: [],
      subcategories: [],

      details: [],
      selectedCategory: "",
      selectedSubCategory: "",
      form: {
        name: "",
        email: "",
        phone: "",
        msg: "",
      },
      inputRules: [(v) => v.length >= 3 || "Minimum length is 3 characters"],
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
    sendemail() {
      if (
        this.form.name === "" ||
        this.form.email === "" ||
        this.form.phone === "" ||
        this.form.msg === ""
      ) {
        console.log("fail");
      } else {
        this.isLoading = true;
        let info = new FormData();
        info.append("name", this.form.name);
        info.append("email", this.form.email);
        info.append("phone", this.form.phone);
        info.append("msg", this.form.msg);
        axios
          .post("api/contact", info)
          .then(() => {
            this.isLoading = false;
            this.snackbar = true;
          })
          .catch((error) => console.log(error));
      }
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

<style  scoped>
@import url("https://fonts.googleapis.com/css2?family=Ballet&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap");
.back {
  background: #524130 !important;
}

.fontClass {
  font-family: "Ballet", cursive !important;
  font-size: 3rem;
}
.heroslog {
  font-family: "Akaya Telivigala", cursive !important;
  font-size: 2.25rem;
}
.contactstyle {
  background: #1a1716;
}
.appbar {
  position: relative;
}
.buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;

  bottom: 0;
  left: 50%;
  right: 50%;
}
.v-parallax__content {
  padding: 0px !important;
}
</style>

