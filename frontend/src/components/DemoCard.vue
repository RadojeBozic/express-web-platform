<template>
  <div class="bg-slate-800 rounded-lg overflow-hidden shadow-md mb-12">
    <div class="p-6 border-b border-slate-700">
      <h2 class="text-xl font-bold text-white mb-2">{{ title }}</h2>
      <p class="text-slate-400 text-sm">{{ description }}</p>
    </div>

    <!-- Prikaz demo prezentacije -->
    <div class="aspect-video bg-black">
      <iframe
        :src="demoUrl"
        frameborder="0"
        class="w-full h-full rounded-b-lg"
        allowfullscreen
      ></iframe>
    </div>

    <div class="p-6 border-t border-slate-700 text-center">
      <router-link
        :to="redirectPath"
        class="inline-block px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded text-sm transition"
      >
        {{ isAuthenticated ? 'Idi na Dashboard' : 'Registruj se besplatno' }}
      </router-link>
    </div>
  </div>
</template>

<script>
import { isAuthenticated } from '../utils/auth'

export default {
  name: 'DemoCard',
  props: {
    title: String,
    description: String,
    template: String, // npr. 'klasicni'
    type: String      // 'free' | 'pro' | 'active'
  },
  computed: {
    demoUrl() {
      return `/prezentacije/demo-${this.template}-${this.type}`
    },
    redirectPath() {
      return isAuthenticated() ? '/dashboard' : '/signup'
    },
    isAuthenticated() {
      return isAuthenticated()
    }
  }
}
</script>
