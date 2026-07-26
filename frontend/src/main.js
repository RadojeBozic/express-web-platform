// src/main.js
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import i18n from './i18n/index.js'

// ❌ NEMA više globalnog axios-a ovde
// import axios from 'axios'  // remove

import 'aos/dist/aos.css'
import './css/style.css'

// ✅ Ako želiš samo "bootstrap" naše axios instance (nije obavezno)
// import '@/api/http'

// ---------- Plausible (samo u production) ----------
if (import.meta.env.PROD) {
  const s = document.createElement('script')
  s.defer = true
  s.setAttribute('data-domain', 'express-web.express') // promeni ako je drugi domen u prod
  s.src = 'https://plausible.io/js/script.js'
  document.head.appendChild(s)
}

const app = createApp(App)
app.use(router)
app.use(i18n)

// SPA pageview za Plausible nakon svake navigacije
router.afterEach(() => {
  setTimeout(() => {
    if (typeof window !== 'undefined' && typeof window.plausible === 'function') {
      window.plausible('pageview')
    }
  }, 0)
})

app.mount('#app')

// Ako ti baš treba this.$axios u Options API, onda dodaj:
// import api from '@/api/http'
// app.config.globalProperties.$api = api
