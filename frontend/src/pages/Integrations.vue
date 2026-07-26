<template>
  <div className="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">

    <!-- Site header -->
    <Header />

    <!-- Page content -->
    <main class="grow">

      <Hero />
      <IntegrationsList />
      <Cta />

    </main>

    <!-- Site footer -->
    <Footer />

  </div>
</template>

<script>
import Header from '../partials/Header.vue'
import Hero from '../partials/IntegrationsHero.vue'
import IntegrationsList from '../partials/IntegrationsList.vue'
import Cta from '../partials/Cta04.vue'
import Footer from '../partials/Footer.vue'

export default {
  name: 'Integrations',
  components: {
    Header,
    Hero,
    IntegrationsList,
    Cta,
    Footer,
  },
}
</script>