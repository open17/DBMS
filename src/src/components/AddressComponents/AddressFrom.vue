<template>
  <el-form
    :model="checkoutForm"
    :rules="rules"
    ref="checkoutForm"
    label-width="100px"
    class="demo-ruleForm"
  >
    <el-form-item label="Post" prop="post">
      <el-input v-model="checkoutForm.post"></el-input>
    </el-form-item>
    <el-form-item label="Street" prop="street">
      <el-input v-model="checkoutForm.street"></el-input>
    </el-form-item>
    <el-form-item label="City" prop="city">
      <el-input v-model="checkoutForm.city"></el-input>
    </el-form-item>
    <el-form-item label="Country" prop="country">
      <el-select v-model="checkoutForm.country" placeholder="Select country">
        <el-option label="China" value="china"></el-option>
        <el-option label="United States" value="usa"></el-option>
        <el-option label="United Kingdom" value="uk"></el-option>
        <el-option label="France" value="france"></el-option>
        <el-option label="Japan" value="japan"></el-option>
        <el-option label="Singapore" value="singapore"></el-option>
      </el-select>
    </el-form-item>
    <el-form-item label="Email" prop="email">
      <el-input v-model="checkoutForm.email"></el-input>
    </el-form-item>
    <el-form-item label="Phone" prop="phone">
      <el-input v-model="checkoutForm.phone"></el-input>
    </el-form-item>
    <el-form-item>
      <el-button type="primary" @click="submitForm('checkoutForm')"
        >Save</el-button
      >
      <el-button @click="resetForm('checkoutForm')">Reset</el-button>
    </el-form-item>
  </el-form>
</template>

<script>
import { mapGetters } from "vuex";
import http from "@/http";

export default {
  computed: {
    ...mapGetters(["getUserId"]),
  },
  data() {
    return {
      checkoutForm: {
        buyer_id: "", // 隐藏字段，不会在表单中展示
        post: "",
        street: "",
        city: "",
        country: "",
        email: "",
        phone: "",
      },
      rules: {
        street: [
          { required: true, message: "Street is required", trigger: "blur" },
        ],
        city: [
          { required: true, message: "City is required", trigger: "blur" },
        ],
        country: [
          {
            required: true,
            message: "Please select a country",
            trigger: "change",
          },
        ],
        email: [
          { required: true, message: "Email is required", trigger: "blur" },
          { type: "email", message: "Invalid email format", trigger: "blur" },
        ],
        phone: [
          {
            required: true,
            message: "Phone number is required",
            trigger: "blur",
          },
        ],
      },
    };
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.checkoutForm.buyer_id = this.getUserId;
          console.log(this.checkoutForm);
          http
            .post("edit_info.php", this.checkoutForm, {
              headers: {
                "Content-Type": "application/x-www-form-urlencoded",
              },
            })
            .then((response) => {
              const data = response.data;
              if (data.error) {
                console.error(data.error);
              } else {
                this.$notify({
                  title: "Success",
                  message: data.success,
                  type: "success",
                });
                console.log(data);
              }
            })
            .catch((error) => {
              console.error(error);
            });
        } else {
          console.log("Error submitting the form!");
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
  },
};
</script>

<style>
</style>