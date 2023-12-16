<template>
  <div class="bg-base-200 flex justify-center flex-col items-center space-y-2">
    <h3 class=" font-bold  text-7xl">{{breadcrumbs[breadcrumbs.length-1]["name"]}}</h3>
    <div class="text-sm breadcrumbs">
      <ul>
        <li><router-link to="/">Home</router-link></li>
        <li v-for="crumb in breadcrumbs" :key="crumb.path">
          <router-link v-if="crumb.path" :to="crumb.path">{{ crumb.name }}</router-link>
          <span v-else>{{ crumb.name }}</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    breadcrumbs() {
      const breadcrumbs = [];
      const matchedRoutes = this.$route.matched;

      for (const route of matchedRoutes) {
        if (route.meta && route.meta.breadcrumb) {
          breadcrumbs.push({
            name: route.meta.breadcrumb,
            path: route.path !== "*" ? route.path : "",
          });
        }
      }
      return breadcrumbs;
    },
  },
};
</script>

<style>
</style>