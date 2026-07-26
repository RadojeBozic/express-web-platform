<template>
  <div class="bg-slate-900 text-white p-6 min-h-screen">
    <h1 class="text-2xl font-bold mb-4">🎨 Izaberi svoj šablon</h1>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="template in templates"
        :key="template.id"
        class="border border-slate-700 rounded shadow hover:border-purple-500 transition"
      >
        <img :src="template.previewImage" alt="" class="w-full h-32 object-cover rounded-t" />
        <div class="p-4 space-y-2">
          <h2 class="text-lg font-semibold">{{ template.name }}</h2>
          <p class="text-sm text-slate-400">{{ template.category }}</p>
          <div class="flex justify-between items-center mt-2">
            <label class="flex items-center space-x-2">
              <input
                type="radio"
                :value="template.id"
                v-model="selectedTemplate"
                class="form-radio"
              />
              <span class="text-sm">Izaberi</span>
            </label>
            <router-link
              :to="'/preview/' + template.id"
              class="text-purple-400 hover:underline text-sm"
            >
              Pregled
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-8">
      <button
        class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded"
        @click="confirmChoice"
        :disabled="!selectedTemplate"
      >
        Potvrdi izbor
      </button>
    </div>
          <router-link
        to="/free-site-form"
        class="mb-6 inline-block bg-slate-700 text-white font-semibold px-4 py-2 rounded hover:bg-slate-600 transition"
      >
        ← Povratak na formu
      </router-link>
  </div>
</template>

<script>
import templates from '../data/templates.json'

export default {
  name: 'SelectTemplate',
  data() {
    return {
      templates,
      selectedTemplate: null
    }
  },
  methods: {
    confirmChoice() {
      // upiši izbor u lokalStorage (ili prosledi roditeljskoj formi preko Vuex / props / query param)
      localStorage.setItem('selectedTemplate', this.selectedTemplate)
      this.$router.push('/free-site-form')
    }
  }
}
</script>
