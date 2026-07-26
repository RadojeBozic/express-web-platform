<template>
  <div class="relative">
    <router-link to="/checkout" class="relative text-slate-300 hover:text-white" aria-label="Cart">
      🛒
      <!-- <span
        v-if="totalItems > 0"
        class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs font-bold px-2 py-0.5 rounded-full"
      >
        {{ totalItems }}
      </span> -->
      <span v-if="count" class="absolute -top-2 -right-2 bg-purple-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ count }}</span>

    </router-link>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useCart } from '@/utils/CartService'

const { totalItems } = useCart()
const count = computed(() => totalItems?.value || 0)
</script>
