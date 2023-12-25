<template>
  <div class="bg-base-200">
    <template v-if="dataFetched">
      <ProductViewVue :product="responseData" :gid="gid" />
      <InformationTabVue :description="getDescription()" :information="getInformation()" />
      <div class="bg-base-200 h-20"></div>
    </template>
  </div>
</template>

<script>
import ProductViewVue from "@/components/DetailComponents/ProductView.vue";
// import CarouselSectionVue from "@/components/HeroComponents/CarouselSection.vue";
import http from "@/http.js";
import InformationTabVue from '@/components/DetailComponents/InformationTab.vue';

export default {
  components: {
    ProductViewVue,
    // CarouselSectionVue,
    InformationTabVue
  },
  data() {
    return {
      responseData: {},
      gid: 0,
      dataFetched: false // 添加一个标志变量表示数据是否已获取
    };
  },
  methods: {
    fetchData() {
      http
        .get("db_details.php?gid=" + this.gid)
        .then((response) => {
          // 响应成功
          this.responseData = response.data;
          this.dataFetched = true; // 设置标志变量为true表示数据已获取
        })
        .catch((error) => {
          // 响应出错
          console.error(error);
        });
    },
    getDescription() {
      return this.responseData.description;
    },
    getInformation() {
      return this.responseData.information;
    }
  },
  mounted() {
    if (this.$route.query.gid) this.gid = this.$route.query.gid;
    this.fetchData();
  }
};
</script>

<style>
</style>