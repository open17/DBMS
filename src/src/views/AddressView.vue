<template>
  <div>
    <BreadCrumbsVue class="h-60"/>
    <AddressCardVue class="my-10"/>
    <AddressFromVue class="pt-20 px-10" v-if="$store.getters.isAddressEditorVisible"/>
  </div>
</template>

<script>
import BreadCrumbsVue from '@/components/UnitComponents/BreadCrumbs.vue'
import AddressFromVue from '@/components/AddressComponents/AddressFrom.vue'
import AddressCardVue from '@/components/AddressComponents/AddressCard.vue'

export default {
  components:{
    AddressFromVue,
    BreadCrumbsVue,
    AddressCardVue
  },
  data(){
    return {

    }
  }
}
</script>

<style>

</style>