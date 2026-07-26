<template>
  <section>
    <!-- ✨ Pozadinska animacija -->
    <div class="absolute inset-0 -z-10">
      <Particles class="absolute inset-0" />
      <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
        <img src="../../../images/glow-top.svg" class="max-w-none" width="2146" height="774" alt="Pozadinska animacija" />
      </div>
    </div>

    <div class="relative max-w-6xl mx-auto">
      <Header />

      <div class="pt-32 pb-16 md:pt-52 md:pb-32">
        <div class="max-w-4xl mx-auto">
          <h1 class="text-3xl font-bold mb-6 text-center">🎨 {{ $t('brandkit.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">
            {{ $t('brandkit.intro') }}
          </p>

          <div class="space-y-6 bg-slate-800 p-6 rounded-lg shadow text-slate-300 text-sm leading-relaxed">
            <!-- Dozvoljeno -->
            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">📌 {{ $t('brandkit.allowed.title') }}</h2>
              <ul class="list-disc list-inside space-y-2">
                <li>{{ $t('brandkit.allowed.item1') }}</li>
                <li>{{ $t('brandkit.allowed.item2') }}</li>
                <li>{{ $t('brandkit.allowed.item3') }}</li>
              </ul>
            </div>

            <!-- Zabranjeno -->
            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">🚫 {{ $t('brandkit.forbidden.title') }}</h2>
              <ul class="list-disc list-inside space-y-2">
                <li>{{ $t('brandkit.forbidden.item1') }}</li>
                <li>{{ $t('brandkit.forbidden.item2') }}</li>
                <li>{{ $t('brandkit.forbidden.item3') }}</li>
              </ul>
            </div>

            <!-- Boje -->
            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">🎨 {{ $t('brandkit.colors.title') }}</h2>
              <div class="flex gap-4 mt-2">
                <div class="w-20 h-10 bg-purple-600 rounded text-center text-xs flex items-center justify-center">#7C3AED</div>
                <div class="w-20 h-10 bg-slate-900 rounded text-center text-xs flex items-center justify-center">#0F172A</div>
                <div class="w-20 h-10 bg-slate-800 rounded text-center text-xs flex items-center justify-center">#1E293B</div>
              </div>
            </div>

            <!-- Font -->
            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">🅰️ {{ $t('brandkit.font.title') }}</h2>
              <p>{{ $t('brandkit.font.text') }}</p>
            </div>

            <!-- Preuzimanja -->
            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">📁 {{ $t('brandkit.download.title') }}</h2>
              <p>
                {{ $t('brandkit.download.text') }}
                <router-link to="/contact" class="text-purple-400 underline hover:text-purple-300">
                  {{ $t('brandkit.download.link') }}
                </router-link>.
              </p>
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
  name: 'BrandkitPage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>
