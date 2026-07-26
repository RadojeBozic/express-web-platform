<template>
  <div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50">
    <!-- Tooltip balon (desktop hint) -->
    <transition name="fade">
      <div
        v-if="showTooltip"
        class="absolute right-16 bottom-3 bg-slate-800 text-white text-xs px-3 py-2 rounded shadow-md max-w-[220px] relative"
      >
        <span class="block">{{ t('chat.tooltip') }}</span>
        <div class="absolute top-1/2 right-[-8px] -translate-y-1/2 w-0 h-0 border-y-8 border-y-transparent border-l-8 border-l-slate-800"></div>
      </div>
    </transition>

    <!-- Dugme za otvaranje -->
    <button
      @click="toggleChat"
      class="bg-purple-600 text-white p-3 rounded-full shadow-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-purple-400"
      :aria-expanded="visible ? 'true' : 'false'"
      :aria-controls="'chat-panel'"
      aria-label="Open chat"
    >
      💬
    </button>

    <!-- Chat panel -->
    <div
      v-if="visible && enabled"
      :id="'chat-panel'"
      class="bg-white w-[90vw] max-w-[22rem] sm:w-96 h-[70vh] sm:h-[420px] rounded shadow-lg overflow-hidden flex flex-col"
      role="dialog"
      :aria-label="t('chat.title')"
    >
      <div class="bg-purple-700 text-white px-4 py-2 font-semibold flex items-center justify-between">
        <span>{{ t('chat.title') }}</span>
        <button
          class="text-white/90 hover:text-white text-sm"
          @click="toggleChat"
          aria-label="Close chat"
        >✖</button>
      </div>

      <div class="flex-1 p-3 overflow-y-auto text-sm text-gray-800 space-y-2">
        <div
          v-for="(msg, index) in messages"
          :key="index"
          class="rounded px-2 py-1"
          :class="msg.role === 'user' ? 'bg-gray-100 self-end' : 'bg-purple-50'"
        >
          <strong>{{ msg.role === 'user' ? t('chat.userLabel') : t('chat.assistantLabel') }}:</strong>
          <span class="ml-1">{{ msg.content }}</span>
        </div>
      </div>

      <form @submit.prevent="sendMessage" class="p-2 border-t border-gray-200 flex gap-2">
        <input
          v-model="input"
          class="flex-1 border rounded px-2 py-2 text-sm text-black bg-white"
          :placeholder="t('chat.inputPlaceholder')"
          autocomplete="off"
          @keydown.enter.exact.prevent="sendMessage"
        />
        <button
          type="submit"
          class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 text-sm rounded disabled:opacity-50"
          :disabled="sending"
        >
          {{ t('chat.buttonSend') }}
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useI18n } from 'vue-i18n'
import api from '@/api/http' // ✅ centralna axios instanca (baseURL=/api + interceptor)

const { t } = useI18n()

// Feature flagovi iz .env.production (opciono)
const enabled = (import.meta.env.VITE_CHAT_ENABLED ?? 'true') === 'true'
const autoOpen = (import.meta.env.VITE_CHAT_AUTO_OPEN ?? 'false') === 'true'

const visible = ref(false)
const showTooltip = ref(false)
const input = ref('')
const sending = ref(false)

const messages = ref([
  { role: 'assistant', content: t('chat.default') }
])

function toggleChat() {
  visible.value = !visible.value
  showTooltip.value = false
}

async function sendMessage() {
  const userMsg = input.value.trim()
  if (!userMsg || sending.value) return

  messages.value.push({ role: 'user', content: userMsg })
  input.value = ''
  sending.value = true

  try {
    const { data } = await api.post('/ai/chat', { message: userMsg })
    const reply = data?.reply || t('chat.fallback')
    messages.value.push({ role: 'assistant', content: reply })
  } catch (err) {
    console.error('AI error:', err)
    messages.value.push({ role: 'assistant', content: t('chat.error') })
  } finally {
    sending.value = false
  }
}

onMounted(() => {
  if (!enabled) return

  if (autoOpen) visible.value = true

  // Prikaži mali tooltip SAMO na desktopu, max 1x / 24h
  const isDesktop = window.matchMedia('(min-width: 768px)').matches
  const lastTip = Number(localStorage.getItem('chat_tip_ts') || 0)
  const dayMs = 24 * 60 * 60 * 1000

  if (isDesktop && Date.now() - lastTip > dayMs) {
    showTooltip.value = true
    localStorage.setItem('chat_tip_ts', String(Date.now()))
    setTimeout(() => (showTooltip.value = false), 4000)
  }
})
</script>

<style scoped>
.fade-enter-active, .fade-leave-active { transition: opacity 0.4s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
</style>
