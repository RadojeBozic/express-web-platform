// src/utils/analytics.js

/**
 * Minimal Plausible helper sa:
 * - bezbednim pozivom (guard)
 * - event queue ako Plausible još nije spreman
 * - trackOnce (po sesiji)
 * - pomoćnim trackError i trackPageview sa putanjom
 */

const QUEUE = [];
let watching = false;

function hasPlausible() {
  return typeof window !== 'undefined' && typeof window.plausible === 'function';
}

function startWatching() {
  if (watching) return;
  watching = true;

  // Lagani watcher koji nađe plausible pa isprazni queue.
  const iv = setInterval(() => {
    if (hasPlausible()) {
      try {
        flushQueue();
      } finally {
        clearInterval(iv);
      }
    }
  }, 300);

  // Safety timeout: i da nema plausible, ne vrti se beskonačno
  setTimeout(() => clearInterval(iv), 15000);
}

function flushQueue() {
  if (!hasPlausible()) return;
  while (QUEUE.length) {
    const { name, opts } = QUEUE.shift();
    try {
      window.plausible(name, opts);
    } catch { /* no-op */ }
  }
}

// Normalizuj props u oblik koji Plausible očekuje
function normalizeProps(props) {
  if (!props || typeof props !== 'object') return undefined;
  try {
    // Filtriraj undefined/funkcije/simboli
    const clean = Object.fromEntries(
      Object.entries(props).filter(([_, v]) => v !== undefined && typeof v !== 'function' && typeof v !== 'symbol')
    );
    return Object.keys(clean).length ? { props: clean } : undefined;
  } catch {
    return undefined;
  }
}

/**
 * Ručni pageview (ako želiš mimo router hook-a)
 * @param {string} [path] - npr. '/pricing'
 */
export function trackPageview(path) {
  const opts = normalizeProps(path ? { path } : undefined);
  send('pageview', opts);
}

/**
 * Generički event sa opcionim props
 * @param {string} name - npr. "Invoice Requested"
 * @param {object} [props] - npr. { currency: 'rsd' }
 */
export function track(name, props) {
  const opts = normalizeProps(props);
  send(name, opts);
}

/**
 * Once-per-session helper (sprečava dvostruke evente)
 * @param {string} key - unikatni ključ (npr. 'checkout_started')
 * @param {() => void} fn - callback koji šalje jedan ili više eventa
 */
export function trackOnce(key, fn) {
  try {
    const storageKey = `pl_once_${key}`;
    if (sessionStorage.getItem(storageKey)) return;
    fn();
    sessionStorage.setItem(storageKey, '1');
  } catch {
    fn(); // privacy mode: samo pošalji
  }
}

/**
 * Semantički helper za greške
 * @param {string} scope - npr. 'Stripe' ili 'Checkout'
 * @param {string} code  - npr. HTTP status ili interni kod
 * @param {string} [message] - kratka poruka (ne loguj PII)
 */
export function trackError(scope, code, message) {
  track('Error', { scope, code, message });
}

// Interno slanje (sa queue fallback-om)
function send(name, opts) {
  if (hasPlausible()) {
    try {
      window.plausible(name, opts);
      return;
    } catch {
      // ako padne poziv, backoff na queue
    }
  }
  QUEUE.push({ name, opts });
  startWatching();
}
