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