<script setup>
defineProps({
  title: {
    type: String,
    default: '',
  },

  type: {
    type: String,
    default: 'info',
  },
})

const variants = {
  info: {
    wrapper:
      'border-purple-500/30 bg-purple-500/10',
    icon:
      'bg-purple-500 text-white',
  },

  success: {
    wrapper:
      'border-emerald-500/30 bg-emerald-500/10',
    icon:
      'bg-emerald-500 text-white',
  },

  warning: {
    wrapper:
      'border-amber-500/30 bg-amber-500/10',
    icon:
      'bg-amber-500 text-slate-900',
  },
}
</script>

<template>
  <aside
    class="my-10 rounded-2xl border p-6"
    :class="variants[type]?.wrapper"
  >
    <div class="flex items-start gap-5">
      <div
        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full text-lg font-bold"
        :class="variants[type]?.icon"
      >
        !
      </div>

      <div class="min-w-0">
        <h3
          v-if="title"
          class="mb-3 text-lg font-semibold text-white"
        >
          {{ title }}
        </h3>

        <div
          class="space-y-4 leading-7 text-slate-200"
        >
          <slot />
        </div>
      </div>
    </div>
  </aside>
</template>