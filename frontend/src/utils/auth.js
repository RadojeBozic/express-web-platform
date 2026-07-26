// src/utils/auth.js
import { readJSON, writeJSON, clearAuth as _clearAuth } from './storage';

// ---- Core getters ----
export function getCurrentUser() {
  return readJSON('user', null);
}
export function getToken() {
  try { return localStorage.getItem('token') || null; } catch { return null; }
}
export function isLoggedIn() {
  return !!getToken();
}

// ---- Save / Clear ----
export function saveLoginPayload(data, fallbackEmail = null) {
  const token = data?.token ?? data?.access_token ?? null;
  const user  = data?.user  ?? data?.data?.user ?? null;

  try {
    if (typeof token === 'string' && token.trim()) {
      localStorage.setItem('token', token.trim());
    }
  } catch { /* no-op */ }

  if (user && typeof user === 'object') {
    writeJSON('user', user);
  } else if (fallbackEmail) {
    writeJSON('user', { email: fallbackEmail });
  }

  // obavesti druge tabove
  notifyAuthChange();
}

export function clearAuth() {
  _clearAuth();
  notifyAuthChange();
}

// ---- Helpers ----
export function authHeader() {
  const t = getToken();
  return t ? { Authorization: `Bearer ${t}` } : {};
}

// Jednostavan subscribe na promene auth-a (radi i cross-tab)
const listeners = new Set();
export function onAuthChange(cb) {
  if (typeof cb === 'function') listeners.add(cb);
  return () => listeners.delete(cb);
}
function notifyAuthChange() {
  const payload = { user: getCurrentUser(), token: getToken() };
  listeners.forEach(fn => { try { fn(payload); } catch {} });
  // trigguj storage event i u drugim tabovima
  try { localStorage.setItem('__auth_ping__', String(Date.now())); } catch {}
}

// ---- Router guard primer (opciono) ----
// Pozovi u routeru: { path:'/dashboard', beforeEnter: requireAuth, ... }
export function requireAuth(to, from, next) {
  if (isLoggedIn()) return next();
  next({ path: '/signin', query: { redirect: to.fullPath || '/' } });
}

// Admin helper (ako backend šalje role)
export function isAdminUser(u = getCurrentUser()) {
  const role = u?.role;
  return role === 'admin' || role === 'superadmin';
}

export function isAuthenticated() {
  return isLoggedIn();
}
