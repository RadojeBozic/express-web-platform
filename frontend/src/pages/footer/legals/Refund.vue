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
          <h1 class="text-3xl font-bold mb-6 text-center">💸 {{ $t('refund.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">{{ $t('refund.intro') }}</p>

          <div class="space-y-6 bg-slate-800 p-6 rounded-lg shadow text-slate-300 text-sm leading-relaxed">
            <p><strong>1. {{ $t('refund.p1.title') }}</strong> {{ $t('refund.p1.text') }}</p>
            <p><strong>2. {{ $t('refund.p2.title') }}</strong> {{ $t('refund.p2.text') }}</p>
            <p><strong>3. {{ $t('refund.p3.title') }}</strong> {{ $t('refund.p3.text') }}</p>
            <p><strong>4. {{ $t('refund.p4.title') }}</strong> {{ $t('refund.p4.text') }}</p>
            <p><strong>5. {{ $t('refund.p5.title') }}</strong> 
              {{ $t('refund.p5.text') }}
              <router-link to="/contact" class="text-purple-400 underline hover:text-purple-300">
                {{ $t('refund.p5.link') }}
              </router-link>.
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
  name: 'RefundPage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>
