<template>
  <div>
    <el-table
      :data="
        tableData.filter(
          (data) =>
            !search || data.name.toLowerCase().includes(search.toLowerCase())
        )
      "
      ref="multipleTable"
      tooltip-effect="dark"
      size="medium"
      style="width: 100%"
       @selection-change="handleSelectionChange"
    >
      <el-table-column type="selection" width="55"> </el-table-column>
      <el-table-column label="Name" prop="name"> </el-table-column>
      <el-table-column label="Category" prop="category"> </el-table-column>
      <el-table-column label="Price" prop="price"> </el-table-column>
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
          <el-button size="mini" @click="handleDetail(scope.$index, scope.row)"
            >Detail</el-button
          >
          <el-button
            size="mini"
            type="danger"
            @click="handleDelete(scope.$index, scope.row)"
            >Delete</el-button
          >
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tableData: [
        {
          name: "Product 1",
          category: "Category 1",
          price: "$100",
        },
        {
          name: "Product 2",
          category: "Category 2",
          price: "$2000",
        },
        {
          name: "Product 3",
          category: "Category 1",
          price: "$230",
        },
      ],
      search: "",
      selectNum: 0,
      selection: [],
    };
  },
  methods: {
    handleDetail(index, row) {
      console.log(index, row);
    },
    handleDelete(index, row) {
      console.log(index, row);
    },
    // 监控多选框事件
    handleSelectionChange(selection) {
      this.selectNum = selection.length;
      this.selection = selection;
    },
  },
};
</script>