// src/utils/CartService.js
import { ref, watch, computed } from 'vue'

/** Verzija šeme u localStorage — ako menjaš strukturu item-a, povisi broj i migriraj ispod */
const CART_VERSION = 1
const STORAGE_KEY = 'express_cart'

function safeParse(json, fallback) {
  try { return JSON.parse(json) ?? fallback } catch { return fallback }
}
function canUseStorage() {
  try {
    if (typeof window === 'undefined') return false
    const t = '__cart_test__'
    localStorage.setItem(t, '1'); localStorage.removeItem(t)
    return true
  } catch { return false }
}
const storageOK = canUseStorage()

function loadInitial() {
  if (!storageOK) return { version: CART_VERSION, items: [] }
  const raw = localStorage.getItem(STORAGE_KEY)
  const payload = safeParse(raw, null)
  if (!payload || typeof payload !== 'object') return { version: CART_VERSION, items: [] }

  // (Po potrebi migracije između verzija)
  if (payload.version !== CART_VERSION) {
    return { version: CART_VERSION, items: Array.isArray(payload.items) ? payload.items : [] }
  }
  return { version: CART_VERSION, items: Array.isArray(payload.items) ? payload.items : [] }
}

const state = ref(loadInitial())

/** Globalni, reaktivan niz item-a */
const cart = computed({
  get: () => state.value.items,
  set: (arr) => { state.value.items = Array.isArray(arr) ? arr : [] }
})

/** Ukupan broj proizvoda */
const totalItems = computed(() =>
  cart.value.reduce((sum, i) => sum + (parseInt(i.quantity, 10) || 0), 0)
)

/** Ukupna cena u centima */
const totalPrice = computed(() =>
  cart.value.reduce((sum, i) => sum + (Math.round(Number(i.price) || 0) * (parseInt(i.quantity, 10) || 0)), 0)
)

/** Dohvati kopiju korpe (ne reaktivnu) */
function getCart() {
  return cart.value.map(i => ({ ...i }))
}

/** Helper: bezbedan upis u storage */
function persist() {
  if (!storageOK) return
  try {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(state.value))
  } catch {
    // ignore quota / privacy errors
  }
}

/** Emit event (za legacy UI/mini widgete i jednostavnije hookove) */
function emitCartUpdated() {
  try {
    const detail = { items: getCart(), totalItems: totalItems.value, totalPrice: totalPrice.value }
    window.dispatchEvent(new CustomEvent('cart-updated', { detail }))
  } catch { /* no-op (SSR / CSP) */ }
}

/** Identifikuj item po (id, variantKey) da bismo podržali varijante istog proizvoda */
function keyOf(item) {
  const id = item?.id ?? ''
  const variant = item?.variantKey ?? '' // npr. boja/veličina
  return `${id}::${variant}`
}

/** Saniraj vrednosti (količina min 1, cena u centima int) */
function normalize(item) {
  const quantity = Math.max(1, parseInt(item?.quantity ?? 1, 10) || 1)
  const priceCents = Math.max(0, Math.round(Number(item?.price ?? 0)))
  return { ...item, quantity, price: priceCents }
}

/** Dodaj ili spoji item */
function addToCart(rawItem) {
  const item = normalize(rawItem)
  const k = keyOf(item)
  const idx = cart.value.findIndex(p => keyOf(p) === k)
  if (idx >= 0) {
    cart.value[idx] = normalize({ ...cart.value[idx], quantity: cart.value[idx].quantity + (item.quantity || 1) })
  } else {
    cart.value = [...cart.value, item]
  }
}

/** Postavi tačnu količinu (min 1); ako postaviš 0, uklanja item */
function updateQuantity(id, variantKey = '', qty = 1) {
  const k = `${id}::${variantKey || ''}`
  const idx = cart.value.findIndex(p => keyOf(p) === k)
  if (idx < 0) return
  const q = Math.max(0, parseInt(qty, 10) || 0)
  if (q === 0) {
    removeFromCart(id, variantKey)
  } else {
    cart.value[idx] = { ...cart.value[idx], quantity: q }
  }
}

/** Ukloni po (id, variantKey) */
function removeFromCart(id, variantKey = '') {
  const k = `${id}::${variantKey || ''}`
  cart.value = cart.value.filter(item => keyOf(item) !== k)
}

/** Isprazni korpu */
function clearCart() {
  cart.value = []
}

/** Zameni celu korpu (npr. restore iz backenda) */
function replaceCart(items = []) {
  cart.value = (Array.isArray(items) ? items : []).map(normalize)
}

/** Auto-persist (+ emit) — debounce-ovan microtaskom */
let persistQueued = false
watch(state, () => {
  if (persistQueued) return
  persistQueued = true
  queueMicrotask(() => {
    persist()
    emitCartUpdated()
    persistQueued = false
  })
}, { deep: true })

/** Cross-tab sinhronizacija (+ emit) */
if (storageOK) {
  window.addEventListener('storage', (e) => {
    if (e.key === STORAGE_KEY && e.newValue) {
      const next = safeParse(e.newValue, null)
      if (next && next.version === CART_VERSION && Array.isArray(next.items)) {
        state.value = next
        emitCartUpdated()
      }
    }
  })
}

/** Public API (Composition stil) */
export function useCart() {
  return {
    cart,
    addToCart,
    updateQuantity,
    removeFromCart,
    clearCart,
    replaceCart,
    getCart,
    totalItems,
    totalPrice,
  }
}

/** Named exports za Options API / van setup-a */
export {
  cart,
  addToCart,
  updateQuantity,
  removeFromCart,
  clearCart,
  replaceCart,
  getCart,
  totalItems,
  totalPrice,
}

/** Optional: helpers za lakši subscribe/unsubscribe iz vanilla delova */
export function onCartUpdated(handler) {
  window.addEventListener('cart-updated', handler)
  // po inicijali da dobiješ trenutni state
  handler({ detail: { items: getCart(), totalItems: totalItems.value, totalPrice: totalPrice.value } })
}
export function offCartUpdated(handler) {
  window.removeEventListener('cart-updated', handler)
}
