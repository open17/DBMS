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
      Tab content 1
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
      Tab content 2
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
      <ReviewViewVue/>
    </div>
  </div>
</template>

<script>
import ReviewViewVue from '@/views/ReviewView.vue';
export default {
    components:{
        ReviewViewVue
    }
};
</script>

<style>
</style>