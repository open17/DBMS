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
              <h2 class="text-2xl font-bold text-gray-900 sm:pr-12">
                {{ product.name }}
              </h2>
              <section aria-labelledby="information-heading" class="mt-2">
                <h3 id="information-heading" class="sr-only">
                  Product information
                </h3>

                <p class="text-2xl text-gray-900">{{ product.price }}</p>

                <!-- Reviews -->
                <div class="mt-6">
                  <h4 class="sr-only">Reviews</h4>
                  <div class="flex items-center">
                    <div class="flex items-center">
                      <!-- Active: "text-gray-900", Default: "text-gray-200" -->
                      <svg
                        class="text-gray-900 h-5 w-5 flex-shrink-0"
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
                        class="text-gray-900 h-5 w-5 flex-shrink-0"
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
                        class="text-gray-900 h-5 w-5 flex-shrink-0"
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
                        class="text-gray-900 h-5 w-5 flex-shrink-0"
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
                      class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500"
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
                      <h4 class="text-sm font-medium text-gray-900">
                        {{ product.detail }}
                      </h4>
                      <a
                        href="#"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-500"
                        >Help guide</a
                      >
                    </div>

                    <fieldset class="mt-4">
                      <legend class="sr-only">Choose</legend>
                      <div class="grid grid-cols-4 gap-4">
                        <label
                          class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 cursor-pointer bg-white text-gray-900 shadow-sm"
                          v-for="i in product.type"
                          :key="i"
                        >
                          <input
                            type="radio"
                            name="type-choice"
                            :value="i"
                            class="sr-only"
                            aria-labelledby="type-choice-0-label"
                          />
                          <span :id="i">{{ i }}</span>
                          <!--
                            Active: "border", Not Active: "border-2"
                            Checked: "border-indigo-500", Not Checked: "border-transparent"
                          -->
                          <span
                            class="pointer-events-none absolute -inset-px rounded-md"
                            aria-hidden="true"
                          ></span>
                        </label>
                        <label
                          class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 cursor-not-allowed bg-gray-50 text-gray-200"
                          v-for="(i, idx) in product.forbid"
                          :key="idx"
                        >
                          <input
                            type="radio"
                            name="type-choice"
                            :value="i"
                            disabled
                            class="sr-only"
                            aria-labelledby="type-choice-7-label"
                          />
                          <span :id="i">{{ i }}</span>
                          <span
                            aria-hidden="true"
                            class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200"
                          >
                            <svg
                              class="absolute inset-0 h-full w-full stroke-2 text-gray-200"
                              viewBox="0 0 100 100"
                              preserveAspectRatio="none"
                              stroke="currentColor"
                            >
                              <line
                                x1="0"
                                y1="100"
                                x2="100"
                                y2="0"
                                vector-effect="non-scaling-stroke"
                              />
                            </svg>
                          </span>
                        </label>
                      </div>
                    </fieldset>
                  </div>

                  <button
                    type="submit"
                    class="mt-6 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
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
  props: ["product","gid"],
  data() {
    return {
      isShow: true,
    };
  },
  methods:{
    getReviewLink(){
      return `review?gid=${this.gid}`
    }
  }
};
</script>

<style>
</style>