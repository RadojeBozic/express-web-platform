<template>
  <section>
    <!-- ✨ Pozadinska animacija -->
    <div class="absolute inset-0 -z-10">
      <Particles class="absolute inset-0" />
      <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
        <img src="../../../images/glow-top.svg" class="max-w-none" width="2146" height="774" alt="Glow background" />
      </div>
    </div>

    <!-- 📦 Glavni sadržaj -->
    <div class="relative max-w-6xl mx-auto">
      <Header />

      <div class="pt-32 pb-16 md:pt-52 md:pb-32">
        <div class="max-w-4xl mx-auto">
          <h1 class="text-3xl font-bold mb-6 text-center">🏢 {{ $t('about.title') }}</h1>
<p class="text-slate-400 text-center mb-12">{{ $t('about.intro') }}</p>

<div class="space-y-6 text-slate-300 text-sm leading-relaxed">
  <p>{{ $t('about.p1') }}</p>
  <p>{{ $t('about.p2') }}</p>
  <p>{{ $t('about.p3') }}</p>
  <p>{{ $t('about.p4') }}</p>
  <p>{{ $t('about.p5') }}</p>
  <p>{{ $t('about.p6') }}</p>
</div>


          <div class="space-y-6 text-slate-300 text-sm leading-relaxed">
           <p v-for="(paragraph, index) in aboutParagraphs" :key="index">
  {{ paragraph }}
</p>
          </div>
        </div>

        <!-- ✨ Donja pozadina -->
        <div class="absolute inset-0 -z-10">
          <Particles class="absolute inset-0" />
          <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
<!--             <img src="../../../images/glow-bottom.svg" class="max-w-none" width="546" height="274" alt="Pozadina" />
 -->          </div>
        </div>
      </div>

      <Footer />
    </div>
  </section>
</template>

<script>
import Header from '../../../partials/Header.vue'
import Footer from '../../../partials/Footer.vue'
import Particles from '../../../partials/Particles.vue'

export default {
  name: 'AboutPage',
  components: {
    Header,
    Footer,
    Particles
  },
  
}
</script>
