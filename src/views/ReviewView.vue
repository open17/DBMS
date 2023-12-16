<template>
  <div class="bg-base-200 flex flex-col">
    <review-card-vue
      v-for="(i, index) in responseData"
      :key="index"
      :cardTitle="i.cardTitle"
      :authorName="i.authorName"
      :avatarSrc="i.avatarSrc"
      :cardText="i.cardText"
      :date="i.date"
      :rating="i.rating"
    />
  </div>
</template>

<script>
import ReviewCardVue from "@/components/ReviewComponents/ReviewCard.vue";
import http from "@/http.js";
export default {
  components: {
    ReviewCardVue,
  },
  data() {
    return {
      gid: 0,
      responseData: null,
    };
  },
  methods: {
    fetchData() {
      http
        .get("reviews.php?gid=" + this.gid)
        .then((response) => {
          // 响应成功
          this.responseData = response.data;
        })
        .catch((error) => {
          // 响应出错
          console.error(error);
        });
    },
  },
  mounted() {
    if (this.$route.query.gid) this.gid = this.$route.query.gid;
    this.fetchData();
  },
};
</script>

<style>
</style>