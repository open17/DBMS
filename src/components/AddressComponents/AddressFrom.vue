<template>
  <el-form :model="checkoutForm" :rules="rules" ref="checkoutForm" label-width="100px" class="demo-ruleForm">
    <el-form-item label="Full Name" prop="name">
      <el-input v-model="checkoutForm.name"></el-input>
    </el-form-item>
    <el-form-item label="Address" prop="address">
      <el-input v-model="checkoutForm.address"></el-input>
    </el-form-item>
    <el-form-item label="City" prop="city">
      <el-input v-model="checkoutForm.city"></el-input>
    </el-form-item>
    <el-form-item label="Country" prop="country">
      <el-select v-model="checkoutForm.country" placeholder="Select country">
        <el-option label="China" value="china"></el-option>
        <el-option label="United States" value="usa"></el-option>
        <el-option label="United Kingdom" value="uk"></el-option>
        <!-- 添加更多的选项 -->
      </el-select>
    </el-form-item>
    <el-form-item label="Email" prop="email">
      <el-input v-model="checkoutForm.email"></el-input>
    </el-form-item>
    <el-form-item label="Phone" prop="phone">
      <el-input v-model="checkoutForm.phone"></el-input>
    </el-form-item>
    <el-form-item>
      <el-button type="primary" @click="submitForm('checkoutForm')">Save</el-button>
      <el-button @click="resetForm('checkoutForm')">Reset</el-button>
    </el-form-item>
  </el-form>
</template>

<script>
export default {
  data() {
    return {
      checkoutForm: {
        name: '',
        address: '',
        city: '',
        country: '',
        email: '',
        phone: ''
      },
      rules: {
        name: [
          { required: true, message: 'Full Name is required', trigger: 'blur' },
          { min: 3, message: 'Full Name should have at least 3 characters', trigger: 'blur' }
        ],
        address: [
          { required: true, message: 'Address is required', trigger: 'blur' }
        ],
        city: [
          { required: true, message: 'City is required', trigger: 'blur' }
        ],
        country: [
          { required: true, message: 'Please select a country', trigger: 'change' }
        ],
        email: [
          { required: true, message: 'Email is required', trigger: 'blur' },
          { type: 'email', message: 'Invalid email format', trigger: 'blur' }
        ],
        phone: [
          { required: true, message: 'Phone number is required', trigger: 'blur' }
        ]
      }
    };
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          alert('Order placed successfully!');
        } else {
          console.log('Error submitting the form!');
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    }
  }
};
</script>

<style>

</style>