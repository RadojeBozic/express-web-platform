<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <!-- Hero sekcija -->
    <section class="relative pt-32 pb-12 md:pt-40 text-center">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="inline-flex font-medium bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-200 pb-3">
          🌐 {{ $t('service.domain.badge') }}
        </div>
        <h1 class="h1 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-6">
          {{ $t('service.domain.title') }}
        </h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-lg">
          {{ $t('service.domain.subtitle') }}
        </p>
      </div>

      <!-- Dekoracija -->
      <div class="md:block absolute left-1/2 -translate-x-1/2 -mt-16 blur-2xl opacity-90 pointer-events-none -z-10">
        <img src="../images/page-illustration.svg" class="max-w-none" width="1440" height="427" alt="Page Illustration">
      </div>
    </section>

    <!-- Sadržaj -->
    <section class="relative py-16 px-6 max-w-5xl mx-auto text-slate-400 text-lg space-y-6">
      <p>🌍 <strong>{{ $t('service.domain.points.1.title') }}</strong> {{ $t('service.domain.points.1.text') }}</p>
      <p>📡 <strong>{{ $t('service.domain.points.2.title') }}</strong> {{ $t('service.domain.points.2.text') }}</p>
      <p>💾 <strong>{{ $t('service.domain.points.3.title') }}</strong> {{ $t('service.domain.points.3.text') }}</p>
      <p>🤝 <strong>{{ $t('service.domain.points.4.title') }}</strong> {{ $t('service.domain.points.4.text') }}</p>
      <p>🔐 <strong>{{ $t('service.domain.points.5.title') }}</strong> {{ $t('service.domain.points.5.text') }}</p>
    </section>

    <!-- CTA -->
    <section class="text-center pb-20">
      <router-link
        to="/contact"
        class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-3 rounded shadow transition"
      >
        {{ $t('service.domain.cta') }}
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
  name: 'ServiceDomainHosting',
  components: {
    Header,
    Footer,
    SupportCTA
  },
  mounted() {
    console.log('Otvorena usluga: domain-hosting')
  }
}
</script>
