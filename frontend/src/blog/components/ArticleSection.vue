<script setup>
defineProps({
  title: {
    type: String,
    default: '',
  },

  lead: {
    type: Boolean,
    default: false,
  },
})
</script>

<template>
  <section class="mb-12 last:mb-0">
    <h2
      v-if="title"
      class="mb-5 text-2xl font-bold leading-tight text-white sm:text-3xl"
    >
      {{ title }}
    </h2>

    <div
      class="space-y-5 leading-8"
      :class="
        lead
          ? 'text-lg text-slate-200 sm:text-xl'
          : 'text-base text-slate-300 sm:text-lg'
      "
    >
      <slot />
    </div>
  </section>
</template>