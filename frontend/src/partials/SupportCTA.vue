<template>
  <section class="bg-slate-900 py-16 text-center relative z-10">
    <h3 class="text-2xl text-white font-bold mb-4">{{ $t('support.cta_title') }}</h3>
    
    <div class="inline-flex items-center justify-center relative">
        <Particles class="absolute inset-0 -z-20" />
        <div class="inline-flex [mask-image:_radial-gradient(circle_at_bottom,transparent_15%,black_70%)]">
          <img src="../images/about-illustration.svg" width="446" height="446" alt="About illustration" />
        </div>
        <img class="absolute mt-[30%] drop-shadow-lg animate-float" src="../images/about-icon.svg" width="72" height="72" alt="About icon" />
      </div>
    <p class="text-slate-400 mb-6">{{ $t('support.cta_subtitle') }}</p>
    <router-link
      to="/contact"
      class="btn text-white bg-purple-500 hover:bg-purple-600 transition px-6 py-2 rounded-lg"
    >
      {{ $t('support.cta_button') }}
    </router-link>
  </section>
</template>

<script>
import Particles from './Particles.vue'
export default {
  name: 'SupportCTA',
  components: {
    Particles
  }
}
</script>
