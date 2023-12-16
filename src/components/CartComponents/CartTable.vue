<template>
  <div class="mx-10 mt-5">
  <table class="table">
    <!-- head -->
    <thead>
      <tr>
        <th>
          <label class="align-middle">
            <input type="checkbox" class="checkbox" />
          </label>
        </th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <!-- row 1 -->
      <tr>
        <th>
          <label>
            <input type="checkbox" class="checkbox" />
          </label>
        </th>
        <td>
          <div class="flex items-center space-x-3">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img
                  src="https://cdn.jsdelivr.net/gh/open17/Pic/img/202311230254921.svg"
                  alt="Avatar Tailwind CSS Component"
                />
              </div>
            </div>
            <div>
              <div class="font-bold">iPhone 19</div>
            </div>
          </div>
        </td>
        <td>
          Phone
        </td>
        <td>$999</td>
        <th>
          <button class="btn btn-ghost btn-xs">details</button>
        </th>
      </tr>
      <!-- row 2 -->
      <tr>
        <th>
          <label>
            <input type="checkbox" class="checkbox" />
          </label>
        </th>
        <td>
          <div class="flex items-center space-x-3">
            <div class="avatar">
              <div class="mask mask-squircle w-12 h-12">
                <img
                  src="https://cdn.jsdelivr.net/gh/open17/Pic/img/202311230254921.svg"
                  alt="Avatar Tailwind CSS Component"
                />
              </div>
            </div>
            <div>
              <div class="font-bold">HUAWEI</div>
            </div>
          </div>
        </td>
        <td>
          Phone
        </td>
        <td>$999</td>
        <th>
          <button class="btn btn-ghost btn-xs">details</button>
        </th>
      </tr>
    </tbody>
  </table>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>