<template>
  <div class="min-h-dvh bg-slate-900 text-white">
    <!-- Fiksni header iznad sadržaja -->
    <Header />

    <!-- Sadržaj sa bezbednim gornjim/donjim razmakom (ne seče na manjim uređajima) -->
    <div class="max-w-3xl mx-auto px-4 pt-28 pb-24">
      <h1 class="text-3xl font-bold mb-8 text-center">🛒 {{ $t('checkout.title') }}</h1>

      <!-- Prazna korpa -->
      <div v-if="cartItems.length === 0" class="text-center text-slate-400">
        {{ $t('checkout.empty') }}
      </div>

      <!-- Stavke -->
      <div v-else class="space-y-4">
        <div
          v-for="(item, index) in cartItems"
          :key="`${item.id}-${index}-${item.variantKey || ''}`"
          class="flex justify-between items-start sm:items-center gap-4 bg-slate-800 p-4 rounded"
        >
          <div class="grow">
            <h3 class="text-lg font-semibold leading-tight">
              {{ item.name }}
            </h3>
            <p class="text-sm text-slate-400 mt-0.5">
              {{ item.quantity }} × {{ formatPrice(item.price) }}
            </p>

            <div class="flex items-center gap-2 mt-3">
              <button
                class="px-2 py-1 bg-slate-700 hover:bg-slate-600 rounded text-xs"
                :aria-label="$t('checkout.decrease') || 'Smanji količinu'"
                @click="changeQty(item, -1)"
              >−</button>

              <span class="text-sm tabular-nums">{{ item.quantity }}</span>

              <button
                class="px-2 py-1 bg-slate-700 hover:bg-slate-600 rounded text-xs"
                :aria-label="$t('checkout.increase') || 'Povećaj količinu'"
                @click="changeQty(item, +1)"
              >+</button>

              <button
                class="text-xs text-red-400 hover:text-red-200 ml-2"
                @click="removeItem(item.id)"
              >
                ❌ {{ $t('checkout.remove') }}
              </button>
            </div>
          </div>

          <p class="text-purple-400 font-bold whitespace-nowrap">
            {{ formatPrice(item.price * item.quantity) }}
          </p>
        </div>

        <!-- Ukupno -->
        <div class="text-right text-lg mt-6 font-semibold text-green-400">
          {{ $t('checkout.total') }}: {{ formatPrice(totalAmount) }}
        </div>

        <!-- Plaćanje / Faktura -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-6">
          <button
            @click="handleStripeCheckout"
            class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded disabled:opacity-50"
            :disabled="processing || totalAmount === 0"
          >
            💳 {{ $t('checkout.payCard') }}
          </button>

          <button
            @click="openInvoiceModal"
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

    <!-- Modal za profakturu -->
    <InvoiceModal
      :visible="showInvoiceModal"
      :items="cartItems"
      :amount="totalAmount"
      @close="closeInvoiceModal"
      @clear-cart="emptyCartAfterInvoice"
      
      :show-close="true"
    />

    <!-- Donji razmak da footer ne “preklopi” sadržaj -->
    <div class="pb-8"></div>

    <Footer />
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
import { useI18n } from 'vue-i18n'

import Header from '@/partials/Header.vue'
import Footer from '@/partials/Footer.vue'
import InvoiceModal from '@/partials/InvoiceModal.vue'

import { useCart } from '@/utils/CartService'
import { track, trackOnce } from '@/utils/analytics'
import api from '@/api/http'

const { t } = useI18n()

const { cart, removeFromCart, clearCart, updateQuantity } = useCart()
const cartItems = computed(() => cart.value || [])
const showInvoiceModal = ref(false)
const processing = ref(false)

onMounted(() => {
  // analitika + ESC za zatvaranje modala
  trackOnce('checkout_started', () => track('Checkout Started'))
  window.addEventListener('keydown', onKey)
})

onBeforeUnmount(() => {
  window.removeEventListener('keydown', onKey)
})

function onKey(e) {
  if (e.key === 'Escape' && showInvoiceModal.value) {
    closeInvoiceModal()
  }
}

const totalAmount = computed(() =>
  (cartItems.value || []).reduce((sum, item) => sum + (item.price * item.quantity), 0)
)

/** Prikaz cene; default RSD za UI (amount u centima; za RSD vizuelno * 117.5) */
function formatPrice(valueCents, currency = 'RSD') {
  const rate = 117.5
  const isRsd = (currency || 'RSD').toUpperCase() === 'RSD'
  const value = isRsd ? (valueCents || 0) * rate : (valueCents || 0)
  return new Intl.NumberFormat('sr-RS', {
    style: 'currency',
    currency: isRsd ? 'RSD' : 'EUR'
  }).format(value / 100)
}

function changeQty(item, diff) {
  const next = Math.max(0, (item.quantity || 0) + diff)
  if (next === 0) {
    removeItem(item.id)
    return
  }
  updateQuantity(item.id, item.variantKey || '', next)
}

function removeItem(id) {
  try {
    removeFromCart(id)
  } catch (e) {
    console.error('Remove item error:', e)
  }
}

function emptyCartAfterInvoice() {
  // dovoljno je samo očistiti store; computed se automatski osvežava
  clearCart()
}

function openInvoiceModal() {
  if (!cartItems.value.length) return
  showInvoiceModal.value = true
}

function closeInvoiceModal() {
  showInvoiceModal.value = false
}

async function handleStripeCheckout() {
  if (!totalAmount.value) {
    alert('❌ ' + (t('checkout.empty') || 'Korpa je prazna.'))
    return
  }
  if (processing.value) return

  processing.value = true
  try {
    const token = 'tok_visa' // Stripe test token
    const res = await api.post('/stripe/checkout', {
      amount: totalAmount.value,   // u centima
      currency: 'eur',
      description: 'ExpressWeb Checkout',
      token
    })

    alert('✅ ' + (t('checkout.paymentSuccess') || `Plaćanje uspešno: ${res?.data?.charge?.id || ''}`))
    track('Payment Success', { method: 'stripe', amount_cents: totalAmount.value })
    clearCart()
  } catch (err) {
    console.error('❌ Stripe greška:', err)
    alert('❌ ' + (t('checkout.paymentFailed') || 'Plaćanje nije uspelo.'))
  } finally {
    processing.value = false
  }
}
</script>
