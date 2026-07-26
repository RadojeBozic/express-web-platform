<template>
  <div v-if="visible" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-slate-800 text-white rounded-lg p-6 w-full max-w-lg shadow-lg relative">
      <h2 class="text-2xl font-bold mb-4 text-center">{{ $t('invoice.title') }}</h2>

      <!-- Forma -->
      <form @submit.prevent="submitForm" class="space-y-4">
        <div>
          <label class="block text-sm mb-1">{{ $t('invoice.form.name') }}</label>
          <input v-model="form.name" required class="w-full rounded px-3 py-2 text-black" />
        </div>

        <div>
          <label class="block text-sm mb-1">{{ $t('invoice.form.email') }}</label>
          <input v-model="form.email" required type="email" class="w-full rounded px-3 py-2 text-black" />
        </div>

        <div>
          <label class="block text-sm mb-1">{{ $t('invoice.form.currency') }}</label>
          <select v-model="form.currency" class="w-full rounded px-3 py-2 text-black">
            <option value="rsd">{{ $t('invoice.currency.rsd') }}</option>
            <option value="eur">{{ $t('invoice.currency.eur') }}</option>
          </select>
        </div>

        <div>
          <label class="block text-sm mb-1">{{ $t('invoice.form.description') }}</label>
          <textarea
            v-model="form.description"
            rows="3"
            class="w-full rounded px-3 py-2 text-black"
            :placeholder="$t('invoice.form.descriptionPlaceholder')"
          ></textarea>
        </div>

        <!-- Pregled stavki -->
        <div v-if="items && items.length" class="bg-slate-900 border border-slate-700 rounded p-3">
          <div class="text-sm font-semibold mb-2">{{ $t('invoice.items.title') }}</div>
          <ul class="space-y-1 text-sm">
            <li v-for="(it, idx) in items" :key="idx" class="flex justify-between">
              <span>{{ it.name }} — {{ it.quantity }} × {{ formatPrice(it.price, currencyForDisplay) }}</span>
              <span class="text-slate-300">{{ formatPrice(it.price * it.quantity, currencyForDisplay) }}</span>
            </li>
          </ul>
          <div class="mt-3 text-right text-green-400 font-semibold">
            {{ $t('invoice.items.total') }}: {{ prettyTotal }}
          </div>
        </div>

        <div v-else class="text-sm text-slate-400">
          {{ $t('invoice.amountLabel') }}
          <span class="text-green-400 font-semibold">{{ formatPrice(amount, form.currency) }}</span>
        </div>

        <div class="flex justify-end gap-2 mt-6">
          <button type="button" @click="close" class="px-4 py-2 bg-slate-600 hover:bg-slate-700 rounded text-sm">
            {{ $t('common.cancel') }}
          </button>
          <button :disabled="loading" type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded text-sm">
            {{ loading ? $t('common.sending') : $t('invoice.submit') }}
          </button>
        </div>
      </form>

      <div v-if="createdInvoiceId" class="mt-4 text-center">
        <a
          :href="`http://localhost:8080/api/invoice-request/${createdInvoiceId}/pdf`"
          target="_blank"
          class="text-sm text-purple-400 hover:underline inline-block"
        >
          📄 {{ $t('invoice.downloadPdf') }}
        </a>
      </div>

      <hr class="my-4 border-slate-700" />
      <div class="text-xs text-slate-400">
        <p><strong>{{ $t('invoice.issuer.title') }}</strong> {{ $t('invoice.issuer.name') }}</p>
        <p>{{ $t('invoice.issuer.address') }}</p>
        <p>{{ $t('invoice.issuer.ids') }}</p>
        <p>{{ $t('invoice.issuer.account') }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import { useI18n } from 'vue-i18n'
import { track } from '@/utils/analytics' // Plausible helper

const { t } = useI18n()

const props = defineProps({
  visible: { type: Boolean, default: false },
  amount: { type: Number, default: 0 },        // u centima
  items: { type: Array, default: () => [] },    // [{ id, name, quantity, price(cents) }]
})

const emit = defineEmits(['close', 'clear-cart'])

const form = ref({
  name: '',
  email: '',
  currency: 'rsd',     // 'rsd' | 'eur'
  description: ''
})

const loading = ref(false)
const createdInvoiceId = ref(null)

const currencyForDisplay = computed(() => form.value.currency)

const totalCents = computed(() => {
  return (props.items && props.items.length)
    ? props.items.reduce((sum, it) => sum + (it.price * it.quantity), 0)
    : (props.amount || 0)
})

const prettyTotal = computed(() => formatPrice(totalCents.value, currencyForDisplay.value))

function formatPrice(amountCents, currency) {
  // samo vizuelna konverzija: RSD ≈ EUR * 117.5
  const rate = 117.5
  const value = currency === 'rsd' ? amountCents * rate : amountCents
  return new Intl.NumberFormat('sr-RS', {
    style: 'currency',
    currency: currency === 'rsd' ? 'RSD' : 'EUR'
  }).format((value || 0) / 100)
}

function close() {
  createdInvoiceId.value = null
  emit('close')
}

async function submitForm() {
  if (loading.value) return
  try {
    loading.value = true
    createdInvoiceId.value = null

    const hasItems = !!(props.items && props.items.length)

    const payload = {
      name: form.value.name.trim(),
      email: form.value.email.trim(),
      currency: form.value.currency, // 'rsd' | 'eur'
      description: form.value.description?.trim() || null,
      ...(hasItems
        ? {
            items: props.items.map(i => ({
              name: i.name,
              qty: i.quantity,
              unit_price_cents: i.price
            }))
          }
        : {
            items: [
              { name: 'Poručene usluge', qty: 1, unit_price_cents: props.amount || 0 }
            ]
          }
      )
    }

    // koristi axios.defaults.baseURL iz main.js
    const res = await axios.post('/invoice-request', payload)
    const id = res?.data?.invoice?.id
    if (id) createdInvoiceId.value = id

    alert('✅ ' + t('invoice.alert.success'))

    // Plausible event (cookieless)
    track('Invoice Requested', { currency: form.value.currency })

    // Isprazni korpu u parent-u
    emit('clear-cart')

  } catch (err) {
    console.error('❌ Greška prilikom slanja:', err)
    alert('❌ ' + t('invoice.alert.error'))
  } finally {
    loading.value = false
  }
}
</script>
