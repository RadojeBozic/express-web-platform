<template>
  <section class="text-center py-20 bg-slate-900 relative min-h-[400px] -z-9">
    <h2 class="text-4xl font-bold text-white mb-4">{{ $t('support.title') }}</h2>

    <Particles class="absolute inset-0 -z-20" />

    <div class="absolute inset-0 rounded-b-[3rem] pointer-events-none overflow-hidden" aria-hidden="true">
      <div class="absolute left-1/2 -translate-x-1/2 bottom-0 -z-10">
        <img src="../images/glow-bottom.svg" class="max-w-none" width="546" height="23" alt="Hero Illustration">
      </div>
    </div>

    <p class="text-slate-400 text-lg max-w-2xl mx-auto">{{ $t('support.subtitle') }}</p>
    <p class="text-slate-400 text-lg max-w-2xl mx-auto">{{ $t('support.description') }}</p>
  </section>
</template>

<script>
import Particles from './Particles.vue'

export default {
  name: 'SupportHero',
  components: {
    Particles
  }
}
</script>
