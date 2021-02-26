<template>
  <div class="mt-16">
    <div>
      <div>
        <v-text-field
          type="text"
          :value="form.name"
          name="name"
          @change="handleChange"
        >
        </v-text-field>
      </div>
      <div>
        <v-text-field
          type="text"
          :value="form.details"
          name="details"
          @change="handleChange"
        >
        </v-text-field>
      </div>
      <div>
        <v-text-field
          type="text"
          :value="form.price"
          name="price"
          @change="handleChange"
        >
        </v-text-field>
      </div>
      <div>
        <v-text-field
          type="text"
          name="famprice"
          :value="form.famprice"
          @change="handleChange"
        >
        </v-text-field>
        <v-btn :class="this.btnclass" @click="omFormSubmit">{{
          btnName
        }}</v-btn>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MyForm",
  data() {
    return {
      btnName: "save",
      btnclass: "btn btn-success",
    };
  },
  props: {
    form: {
      type: Object,
    },
  },
  methods: {
    handleChange(event) {
      const { name, value } = event.target;
      let form = this.form;
      form[name] = value;
      this.form = form;
    },
    omFormSubmit(e) {
      e.preventDefault();

      this.$emit("omFormSubmit", this.form);
      this.btnName = "Save";
      this.btnclass = "btn btn-success";
      this.clearFormFields();
    },

    clearFormFields() {
      this.form.name = "";
      this.form.details = "";
      this.form.price = "";
      this.form.famprice = false;

      document.querySelector(".form").reset();
    },
  },
  updated() {
    if (this.form.isEdit) {
      this.btnName = "Update";
      this.btnclass = "btn btn-warning";
    }
  },
};
</script>

<style lang="stylus" scoped></style>
