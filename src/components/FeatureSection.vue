<template>
  <section class="body-font">
    <div class="container px-5 py-24 mx-auto">
      <div class="text-center mb-20">
        <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4">
          What's More?
        </h1>
        <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto">
          Here are our awesome features that you can use freely as long as you sign up a account now.
        </p>
        <div class="flex mt-6 justify-center">
          <div class="w-16 h-1 rounded-full bg-secondary inline-flex"></div>
        </div>
      </div>
      <div
        class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4 md:space-y-0 space-y-6"
      >
        <div class="p-4 md:w-1/3 flex flex-col text-center items-center">
          <div
            class="w-28 h-28 inline-flex items-center justify-center rounded-full bg-primary-content text-secondary mb-5 flex-shrink-0 hover:scale-110 transition"
          >
            <img
              src="https://cdn.jsdelivr.net/gh/open17/Pic/img/202312011632058.png"
            />
          </div>
          <div class="flex-grow">
            <h2 class="text-lg title-font mb-3 font-bold">
              Same day delivery
            </h2>
            <p class="leading-relaxed text-base">
              Cant't wait? We offer a delivery service that can let you receive your products within hours.
            </p>
            <a class="mt-3 text-secondary inline-flex items-center"
              >Learn More
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                class="w-4 h-4 ml-2"
                viewBox="0 0 24 24"
              >
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
        <div class="p-4 md:w-1/3 flex flex-col text-center items-center">
          <div
            class="w-28 h-28 inline-flex items-center justify-center rounded-full bg-primary-content text-secondary mb-5 flex-shrink-0 hover:scale-110 transition"
          >
            <img
              src="https://cdn.jsdelivr.net/gh/open17/Pic/img/202312011624414.png"
            />
          </div>
          <div class="flex-grow">
            <h2 class="text-lg title-font mb-3 font-bold">Free returns</h2>
            <p class="leading-relaxed text-base">
              Not what you expected? Place it back in the parcel and attach the
              pre-paid postage stamp.
            </p>
            <a class="mt-3 text-secondary inline-flex items-center"
              >Learn More
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                class="w-4 h-4 ml-2"
                viewBox="0 0 24 24"
              >
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
        <div class="p-4 md:w-1/3 flex flex-col text-center items-center">
          <div
            class="w-28 h-28 inline-flex items-center justify-center rounded-full bg-primary-content text-secondary mb-5 flex-shrink-0 hover:scale-110 transition"
          >
            <img
              src="https://cdn.jsdelivr.net/gh/open17/Pic/img/202312011640625.png"
            />
          </div>
          <div class="flex-grow">
            <h2 class="text-lg title-font mb-3 font-bold">
              All year discount
            </h2>
            <p class="leading-relaxed text-base">
              Looking for a deal? You can use the code "OPEN17" at checkout and
              get money off all year round.
            </p>
            <a class="mt-3 text-secondary inline-flex items-center"
            onclick="my_modal_1.showModal()"
              >Learn More
              <svg
                fill="none"
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                class="w-4 h-4 ml-2"
                viewBox="0 0 24 24"
              >
                <path d="M5 12h14M12 5l7 7-7 7"></path>
              </svg>
            </a>
          </div>
        </div>
      </div>
      <button class="btn btn-outline btn-secondary flex mx-auto mt-16">Register now!</button>
    </div>
  </section>
</template>

<script>
export default {};
</script>

<style>
</style>