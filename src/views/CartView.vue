<template>
  <div class="overflow-x-auto w-full min-h-screen">
    <BreadCrumbsVue class="h-52" />
    <cart-table-vue class="bg-base-100" />
    <div class="stats shadow">
      <div class="stat">
        <div class="stat-title">Downloads</div>
        <div class="stat-value">31K</div>
        <div class="stat-desc">Jan 1st - Feb 1st</div>
      </div>

      <div class="stat">
        <div class="stat-title">New Users</div>
        <div class="stat-value">4,200</div>
        <div class="stat-desc">↗︎ 400 (22%)</div>
      </div>

      <div class="stat">
        <div class="stat-title">New Registers</div>
        <div class="stat-value">1,200</div>
        <div class="stat-desc">↘︎ 90 (14%)</div>
      </div>
    </div>
  </div>
</template>

<script>
import CartTableVue from "@/components/CartComponents/CartTable.vue";
import BreadCrumbsVue from "@/components/UnitComponents/BreadCrumbs.vue";
export default {
  components: {
    CartTableVue,
    BreadCrumbsVue,
  },
};
</script>

<style>
</style>