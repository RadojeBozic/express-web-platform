<template>
  <section>
    <!-- ✨ Particles animacija -->
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
          <h1 class="text-3xl font-bold mb-6 text-center">📊 {{ $t('finance.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">
            {{ $t('finance.intro') }}
          </p>

          <div class="space-y-6">
            <!-- Izveštaj 2025 -->
            <div class="bg-slate-800 border border-slate-700 rounded p-5 shadow hover:shadow-lg transition">
              <h2 class="text-xl font-semibold text-purple-400">{{ $t('finance.r2025.title') }}</h2>
              <p class="text-slate-300 text-sm mt-1">{{ $t('finance.r2025.description') }}</p>
              <div class="mt-4">
                <button class="bg-purple-600 text-white px-4 py-2 rounded text-sm" disabled>
                  📁 {{ $t('finance.download') }}
                </button>
              </div>
            </div>

            <!-- Izveštaj 2024 -->
            <div class="bg-slate-800 border border-slate-700 rounded p-5 shadow hover:shadow-lg transition">
              <h2 class="text-xl font-semibold text-purple-400">{{ $t('finance.r2024.title') }}</h2>
              <p class="text-slate-300 text-sm mt-1">{{ $t('finance.r2024.description') }}</p>
              <div class="mt-4">
                <button class="bg-purple-600 text-white px-4 py-2 rounded text-sm" disabled>
                  📁 {{ $t('finance.download') }}
                </button>
              </div>
            </div>

            <!-- Izveštaj 2023 -->
            <div class="bg-slate-800 border border-slate-700 rounded p-5 shadow hover:shadow-lg transition">
              <h2 class="text-xl font-semibold text-purple-400">{{ $t('finance.r2023.title') }}</h2>
              <p class="text-slate-300 text-sm mt-1">{{ $t('finance.r2023.description') }}</p>
              <div class="mt-4">
                <button class="bg-purple-600 text-white px-4 py-2 rounded text-sm" disabled>
                  📁 {{ $t('finance.download') }}
                </button>
              </div>
            </div>
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
  name: 'FinancePage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>
