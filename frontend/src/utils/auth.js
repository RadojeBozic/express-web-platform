// src/utils/auth.js
import { readJSON, writeJSON, clearAuth as _clearAuth } from './storage';

export function getCurrentUser() {
  return readJSON('user', null);
}

export function isLoggedIn() {
  return !!getCurrentUser();
}

export function saveLoginPayload(data, fallbackEmail = null) {
  const token = data?.token ?? data?.access_token ?? null;
  const user  = data?.user  ?? data?.data?.user ?? null;

  if (token) localStorage.setItem('token', token);

  if (user && typeof user === 'object') {
    writeJSON('user', user);
  } else if (fallbackEmail) {
    // ako backend ne vraća user odmah, sačuvaj minimum
    writeJSON('user', { email: fallbackEmail });
  }
}

export function clearAuth() {
  _clearAuth();
}
