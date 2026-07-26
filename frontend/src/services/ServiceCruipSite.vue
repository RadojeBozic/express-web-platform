<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <section class="relative pt-32 pb-10 md:pt-40 text-center">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="inline-flex font-medium bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-200 pb-3">
          💡 {{ $t('service.cruipsite.badge') }}
        </div>
        <h1 class="h1 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-6">
          {{ $t('service.cruipsite.title') }}
        </h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg">
          {{ $t('service.cruipsite.subtitle') }}
        </p>
      </div>

      <div class="md:block absolute left-1/2 -translate-x-1/2 -mt-16 blur-2xl opacity-90 pointer-events-none -z-10">
        <img src="../images/page-illustration.svg" class="max-w-none" width="1440" height="427" alt="Page Illustration">
      </div>
    </section>

    <section class="relative py-16 px-6 max-w-5xl mx-auto">
      <div class="text-slate-400 space-y-6 text-lg">
        <p>⚡ <strong>{{ $t('service.cruipsite.points.1.title') }}</strong> {{ $t('service.cruipsite.points.1.text') }}</p>
        <p>🎯 <strong>{{ $t('service.cruipsite.points.2.title') }}</strong> {{ $t('service.cruipsite.points.2.text') }}</p>
        <p>🎨 <strong>{{ $t('service.cruipsite.points.3.title') }}</strong> {{ $t('service.cruipsite.points.3.text') }}</p>
        <p>🔧 <strong>{{ $t('service.cruipsite.points.4.title') }}</strong> {{ $t('service.cruipsite.points.4.text') }}</p>
        <p>💰 <strong>{{ $t('service.cruipsite.points.5.title') }}</strong> {{ $t('service.cruipsite.points.5.text') }}</p>
      </div>
    </section>

    <section class="text-center pb-20">
      <router-link
        to="/contact"
        class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-3 rounded shadow transition"
      >
        {{ $t('service.cruipsite.cta') }}
      </router-link>
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
  name: 'ServiceCruipSite',
  components: {
    Header,
    Footer,
    SupportCTA
  },
  mounted() {
    console.log('Otvorena usluga: cruipsite')
  }
}
</script>
