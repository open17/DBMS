<template>
  <div class=" overflow-x-hidden">
    <BreadCrumbsVue class="h-60" />
    <ShopStepsVue :step="3"/>
     <el-result icon="success" title="Success" subTitle="Order Successfully">
      <template slot="extra">
        <el-button type="primary" size="medium" @click="$router.push('cart')">Back to cart</el-button>
      </template>
    </el-result>
  </div>
</template>

<script>
import BreadCrumbsVue from "@/components/UnitComponents/BreadCrumbs.vue";
import ShopStepsVue from '@/components/UnitComponents/ShopSteps.vue';
export default {
  components: {
    BreadCrumbsVue,
    ShopStepsVue
  },
};
</script>

<style>
</style>