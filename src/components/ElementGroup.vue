<template>
  <div class="flex gap-4 my-5 mx-4 flex-wrap justify-start">
    <a v-for="(item, index) in items" :key="index" :href="item.link" >
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
  components: {
    CardGoodsVue,
  },
  data() {
    return {
      items: [
        {
          title: "iPhone",
          badge: "New",
          description: "This is the description for Product 1.",
          tags: ["Tag 1", "Tag 2", "Tag 3"],
          img: "https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032218979.png",
          price: "$1000",
          rating: 4,
          link:'/iphone.html'
        },
        {
          title: "HUAWEI",
          description: "This is the description for Product 2.",
          tags: ["Tag 4"],
          img: "https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032224142.jpeg",
          price: "$1000",
          rating: 4,
          link:'/huawei.html'
        },
        {
          title: "XiaoMi",
          badge: "Sale",
          description: "This is the description for Product 2.",
          tags: [],
          img: "https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032220554.png",
          price: "$1000 ",
          rating: 4,
          link:'/xiaomi.html'
        },
        {
          title: "Product 2",
          description: "This is the description for Product 2.",
          tags: ["Tag 5"],
          img: "https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032225840.jpeg",
          price: "$1000 ",
          rating: 4,
        },
        {
          title: "Product 2",
          badge: "Sale",
          description: "This is the description for Product 2.",
          tags: ["Tag 4", "Tag 5"],
          img: "https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032226141.jpeg",
          price: "$1000 ",
          rating: 4,
        },
        {
          title: "Product 2",
          badge: "Sale",
          description: "This is the description for Product 2.",
          tags: ["Tag 4", "Tag 5"],
          img: "https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032230374.jpeg",
          price: "$1000 ",
          rating: 4,
        },
        {
          title: "Product 2",
          badge: "Sale",
          description: "This is the description for Product 2.",
          tags: ["Tag 4", "Tag 5"],
          img: "https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032232491.jpeg",
          price: "$1000 ",
          rating: 4,
        },
        {
          title: "Product 2",
          badge: "Sale",
          description: "This is the description for Product 2.",
          tags: ["Tag 4", "Tag 5"],
          img: "https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032233320.png",
          price: "$1000 ",
          rating: 4,
        },
        {
          title: "Product 2",
          badge: "Sale",
          description: "This is the description for Product 2.",
          tags: ["Tag 6"],
          img: "https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032233856.jpeg",
          price: "$1000 ",
          rating: 4,
        },
      ],
    };
  },
};
</script>

<style>
</style>