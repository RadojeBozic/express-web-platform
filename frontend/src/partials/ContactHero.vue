<template>
  <section class="py-10 text-center ">

    <!-- Particles animation -->
      <Particles class="absolute inset-0 -z-10" />

      
  <div class="max-w-6xl mx-auto px-4 sm:px-6 pt-32 pb-8 md:pt-12 md:pb-16">

    <h2 class=" text-4xl font-bold text-white mb-4 -z-10">{{ $t('contact.title') }}</h2>
    <p class="text-slate-400 text-lg max-w-2xl mx-auto">{{ $t('contact.description') }}</p>
                  </div>
  </section>
</template>

<script>
import Particles from './Particles.vue'

export default {
  name: 'ContactHero',
  components: {
    Particles
  },
}
</script>
