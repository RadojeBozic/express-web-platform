<template>
  <div class="text-center">
    <button
      @click="payNow"
      class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded shadow transition"
    >
      💳 Testiraj Stripe Plaćanje ($10)
    </button>
    <p v-if="success" class="text-green-400 mt-4">✅ Plaćanje uspešno!</p>
    <p v-if="error" class="text-red-400 mt-4">❌ {{ error }}</p>
  </div>
</template>

<script>
import api from '@/api/http'

export default {
  name: 'StripeTestButton',
  data() {
    return {
      success: false,
      error: '',
      loading: false,
    }
  },
  methods: {
    async payNow() {
      if (this.loading) return
      this.success = false
      this.error = ''
      this.loading = true

      try {
        const { data } = await api.post('/stripe/checkout', {
          amount: 1000,              // 10.00 u valuti ispod (centi)
          currency: 'usd',           // promeni u 'eur' ako backend tako očekuje
          token: 'tok_visa',         // Stripe test token
          description: 'Test plaćanje preko Stripe-a',
        })

        if (data?.success) {
          this.success = true
        } else {
          this.error = data?.message || 'Plaćanje nije uspelo.'
        }
      } catch (err) {
        console.error('❌ Stripe greška:', err)
        this.error = err?.response?.data?.message || 'Došlo je do greške.'
      } finally {
        this.loading = false
      }
    },
  },
}
</script>

