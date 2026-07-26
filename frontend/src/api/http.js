import axios from 'axios'

// BASE URLS
const isBrowser = typeof window !== 'undefined'
const isLocal   = isBrowser && /(localhost|127\.0\.0\.1)/.test(window.location.hostname)
const RUNTIME_API = isBrowser && window.__API_BASE_URL
const RUNTIME_WEB = isBrowser && window.__WEB_BASE_URL

const API_BASE =
  RUNTIME_API ||
  import.meta.env?.VITE_API_URL ||
  (isLocal ? 'http://localhost:8000/api' : '/api')

const WEB_BASE =
  RUNTIME_WEB ||
  import.meta.env?.VITE_WEB_BASE_URL ||
  (isLocal ? 'http://localhost:8000' : '/')

// INSTANCES
export const web = axios.create({
  baseURL: WEB_BASE,
  withCredentials: true,
  headers: {
    Accept: 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
    'Accept-Language': isBrowser ? (navigator.language || 'en') : 'en',
  },
})

export const api = axios.create({
  baseURL: API_BASE,
  withCredentials: true,
  headers: {
    Accept: 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
    'Accept-Language': isBrowser ? (navigator.language || 'en') : 'en',
  },
})

for (const c of [web, api]) {
  c.defaults.xsrfCookieName = 'XSRF-TOKEN'
  c.defaults.xsrfHeaderName = 'X-XSRF-TOKEN'
}

// CSRF COOKIE
export function getCsrfCookie() {
  return web.get('/sanctum/csrf-cookie', { withCredentials: true })
}

// XSRF HEADER from cookie (edge slučajevi)
function attachXsrf(config) {
  try {
    if (isBrowser) {
      const m = document.cookie.match(/(?:^|;\s*)XSRF-TOKEN=([^;]+)/)
      if (m) config.headers['X-XSRF-TOKEN'] = decodeURIComponent(m[1])
    }
  } catch {}
  return config
}
web.interceptors.request.use(attachXsrf)
api.interceptors.request.use(attachXsrf)

// DEV logger + 419 retry
const DEV = import.meta.env?.DEV === true
for (const c of [web, api]) {
  c.interceptors.response.use(
    (r) => {
      if (DEV) console.log(`✅ ${r.config.method?.toUpperCase()} ${r.config.url} → ${r.status}`)
      return r
    },
    async (e) => {
      if (DEV) console.error(`❌ ${e.config?.method?.toUpperCase()} ${e.config?.url} → ${e.response?.status}`)
      const status = e?.response?.status
      const cfg    = e?.config
      const canRetry = status === 419 && cfg && !cfg.__csrfRetried
      if (canRetry) {
        try {
          await getCsrfCookie()
          cfg.__csrfRetried = true
          return (cfg.baseURL === API_BASE ? api : web).request(cfg)
        } catch {}
      }
      return Promise.reject(e)
    }
  )
}

// /api/user bez “crvenila” kad nisi logovan
export async function getCurrentUserSafe() {
  try {
    const { data } = await api.get('/user')
    return data
  } catch (e) {
    if (e?.response?.status === 401) return null
    throw e
  }
}

export default api
