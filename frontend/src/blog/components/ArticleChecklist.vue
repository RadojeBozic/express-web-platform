<script setup>
defineProps({
  items: {
    type: Array,
    required: true,
  },

  title: {
    type: String,
    default: '',
  },

  ordered: {
    type: Boolean,
    default: false,
  },
})
</script>

<template>
  <section class="my-10">
    <h3
      v-if="title"
      class="mb-5 text-xl font-semibold text-white sm:text-2xl"
    >
      {{ title }}
    </h3>

    <component
      :is="ordered ? 'ol' : 'ul'"
      class="space-y-4"
    >
      <li
        v-for="(item, index) in items"
        :key="`${index}-${item.title || item}`"
        class="flex items-start gap-4 rounded-xl border border-slate-800 bg-slate-900/60 p-4"
      >
        <div
          class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-purple-500/15 text-sm font-bold text-purple-300"
        >
          <span v-if="ordered">
            {{ index + 1 }}
          </span>

          <span v-else aria-hidden="true">
            ✓
          </span>
        </div>

        <div class="min-w-0">
          <template v-if="typeof item === 'string'">
            <p class="leading-7 text-slate-200">
              {{ item }}
            </p>
          </template>

          <template v-else>
            <h4
              v-if="item.title"
              class="font-semibold text-white"
            >
              {{ item.title }}
            </h4>

            <p
              v-if="item.description"
              class="mt-1 leading-7 text-slate-300"
            >
              {{ item.description }}
            </p>
          </template>
        </div>
      </li>
    </component>
  </section>
</template>