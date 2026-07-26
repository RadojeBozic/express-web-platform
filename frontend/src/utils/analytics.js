// src/utils/analytics.js

// Bezbedno proveri da li je Plausible spreman
function hasPlausible() {
  return typeof window !== 'undefined' && typeof window.plausible === 'function'
}

/**
 * Pageview (ručno, ako želiš)
 * Inače već šaljemo preko router.afterEach u main.js
 */
export function trackPageview() {
  if (hasPlausible()) window.plausible('pageview')
}

/**
 * Event sa opcionim props
 * @param {string} name - npr. "Invoice Requested"
 * @param {object} [props] - npr. { currency: 'rsd' }
 */
export function track(name, props) {
  if (!hasPlausible()) return
  if (props && Object.keys(props).length) {
    window.plausible(name, { props })
  } else {
    window.plausible(name)
  }
}

/**
 * Helper za once-per-session (sprečava dupli event)
 * @param {string} key - unikatni ključ
 * @param {() => void} fn - callback koji šalje event(e)
 */
export function trackOnce(key, fn) {
  try {
    const storageKey = `plausible_once_${key}`
    if (sessionStorage.getItem(storageKey)) return
    fn()
    sessionStorage.setItem(storageKey, '1')
  } catch {
    // ako je storage nedostupan (privacy mode), samo pošalji
    fn()
  }
}
