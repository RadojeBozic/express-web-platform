// src/i18n/index.js
import { createI18n } from 'vue-i18n'

import sr from './locales/sr.json'
import en from './locales/en.json'

const defaultLocale = localStorage.getItem('locale') || 'sr'

const i18n = createI18n({
  legacy: false,
  locale: defaultLocale,
  fallbackLocale: 'sr',
  globalInjection: true,
  messages: {
    sr,
    en
  }
})

export default i18n
