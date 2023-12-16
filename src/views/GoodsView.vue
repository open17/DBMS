<template>
  <div class="w-full min-h-screen flex bg-base-200 flex-col">
    <BreadCrumbsVue class=" h-52"/>
    <SearchBoxVue />
    <ElementGroupVue :items="responseData" />
  </div>
</template>

<script>
import SearchBoxVue from "@/components/GoodsComponents/SearchBox.vue";
import ElementGroupVue from "@/components/GoodsComponents/ElementGroup.vue";
import http from "@/http.js";
import BreadCrumbsVue from '@/components/UnitComponents/BreadCrumbs.vue';
export default {
  components: {
    ElementGroupVue,
    SearchBoxVue,
    BreadCrumbsVue
  },
  data() {
    return {
      category: "All",
      keyword: "",
      responseData: null,
      query: null,
    };
  },
  methods: {
    fetchData() {
      if (this.$route.query.category)
        this.category = this.$route.query.category;
      if (this.$route.query.keyword) this.keyword = this.$route.query.keyword;
      http
        .get("goods.php?category=" + this.category + "&keyword=" + this.keyword)
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
  watch: {
    "$route.query": {
      immediate: true,
      handler() {
        this.fetchData();
      },
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>

<style>
</style>