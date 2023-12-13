<template>
  <div class="flex w-full space-x-5 p-2">
   <CardProductVue v-for="(i,idx) in products" :key="idx" :badge="i.badge" :title="i.title" :links="i.links" :img="i.img"/>
  </div>
</template>

<script>
import CardProductVue from './CardProduct.vue';

export default {
    components:{
        CardProductVue
    },
    data(){
        return {
          products:[
            {
              title:'Phone',
              img:'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312031450944.png',
              badge:'HOT',
              links:[
                {
                  title:'Flagship phone',
                  link:'#'
                },
                {
                  title:'Budget mobile',
                  link:'#'
                },
                {
                  title:'Phone accessories',
                  link:'#'
                },
                {
                  title:'Refurbished product',
                  link:'#'
                },
              ]
            },
             {
              title:'Computer',
              img:'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312031639452.png',
              links:[
                {
                  title:'Desktop computer',
                  link:'#'
                },
                {
                  title:'Computer peripherals',
                  link:'#'
                },
                {
                  title:'Peripheral devices',
                  link:'#'
                },
                {
                  title:'Maintenance service',
                  link:'#'
                },
              ]
            },
            {
              title:'Audiovisual',
              img:'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312031645874.png',
              links:[
                {
                  title:'Headphones',
                  link:'#'
                },
                {
                  title:'Speakers',
                  link:'#'
                },
                {
                  title:'Projector',
                  link:'#'
                },
                {
                  title:'Live-streaming',
                  link:'#'
                },
              ]
            },
            {
              title:'More',
              img:'https://cdn.jsdelivr.net/gh/open17/Pic/img/202312031438741.png',
              links:[
                {
                  title:'Smart Robot',
                  link:'#'
                },
                {
                  title:'Gaming devices',
                  link:'#'
                },
                {
                  title:'Home appliances',
                  link:'#'
                },
                {
                  title:'Others',
                  link:'#'
                },
              ]
            },
          ]
        }
        
    }
};
</script>

<style>
</style>