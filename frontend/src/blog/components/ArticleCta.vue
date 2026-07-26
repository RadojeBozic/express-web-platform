<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  title: {
    type: String,
    required: true,
  },

  description: {
    type: String,
    required: true,
  },

  primaryText: {
    type: String,
    required: true,
  },

  primaryLink: {
    type: String,
    default: '/contact',
  },

  secondaryText: {
    type: String,
    default: '',
  },

  secondaryLink: {
    type: String,
    default: '',
  },
})
</script>

<template>
  <section
    class="my-16 overflow-hidden rounded-3xl border border-purple-500/20 bg-gradient-to-br from-purple-900/30 via-slate-900 to-slate-950 p-8 shadow-xl"
  >
    <div class="max-w-3xl">
      <h2 class="text-3xl font-bold text-white">
        {{ title }}
      </h2>

      <p class="mt-4 text-lg leading-8 text-slate-300">
        {{ description }}
      </p>

      <div class="mt-8 flex flex-wrap gap-4">
        <RouterLink
          :to="primaryLink"
          class="rounded-xl bg-purple-600 px-6 py-3 font-semibold text-white transition hover:bg-purple-500"
        >
          {{ primaryText }}
        </RouterLink>

        <RouterLink
          v-if="secondaryText"
          :to="secondaryLink"
          class="rounded-xl border border-slate-700 px-6 py-3 font-semibold text-slate-300 transition hover:border-purple-400 hover:text-white"
        >
          {{ secondaryText }}
        </RouterLink>
      </div>
    </div>
  </section>
</template>