<template>
  <div class="flex min-h-screen flex-col overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <main class="grow">
      <Hero />
      <Clients />
      <Features />
      <Features02 />
      <Testimonials />
      <Cta />
    </main>

    <ChatWidget />
    <Footer />
  </div>
</template>

<script>
import Header from '../partials/Header.vue'
import Hero from '../partials/Hero.vue'
import Clients from '../partials/Clients.vue'
import Features from '../partials/Features.vue'
import Features02 from '../partials/Features02.vue'
import Testimonials from '../partials/Testimonials.vue'
import Cta from '../partials/Cta.vue'
import ChatWidget from '../partials/ChatWidget.vue'
import Footer from '../partials/Footer.vue'

export default {
  name: 'Home',
  components: {
    Header,
    Hero,
    Clients,
    Features,
    Features02,
    Testimonials,
    Cta,
    ChatWidget,
    Footer,
  },
}
</script>
