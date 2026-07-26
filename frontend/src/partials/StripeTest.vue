<template>
  <div class="min-h-screen bg-slate-900 text-white p-10">
    <h1 class="text-2xl font-bold mb-6">🔐 Stripe Test Naplata</h1>
    <StripeTestButton />
  </div>
</template>

<script>
import StripeTestButton from '../partials/StripeTestButton.vue'

export default {
  components: { StripeTestButton }
}
</script>
