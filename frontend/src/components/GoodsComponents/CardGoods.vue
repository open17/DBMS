<template>
  <div class="card w-96 bg-base-100 shadow-xl hover:scale-105 transform transition cursor-pointer">
    <figure>
      <img :src="img" alt="" class="object-cover object-center h-60 w-full"/>
    </figure>
    <div class="card-body">
      <h2 class="card-title">
        {{ title }}
        <div class="badge badge-secondary" v-if="badge">{{ badge }}</div>
      </h2>
      <p>{{ description }}</p>
      <div class="card-actions justify-between">
        <div class="rating">
          <input type="radio" class="mask mask-star-2 bg-orange-400" disabled v-for="i of rating-1" :key="i"/>
          <input type="radio" class="mask mask-star-2 bg-orange-400" checked />
          <input type="radio" class="mask mask-star-2 bg-orange-400" disabled  v-for="i of 5-rating" :key="i"/>
        </div>
        <div class="flex gap-2" v-if="tags">
          <div
            class="badge badge-outline"
            v-for="(i, index) in tags"
            :key="index"
          >
            {{ i }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["title", "badge", "description", "tags", "img","rating"],
};
</script>

<style>
</style>