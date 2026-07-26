// src/api/http.js
import axios from 'axios';

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL || '/api',
  // withCredentials: true, // uključi ako koristiš Sanctum/session
});

// Bearer token iz localStorage (JWT varijanta)
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) config.headers.Authorization = `Bearer ${token}`;
  return config;
});

// Sigurnosna mreža: ako je neko greškom stavio http:// u baseURL, forsiraj relativni
if (api.defaults.baseURL?.startsWith?.('http://')) {
  api.defaults.baseURL = '/api';
}

export default api;
