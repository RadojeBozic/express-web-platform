<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <!-- Hero sekcija -->
    <section class="text-center py-20 bg-slate-900 text-white">
      <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">🎨 {{ $t('service.design.title') }}</h1>
        <p class="text-slate-300 text-lg">{{ $t('service.design.subtitle') }}</p>
      </div>
    </section>

    <!-- Info sekcije -->
    <section class="py-16 px-4 max-w-5xl mx-auto text-slate-200 space-y-10">
      <div class="grid md:grid-cols-2 gap-8">
        <div>
          <h2 class="text-xl font-semibold mb-2">🎯 {{ $t('service.design.offerTitle') }}</h2>
          <ul class="list-disc list-inside text-sm space-y-2">
            <li>{{ $t('service.design.offer.1') }}</li>
            <li>{{ $t('service.design.offer.2') }}</li>
            <li>{{ $t('service.design.offer.3') }}</li>
            <li>{{ $t('service.design.offer.4') }}</li>
          </ul>
        </div>
        <div>
          <h2 class="text-xl font-semibold mb-2">🤖 {{ $t('service.design.aiTitle') }}</h2>
          <p class="text-sm">{{ $t('service.design.aiText') }}</p>
        </div>
      </div>

      <!-- CTA -->
      <div class="bg-slate-800 border border-slate-600 p-6 rounded-lg shadow text-center">
        <h3 class="text-lg font-semibold mb-2">{{ $t('service.design.ctaTitle') }}</h3>
        <p class="text-sm mb-4">{{ $t('service.design.ctaText') }}</p>
        <router-link
          to="/contact"
          class="btn bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded text-sm"
        >
          {{ $t('service.design.ctaButton') }}
        </router-link>
      </div>
    </section>

    <SupportCTA />
    <Footer />
  </div>
</template>


<script>
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import SupportCTA from '../partials/SupportCTA.vue'

export default {
  name: 'ServiceDesign',
  components: {
    Header,
    Footer,
    SupportCTA
  },
  mounted() {
    console.log('Otvorena usluga: dizajn')
  }
}
</script>
