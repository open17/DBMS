<template>
  <div class="mx-20">
    <el-descriptions title="Current Info" border>
      <template slot="extra">
        <el-button type="primary" size="small" @click="$store.commit('toggleAddressEditor')">Edit</el-button>
      </template>

      <el-descriptions-item label="Post">{{
        info.post
      }}</el-descriptions-item>
      <el-descriptions-item label="Street">{{
        info.street
      }}</el-descriptions-item>
      <el-descriptions-item label="City">{{
        info.city
      }}</el-descriptions-item>
      <el-descriptions-item label="Country">{{
        info.country
      }}</el-descriptions-item>
      <el-descriptions-item label="Email">
        {{ info.email }}
      </el-descriptions-item>
      <el-descriptions-item label="Phone">{{
        info.phone
      }}</el-descriptions-item>
    </el-descriptions>
  </div>
</template>

<script>
import http from '@/http';
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      info: {},
    };
  },
   computed: {
    ...mapGetters(["getUserId"]),
  },
  mounted() {
    this.fetchInfo();
  },
  methods: {
    fetchInfo() {
      http.get(`get_info.php?buyer_id=${this.getUserId}`)
        .then((response) => {
          const data = response.data;
          if (data.error) {
            console.error(data.error);
          } else {
            this.info = data;
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>

<style scoped>
</style>