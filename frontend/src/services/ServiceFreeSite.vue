<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <!-- Hero sekcija -->
    <section class="relative">
      <!-- Radial gradient + Particles + Illustrations -->
      <div class="absolute flex items-center justify-center top-0 -translate-y-1/2 left-1/2 -translate-x-1/2 pointer-events-none -z-10 w-[800px] aspect-square">
        <div class="absolute inset-0 bg-purple-500 rounded-full blur-[120px] opacity-30"></div>
        <div class="absolute w-64 h-64 bg-purple-400 rounded-full blur-[80px] opacity-70"></div>
      </div>
      <Particles class="absolute inset-0 h-96 -z-10" :quantity="15" />
      <div class="md:block absolute left-1/2 -translate-x-1/2 -mt-16 blur-2xl opacity-90 pointer-events-none -z-10">
        <img src="../images/page-illustration.svg" class="max-w-none" width="1440" height="427" alt="Page Illustration" />
      </div>

      <div class="max-w-6xl mx-auto px-4 sm:px-6 pt-32 pb-10 md:pt-40">
        <div class="text-center">
          <div class="inline-flex font-medium bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-200 pb-3">
            ✔️ {{ $t('landing.freesite.badge') }}
          </div>
          <h1 class="h1 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-6">
            {{ $t('landing.freesite.title') }}
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
    </section>

    <!-- Second section: Benefits -->
    <section class="relative">
      <div class="absolute top-0 -mt-32 left-1/2 -translate-x-1/2 ml-10 blur-2xl opacity-70 pointer-events-none -z-10">
        <svg xmlns="http://www.w3.org/2000/svg" width="434" height="427">
          <defs>
            <linearGradient id="bs4-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
              <stop offset="0%" stop-color="#A855F7" />
              <stop offset="100%" stop-color="#6366F1" stop-opacity="0" />
            </linearGradient>
          </defs>
          <path fill="url(#bs4-a)" fill-rule="evenodd" d="m0 0 461 369-284 58z" transform="matrix(1 0 0 -1 0 427)" />
        </svg>
      </div>

      <div class="px-4 sm:px-6 max-w-5xl mx-auto">
        <div class="pb-12 md:pb-20">
          <div class="max-w-3xl mx-auto text-center pb-12 md:pb-20">
            <h2 class="h2 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60">
              {{ $t('landing.freesite.subtitle') }}
            </h2>
          </div>

          <div class="md:flex justify-between space-x-6 md:space-x-8 lg:space-x-14">
            <figure class="min-w-[240px]">
              <img class="sticky top-8 mx-auto mb-12 md:mb-0 rounded-lg -rotate-[4deg]" src="../images/team.jpg" width="420" height="280" alt="Team" />
            </figure>
            <div class="max-w-[548px] mx-auto text-slate-400 space-y-6 text-lg">
              <p v-for="i in 5" :key="i">
                <!-- <span>{{ $t(`landing.freesite.points.${i}.icon`) }}</span> -->
                <strong> {{ $t(`landing.freesite.points.${i}.title`) }} </strong>
                {{ $t(`landing.freesite.points.${i}.text`) }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="relative">
      <div class="absolute top-0 -translate-y-1/3 left-1/2 -translate-x-1/2 ml-24 blur-2xl opacity-50 pointer-events-none -z-10">
        <svg xmlns="http://www.w3.org/2000/svg" width="434" height="427">
          <defs>
            <linearGradient id="bs3-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
              <stop offset="0%" stop-color="#6366F1" />
              <stop offset="100%" stop-color="#6366F1" stop-opacity="0" />
            </linearGradient>
          </defs>
          <path fill="url(#bs3-a)" fill-rule="evenodd" d="m410 0 461 369-284 58z" transform="matrix(1 0 0 -1 -410 427)" />
        </svg>
      </div>

      <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12 md:py-20 border-t border-slate-800">
        <div class="max-w-3xl mx-auto text-center pb-12 md:pb-20">
          <div class="inline-flex font-medium bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-200 pb-3">
            {{ $t('landing.freesite.faq.badge') }}
          </div>
          <h2 class="h2 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-4">
            {{ $t('landing.freesite.faq.title') }}
          </h2>
        </div>

        <div class="md:flex md:space-x-12 space-y-8 md:space-y-0">
          <div class="w-full md:w-1/2 space-y-8">
            <div v-for="i in 3" :key="i" class="space-y-2">
              <h4 class="font-semibold">{{ $t(`landing.freesite.faq.items.${i}.q`) }}</h4>
              <p class="text-slate-400">{{ $t(`landing.freesite.faq.items.${i}.a`) }}</p>
            </div>
          </div>
          <div class="w-full md:w-1/2 space-y-8">
            <div v-for="i in [4, 5, 6]" :key="i" class="space-y-2">
              <h4 class="font-semibold">{{ $t(`landing.freesite.faq.items.${i}.q`) }}</h4>
              <p class="text-slate-400">{{ $t(`landing.freesite.faq.items.${i}.a`) }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA bar -->
    <div class="w-full bg-purple-900 text-white text-center py-6 px-4 mt-10 rounded shadow-lg">
      <h3 class="text-xl font-semibold mb-2">{{ $t('landing.freesite.cta.title') }}</h3>
      <p class="mb-4">{{ $t('landing.freesite.cta.text') }}</p>

      <router-link to="/free-site-form" class="inline-block bg-white text-purple-700 font-bold px-6 py-2 rounded hover:bg-slate-100 transition">
        <button type="button" class="btn text-sm text-white bg-purple-500 hover:bg-purple-600 w-full shadow-xs group">
          {{ $t('landing.freesite.cta.button') }}
          <span class="tracking-normal text-purple-300 group-hover:translate-x-0.5 transition ml-1">→</span>
        </button>
      </router-link>

      <router-link
        to="/demo"
        class="inline-block bg-transparent text-white font-medium px-6 py-2 rounded border border-white hover:bg-white hover:text-purple-700 transition"
      >
        {{ $t('landing.freesite.cta.demo') }}
      </router-link>
    </div>

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
  name: 'ServiceFreeSite',
  components: {
    Particles,
    Header,
    Footer,
    SupportCTA
  },
  props: ['slug'],
  mounted() {
    console.log('Otvorena usluga:', this.slug)
    // Na osnovu slug-a možeš menjati sadržaj
  },
  
}
</script>