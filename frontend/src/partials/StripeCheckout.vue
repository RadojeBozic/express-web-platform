<template>
  <div class="max-w-md mx-auto bg-white p-6 rounded shadow text-black">
    <h2 class="text-xl font-semibold mb-4">💳 Plaćanje</h2>

    <form @submit.prevent="handleSubmit">
      <div id="card-element" class="mb-4"></div>

      <button
        type="submit"
        class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded"
        :disabled="processing"
      >
        {{ processing ? 'Obrada...' : 'Plati 30 €' }}
      </button>

      <p v-if="error" class="text-red-500 text-sm mt-2">⚠️ {{ error }}</p>
      <p v-if="success" class="text-green-600 text-sm mt-2">✅ {{ success }}</p>
    </form>
  </div>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js'

export default {
  name: 'StripeCheckout',
  data() {
    return {
      stripe: null,
      elements: null,
      card: null,
      error: '',
      success: '',
      processing: false
    }
  },
  async mounted() {
    this.stripe = await loadStripe('pk_test_51RMGurIiKepfHWu2UAZx2ChE4J4euAdIABde4ErXiiVaFl8BbCraRXPGpgdkBlRUqxXkaQYesIZCvf0yyMcRrBdI003cqJ5BRq') 
    this.elements = this.stripe.elements()
    this.card = this.elements.create('card')
    this.card.mount('#card-element')
  },
  methods: {
    async handleSubmit() {
      this.processing = true
      this.error = ''
      this.success = ''

      const { token, error } = await this.stripe.createToken(this.card)

      if (error) {
        this.error = error.message
        this.processing = false
        return
      }

      try {
        const res = await fetch('http://localhost:8080/api/stripe/checkout', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${localStorage.getItem('token')}`
          },
          body: JSON.stringify({
            amount: 3000,
            currency: 'eur',
            description: 'Plaćanje Premium plana',
            plan: 'premium',
            token: token.id
          })
        })

        const data = await res.json()

        if (res.ok) {
          this.success = 'Plaćanje uspešno! ✅'
        } else {
          this.error = data.error || 'Greška pri naplati.'
        }
      } catch (err) {
        this.error = 'Server greška. Pokušajte ponovo.'
      } finally {
        this.processing = false
      }
    }
  }
}
</script>
