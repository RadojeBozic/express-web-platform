<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <!-- Hero sekcija -->
    <section class="relative">
      <div class="absolute flex items-center justify-center top-0 -translate-y-1/2 left-1/2 -translate-x-1/2 pointer-events-none -z-10 w-[800px] aspect-square" aria-hidden="true">
        <div class="absolute inset-0 bg-purple-500 rounded-full blur-[120px] opacity-30"></div>
        <div class="absolute w-64 h-64 bg-purple-400 rounded-full blur-[80px] opacity-70"></div>
      </div>
      <Particles class="absolute inset-0 h-96 -z-10" :quantity="15" />
      <div class="md:block absolute left-1/2 -translate-x-1/2 -mt-16 blur-2xl opacity-90 pointer-events-none -z-10">
        <img src="../images/page-illustration.svg" class="max-w-none" width="1440" height="427" alt="Page Illustration" />
      </div>

      <div class="max-w-6xl mx-auto px-4 sm:px-6 pt-32 pb-10 md:pt-40 text-center">
        <div class="inline-flex font-medium bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-200 pb-3">
          {{ $t('shop.hero.badge') }}
        </div>
        <h1 class="h1 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-6">
          {{ $t('shop.hero.title') }}
        </h1>
      </div>
    </section>

    <!-- Benefits sekcija -->
    <section class="relative py-20">
      <div class="max-w-5xl mx-auto px-4 sm:px-6">
        <div class="max-w-3xl mx-auto text-center pb-12">
          <h2 class="h2 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60">
            {{ $t('shop.section.title') }}
          </h2>
        </div>
        <div class="text-slate-400 space-y-6 text-lg">
          <p>🛍️ <strong>{{ $t('shop.section.paragraphs.1.title') }}</strong> {{ $t('shop.section.paragraphs.1.text') }}</p>
          <p>🧑‍🤝‍🧑 <strong>{{ $t('shop.section.paragraphs.2.title') }}</strong> {{ $t('shop.section.paragraphs.2.text') }}</p>
          <p>⚙️ <strong>{{ $t('shop.section.paragraphs.3.title') }}</strong> {{ $t('shop.section.paragraphs.3.text') }}</p>
          <p>💳 <strong>{{ $t('shop.section.paragraphs.4.title') }}</strong> {{ $t('shop.section.paragraphs.4.text') }}</p>
          <p>📊 <strong>{{ $t('shop.section.paragraphs.5.title') }}</strong> {{ $t('shop.section.paragraphs.5.text') }}</p>
          <p>📱 <strong>{{ $t('shop.section.paragraphs.6.title') }}</strong> {{ $t('shop.section.paragraphs.6.text') }}</p>
        </div>
      </div>
    </section>

    <!-- FAQ sekcija -->
    <section id="faq" class="relative">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12 md:py-20 border-t border-slate-800">
        <div class="max-w-3xl mx-auto text-center pb-12 md:pb-20">
          <div class="inline-flex font-medium bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-200 pb-3">
            {{ $t('shop.faq.title') }}
          </div>
          <h2 class="h2 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-4">
            {{ $t('shop.faq.subtitle') }}
          </h2>
        </div>

        <div class="md:flex md:space-x-12 space-y-8 md:space-y-0 mt-16 border-t border-slate-700 pt-12">
          <div class="w-full md:w-1/2 space-y-8">
            <div v-for="i in 6" :key="'faq1-' + i" class="space-y-2">
              <h4 class="font-semibold">{{ $t(`shop.faq.items.${i}.q`) }}</h4>
              <p class="text-slate-400">{{ $t(`shop.faq.items.${i}.a`) }}</p>
            </div>
          </div>
          <div class="w-full md:w-1/2 space-y-8">
            <div v-for="i in [7,8,9,10,11,12]" :key="'faq2-' + i" class="space-y-2">
              <h4 class="font-semibold">{{ $t(`shop.faq.items.${i}.q`) }}</h4>
              <p class="text-slate-400">{{ $t(`shop.faq.items.${i}.a`) }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
   <section class="w-full bg-purple-900 text-white py-6 px-4 mt-10 rounded shadow-lg">
  <div class="max-w-4xl mx-auto text-center">
    <h3 class="text-xl font-semibold mb-2">{{ $t('shop.cta.title') }}</h3>
    <p class="mb-4">{{ $t('shop.cta.text') }}</p>

    <a href="https://agro-shop.in.rs/" target="_blank">
      <button type="button" class="btn text-sm text-white bg-purple-500 hover:bg-purple-600 w-full sm:w-auto shadow-xs group mb-3">
        {{ $t('shop.cta.buttons.shop') }}
        <span class="text-purple-300 ml-1">→</span>
      </button>
    </a>

    <a href="https://mymaxico.com" target="_blank">
      <button type="button" class="btn text-sm text-white bg-purple-500 hover:bg-purple-600 w-full sm:w-auto shadow-xs group">
        {{ $t('shop.cta.buttons.market') }}
        <span class="text-purple-300 ml-1">→</span>
      </button>
    </a>
  </div>
</section>


    <SupportCTA />
    <Footer />
  </div>
</template>

<script>
import Particles from '../partials/Particles.vue'
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import SupportCTA from '../partials/SupportCTA.vue'

export default {
  name: 'ServiceOnlineShop',
  components: {
    Particles,
    Header,
    Footer,
    SupportCTA
  },
  props: ['slug'],
  mounted() {
    console.log('Otvorena usluga:', this.slug)
  }
}
</script>