<template>
  <div className="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">

    <!-- Site header -->
    <Header />

    <!-- Page content -->
    <main class="grow">

      <Hero />
      <Clients />
      <Features />
      <Features02 />
      <Features03 />
      <TestimonialsCarousel />
      <Features04 />
      <Pricing />
      <Testimonials />
      <RouterView />
      <ChatWidget />

      <Cta />

    </main>
    
    <!-- Site footer -->
    <Footer />    

  </div>
</template>

<script>
import Header from '../partials/Header.vue'
import Hero from '../partials/Hero.vue'
import Clients from '../partials/Clients.vue'
import Features from '../partials/Features.vue'
import Features02 from '../partials/Features02.vue'
import Features03 from '../partials/Features03.vue'
import TestimonialsCarousel from '../partials/TestimonialsCarousel.vue'
import Features04 from '../partials/Features04.vue'
import Pricing from '../partials/PricingHome.vue'
import Testimonials from '../partials/Testimonials.vue'
import Cta from '../partials/Cta.vue'
import Footer from '../partials/Footer.vue'
import ChatWidget from '../partials/ChatWidget.vue'

export default {
  name: 'Home',
  components: {
    Header,
    Hero,
    Clients,
    Features,
    Features02,
    Features03,
    TestimonialsCarousel,
    Features04,
    Pricing,
    Testimonials,
    Cta,
    ChatWidget,
    // Include the AI helper component if needed
    Footer,
    
  },
}
</script>