<template>
  <v-app>
    <v-app-bar color="#fcb69f" dark src="img/1.jpg" height="70px">
      <template v-slot:img="{ props }">
        <v-img
          v-bind="props"
          gradient="to top right, rgba(82, 65, 48,.6), rgba(82, 65, 48,.7)"
        ></v-img>
      </template>
      <div
        style="
          width: 90%;
          max-width: 1000px;

          display: flex;
          margin: 0 auto;
          align-items: center;
        "
      >
        <v-btn @click="$vuetify.goTo('#item-menu')" text rounded>
          <v-icon>mdi-menu</v-icon>
          <span>menu</span>
        </v-btn>
        <v-spacer></v-spacer>
        <span> Vejby Restaurang </span>
        <v-spacer></v-spacer>
        <v-btn @click="$vuetify.goTo('#contact')" text rounded>
          <v-icon>mdi-map-marker</v-icon>
          <span>address</span>
        </v-btn>
      </div>
    </v-app-bar>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
export default {
  data: () => ({}),
};
</script>

<style  scoped>
@import url("https://fonts.googleapis.com/css2?family=Ballet&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Akaya+Telivigala&display=swap");
.back {
  background: #524130 !important;
}
/* .custom {
  display: grid;
  grid-template-columns: 1fr 1fr;
} */
.fontClass {
  font-family: "Ballet", cursive !important;
  font-size: 3rem;
}
.heroslog {
  font-family: "Akaya Telivigala", cursive !important;
  font-size: 2rem;
}
.contactstyle {
  background: #1a1716;
}
/* .appbar {
  position: relative;
} */
/* .buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;

  bottom: 0;
  left: 50%;
  right: 50%;
} */
</style>
