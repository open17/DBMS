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
  </div>
</template>

<script>
export default {
  props: ["description", "information"],
  components: {
  },
  methods: {
    decodeImg(image){
      return `http://localhost/api/get_img.php?file=${image}`
    }
  },
};
</script>

<style>
</style>