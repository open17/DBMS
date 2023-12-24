<template>
  <div role="tablist" class="tabs tabs-lifted tabs-lg mx-5">
    <input
      type="radio"
      name="my_tabs_2"
      role="tab"
      class="tab"
      aria-label="Description"
    />
    <div
      role="tabpanel"
      class="tab-content bg-base-100 border-base-300 rounded-box p-6"
    >
      {{ description }}
    </div>

    <input
      type="radio"
      name="my_tabs_2"
      role="tab"
      class="tab"
      aria-label="Information"
      checked
    />
    <div
      role="tabpanel"
      class="tab-content bg-base-100 border-base-300 rounded-box p-6"
    >
      <img
        :src="decodeImg(information)"
        alt=""
        class="object-cover object-center"
      />
    </div>

    <input
      type="radio"
      name="my_tabs_2"
      role="tab"
      class="tab"
      aria-label="Reviews"
    />
    <div
      role="tabpanel"
      class="tab-content bg-base-100 border-base-300 rounded-box p-6"
    >
      <ReviewViewVue />
    </div>
  </div>
</template>

<script>
import ReviewViewVue from "@/views/ReviewView.vue";
export default {
  props: ["description", "information"],
  components: {
    ReviewViewVue,
  },
  methods: {
    decodeImg(image){
      return `data:image/jpeg;base64,${image}`
    }
  },
};
</script>

<style>
</style>