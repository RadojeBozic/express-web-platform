<template>
  <div class="min-h-screen bg-slate-900 text-white py-12 px-4">
    <Header />

    <div class="max-w-3xl mx-auto">
      <h1 class="text-3xl font-bold mb-6 text-center mt-[6rem]">🛒 {{ $t('checkout.title') }}</h1>

      <div v-if="cartItems.length === 0" class="text-center text-slate-400">
        {{ $t('checkout.empty') }}
      </div>

      <div v-else class="space-y-4">
        <div
          v-for="(item, index) in cartItems"
          :key="`${item.id}-${index}`"
          class="flex justify-between items-center bg-slate-800 p-4 rounded"
        >
          <div>
            <h3 class="text-lg font-semibold">{{ item.name }}</h3>
            <p class="text-sm text-slate-400">
              {{ item.quantity }} × {{ formatPrice(item.price) }}
            </p>
            <button
              @click="removeItem(item.id)"
              class="text-xs text-red-400 hover:text-red-200 mt-1"
            >
              ❌ {{ $t('checkout.remove') }}
            </button>
          </div>
          <p class="text-purple-400 font-bold">
            {{ formatPrice(item.price * item.quantity) }}
          </p>
        </div>

        <div class="text-right text-lg mt-6 font-semibold text-green-400">
          {{ $t('checkout.total') }}: {{ formatPrice(totalAmount) }}
        </div>

        <!-- Payment Options -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-6">
          <button
            @click="handleStripeCheckout"
            class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded"
          >
            💳 {{ $t('checkout.payCard') }}
          </button>

          <button
            @click="showInvoiceModal = true"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded"
          >
            🧾 {{ $t('checkout.invoice_request') }}
          </button>

          <button disabled class="bg-slate-600 text-white font-semibold py-3 rounded opacity-50">
            🅿️ PayPal (uskoro)
          </button>
        </div>
      </div>
    </div>

    <!-- Prosledi stavke iz korpe u modal -->
    <InvoiceModal
      :visible="showInvoiceModal"
      :items="cartItems"
      :amount="totalAmount"
      @close="showInvoiceModal = false"
      @clear-cart="emptyCartAfterInvoice"
    />

    <Footer />
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'

import Header from '@/partials/Header.vue'
import Footer from '@/partials/Footer.vue'
import InvoiceModal from '@/partials/InvoiceModal.vue'

import { useCart } from '@/utils/CartService'
import { track, trackOnce } from '@/utils/analytics'

// ✅ koristimo centralnu axios instancu
import api from '@/api/http'

const { t } = useI18n()

const { cart, removeFromCart, clearCart } = useCart()
const cartItems = ref([])
const showInvoiceModal = ref(false)

onMounted(() => {
  // sync iz store-a
  cartItems.value = [...(cart.value || [])]

  // Plausible: zabeleži ulazak u checkout (jednom po sesiji)
  trackOnce('checkout_started', () => track('Checkout Started'))
})

const totalAmount = computed(() =>
  (cartItems.value || []).reduce((sum, item) => sum + (item.price * item.quantity), 0)
)

/**
 * Prikaz cene; default RSD za UI (po potrebi promeni na 'EUR')
 * amount je u centima (EUR centi), pa za RSD radimo vizuelnu konverziju.
 */
function formatPrice(valueCents, currency = 'RSD') {
  const rate = 117.5
  const isRsd = currency.toUpperCase() === 'RSD'
  const value = isRsd ? (valueCents || 0) * rate : (valueCents || 0)
  return new Intl.NumberFormat('sr-RS', {
    style: 'currency',
    currency: isRsd ? 'RSD' : 'EUR'
  }).format(value / 100)
}

function removeItem(id) {
  try {
    removeFromCart(id)
    cartItems.value = [...(cart.value || [])]
  } catch (e) {
    console.error('Remove item error:', e)
  }
}

function emptyCartAfterInvoice() {
  clearCart()
  cartItems.value = []
}

async function handleStripeCheckout() {
  if (!totalAmount.value) {
    alert('❌ ' + (t('checkout.empty') || 'Korpa je prazna.'))
    return
  }

  try {
    const token = 'tok_visa' // Stripe test token

    // ✅ api.post('/stripe/checkout') -> efektivno pogađa /api/stripe/checkout na serveru
    const res = await api.post('/stripe/checkout', {
      amount: totalAmount.value,   // u centima
      currency: 'eur',
      description: 'ExpressWeb Checkout',
      token
    })

    alert('✅ ' + (t('checkout.paymentSuccess') || `Plaćanje uspešno: ${res?.data?.charge?.id || ''}`))

    // Plausible event
    track('Payment Success', { method: 'stripe', amount_cents: totalAmount.value })

    // Prazni korpu
    clearCart()
    cartItems.value = []

  } catch (err) {
    console.error('❌ Stripe greška:', err)
    alert('❌ ' + (t('checkout.paymentFailed') || 'Plaćanje nije uspelo.'))
  }
}
</script>
