<template>
  <div class="overflow-x-auto w-full min-h-screen">
  <table class="table w-full">
    <!-- head -->
    <thead>
      <tr>
        <th>
          <label class="align-middle">
            <input type="checkbox" class="checkbox" />
            <p>select All</p>
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
                <img src="https://cdn.jsdelivr.net/gh/open17/Pic/img/202311230254921.svg" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">iPhone 19</div>
              <div class="text-sm opacity-50">Hot</div>
            </div>
          </div>
        </td>
        <td>
          Phone
          <br/>
          <span class="badge badge-ghost badge-sm">Flagship phone</span>
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
                <img src="https://cdn.jsdelivr.net/gh/open17/Pic/img/202311230254921.svg" alt="Avatar Tailwind CSS Component" />
              </div>
            </div>
            <div>
              <div class="font-bold">HUAWEI</div>
              <div class="text-sm opacity-50">HOT</div>
            </div>
          </div>
        </td>
        <td>
          Phone
          <br/>
          <span class="badge badge-ghost badge-sm">Flagship phone</span>
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
export default {

}
</script>

<style>

</style>