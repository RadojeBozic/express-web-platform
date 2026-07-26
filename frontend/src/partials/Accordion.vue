<template>
  <div class="border border-slate-700 rounded-lg">
    <button
      class="w-full text-left px-4 py-3 font-medium text-white bg-slate-800 hover:bg-slate-700 transition"
      @click="isOpen = !isOpen"
      :aria-expanded="isOpen.toString()"
    >
      {{ title }}
    </button>
    <div v-show="isOpen" class="px-4 py-3 text-slate-400 border-t border-slate-700">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: 'Accordion',
  props: {
    title: {
      type: String,
      required: true,
    },
    active: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      isOpen: this.active,
    }
  },
}
</script>
