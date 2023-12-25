<template>
  <div class="flex flex-col items-center justify-center bg-base-200">
    <BreadCrumbsVue class="h-60 w-full" />
    <div class="w-full max-w-md bg-base-100 rounded-lg shadow-md p-6 mb-10">
      <h2 class="text-2xl font-bold text-gray-900 mb-4">Signup</h2>
      <div class="flex flex-col">
        <input
          type="text"
          v-model="username"
          class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="User name"
        />
        <input
          type="password"
          v-model="password"
          class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="Password"
        />
        <input
          type="password"
          v-model="confirmPassword"
          class="bg-gray-100 text-gray-900 border-0 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="Type Password Again"
        />
        <label for="admin" class="text-sm text-gray-900 cursor-pointer">
          <input type="checkbox" id="admin" class="mr-2" v-model="is_admin" />
          admin
        </label>
        <input
          type="password"
          v-model="admin_key"
          class="bg-gray-100 text-gray-900 border-0 mt-5 rounded-md p-2 mb-4 focus:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition ease-in-out duration-150"
          placeholder="Admin invite key"
          v-if="is_admin"
        />
        <div class="flex items-center justify-between flex-wrap">
          <p class="text-gray-900 mt-4">
            Already have an account?
            <router-link
              to="login"
              class="text-sm text-blue-500 -200 hover:underline mt-4"
              >Login</router-link
            >
          </p>
        </div>
        <button
          @click="trySignup"
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
import http from "@/http.js";

export default {
  components: {
    BreadCrumbsVue,
  },
  data() {
    return {
      username: "", // 用户名
      password: "", // 密码
      confirmPassword: "", // 确认密码
      is_admin: false,
    };
  },
  methods: {
    trySignup() {
      // 检查密码是否匹配
      if (this.password !== this.confirmPassword) {
        this.$notify({
          title: "Warning",
          message: "Passwords do not match",
          type: "warning",
        });
        return;
      }

      // 构建请求参数对象
      const postData = {
        buyer_name: this.username,
        password: this.password,
      };
      const config = {
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
      };
      // 发送 POST 请求
      http
        .post("signup.php", postData, config)
        .then((response) => {
          if (response.data.success) {
            // 注册成功
            // 完成登录等逻辑
            this.$notify({
              title: "Success",
              message: "Registration successful",
              type: "success",
            });
            // ... 完成登录等逻辑
            this.tryLogin();
          } else {
            // 注册失败
            this.$notify({
              title: "Error",
              message: response.data.error,
              type: "error",
            });
          }
        })
        .catch((error) => {
          // 注册失败，处理错误信息
          console.error(error);
        });
    },
    tryLogin() {
      // 构建请求参数对象
      const postData = {
        username: this.username,
        password: this.password,
        is_admin: false,
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
            // this.$notify({
            //   title: "Success",
            //   message: "Login successful",
            //   type: "success",
            // });
            // ... 完成登录后的逻辑

            // 更新用户 ID
            this.$store.dispatch("updateUserId", response.data.userId);
            this.$store.dispatch("updateLoggedIn", true);
            this.$router.push("/");
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