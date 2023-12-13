<template>
  <div class="bg-base-200">
    <ProductViewVue v-for="(i,idx) in products" :product="i" :key="idx"/>
    <h2 class="m-2 text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>
    <CarouselSectionVue class="bg-base-200"/>
    <div class="bg-base-200 h-20"></div>
  </div>
</template>

<script>
import ProductViewVue from '@/components/ProductView.vue'
import CarouselSectionVue from '@/components/CarouselSection.vue'


export default {
components:{
  ProductViewVue,
  CarouselSectionVue
},
data(){
  return{
    products:[{
      "name": "XiaoMi 14",
      "price": '$1000', 
      "category": "mobile",
      "img":'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312032311211.jpeg',
      "type":["Pro+128BG","Pro+64GB","SE+256GB","SE+128GE","SE+64GB","128GB"],
      "forbid":["Pro+256BG","256GB"]
    }]
  }
}
}
</script>

<style>

</style>