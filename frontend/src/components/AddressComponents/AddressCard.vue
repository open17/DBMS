<template>
  <div class="mx-20">
    <el-descriptions title="Current Info" border>
      <template slot="extra">
        <el-button type="primary" size="small" @click="$store.commit('toggleAddressEditor')">Edit</el-button>
      </template>

      <el-descriptions-item label="Full Name">{{
        addressForm.name
      }}</el-descriptions-item>
      <el-descriptions-item label="Street">{{
        addressForm.address
      }}</el-descriptions-item>
      <el-descriptions-item label="City">{{
        addressForm.city
      }}</el-descriptions-item>
      <el-descriptions-item label="Country">{{
        addressForm.country
      }}</el-descriptions-item>
      <el-descriptions-item label="Email">
        {{ addressForm.email }}
      </el-descriptions-item>
      <el-descriptions-item label="Phone">{{
        addressForm.phone
      }}</el-descriptions-item>
    </el-descriptions>
  </div>
</template>

<script>
export default {
  props: {
    addressForm: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style scoped>
</style>