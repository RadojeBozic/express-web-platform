<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <!-- Hero sekcija -->
    <section class="relative">
      <Particles class="absolute inset-0 h-96 -z-10" :quantity="12" />

      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="pt-32 pb-16 md:pt-40 text-center">
          <div class="inline-flex font-medium text-purple-400 pb-3">
            {{ $t('service.basicshop.badge') }}
          </div>
          <h1 class="h1 text-white mb-6">
            {{ $t('service.basicshop.title') }}
          </h1>
          <p class="text-slate-400 max-w-2xl mx-auto">
            {{ $t('service.basicshop.subtitle') }}
          </p>
        </div>
      </div>
    </section>

    <!-- Sadržaj -->
    <section class="relative py-16">
      <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="grid md:grid-cols-2 gap-12 text-slate-400">
          <div>
            <h2 class="text-xl font-semibold text-white mb-4">
              🛍️ {{ $t('service.basicshop.featuresTitle') }}
            </h2>
            <ul class="space-y-4 list-disc pl-5">
              <li v-for="i in 6" :key="i">{{ $t(`service.basicshop.features.${i}`) }}</li>
            </ul>
          </div>
          <div>
            <h2 class="text-xl font-semibold text-white mb-4">
              📦 {{ $t('service.basicshop.idealTitle') }}
            </h2>
            <ul class="space-y-4 list-disc pl-5">
              <li v-for="i in 4" :key="i">{{ $t(`service.basicshop.idealFor.${i}`) }}</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="text-center bg-purple-900 text-white py-10 px-4 mt-6 rounded-t-lg shadow-inner">
      <h3 class="text-xl font-bold mb-2">
        {{ $t('service.basicshop.cta.title') }}
      </h3>
      <p class="mb-4 text-slate-200">{{ $t('service.basicshop.cta.text') }}</p>
      <router-link
        to="/contact"
        class="inline-block bg-white text-purple-700 font-bold px-6 py-2 rounded hover:bg-slate-100 transition mb-3"
      >
        <button
          type="button"
          class="btn text-sm text-white bg-purple-500 hover:bg-purple-600 w-full shadow-xs group"
        >
          {{ $t('service.basicshop.cta.button') }}
          <span class="ml-1 text-purple-300 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out">→</span>
        </button>
      </router-link>
    </section>

    <SupportCTA />
    <Footer />
  </div>
</template>


<script>
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import Particles from '../partials/Particles.vue'
import SupportCTA from '../partials/SupportCTA.vue'

export default {
  name: 'ServiceOnlineshop',
  components: {
    Header,
    Footer,
    Particles,
    SupportCTA
  },
  props: ['slug'],
  mounted() {
    console.log('Otvorena usluga: Basic Online Shop')
  }
}
</script>
