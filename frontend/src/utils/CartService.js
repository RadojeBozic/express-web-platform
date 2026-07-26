// src/utils/CartService.js

import { ref, watch } from 'vue'

// 🔐 Lokalni ključ za čuvanje korpe
const STORAGE_KEY = 'express_cart'

// 🔁 Reaktivan cart – učitavamo iz localStorage ako postoji
const cart = ref(JSON.parse(localStorage.getItem(STORAGE_KEY)) || [])

// 🔄 Čuvamo promene automatski u localStorage
watch(cart, (newCart) => {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(newCart))
}, { deep: true })

// 📥 Dodaj proizvod u korpu
function addToCart(item) {
  const existing = cart.value.find(p => p.id === item.id)
  if (existing) {
    existing.quantity += item.quantity || 1
  } else {
    cart.value.push({ ...item, quantity: item.quantity || 1 })
  }
}

// ❌ Ukloni proizvod po ID
function removeFromCart(id) {
  cart.value = cart.value.filter(item => item.id !== id)
}

// 🧹 Isprazni korpu
function clearCart() {
  cart.value = []
}

// 🔢 Ukupan broj proizvoda u korpi
function totalItems() {
  return cart.value.reduce((sum, item) => sum + item.quantity, 0)
}

// 💰 Ukupna cena korpe
function totalPrice() {
  return cart.value.reduce((sum, item) => sum + item.price * item.quantity, 0)
}

// 📤 Dohvatanje trenutne korpe
function getCart() {
  return cart.value
}

// ✅ Kompozabilna funkcija za import
export function useCart() {
  return {
    cart,
    addToCart,
    removeFromCart,
    clearCart,
    totalItems,
    totalPrice
  }
}

// ⚙️ Alternativni pristup za ne-setup fajlove (ako ti ikad zatreba)
export {
  addToCart,
  removeFromCart,
  clearCart,
  getCart,
  totalItems,
  totalPrice
}
