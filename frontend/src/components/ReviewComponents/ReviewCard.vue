<template>
  <div class="card mx-40 w-auto bg-base-100 shadow-xl my-5">
    <div class="card-body">
      <h2 class="card-title">{{ cardTitle }}</h2>
      <p>{{ cardText }}</p>
    </div>
    <div class="card-actions justify-between items-center mb-3">
      <div class="flex items-center justify-start">
        <div class="avatar">
          <div class="w-12 rounded-full m-2 ml-5">
            <img :src="avatarSrc" />
          </div>
        </div>
        <div class="flex flex-col">
          <div class="font-bold">{{ authorName }}</div>
          <div class="text-sm text-base-content">{{ date }}</div>
        </div>
        <div class="rating ml-5">
          <input
            type="radio"
            class="mask mask-star-2 bg-orange-400"
            disabled
            v-for="i of rating - 1"
            :key="i"
          />
          <input
            type="radio"
            class="mask mask-star-2 bg-orange-400"
            checked
          />
          <input
            type="radio"
            class="mask mask-star-2 bg-orange-400"
            disabled
            v-for="i of 5 - rating"
            :key="i + 5"
          />
        </div>
      </div>
      <button class="btn btn-ghost mr-6 m-2">Reply</button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    cardTitle: {
      type: String,
      required: true
    },
    cardText: {
      type: String,
      required: true
    },
    avatarSrc: {
      type: String,
      required: true
    },
    authorName: {
      type: String,
      required: true
    },
    date: {
      type: String,
      required: true
    },
    rating: {
      type: Number,
      required: true
    }
  }
};
</script>