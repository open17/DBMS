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
                :src="product.img"
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

                <p class="text-2xl text-base-content">{{ product.price }}</p>

                <!-- Reviews -->
                <div class="mt-6">
                  <h4 class="sr-only">Reviews</h4>
                  <div class="flex items-center">
                    <div class="flex items-center">
                      <!-- Active: "text-base-content", Default: "text-gray-200" -->
                      <svg
                        class="text-base-content h-5 w-5 flex-shrink-0"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      <svg
                        class="text-base-content h-5 w-5 flex-shrink-0"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      <svg
                        class="text-base-content h-5 w-5 flex-shrink-0"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      <svg
                        class="text-base-content h-5 w-5 flex-shrink-0"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      <svg
                        class="text-gray-200 h-5 w-5 flex-shrink-0"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </div>
                    <p class="sr-only">3.9 out of 5 stars</p>
                    <router-link
                      :to="getReviewLink()"
                      class="ml-3 text-sm font-medium text-primary hover:text-primary"
                      >117 reviews</router-link
                    >
                  </div>
                </div>
              </section>

              <section aria-labelledby="options-heading" class="mt-10">
                <h3 id="options-heading" class="sr-only">Product options</h3>

                <form>
                  <!-- Sizes -->
                  <div class="mt-10">
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
                          v-for="i in product.type"
                          :key="i"
                          :class="{
                            'border-2 text-primary': selectedType == i,
                          }"
                        >
                          <input
                            type="radio"
                            name="type-choice"
                            :value="i"
                            class="sr-only"
                            aria-labelledby="type-choice-0-label"
                            v-model="selectedType"
                          />
                          <span :id="i">{{ i }}</span>
                          <!-- Active: "border", Not Active: "border-2" -->
                          <span
                            class="pointer-events-none absolute -inset-px rounded-md"
                            aria-hidden="true"
                          ></span>
                        </label>
                      </div>
                    </fieldset>
                  </div>

                  <button
                    type="submit"
                    class="mt-6 flex w-full items-center justify-center rounded-md border border-transparent bg-primary px-8 py-3 text-base font-medium text-white hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                  >
                    Add to cart
                  </button>
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
export default {
  props: ["product", "gid"],
  data() {
    return {
      isShow: true,
      selectedType: "",
    };
  },
  methods: {
    getReviewLink() {
      return `review?gid=${this.gid}`;
    },
  },
};
</script>

<style>
</style>