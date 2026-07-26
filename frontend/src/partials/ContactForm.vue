<template>
  <section>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 relative">
      <!-- Particles animation -->
      <Particles class="absolute inset-0 -z-10" />

      <!-- Illustration -->
      <div class="absolute inset-0 -z-10 -mx-28 rounded-b-[3rem] pointer-events-none overflow-hidden" aria-hidden="true">
        <div class="absolute left-1/2 -translate-x-1/2 bottom-0 -z-10">
          <img src="../images/glow-bottom.svg" class="max-w-none" width="116" height="74" alt="Hero Illustration" />
        </div>
      </div>

      <!-- 💜 Gradient iza forme -->
      <div class="absolute inset-0 flex items-center justify-center pointer-events-none -z-10">
        <div class="w-[400px] h-[400px] bg-purple-500 rounded-full blur-[160px] opacity-40"></div>
      </div>

      <!-- 🟣 SVG shape iza forme -->
      <div class="absolute bottom-0 left-0 w-full pointer-events-none -z-10 opacity-50 blur-2xl" aria-hidden="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="434" height="427">
          <defs>
            <linearGradient id="bs5-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
              <stop offset="0%" stop-color="#A855F7" />
              <stop offset="100%" stop-color="#6366F1" stop-opacity="0" />
            </linearGradient>
          </defs>
          <path fill="url(#bs5-a)" fill-rule="evenodd" d="m0 0 461 369-284 58z" transform="matrix(1 0 0 -1 0 427)" />
        </svg>
      </div>

      <!-- 📬 Kontakt forma -->
      <form @submit.prevent="submitForm" class="max-w-xl mx-auto space-y-4 relative pt-16 pb-8 md:pt-4 md:pb-16 z-10" novalidate>
        <div>
          <label for="name" class="block text-sm text-slate-300 font-medium mb-1">{{ $t('contact.form.name') }}</label>
          <input id="name" v-model.trim="form.name" class="form-input w-full" type="text" required />
        </div>

        <div>
          <label for="email" class="block text-sm text-slate-300 font-medium mb-1">{{ $t('contact.form.email') }}</label>
          <input id="email" v-model.trim="form.email" class="form-input w-full" type="email" required />
        </div>

        <div>
          <label for="message" class="block text-sm text-slate-300 font-medium mb-1">{{ $t('contact.form.message') }}</label>
          <textarea id="message" v-model.trim="form.message" class="form-textarea w-full h-32" required></textarea>
        </div>

        <div class="flex items-center">
          <input id="newsletter" v-model="form.newsletter" type="checkbox" class="form-checkbox text-purple-500" />
          <label for="newsletter" class="ml-2 text-slate-400 text-sm">{{ $t('contact.form.newsletter') }}</label>
        </div>

        <div v-if="success" class="text-green-500 text-sm">{{ success }}</div>
        <div v-if="error" class="text-red-500 text-sm">{{ error }}</div>

        <div class="text-center mt-6">
          <button
            class="btn text-white bg-purple-500 hover:bg-purple-600 px-6 py-2 rounded"
            type="submit"
            :disabled="loading"
            :aria-busy="loading ? 'true' : 'false'"
          >
            {{ loading ? ($t('contact.form.sending') || 'Slanje…') : $t('contact.form.submit') }}
          </button>
        </div>
      </form>
    </div>
  </section>
</template>

<script>
import Particles from './Particles.vue'
import api from '@/api/http'

export default {
  name: 'ContactForm',
  components: { Particles },
  data() {
    return {
      form: { name: '', email: '', message: '', newsletter: false },
      success: '',
      error: '',
      loading: false,
    }
  },
  methods: {
    async submitForm() {
      if (this.loading) return
      this.success = ''
      this.error = ''

      if (!this.form.name?.trim() || !this.form.email?.trim() || !this.form.message?.trim()) {
        this.error = this.$t?.('contact.required') || 'Sva polja su obavezna.'
        return
      }

      this.loading = true
      try {
        await api.post('/contact', {
          name: this.form.name.trim(),
          email: this.form.email.trim(),
          message: this.form.message.trim(),
          newsletter: !!this.form.newsletter,
        })
        this.success = this.$t?.('contact.success') || 'Poruka uspešno poslata!'
        this.form = { name: '', email: '', message: '', newsletter: false }
      } catch (err) {
        console.error('❌ Kontakt greška:', err?.response?.data || err)
        // 422 → prikaži prvu poruku
        if (err?.response?.status === 422 && err?.response?.data?.errors) {
          const first = Object.values(err.response.data.errors).flat()?.[0]
          this.error = first || 'Proveri unete podatke.'
        } else {
          this.error = err?.response?.data?.message || 'Došlo je do greške pri slanju.'
        }
      } finally {
        this.loading = false
      }
    },
  },
  mounted() {
    this.success = ''
    this.error = ''
    this.form = { name: '', email: '', message: '', newsletter: false }
  },
}
</script>
