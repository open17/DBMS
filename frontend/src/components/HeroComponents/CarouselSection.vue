<template>
  <div>
    <div class="carousel w-full z-0">
      <div id="slide1" class="carousel-item relative w-full">
        <div
          class="mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 mx-20 w-full"
        >
          <GoodShowVue v-for="i in 4" :key="i" />
        </div>
        <div
          class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"
        >
          <a href="#slide4" class="btn btn-circle bg-base-100">❮</a>
          <a href="#slide2" class="btn btn-circle bg-base-100">❯</a>
        </div>
      </div>
      <div id="slide2" class="carousel-item relative w-full">
        <div
          class="mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 mx-20 w-full"
        >
          <GoodShowVue v-for="i in 4" :key="i" />
        </div>
        <div
          class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"
        >
          <a href="#slide1" class="btn btn-circle bg-base-100">❮</a>
          <a href="#slide3" class="btn btn-circle bg-base-100">❯</a>
        </div>
      </div>
      <div id="slide3" class="carousel-item relative w-full">
        <div
          class="mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 mx-20 w-full"
        >
          <GoodShowVue v-for="i in 4" :key="i" />
        </div>
        <div
          class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"
        >
          <a href="#slide2" class="btn btn-circle bg-base-100">❮</a>
          <a href="#slide4" class="btn btn-circle bg-base-100">❯</a>
        </div>
      </div>
      <div id="slide4" class="carousel-item relative w-full">
        <div
          class="mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 mx-20 w-full"
        >
          <GoodShowVue v-for="i in 4" :key="i" />
        </div>
        <div
          class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2"
        >
          <a href="#slide3" class="btn btn-circle bg-base-100">❮</a>
          <a href="#slide1" class="btn btn-circle bg-base-100">❯</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import GoodShowVue from "./GoodShow.vue";

export default {
  components: {
    GoodShowVue,
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
