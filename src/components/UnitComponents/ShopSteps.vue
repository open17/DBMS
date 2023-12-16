<template>
  <div class="flex justify-center my-5 w-screen">
    <el-steps  :active="step" finish-status="success" align-center class="w-full">
      <el-step title="Cart"></el-step>  
      <el-step title="Checkout"></el-step>
      <el-step title="Order"></el-step>
    </el-steps>
  </div>
</template>

<script>
export default {
    props:['step']
}
</script>

<style>

</style>