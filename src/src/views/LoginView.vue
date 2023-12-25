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
          v-model="password"
          class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="Password"
        />
        <div class="flex items-center justify-between flex-wrap">
          <label for="admin" class="text-sm text-gray-900 cursor-pointer">
            <input type="checkbox" id="admin" class="mr-2"  v-model="is_admin"/>
            admin
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
import http from "@/http.js";
import { mapGetters, mapActions } from 'vuex';
export default {
    components:{
        BreadCrumbsVue
    },
    data() {
    return {
      username: '',
      password: '',
      is_admin:false
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
      // 构建请求参数对象
      const postData = {
        username: this.username,
        password: this.password,
        is_admin: this.is_admin,
      };
      const config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      };
      console.log(postData);
      // 发送登录请求
      http
        .post("login.php", postData, config)
        .then((response) => {
          if (response.data.success) {
            // 登录成功
            // 完成登录后的逻辑
            this.$notify({
              title: "Success",
              message: "Login successful",
              type: "success",
            });
            // ... 完成登录后的逻辑

            // 更新用户 ID
            this.$store.dispatch('updateUserId', response.data.userId);
            this.$store.dispatch('updateLoggedIn', true);
            this.$store.dispatch('updateAdmin', this.is_admin);
            this.$router.push('/');
          } else {
            // 登录失败
            this.$notify({
              title: "Error",
              message: response.data.error,
              type: "error",
            });
          }
        })
        .catch((error) => {
          // 登录失败，处理错误信息
          console.error(error);
        });
    },
  },
};
</script>

<style>
</style>