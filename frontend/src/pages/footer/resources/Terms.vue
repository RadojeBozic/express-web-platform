<template>
  <section>
    <!-- ✨ Pozadinska animacija -->
    <div class="absolute inset-0 -z-10">
      <Particles class="absolute inset-0" />
      <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
        <img src="../../../images/glow-top.svg" class="max-w-none" width="2146" height="774" alt="Glow background" />
      </div>
    </div>

    <div class="relative max-w-6xl mx-auto">
      <Header />

      <div class="pt-32 pb-16 md:pt-52 md:pb-32">
        <div class="max-w-4xl mx-auto">
          <h1 class="text-3xl font-bold mb-6 text-center">📜 {{ $t('terms.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">
            {{ $t('terms.intro') }}
          </p>

          <div class="space-y-8 text-slate-300 text-sm leading-relaxed">
            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">1. {{ $t('terms.1.title') }}</h2>
              <p>{{ $t('terms.1.text') }}</p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">2. {{ $t('terms.2.title') }}</h2>
              <p>{{ $t('terms.2.text') }}</p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">3. {{ $t('terms.3.title') }}</h2>
              <p>{{ $t('terms.3.text') }}</p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">4. {{ $t('terms.4.title') }}</h2>
              <p>{{ $t('terms.4.text') }}</p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">5. {{ $t('terms.5.title') }}</h2>
              <p>{{ $t('terms.5.text') }}</p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">6. {{ $t('terms.6.title') }}</h2>
              <p>
                {{ $t('terms.6.text') }}
                <router-link to="/contact" class="text-purple-400 underline hover:text-purple-300">
                  {{ $t('terms.6.link') }}
                </router-link>.
              </p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">7. {{ $t('terms.7.title') }}</h2>
              <p>{{ $t('terms.7.text') }}</p>
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
  name: 'TermsPage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>