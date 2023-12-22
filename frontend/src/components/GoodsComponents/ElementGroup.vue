<template>
  <div class="flex gap-4 my-5 mx-4 flex-wrap justify-start">
    <router-link v-for="(item, index) in items" :key="index" :to="getLink(item.goods_id)" >
      <CardGoodsVue
        :title="item.name"
        :badge="item.badge"
        :description="item.description"
        :tags="item.tags"
        :img="decodeImg(item.image)"
        :rating="getRating(item.rating)"
      />
    </router-link>
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
    },
    getRating(rating){
      if(rating)return rating;
      return 3;
    },
    decodeImg(image){
      return `data:image/jpeg;base64,${image}`
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