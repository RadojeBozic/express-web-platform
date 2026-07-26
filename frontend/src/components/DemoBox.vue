<template>
  <div class="bg-slate-800 rounded-lg shadow-md p-6 flex flex-col justify-between h-full">
    <div>
      <h2 class="text-xl font-bold mb-2 text-white">{{ title }}</h2>
      <p class="text-slate-400 text-sm mb-4">{{ description }}</p>
    </div>
    <component
      :is="isInternal ? 'router-link' : 'a'"
      :to="isInternal ? link : null"
      :href="!isInternal ? link : null"
      target="_blank"
      class="mt-auto inline-block text-center bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded text-sm transition"
    >
      🌐 Pogledaj prezentaciju
    </component>
  </div>
</template>

<script>
export default {
  name: 'DemoBox',
  props: {
    title: String,
    description: String,
    link: String
  },
  computed: {
    isInternal() {
      return this.link.startsWith('/') // `/preview/...`
    }
  }
}
</script>
