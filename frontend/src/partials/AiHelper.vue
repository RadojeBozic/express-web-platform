<template>
  <div class="bg-slate-800 text-white p-4 rounded-lg shadow-md relative">
    <div class="flex items-center justify-between mb-2">
      <h3 class="text-lg font-semibold">🤖 {{ t('aihelper.title') || 'AI predlog' }}</h3>

      <!-- Kopiraj dugme, pojavljuje se kad ima rezultata -->
      <button
        v-if="suggestion"
        class="px-3 py-1 text-xs bg-slate-700 hover:bg-slate-600 rounded cursor-pointer"
        type="button"
        @click="copyToClipboard"
        :title="t('aihelper.copy') || 'Kopiraj'"
        :aria-label="t('aihelper.copy') || 'Kopiraj'"
      >
        {{ copied ? (t('aihelper.copied') || 'Kopirano!') : (t('aihelper.copy') || 'Kopiraj') }}
      </button>
    </div>

    <button
      class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded text-white text-sm cursor-pointer disabled:opacity-50"
      type="button"
      @click="generateSuggestion"
      :disabled="loading"
      :aria-busy="loading ? 'true' : 'false'"
      :aria-label="loading ? (t('aihelper.generating') || 'Generišem…') : (t('aihelper.request') || 'Zatraži predlog')"
    >
      {{ loading ? (t('aihelper.generating') || 'Generišem…') : (t('aihelper.request') || 'Zatraži predlog') }}
    </button>

    <div v-if="suggestion" class="mt-4 bg-slate-700 p-3 rounded relative">
      <p class="text-sm whitespace-pre-line">{{ suggestion }}</p>

      <div class="mt-2 text-xs text-slate-300 flex items-center gap-2">
        <span v-if="cached">⚡ {{ t('aihelper.cached') || 'Odgovor iz keša (12h)' }}</span>
      </div>

      <button
        type="button"
        @click="suggestion = ''"
        class="absolute top-2 right-2 text-xs text-red-400 hover:text-red-200"
        :title="t('aihelper.close') || 'Zatvori'"
        :aria-label="t('aihelper.close') || 'Zatvori'"
      >
        ✖
      </button>
    </div>

    <div v-if="error" class="mt-2 text-red-400 text-sm">⚠️ {{ error }}</div>
  </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import api from '@/api/http' // baseURL = /api

const { t } = useI18n()

const props = defineProps({
  prompt: { type: String, required: true }
})
const emit = defineEmits(['result'])

const suggestion = ref('')
const loading = ref(false)
const error = ref('')
const cached = ref(false)
const copied = ref(false)

// backend limit je 1000, pa ovde bezbedno skraćujemo
const cleanPrompt = computed(() => (props.prompt || '').trim().slice(0, 1000))

watch(() => props.prompt, () => {
  // resetuj state kad se prompt znatno promeni
  error.value = ''
  copied.value = false
})

async function generateSuggestion() {
  error.value = ''
  suggestion.value = ''
  cached.value = false
  copied.value = false

  if (!cleanPrompt.value) {
    error.value = t('aihelper.error') || 'Unesite tekst za predlog.'
    return
  }

  loading.value = true
  try {
    const { data } = await api.post('/ai/suggest', { prompt: cleanPrompt.value })
    const result = (data?.suggestion || '').trim()
    suggestion.value = result || (t('aihelper.noResponse') || 'Nema odgovora.')
    cached.value = !!data?.cached
    emit('result', suggestion.value)
  } catch (err) {
    const status = err?.response?.status
    if (status === 429) {
      error.value = t('aihelper.limit') || 'Dostigli ste dnevni AI limit.'
    } else if (status === 403) {
      error.value = t('aihelper.planRestriction') || 'Ova AI funkcija nije dostupna za vaš plan.'
    } else {
      error.value = t('aihelper.error') || 'Greška u komunikaciji sa AI.'
    }
    console.error('❌ AI error:', err)
  } finally {
    loading.value = false
  }
}

async function copyToClipboard() {
  if (!suggestion.value) return
  try {
    await navigator.clipboard.writeText(suggestion.value)
    copied.value = true
    setTimeout(() => (copied.value = false), 1500)
  } catch {
    // fallback
    const area = document.createElement('textarea')
    area.value = suggestion.value
    document.body.appendChild(area)
    area.select()
    document.execCommand('copy')
    document.body.removeChild(area)
    copied.value = true
    setTimeout(() => (copied.value = false), 1500)
  }
}
</script>
