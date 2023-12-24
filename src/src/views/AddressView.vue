<template>
  <div>
    <BreadCrumbsVue class="h-60"/>
    <AddressCardVue :addressForm="addressForm" class="my-10"/>
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
      addressForm: {
      name: 'John Doe',
      address: '123 Main Street',
      city: 'New York',
      country: 'United States',
      email: 'johndoe@example.com',
      phone: '123-456-7890'
    }
    }
  }
}
</script>

<style>

</style>