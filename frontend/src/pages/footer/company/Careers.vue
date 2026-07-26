<template>
  <section>
    <!-- ✨ Pozadina sa particles efektom -->
    <div class="absolute inset-0 -z-10">
      <Particles class="absolute inset-0" />
      <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
        <img src="../../../images/glow-top.svg" class="max-w-none" width="2146" height="774" alt="Pozadina" />
      </div>
    </div>

    <div class="relative max-w-6xl mx-auto">
      <Header />

      <div class="pt-32 pb-16 md:pt-52 md:pb-32">
        <div class="max-w-4xl mx-auto">
          <h1 class="text-3xl font-bold mb-6 text-center">💼 {{ $t('careers.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">
            {{ $t('careers.intro') }}
          </p>

          <!-- 🧑‍💻 Pozicije -->
          <div class="space-y-8">

            <div class="bg-slate-800 p-5 rounded border border-slate-700 shadow">
              <h2 class="text-xl font-semibold text-purple-400 mb-1">{{ $t('careers.p1.title') }}</h2>
              <p class="text-slate-300 text-sm leading-relaxed mb-2">{{ $t('careers.p1.text') }}</p>
              <ul class="text-sm text-slate-400 list-disc list-inside space-y-1">
                <li>{{ $t('careers.p1.time') }}</li>
                <li>{{ $t('careers.p1.pay') }}</li>
                <li>{{ $t('careers.p1.type') }}</li>
              </ul>
            </div>

            <div class="bg-slate-800 p-5 rounded border border-slate-700 shadow">
              <h2 class="text-xl font-semibold text-purple-400 mb-1">{{ $t('careers.p2.title') }}</h2>
              <p class="text-slate-300 text-sm leading-relaxed mb-2">{{ $t('careers.p2.text') }}</p>
              <ul class="text-sm text-slate-400 list-disc list-inside space-y-1">
                <li>{{ $t('careers.p2.time') }}</li>
                <li>{{ $t('careers.p2.pay') }}</li>
                <li>{{ $t('careers.p2.type') }}</li>
              </ul>
            </div>

            <div class="bg-slate-800 p-5 rounded border border-slate-700 shadow">
              <h2 class="text-xl font-semibold text-purple-400 mb-1">{{ $t('careers.p3.title') }}</h2>
              <p class="text-slate-300 text-sm leading-relaxed mb-2">{{ $t('careers.p3.text') }}</p>
              <ul class="text-sm text-slate-400 list-disc list-inside space-y-1">
                <li>{{ $t('careers.p3.time') }}</li>
                <li>{{ $t('careers.p3.pay') }}</li>
                <li>{{ $t('careers.p3.type') }}</li>
              </ul>
            </div>

            <div class="bg-slate-800 p-5 rounded border border-slate-700 shadow">
              <h2 class="text-xl font-semibold text-purple-400 mb-1">{{ $t('careers.p4.title') }}</h2>
              <p class="text-slate-300 text-sm leading-relaxed mb-2">{{ $t('careers.p4.text') }}</p>
              <ul class="text-sm text-slate-400 list-disc list-inside space-y-1">
                <li>{{ $t('careers.p4.time') }}</li>
                <li>{{ $t('careers.p4.pay') }}</li>
                <li>{{ $t('careers.p4.type') }}</li>
              </ul>
            </div>

            <div class="bg-slate-800 p-5 rounded border border-slate-700 shadow">
              <h2 class="text-xl font-semibold text-purple-400 mb-1">{{ $t('careers.p5.title') }}</h2>
              <p class="text-slate-300 text-sm leading-relaxed mb-2">{{ $t('careers.p5.text') }}</p>
              <ul class="text-sm text-slate-400 list-disc list-inside space-y-1">
                <li>{{ $t('careers.p5.time') }}</li>
                <li>{{ $t('careers.p5.pay') }}</li>
                <li>{{ $t('careers.p5.type') }}</li>
              </ul>
            </div>
          </div>

          <!-- Dugme -->
          <div class="text-center mt-12">
            <router-link
              to="/contact"
              class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded text-lg font-semibold transition"
            >
              📧 {{ $t('careers.cta') }}
            </router-link>
          </div>
        </div>

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
  name: 'CareersPage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>
