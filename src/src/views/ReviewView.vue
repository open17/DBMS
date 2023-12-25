<template>
  <div class="bg-base-200 flex flex-col">{{ responseData }}</div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      gid: 0,
      responseData: null,
    };
  },
  methods: {
    fetchData() {
      axios({
        method: 'POST',
        url: 'http://localhost/api/test_post.php',
        data: {
          id: 1,
          name: "张三"
        },
        
      })
      .then(response => {
        console.log(response.data);
        this.responseData = response.data; // 将响应数据赋值给 responseData
      })
      .catch(error => {
        console.log('错误', error.message);
      });
    },
  },
  mounted() {
    this.fetchData();
  },
};
</script>

<style>
</style>