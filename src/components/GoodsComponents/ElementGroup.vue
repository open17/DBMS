<template>
  <div class="flex gap-4 my-5 mx-4 flex-wrap justify-start">
    <a v-for="(item, index) in items" :key="index" :href="getLink(item.gid)" >
      <CardGoodsVue
        :title="item.name"
        :badge="item.badge"
        :description="item.description"
        :tags="item.tags"
        :img="decodeImg(item.image)"
        :rating="getRating(item.rating)"
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
    },
    getRating(rating){
      if(rating)return rating;
      return 5;
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