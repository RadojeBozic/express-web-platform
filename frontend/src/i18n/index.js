// src/i18n/index.js
import { createI18n } from 'vue-i18n'

import sr from './locales/sr.json'
import en from './locales/en.json'
import de from './locales/de.json'

const defaultLocale = localStorage.getItem('locale') || 'sr'

const i18n = createI18n({
  legacy: false,
  locale: defaultLocale,
  fallbackLocale: 'sr',
  globalInjection: true,
  messages: {
    sr,
    en,
    de
  }
})

export default i18n
