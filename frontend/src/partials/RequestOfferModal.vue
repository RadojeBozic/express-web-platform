<template>
  <div
    v-if="visible"
    class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50"
  >
    <div class="bg-slate-900 p-6 rounded-lg w-full max-w-lg shadow-lg relative">
      <button
        @click="$emit('close')"
        class="absolute top-3 right-3 text-slate-400 hover:text-white text-xl font-bold"
      >
        &times;
      </button>
      <h2 class="text-xl font-semibold text-white mb-2">
        {{ $t('requestModal.title') }}
      </h2>
      <p class="text-slate-400 mb-4">
        {{ $t('requestModal.subtitle') }}
        <strong class="text-white">{{ selectedService }}</strong>
      </p>

      <form @submit.prevent="submitRequest" class="space-y-4">
        <div>
          <label class="block text-sm text-slate-300 mb-1">{{ $t('requestModal.name') }}</label>
          <input v-model="form.name" required class="form-input w-full" type="text" />
        </div>
        <div>
          <label class="block text-sm text-slate-300 mb-1">{{ $t('requestModal.email') }}</label>
          <input v-model="form.email" required class="form-input w-full" type="email" />
        </div>
        <div>
          <label class="block text-sm text-slate-300 mb-1">{{ $t('requestModal.message') }}</label>
          <textarea v-model="form.message" rows="4" class="form-textarea w-full"></textarea>
        </div>

        <div v-if="success" class="text-green-500 text-sm">{{ success }}</div>
        <div v-if="error" class="text-red-500 text-sm">{{ error }}</div>

        <div class="text-center">
          <button class="btn bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded" type="submit">
            📤 {{ $t('requestModal.send') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'RequestOfferModal',
  props: {
    visible: Boolean,
    selectedService: String
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        message: ''
      },
      success: '',
      error: ''
    }
  },
  methods: {
    async submitRequest() {
      try {
        const payload = {
          name: this.form.name,
          email: this.form.email,
          message: `[Upit za: ${this.selectedService}] ${this.form.message}`
        }

        await axios.post('http://localhost:8080/api/contact', payload)

        this.success = this.$t('requestModal.success')
        this.error = ''
        this.form = { name: '', email: '', message: '' }
      } catch (err) {
        this.error = this.$t('requestModal.error')
        this.success = ''
        console.error('❌ Kontakt greška:', err)
      }
    }
  }
}
</script>