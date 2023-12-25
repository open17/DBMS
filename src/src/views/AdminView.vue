<template>
  <div class="add-product">
    <el-form ref="productForm" :model="product" label-width="100px">
      <el-form-item label="Product Name" prop="goods_name">
        <el-input v-model="product.goods_name"></el-input>
      </el-form-item>
      <el-form-item label="Product Description" prop="goods_description">
        <el-input v-model="product.goods_description"></el-input>
      </el-form-item>
      <el-form-item
        label="Product Type"
        v-for="(type, index) in product.types"
        :key="index"
      >
        <el-input v-model="type.name" placeholder="Type Name"></el-input>
        <el-input v-model="type.price" placeholder="Type Price"></el-input>
        <el-button type="danger" @click="removeType(index)">Remove</el-button>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="addType">Add Type</el-button>
      </el-form-item>
      <el-form-item label="Product Image" prop="goods_pic">
        <el-upload
          class="upload-demo"
          action="http://localhost/api/upload.php"
          :on-success="handleUploadSuccess('goods_pic')"
          :on-error="handleUploadError"
        >
          <el-button size="small" type="primary">Click to Upload</el-button>
        </el-upload>
      </el-form-item>
      <el-form-item label="Product Information Image" prop="goods_information_pic">
        <el-upload
          class="upload-demo"
          action="http://localhost/api/upload.php"
          :on-success="handleUploadSuccess('goods_information_pic')"
          :on-error="handleUploadError"
        >
          <el-button size="small" type="primary">Click to Upload</el-button>
        </el-upload>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="addProduct">Add Product</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import http from '@/http.js';
export default {
  data() {
    return {
      product: {
        goods_name: "",
        goods_description: "",
        types: [], // Product Type field
        goods_pic: null,
        goods_information_pic: null,
      },
    };
  },
  methods: {
    handleUploadSuccess(field) {
      return (response) => {
        // Handling successful file upload
        if (response && response.success) {
          this.product[field] = response.filename;
          this.$message.success("File uploaded successfully");
        } else {
          this.$message.error("File upload failed");
        }
      };
    },
    handleUploadError() {
      this.$message.error("File upload failed");
    },
    addType() {
      this.product.types.push({
        name: "",
        price: "",
      });
    },
    removeType(index) {
      this.product.types.splice(index, 1);
    },
    addProduct() {
      this.$refs.productForm.validate((valid) => {
        if (valid) {
          console.log(this.product);
          http
            .post("add_goods.php", this.product)
            .then((response) => {
              if (response && response.data && response.data.success) {
                this.$message.success("Product added successfully");
                // Clearing the form
                this.product = {
                  goods_name: "",
                  goods_description: "",
                  types: [], // Product Type field
                  goods_pic: null,
                  goods_information_pic: null,
                };
              } else {
                this.$message.error("Failed to add product");
              }
            })
            .catch((error) => {
              this.$message.error("Request failed");
              console.error(error);
            });
        } else {
          this.$message.error("Incomplete form submission");
          return false;
        }
      });
    },
  },
};
</script>