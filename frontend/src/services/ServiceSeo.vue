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
        <img src="../images/page-illustration.svg" class="max-w-none" width="1440" height="427" alt="Page Illustration">
      </div>

      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="pt-32 pb-10 md:pt-40">
          <div class="text-center">
            <div class="inline-flex font-medium bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-200 pb-3">
              {{ $t('service.seo.badge') }}
            </div>
            <h1 class="h1 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-6">
              {{ $t('service.seo.title') }}
            </h1>
            <div class="inline-flex items-center justify-center relative">
              <Particles class="absolute inset-0 -z-10" :quantity="10" />
              <div class="inline-flex [mask-image:_radial-gradient(circle_at_bottom,transparent_15%,black_70%)]">
                <img src="../images/about-illustration.svg" width="446" height="446" alt="About illustration" />
              </div>
              <img class="absolute mt-[30%] drop-shadow-lg animate-float" src="../images/about-icon.svg" width="72" height="72" alt="About icon" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sekcija sa prednostima -->
    <section class="relative">
      <div class="px-4 sm:px-6">
        <div class="max-w-5xl mx-auto pb-20">
          <div class="max-w-3xl mx-auto text-center pb-12">
            <h2 class="h2 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60">
              {{ $t('service.seo.sectionTitle') }}
            </h2>
          </div>
          <div class="text-slate-400 space-y-6 max-w-3xl mx-auto">
            <p>{{ $t('service.seo.points.1') }}</p>
            <p>{{ $t('service.seo.points.2') }}</p>
            <p>{{ $t('service.seo.points.3') }}</p>
            <p>{{ $t('service.seo.points.4') }}</p>
            <p>{{ $t('service.seo.points.5') }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="text-center py-12 bg-slate-900 border-t border-slate-700">
      <div class="max-w-xl mx-auto">
        <h2 class="text-xl font-semibold text-white mb-4">{{ $t('service.seo.ctaTitle') }}</h2>
        <p class="text-slate-400 mb-6">{{ $t('service.seo.ctaText') }}</p>
        <router-link
          to="/contact"
          class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-2 rounded"
        >
          {{ $t('service.seo.ctaButton') }}
        </router-link>
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
  name: 'ServiceSeo',
  components: {
    Particles,
    Header,
    Footer,
    SupportCTA
  },
  mounted() {
    console.log('Otvorena usluga: seo')
  },
}
</script>