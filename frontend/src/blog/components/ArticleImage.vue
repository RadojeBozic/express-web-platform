<script setup>
defineProps({
  src: {
    type: String,
    required: true,
  },

  alt: {
    type: String,
    required: true,
  },

  caption: {
    type: String,
    default: '',
  },

  rounded: {
    type: Boolean,
    default: true,
  },

  shadow: {
    type: Boolean,
    default: true,
  },
})
</script>

<template>
  <figure class="my-12">
    <img
      :src="src"
      :alt="alt"
      loading="lazy"
      class="w-full border border-slate-800 object-cover"
      :class="[
        rounded ? 'rounded-3xl' : '',
        shadow ? 'shadow-2xl' : '',
      ]"
    />

    <figcaption
      v-if="caption"
      class="mt-4 text-center text-sm italic text-slate-400"
    >
      {{ caption }}
    </figcaption>
  </figure>
</template>