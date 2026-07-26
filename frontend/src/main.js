// C:\xampp\htdocs\expressajt\src\main.js
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import i18n from './i18n/index.js'
import axios from 'axios'

import 'aos/dist/aos.css'
import './css/style.css'

// ---------- Axios globalna podešavanja ----------
axios.defaults.baseURL = import.meta.env.VITE_API_URL || 'http://localhost:8080/api'
// Ako koristiš credentials/cookies prema API-ju, odkomentariši:
// axios.defaults.withCredentials = true

axios.interceptors.request.use(config => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

// (Opcionalno) global error handler za 401/403
// axios.interceptors.response.use(
//   res => res,
//   err => {
//     if (err?.response?.status === 401 || err?.response?.status === 403) {
//       localStorage.removeItem('token')
//       if (router.currentRoute.value.path !== '/signin') router.push('/signin')
//     }
//     return Promise.reject(err)
//   }
// )

// ---------- Plausible (cookieless) samo u production ----------
if (import.meta.env.PROD) {
  const s = document.createElement('script')
  s.defer = true
  s.setAttribute('data-domain', 'express-web.express') // ⇐ zameni ako koristiš drugi domen u prod
  s.src = 'https://plausible.io/js/script.js'
  document.head.appendChild(s)
}

// ---------- Inicijalizacija aplikacije ----------
const app = createApp(App)
app.use(router)
app.use(i18n)

// SPA pageview za Plausible nakon svake navigacije
router.afterEach(() => {
  // Sačekamo microtask da se URL/title stabilizuju
  setTimeout(() => {
    if (typeof window !== 'undefined' && typeof window.plausible === 'function') {
      window.plausible('pageview')
    }
  }, 0)
})

app.mount('#app')

// (Opcionalno) ako želiš da axios bude dostupan kao this.$axios u Options API:
// app.config.globalProperties.$axios = axios

// (Ako ti treba helper)
// export function isAuthenticated() {
//   return !!localStorage.getItem('token')
// }
