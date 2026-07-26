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
import axios from 'axios'

export default {
  name: 'StripeTestButton',
  data() {
    return {
      success: false,
      error: ''
    }
  },
  methods: {
    async payNow() {
      this.success = false
      this.error = ''

      try {
        const res = await axios.post('http://localhost:8080/api/stripe/checkout', {
          amount: 1000, // $10.00
          currency: 'usd',
          token: 'tok_visa', // test token od Stripe-a
          description: 'Test plaćanje preko Stripe-a'
        })

        if (res.data.success) {
          this.success = true
        } else {
          this.error = 'Plaćanje nije uspelo.'
        }
      } catch (err) {
        console.error('❌ Stripe greška:', err)
        this.error = err.response?.data?.message || 'Došlo je do greške.'
      }
    }
  }
}
</script>
