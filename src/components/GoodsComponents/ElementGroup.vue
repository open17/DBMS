<template>
  <div class="flex gap-4 my-5 mx-4 flex-wrap justify-start">
    <a v-for="(item, index) in items" :key="index" :href="getLink(item.gid)" >
      <CardGoodsVue
        :title="item.title"
        :badge="item.badge"
        :description="item.description"
        :tags="item.tags"
        :img="item.img"
        :price="item.price"
        :rating="item.rating"
      />
    </a>
  </div>
</template>

<script>
import CardGoodsVue from "./CardGoods.vue";

export default {
  props:['items'],
  components: {
    CardGoodsVue,
  },
  methods:{
    getLink(gid){
      return "detail?gid="+gid;
    }
  },
  data() {
    return {
    };
  },
};
</script>

<style>
</style>