<template>
  <div class="w-full min-h-screen overflow-x-hidden">
    <BreadCrumbsVue class="h-52" />
    <ShopStepsVue :step="0"/>
    <cart-table-vue class="bg-base-100" />
    <div class="flex m-20 justify-center space-x-20">
      <button class="btn btn-primary mr-5" @click="$router.push('goods')">
        Continue shopping
      </button>
      <button class="btn btn-secondary" @click="$router.push('checkout')">
        Proceed to checkout
      </button>
    </div>
  </div>
</template>

<script>

import CartTableVue from "@/components/CartComponents/CartTable.vue";
import BreadCrumbsVue from "@/components/UnitComponents/BreadCrumbs.vue";
import ShopStepsVue from '@/components/UnitComponents/ShopSteps.vue';
export default {
  components: {
    CartTableVue,
    BreadCrumbsVue,
    ShopStepsVue
  },
};
</script>

<style>
</style>