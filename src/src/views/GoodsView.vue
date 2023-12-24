<template>
  <div class="w-full min-h-screen flex bg-base-200 flex-col justify-center">
    <BreadCrumbsVue class="h-52" />
    <SearchBoxVue />
    <div class="flex justify-center w-full">
      <el-pagination
        background
        layout="prev, pager, next"
        :total="totalCount"
        :current-page="currentPage"
        :hide-on-single-page="true"
        @current-change="handlePageChange"
      ></el-pagination>
    </div>
    <ElementGroupVue :items="responseData" />
  </div>
</template>

<script>
import SearchBoxVue from "@/components/GoodsComponents/SearchBox.vue";
import ElementGroupVue from "@/components/GoodsComponents/ElementGroup.vue";
import http from "@/http.js";
import BreadCrumbsVue from "@/components/UnitComponents/BreadCrumbs.vue";

export default {
  components: {
    ElementGroupVue,
    SearchBoxVue,
    BreadCrumbsVue,
  },
  data() {
    return {
      category: "All",
      keyword: "",
      responseData: [],
      query: null,
      currentPage: 1, // 当前页码，默认为第一页
      totalPages: 0, // 总页数
      limit: 9, // 每页显示的记录数
      totalCount: 0, // 总记录数
    };
  },
  methods: {
    fetchData() {
      if (this.$route.query.category)
        this.category = this.$route.query.category;
      if (this.$route.query.keyword) this.keyword = this.$route.query.keyword;
      http
        .get(
          `db_goods.php?category=${this.category}&keyword=${this.keyword}&page=${this.currentPage}&limit=${this.limit}`
        )
        .then((response) => {
          // 响应成功
          this.responseData = response.data.data;
          this.currentPage = Number(response.data.page);
          this.totalCount =  Number(response.data.totalCount);
          this.totalPages = Math.ceil(this.totalCount / this.limit);
        })
        .catch((error) => {
          // 响应出错
          console.error(error);
        });
    },
    handlePageChange(page) {
      this.currentPage = page;
      this.fetchData();
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
    // console.log(this.responseData);
  },
};
</script>

<style>
</style>