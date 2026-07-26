<template>
  <div className="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">

    <!-- Site header -->
    <Header />

    <!-- Page content -->
    <main class="grow">

      <Hero />
      <PricingDetailed />
      <Features />
      <!-- <Customers /> -->
      <Faqs />
      <!-- <Cta /> -->

    </main>

    <!-- Site footer -->
    <Footer />

  </div>
</template>

<script>
import Header from '../partials/Header.vue'
import Hero from '../partials/PricingHero.vue'
import Features from '../partials/Features05.vue'
import Customers from '../partials/Customers.vue'
import Faqs from '../partials/Faqs.vue'
import Cta from '../partials/Cta.vue'
import Footer from '../partials/Footer.vue'
import PricingDetailed from '../partials/PricingDetailed.vue'

export default {
  name: 'Pricing',
  components: {
    Header,
    Hero,
    PricingDetailed,
    Features,
    Customers,
    Faqs,
    Cta,
    Footer,
  },
}
</script>