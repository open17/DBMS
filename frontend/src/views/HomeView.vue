<template>
  <div class="bg-base-200">
    <hero-section/>
    <div class="divider text-3xl font-bold my-10">Shop by Category</div>
    <ProductCardVue/>
  <PromoSectionVue/>
    <div class="divider text-3xl font-bold my-10">Trending product</div>
    <CarouselSection/>
    <FeatureSectionVue/>
    <TestimonialsSectionVue/>
    <!-- 当feature按下按钮时弹出 -->
    <SerectMailVue/>
  </div>
</template>

<script>
// @ is an alias to /src
import CarouselSection from '@/components/HeroComponents/CarouselSection.vue'
import HeroSection from '@/components/HeroComponents/HeroSection.vue'
import ProductCardVue from '@/components/HeroComponents/ProductCard.vue'
import FeatureSectionVue from '@/components/HeroComponents/FeatureSection.vue'
import PromoSectionVue from '@/components/HeroComponents/PromoSection.vue'
import TestimonialsSectionVue from '@/components/HeroComponents/TestimonialsSection.vue'
import SerectMailVue from '@/components/HeroComponents/SerectMail.vue'


export default {
  name: 'HomeView',
  components: {
    HeroSection,
ProductCardVue,
CarouselSection,
FeatureSectionVue,
PromoSectionVue,
TestimonialsSectionVue,
SerectMailVue
  }
}
</script>
