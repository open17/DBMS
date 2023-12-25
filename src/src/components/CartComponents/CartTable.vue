<template>
  <div>
    <el-statistic
            group-separator=","
            :precision="2"
            :value="totalPrice"
            title="Total Price($)"
          ></el-statistic>
      <br>
    <el-table
      :data="filteredTableData"
      ref="multipleTable"
      tooltip-effect="dark"
      size="medium"
      style="width: 100%"
      height="250"
      empty-text="empty"
    >
      <el-table-column label="Name" prop="goods_name"></el-table-column>
      <el-table-column label="Type" prop="goods_type_name"></el-table-column>
      <el-table-column label="Price" prop="price"></el-table-column>
      <el-table-column align="right">
        <template slot="header" slot-scope="scope">
          <el-input
            v-model="search"
            size="large"
            placeholder="Search"
            :class="scope"
          />
        </template>
        <template slot-scope="scope">
          <el-button size="mini" @click="handleDetail(scope.$index, scope.row)">
            Detail
          </el-button>
          <el-button
            size="mini"
            type="danger"
            @click="handleDelete(scope.$index, scope.row)"
          >
            Delete
          </el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import http from "@/http.js";
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      cartItems: [], // 存储购物车商品
      totalPrice: 0, // 存储购物车总价
      search: "", // 存储搜索关键字
    };
  },
  mounted() {
    this.fetchCartItems(); // 在组件加载时获取购物车商品
  },
  filters: {
    formatPrice(value) {
      return value.toFixed(2);
    },
  },
  computed: {
    ...mapGetters(["isLoggedIn", "isAdmin", "getUserId"]),
    filteredTableData() {
      // if (!this.search) {
      //   return this.cartItems;
      // }
      const searchTerm = this.search.toLowerCase();
      return this.cartItems.filter((data) =>
        data.goods_name.toLowerCase().includes(searchTerm)
      );
    },
  },
  methods: {
    fetchCartItems() {
      const buyerId = this.getUserId;

      // 发起 HTTP GET 请求获取购物车信息
      http
        .get(`/view_cart.php?buyer_id=${buyerId}`)
        .then((response) => {
          this.cartItems = response.data.cart_items;
          this.totalPrice = response.data.total_price;
        })
        .catch((error) => {
          console.error("Error fetching cart items:", error);
        });
    },
    handleDetail(index, row) {
      // console.log(index, row,row.goods_name);
      this.$router.push(`goods?keyword=${row.goods_name}`);
    },
    handleDelete(index, row) {
      console.log(index, row);
      // 构造请求URL
      const goodsTypeId = row.goods_type_id;
      const buyerId = this.getUserId;
      const url = `/remove_cart.php?goods_type_id=${goodsTypeId}&buyer_id=${buyerId}`;
      // 发起 HTTP GET 请求删除购物车中的商品
      http
        .get(url)
        .then((response) => {
          // 处理删除成功后的逻辑
          console.log("Item removed:", response.data);
          // 更新购物车信息
          this.fetchCartItems();
        })
        .catch((error) => {
          console.error("Error removing item:", error);
        });
    },
  },
};
</script>