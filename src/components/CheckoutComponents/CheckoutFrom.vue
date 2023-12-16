<template>
  <div class="checkout">
    <div class="text-lg font-bold mb-5">CHECKOUT TOTAL</div>
    <div class="stats shadow">
      <div class="stat">
        <div class="stat-title">SUBTOTAL</div>
        <div class="stat-value">$89,400</div>
      </div>
      <div class="stat">
        <div class="stat-title">TOTAL</div>
        <div class="stat-value">$89,400</div>
      </div>
    </div>
    <div class="text-lg font-bold mb-5 mt-5">PAYMENT</div>
    <el-radio-group v-model="radio1" class="pb-10">
      <el-radio-button label="PAYPAL"></el-radio-button>
      <el-radio-button label="CASH ON DELIVERY"></el-radio-button>
      <el-radio-button label="CHECK PAYMENTS"></el-radio-button>
      <el-radio-button label="DIRECT BANK TRANSFER"></el-radio-button>
    </el-radio-group>
  </div>
</template>

<script>
export default {
  data() {
    return {
      radio1: "PAYPAL",
    };
  },
};
</script>

<style>
.subtotal,
.total {
  margin-bottom: 1rem;
}

.subtotal span,
.total span {
  font-weight: bold;
}
</style>