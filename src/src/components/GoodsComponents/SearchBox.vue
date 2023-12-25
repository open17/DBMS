<template>
  <div class="flex items-center justify-center px-5 pb-5">
    <div class="rounded-lg bg-base-200 px-5 pb-5">
      <div class="flex">
        <div
          class="flex w-16 items-center justify-center rounded-tl-lg rounded-bl-lg border-r border-base-200 bg-base-100 p-5"
        >
          <svg
            viewBox="0 0 20 20"
            aria-hidden="true"
            class="pointer-events-none absolute w-5 fill-base-500 transition"
          >
            <path
              d="M16.72 17.78a.75.75 0 1 0 1.06-1.06l-1.06 1.06ZM9 14.5A5.5 5.5 0 0 1 3.5 9H2a7 7 0 0 0 7 7v-1.5ZM3.5 9A5.5 5.5 0 0 1 9 3.5V2a7 7 0 0 0-7 7h1.5ZM9 3.5A5.5 5.5 0 0 1 14.5 9H16a7 7 0 0 0-7-7v1.5Zm3.89 10.45 3.83 3.83 1.06-1.06-3.83-3.83-1.06 1.06ZM14.5 9a5.48 5.48 0 0 1-1.61 3.89l1.06 1.06A6.98 6.98 0 0 0 16 9h-1.5Zm-1.61 3.89A5.48 5.48 0 0 1 9 14.5V16a6.98 6.98 0 0 0 4.95-2.05l-1.06-1.06Z"
            ></path>
          </svg>
        </div>
        <input
          type="text"
          class="h-12 w-96 bg-base-100 pl-4 text-base font-semibold outline-0"
          placeholder="type somethings ..."
          v-model="inputText"
        />
        <input
          type="button"
          value="Search"
          class="bg-primary p-2 px-5 rounded-tr-lg rounded-br-lg text-base-100 font-semibold cursor-pointer"
          @click="submitForm"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      inputText: "",
    };
  },
  methods: {
    submitForm() {
      const inputText = this.inputText;
      const query = { ...this.$route.query };
      // 修改查询参数的值
      if (query.keyword != inputText) {
        query.keyword = inputText;
        // 使用新的查询参数进行路由跳转
        this.$router.push({ query });
      }
    },
  },
};
</script>

<style>
</style>