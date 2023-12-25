<template>
  <div class="flex gap-4 my-5 mx-4 flex-wrap justify-start">
    <router-link v-for="(item, index) in items" :key="index" :to="getLink(item.goods_id)">
      <CardGoodsVue
        :title="item.goods_name"
        :description="item.goods_description"
        :img="getImg(item.goods_pic)"
      />
    </router-link>
  </div>
</template>

<script>
import CardGoodsVue from "./CardGoods.vue";
// import http from "@/http.js";

export default {
  props: ['items'],
  components: {
    CardGoodsVue,
  },
  data() {
    return {
      imageData: [], // 创建一个局部数据属性来存储图片数据
    };
  },
  methods: {
    getImg(url){
      return `http://localhost/api/get_img.php?file=${url}`
    },
    getLink(gid) {
      return "detail?gid=" + gid;
    },
  },
  mounted() {
  },
};
</script>

<style>
</style>