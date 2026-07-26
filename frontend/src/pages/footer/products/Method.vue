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
        <div class="max-w-5xl mx-auto">
          <h1 class="text-3xl font-bold mb-6 text-center">🚀 {{ $t('method.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">{{ $t('method.intro') }}</p>

          <ol class="space-y-8 list-decimal list-inside text-slate-300 text-sm">
            <li><strong class="text-white">🎯 {{ $t('method.step1.title') }}</strong> {{ $t('method.step1.desc') }}</li>
            <li><strong class="text-white">🧩 {{ $t('method.step2.title') }}</strong> {{ $t('method.step2.desc') }}</li>
            <li><strong class="text-white">⚡ {{ $t('method.step3.title') }}</strong> {{ $t('method.step3.desc') }}</li>
            <li><strong class="text-white">🔁 {{ $t('method.step4.title') }}</strong> {{ $t('method.step4.desc') }}</li>
            <li><strong class="text-white">🔐 {{ $t('method.step5.title') }}</strong> {{ $t('method.step5.desc') }}</li>
            <li><strong class="text-white">📈 {{ $t('method.step6.title') }}</strong> {{ $t('method.step6.desc') }}</li>
          </ol>
        </div>

        <!-- ✨ Pozadina sa particles efektom -->
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
  name: 'MethodPage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>
