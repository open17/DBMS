<template>
   <div class="card w-1/4 bg-base-100 shadow-xl hover:scale-105 transition">
      <figure>
        <img
          :src="img"
          :alt="title"
          class="h-40 px-5 mt-5"
        />
      </figure>
      <div class="card-body">
        <h2 class="card-title">
          {{title}}
          <div class="badge badge-secondary" v-if="badge">{{badge}}</div>
        </h2>
        <ul class="menu w-full menu-lg rounded-box" >
          <li v-for="(i,idx) in links" :key="idx" class="px-0"><a :href="i.link" class="text-sm mx-0">{{i.title}}</a></li>
        </ul>
        <div class="card-actions justify-center">
          <button class="btn btn-outline btn-xs sm:btn-sm md:btn-md" @click="$router.push('goods?category='+title)">
            Shop All
          </button>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  props:["title","img","badge","links"]
}
</script>

<style>

</style>