<template>
  <div>
    <el-table
      :data="filteredTableData"
      ref="multipleTable"
      tooltip-effect="dark"
      size="medium"
      style="width: 100%"
      @selection-change="handleSelectionChange"
    >
      <el-table-column type="selection" width="55"></el-table-column>
      <el-table-column label="Name" prop="name"></el-table-column>
      <el-table-column label="Category" prop="category"></el-table-column>
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
import { mapGetters, mapActions } from 'vuex';

export default {
  computed: {
    ...mapGetters(['getCart']),
    filteredTableData() {
      if (!this.search) {
        return this.getCart;
      }
      const searchTerm = this.search.toLowerCase();
      return this.getCart.filter(
        data => data.name.toLowerCase().includes(searchTerm)
      );
    },
  },
  methods: {
    ...mapActions(['removeFromCart']),
    handleDetail(index, row) {
      console.log(index, row);
    },
    handleDelete(index, row) {
      console.log(index, row);
      this.removeFromCart(row.id); // 调用 Vuex 的 removeFromCart action 删除购物车中的商品
    },
    handleSelectionChange(selection) {
      this.selectNum = selection.length;
      this.selection = selection;
    },
  },
};
</script>