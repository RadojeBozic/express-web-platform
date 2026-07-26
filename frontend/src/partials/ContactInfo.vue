<template>
  <section>
 <div class="relative max-w-6xl mx-auto px-4 sm:px-6">

      <!-- Particles animation -->
      <Particles class="absolute inset-0 -z-10" />

      <!-- Illustration -->
      <div class="absolute inset-0 -z-10 -mx-28 rounded-b-[3rem] pointer-events-none overflow-hidden" aria-hidden="true">
        <div class="absolute left-1/2 -translate-x-1/2 bottom-0 -z-10">
          <img src="../images/glow-bottom.svg" class="max-w-none" width="1146" height="274" alt="Hero Illustration">
        </div>
      </div>
    <div class="max-w-4xl mx-auto px-4 pt-16 pb-8 md:pt-20 md:pb-16">
      <h3 class="text-2xl font-bold text-white mb-8">{{ $t('contact.info.address_title') }}</h3>
      <ul class="space-y-4">
        <li><strong>{{ $t('contact.info.address_title') }}:</strong> {{ $t('contact.info.address_line1') }}, {{ $t('contact.info.address_line2') }}</li>
        <li><strong>{{ $t('contact.info.email_title') }}:</strong> <a class="text-purple-400 hover:underline" href="mailto:{{ $t('contact.info.email_value') }}">{{ $t('contact.info.email_value') }}</a></li>
        <li><strong>{{ $t('contact.info.phone_title') }}:</strong> <a class="text-purple-400 hover:underline" href="tel:+381641234567">{{ $t('contact.info.phone_value') }}</a></li>
      </ul>
    </div>
 </div>
  </section>
</template>

<script>
import Particles from './Particles.vue'
export default {
  name: 'ContactInfo',
  components: {
    Particles
  }
}
</script>