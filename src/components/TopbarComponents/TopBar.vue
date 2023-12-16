<template>
  <div class="navbar bg-base-100 z-50 justify-between">
    <div class="flex">
      <img src="@/assets/favicon.png" alt="" class="w-10 h-10" />
      <a class="btn btn-ghost normal-case text-xl">ZapZone</a>
    </div>
    <div class="flex-none gap-2">
      <ul class="menu menu-horizontal px-1">
        <li>
          <router-link to="/" class="mr-2">Home</router-link>
        </li>
        <li>
          <details>
            <summary>Shop</summary>
            <ul class="p-2 bg-base-100 rounded-t-none z-30">
              <li v-for="(value, key) in navData" :key="key" class="mr-2">
                <router-link :to="value">
                  {{ key }}
                </router-link>
              </li>
            </ul>
          </details>
        </li>
        <li>
          <details>
            <summary>More</summary>
            <ul class="p-2 bg-base-100 rounded-t-none z-30">
              <li><a>Contact</a></li>
              <li><a>Blog</a></li>
              <li><a>Github</a></li>
            </ul>
          </details>
        </li>
      </ul>
      <ThemeSelectorVue />
      <div class="dropdown dropdown-end z-10">
        <label tabindex="0" class="btn btn-ghost btn-circle">
          <div class="indicator">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-8 w-8"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
              />
            </svg>
            <span class="badge badge-sm indicator-item">2</span>
          </div>
        </label>
        <div
          tabindex="0"
          class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow"
        >
          <div class="card-body">
            <span class="font-bold text-lg">2 Items</span>
            <span class="">Subtotal: $1998</span>
            <div class="card-actions">
              <button
                class="btn btn-primary btn-block"
                @click="$router.push('/cart')"
              >
                View cart
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="dropdown dropdown-end z-10">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img
              src="https://cdn.jsdelivr.net/gh/open17/Pic/img/202311230409324.svg"
            />
          </div>
        </label>
        <ul
          tabindex="0"
          class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
        >
          <li>
            <a class="justify-between" href="/login_phone.html">
              Admin
              <span class="badge">Phone</span>
            </a>
          </li>
          <li><a href="/login.html">Sign Up</a></li>
          <li><a href="/register.html">Login</a></li>
          <li><router-link to="/setting">Setting</router-link></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import ThemeSelectorVue from "./ThemeSelector.vue";
export default {
  components: {
    ThemeSelectorVue,
  },
  data() {
    return {
      navData: {
        All: "/goods?category=All",
        Phone: "/goods?category=Phone",
        Computer: "/goods?category=Computer",
        Audiovisual: "/goods?category=Audiovisual",
        Others: "/goods?category=Others",
      },
    };
  },
};
</script>

<style>
</style>