<template>
  <div class="relative">
    <router-link to="/checkout" class="relative text-slate-300 hover:text-white">
      🛒
      <span
        v-if="totalItems > 0"
        class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs font-bold px-2 py-0.5 rounded-full"
      >
        {{ totalItems }}
      </span>
    </router-link>
  </div>
</template>

<script>
import { getCart } from '@/utils/CartService'

export default {
  name: 'MiniCart',
  data() {
    return {
      totalItems: 0
    }
  },
  mounted() {
    this.updateCartCount()
    window.addEventListener('cart-updated', this.updateCartCount)
  },
  beforeUnmount() {
    window.removeEventListener('cart-updated', this.updateCartCount)
  },
  methods: {
    updateCartCount() {
      const cart = getCart()
      this.totalItems = cart.reduce((sum, item) => sum + item.quantity, 0)
    }
  }
}
</script>
