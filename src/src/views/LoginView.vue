<template>
  <div class="flex flex-col items-center justify-center bg-base-200">
    <BreadCrumbsVue class="h-60 w-full" />
    <div class="w-full max-w-md bg-base-100  rounded-lg shadow-md p-6 mb-10">
      <h2 class="text-2xl font-bold text-gray-900 mb-4">Login</h2>
      <div class="flex flex-col">
        <input
          type="text"
          class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="User name"
          v-model="username"
        />
        <input
          type="password"
          class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="Password"
        />
        <div class="flex items-center justify-between flex-wrap">
          <label for="remember-me" class="text-sm text-gray-900 cursor-pointer">
            <input type="checkbox" id="remember-me" class="mr-2" />
            Remember me
          </label>
          <a href="#" class="text-sm text-blue-500 hover:underline mb-0.5"
            >Forgot password?</a
          >
          <p class="text-gray-900 mt-4">
            Don't have an account?
            <router-link to="signup" class="text-sm text-blue-500 -200 hover:underline mt-4"
              >Signup</router-link
            >
          </p>
        </div>
        <button
        @click="tryLogin"
          class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold py-2 px-4 rounded-md mt-4 hover:bg-indigo-600 hover:to-blue-600 transition ease-in-out duration-150"
        >
          Login
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import BreadCrumbsVue from "@/components/UnitComponents/BreadCrumbs.vue";
import { mapGetters, mapActions } from 'vuex';
export default {
    components:{
        BreadCrumbsVue
    },
    data() {
    return {
      username: '',
      password: '',
    };
  },
  computed: {
    ...mapGetters(['isLoggedIn']),
  },
  methods: {
    ...mapActions(['updateLoggedIn','updateAdmin']),
    login() {
      this.updateLoggedIn(true);
    },
    logout() {
      this.updateLoggedIn(false);
    },
    loginAdmin() {
        this.updateAdmin(true);
    },
    tryLogin() {
        if(this.username === 'seller')this.loginAdmin();
        this.login();
        this.$router.push('/');
    }
  },
};
</script>

<style>
</style>