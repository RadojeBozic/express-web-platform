<template>
  <section>
    <!-- 🎇 Pozadina -->
    <div class="absolute inset-0 -z-10">
      <Particles class="absolute inset-0" />
      <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
        <img src="../../../images/glow-top.svg" class="max-w-none" width="2146" height="774" alt="Glow background" />
      </div>
    </div>

    <!-- ✅ Sadržaj -->
    <div class="relative max-w-6xl mx-auto">
      <Header />

      <div class="pt-32 pb-16 md:pt-52 md:pb-32">
        <div class="max-w-5xl mx-auto">
          <h1 class="text-3xl font-bold mb-6 text-center">📝 {{ $t('changelog.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">{{ $t('changelog.intro') }}</p>

          <!-- Verzija 1 -->
          <div class="border border-slate-700 rounded p-4 bg-slate-800 shadow hover:shadow-lg transition mb-6">
            <h2 class="text-lg font-semibold text-purple-400">{{ $t('changelog.c1.date') }} – {{ $t('changelog.c1.version') }}</h2>
            <ul class="list-disc ml-5 mt-2 space-y-1 text-slate-300 text-sm">
              <li>{{ $t('changelog.c1.i1') }}</li>
              <li>{{ $t('changelog.c1.i2') }}</li>
              <li>{{ $t('changelog.c1.i3') }}</li>
            </ul>
          </div>

          <!-- Verzija 2 -->
          <div class="border border-slate-700 rounded p-4 bg-slate-800 shadow hover:shadow-lg transition mb-6">
            <h2 class="text-lg font-semibold text-purple-400">{{ $t('changelog.c2.date') }} – {{ $t('changelog.c2.version') }}</h2>
            <ul class="list-disc ml-5 mt-2 space-y-1 text-slate-300 text-sm">
              <li>{{ $t('changelog.c2.i1') }}</li>
              <li>{{ $t('changelog.c2.i2') }}</li>
            </ul>
          </div>

          <!-- Verzija 3 -->
          <div class="border border-slate-700 rounded p-4 bg-slate-800 shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-purple-400">{{ $t('changelog.c3.date') }} – {{ $t('changelog.c3.version') }}</h2>
            <ul class="list-disc ml-5 mt-2 space-y-1 text-slate-300 text-sm">
              <li>{{ $t('changelog.c3.i1') }}</li>
              <li>{{ $t('changelog.c3.i2') }}</li>
              <li>{{ $t('changelog.c3.i3') }}</li>
            </ul>
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
  name: 'ChangelogPage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>
