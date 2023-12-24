<template>
  <div class="flex flex-col items-center justify-center bg-base-200">
    <BreadCrumbsVue class="h-60 w-full" />
    <div class="w-full max-w-md bg-base-100  rounded-lg shadow-md p-6 mb-10">
      <h2 class="text-2xl font-bold text-gray-900 mb-4">Signup</h2>
      <div class="flex flex-col">
        <input
          type="text"
          class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="User name"
        />
        <input
          type="password"
          class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="Password"
        />
        <input
          type="password"
          class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="Type Password Again"
        />
        <div class="flex items-center justify-between flex-wrap">
          <p class="text-gray-900 mt-4">
            Alreay have an account?
            <router-link to="login" class="text-sm text-blue-500 -200 hover:underline mt-4"
              >Login</router-link
            >
          </p>
        </div>
        <button
          @click="open2()"
          class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150"
        >
          Signup
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import BreadCrumbsVue from "@/components/UnitComponents/BreadCrumbs.vue";
export default {
    components:{
        BreadCrumbsVue
    },
    methods:{
          open2() {
        this.$notify({
          title: 'Warning',
          message: 'User name have already exited',
          type: 'warning'
        });
      },
    },
};
</script>

<style>
</style>