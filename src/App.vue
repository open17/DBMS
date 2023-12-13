<template>
  <div id="app">
    <TopBarVue class=""/>
    <router-view/>
    <FooterVue/>
  </div>
</template>
<script>
import FooterVue from './components/FooterSection.vue'
import TopBarVue from './components/TopBar.vue'
import './style.css'
export default {
  components:{
    TopBarVue,
    FooterVue
  },
}
</script>
<style>
</style>
