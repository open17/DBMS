<template>
  <div class="bg-base-200">
    <ProductViewVue :product="responseData" :gid="gid" />
    <InformationTabVue/>
    <h2 class="m-2 text-2xl font-bold tracking-tight text-gray-900">
      Customers also purchased
    </h2>
    <CarouselSectionVue class="bg-base-200" />
    <div class="bg-base-200 h-20"></div>
  </div>
</template>

<script>
import ProductViewVue from "@/components/DetailComponents/ProductView.vue";
import CarouselSectionVue from "@/components/HeroComponents/CarouselSection.vue";
import http from "@/http.js";
import InformationTabVue from '@/components/DetailComponents/InformationTab.vue';

export default {
  components: {
    ProductViewVue,
    CarouselSectionVue,
    InformationTabVue
  },
  data() {
    return {
      responseData: {},
      gid:0,
    };
  },
  methods: {
    fetchData() {
      http
        .get("details.php?gid="+this.gid)
        .then((response) => {
          // 响应成功
          this.responseData = response.data;
        })
        .catch((error) => {
          // 响应出错
          console.error(error);
        });
    },
  },
  mounted(){
    if(this.$route.query.gid)this.gid=this.$route.query.gid;
    this.fetchData();
  }
};
</script>

<style>
</style>