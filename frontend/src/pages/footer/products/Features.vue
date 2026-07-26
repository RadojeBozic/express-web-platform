<template>
  <section>
    <!-- Particles background -->
    <div class="absolute inset-0 -z-10">
      <Particles class="absolute inset-0" />
      <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
        <img src="../../../images/glow-top.svg" class="max-w-none" width="2146" height="774" alt="Glow background" />
      </div>
    </div>

    <div class="relative max-w-6xl mx-auto mt-4">
      <Header />

      <div class="pt-32 pb-16 md:pt-52 md:pb-32">
        <div class="max-w-5xl mx-auto">
          <h1 class="text-3xl font-bold mb-6 text-center">✨ {{ $t('features.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">{{ $t('features.intro') }}</p>

          <ul class="space-y-6">
            <li v-for="n in 11" :key="n" class="border border-slate-700 rounded p-4 bg-slate-800 shadow hover:shadow-lg transition">
              <h2 class="text-xl font-semibold text-purple-400">{{ $t(`features.f${n}.title`) }}</h2>
              <p class="text-slate-300 text-sm mt-1">{{ $t(`features.f${n}.desc`) }}</p>
            </li>
          </ul>
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
  name: 'FeaturesPage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>
