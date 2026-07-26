<template>
  <div class="bg-slate-800 text-white p-4 rounded-lg shadow-md relative">
    <h3 class="text-lg font-semibold mb-2">🤖 {{ t('aihelper.title') }}</h3>

    <button
      class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded text-white text-sm cursor-pointer disabled:opacity-50"
      @click="generateSuggestion"
      :disabled="loading"
      :aria-busy="loading ? 'true' : 'false'"
      :aria-label="loading ? t('aihelper.generating') : t('aihelper.request')"
    >
      {{ loading ? t('aihelper.generating') : t('aihelper.request') }}
    </button>

    <div v-if="suggestion" class="mt-4 bg-slate-700 p-3 rounded relative">
      <p class="text-sm whitespace-pre-line">{{ suggestion }}</p>

      <button
        @click="suggestion = ''"
        class="absolute top-2 right-2 text-xs text-red-400 hover:text-red-200"
        :title="t('aihelper.close')"
        aria-label="Close"
      >
        ✖
      </button>
    </div>

    <div v-if="error" class="mt-2 text-red-400 text-sm">⚠️ {{ error }}</div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()

const props = defineProps({
  prompt: { type: String, required: true }
})

const baseURL = import.meta.env.VITE_API_URL?.replace(/\/+$/, '') || ''
const api = axios.create({ baseURL })

const suggestion = ref('')
const loading = ref(false)
const error = ref('')

const cleanPrompt = computed(() => (props.prompt || '').trim())

async function generateSuggestion() {
  error.value = ''
  suggestion.value = ''

  if (!cleanPrompt.value) {
    error.value = t('aihelper.error')
    return
  }

  loading.value = true
  try {
    const { data } = await api.post('/ai/suggest', { prompt: cleanPrompt.value })
    const result = (data?.suggestion || '').trim()
    suggestion.value = result || t('aihelper.noResponse')
  } catch (err) {
    const status = err?.response?.status
    if (status === 429) error.value = t('aihelper.limit')
    else if (status === 403) error.value = t('aihelper.planRestriction')
    else error.value = t('aihelper.error')
    console.error('❌ AI error:', err)
  } finally {
    loading.value = false
  }
}
</script>
