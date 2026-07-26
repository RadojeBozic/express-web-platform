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
          <h1 class="text-3xl font-bold mb-6 text-center">🍪 {{ $t('cookie.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">
            {{ $t('cookie.intro') }}
          </p>

          <div class="space-y-8 text-slate-300 text-sm leading-relaxed">
            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">1. {{ $t('cookie.1.title') }}</h2>
              <p>{{ $t('cookie.1.text') }}</p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">2. {{ $t('cookie.2.title') }}</h2>
              <p>{{ $t('cookie.2.text') }}</p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">3. {{ $t('cookie.3.title') }}</h2>
              <p>{{ $t('cookie.3.text') }}</p>
              <ul class="list-disc pl-5 mt-2 space-y-1">
                <li>{{ $t('cookie.3.li1') }}</li>
                <li>{{ $t('cookie.3.li2') }}</li>
                <li>{{ $t('cookie.3.li3') }}</li>
              </ul>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">4. {{ $t('cookie.4.title') }}</h2>
              <p>{{ $t('cookie.4.text') }}</p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">5. {{ $t('cookie.5.title') }}</h2>
              <p>
                {{ $t('cookie.5.text') }}
                <router-link to="/contact" class="text-purple-400 underline hover:text-purple-300">
                  {{ $t('cookie.5.link') }}
                </router-link>.
              </p>
            </div>

            <div>
              <h2 class="text-lg font-semibold text-purple-400 mb-2">6. {{ $t('cookie.6.title') }}</h2>
              <p>{{ $t('cookie.6.text') }}</p>
            </div>
          </div>
        </div>

        <!-- ✨ Donja pozadina -->
        <div class="absolute inset-0 -z-10">
          <Particles class="absolute inset-0" />
          <div class="absolute left-1/2 -translate-x-1/2 bottom-0"></div>
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
  name: 'CookiePolicyPage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>
