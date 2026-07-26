<template>
  <section>
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6">
      <Particles class="absolute inset-0 -z-10" />

      <div
        class="absolute inset-0 -z-10 -mx-28 rounded-b-[3rem] pointer-events-none overflow-hidden"
        aria-hidden="true"
      >
        <div class="absolute left-1/2 -translate-x-1/2 bottom-0 -z-10">
          <img
            src="../images/glow-bottom.svg"
            class="max-w-none"
            width="146"
            height="74"
            alt="Hero Illustration"
          />
        </div>
      </div>

      <div class="max-w-4xl mx-auto px-4 pt-16 pb-8 md:pt-20 md:pb-16">
        <h3 class="text-2xl font-bold text-white mb-8">
          {{ $t('contact.info.address_title') }}
        </h3>

        <ul class="space-y-4">
          <li>
            <strong>{{ $t('contact.info.address_title') }}:</strong>
            {{ $t('contact.info.address_line1') }},
            {{ $t('contact.info.address_line2') }}
          </li>

          <li>
            <strong>{{ $t('contact.info.email_title') }}:</strong>
            <a
              class="text-purple-400 hover:underline"
              :href="`mailto:${fullEmail}`"
            >
              {{ displayEmail }}
            </a>
          </li>

          <li>
            <strong>{{ $t('contact.info.phone_title') }}:</strong>
            <a
              class="text-purple-400 hover:underline"
              :href="`tel:${rawPhone}`"
            >
              {{ $t('contact.info.phone_value') }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>

<script>
import Particles from './Particles.vue'

export default {
  name: 'ContactInfo',
  components: { Particles },
  computed: {
    fullEmail() {
      const user = String(this.$t('contact.info.email_user')).trim()
      const domain = String(this.$t('contact.info.email_domain')).trim()
      return `${user}@${domain}`
    },
    // Po želji prikaži sa tankim razmakom oko @ (teže botovima, ljudima isto čitljivo)
    displayEmail() {
      const [u, d] = [this.$t('contact.info.email_user'), this.$t('contact.info.email_domain')]
      return `${u}@${d}`
      // ako želiš diskretnu zaštitu: return `${u} @ ${d}`  // NBSP oko @
    },
    rawPhone() {
      const p = this.$t('contact.info.phone_value')
      return String(p).replace(/[\s().-]/g, '')
    },
  },
}
</script>
