<template>
  <div class="inset-0 overflow-hidden bg-base-200 w-full">
    <div
      class="flex h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4"
    >
      <div class="flex w-full transform text-left text-base transition m-5 p-5">
        <div class="relative flex w-full items-center overflow-hidden">
          <div
            class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8"
          >
            <div
              class="aspect-h-3 aspect-w-2 overflow-hidden rounded-lg bg-base-200 sm:col-span-4 lg:col-span-5"
            >
              <img
                :src="decodeImg(product.image)"
                alt=""
                class="object-cover object-center"
              />
            </div>
            <div class="sm:col-span-8 lg:col-span-7">
              <h2 class="text-2xl font-bold text-base-content sm:pr-12">
                {{ product.name }}
              </h2>
              <section aria-labelledby="information-heading" class="mt-2">
                <h3 id="information-heading" class="sr-only">
                  Product information
                </h3>

                <p class="text-2xl text-base-content">
                  ${{ idToPriceMap[selectedType] }}
                </p>

                <!-- Reviews -->
              </section>

              <section aria-labelledby="options-heading" class="">
                <h3 id="options-heading" class="sr-only">Product options</h3>

                <form>
                  <!-- Sizes -->
                  <div class="">
                    <div class="flex items-center justify-between">
                      <h4 class="text-sm font-medium text-base-content">
                        {{ product.detail }}
                      </h4>
                      <a
                        href="#"
                        class="text-sm font-medium text-primary hover:text-primary"
                        >Help guide</a
                      >
                    </div>

                    <fieldset class="mt-4">
                      <legend class="sr-only">Choose</legend>
                      <div class="grid grid-cols-4 gap-4">
                        <label
                          class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 cursor-pointer bg-base-100 text-base-content shadow-sm"
                          v-for="(i, index) in product.type"
                          :key="index"
                          :class="{
                            'border-2 text-primary':
                              selectedType == i.goods_type_id,
                          }"
                        >
                          <input
                            type="radio"
                            name="type-choice"
                            :value="i.goods_type_id"
                            class="sr-only"
                            aria-labelledby="type-choice-0-label"
                            v-model="selectedType"
                          />
                          <span :id="i.goods_type_id">{{
                            i.goods_type_name
                          }}</span>
                          <span
                            class="pointer-events-none absolute -inset-px rounded-md"
                            aria-hidden="true"
                          ></span>
                        </label>
                      </div>
                    </fieldset>
                  </div>

                  <div
                    class="mt-6 flex w-full items-center justify-center rounded-md border border-transparent bg-primary px-8 py-3 text-base font-medium text-white hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 cursor-pointer"
                    v-if="!isAdmin"
                    @click="addProductToCart()"
                  >
                    Add to cart
                  </div>
                </form>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";
import http from "@/http.js"
export default {
  props: ["product", "gid"],
  data() {
    return {
      isShow: true,
      selectedType: null,
      selectedPrice: "",
      idToPriceMap: {},
    };
  },
  computed: {
    ...mapGetters(["isLoggedIn", "isAdmin", "getUserId"]),
    idPriceMapping() {
      const mapping = {};
      this.types.forEach((type) => {
        mapping[type.goods_type_id] = parseFloat(type.price);
      });
      return mapping;
    },
  },
  mounted() {
    this.types = this.product.type;
    this.selectedType = this.types[0].goods_type_id;
    this.idToPriceMap = this.idPriceMapping;
  },
  methods: {
    ...mapActions(["addToCart"]),
    decodeImg(image) {
      return `http://localhost/api/get_img.php?file=${image}`;
    },
    addProductToCart() {
      if (!this.isLoggedIn) {
        this.$notify.info({
          title: "Have not Login?",
          message: "Login first!",
        });
        return;
      }
      http
        .get(
          `/add_cart.php?goods_type_id=${this.selectedType}&buyer_id=${this.getUserId}`
        )
        .then((response) => {
          // console.log(response.data); // 处理后端返回的响应数据
          if (response.data.success) {
            this.$notify({
              title: "Success",
              message: response.data.success,
              type: "success",
            });
          } else {
            this.$notify({
              title: "error",
              message: "Already in cart",
              type: "error",
            });
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>

<style>
</style>