<template>
  <div class="w-full min-h-screen flex bg-base-200 flex-col">
    <SearchBoxVue />
    <ElementGroupVue />
  </div>
</template>

<script>
import SearchBoxVue from "@/components/SearchBox.vue";
import ElementGroupVue from "../components/ElementGroup.vue";

export default {
  components: {
    ElementGroupVue,
    SearchBoxVue,
  },
};
</script>

<style>
</style>