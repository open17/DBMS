<template>
  <div class=" overflow-x-hidden">
    <BreadCrumbsVue class="h-60" />
    <ShopStepsVue :step="1"/>
    <AddressCardVue :addressForm="addressForm" class="my-10" />
    <AddressFromVue
      class="pt-20 px-10"
      v-if="$store.getters.isAddressEditorVisible"
    />
    <CheckoutFromVue class="pt-20 px-10" />
    <div class="flex m-20 justify-center space-x-20">
      <button class="btn btn-primary mr-5" @click="$router.push('cart')">
        Back to cart
      </button>
      <button class="btn btn-secondary" @click="removeAllFromCart();$router.push('order')">
        Place an order
      </button>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import CheckoutFromVue from "@/components/CheckoutComponents/CheckoutFrom.vue";
import BreadCrumbsVue from "@/components/UnitComponents/BreadCrumbs.vue";
import AddressFromVue from "@/components/AddressComponents/AddressFrom.vue";
import AddressCardVue from "@/components/AddressComponents/AddressCard.vue";
import ShopStepsVue from '@/components/UnitComponents/ShopSteps.vue';
export default {
  components: {
    CheckoutFromVue,
    AddressFromVue,
    BreadCrumbsVue,
    AddressCardVue,
    ShopStepsVue
  },
  data(){
    return {
      addressForm: {
      name: 'John Doe',
      address: '123 Main Street',
      city: 'New York',
      country: 'usa',
      email: 'johndoe@example.com',
      phone: '123-456-7890'
    }
    }
  },
  methods:{
    ...mapActions(['removeAllFromCart']),
  }
};
</script>

<style>
</style>