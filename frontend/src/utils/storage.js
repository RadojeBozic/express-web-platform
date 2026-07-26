// src/utils/storage.js

function canUseStorage() {
  try {
    if (typeof window === 'undefined') return false
    const testKey = '__storage_test__'
    localStorage.setItem(testKey, '1')
    localStorage.removeItem(testKey)
    return true
  } catch {
    return false
  }
}

const storageOK = canUseStorage()

export function readJSON(key, fallback = null) {
  if (!storageOK) return fallback
  try {
    const raw = localStorage.getItem(key)
    if (!raw) return fallback
    return JSON.parse(raw)
  } catch {
    // korumpiran unos — obriši ga
    try { localStorage.removeItem(key) } catch {}
    return fallback
  }
}

export function writeJSON(key, value) {
  if (!storageOK) return
  try {
    localStorage.setItem(key, JSON.stringify(value))
  } catch {
    // quota exceeded ili privacy mode
  }
}

export function removeKey(key) {
  if (!storageOK) return
  try { localStorage.removeItem(key) } catch {}
}

export function clearAuth() {
  removeKey('user')
  removeKey('token')
}
