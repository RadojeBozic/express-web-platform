import axios from 'axios'

// Preferiraj VITE_API_URL; ako ga nema, koristi origin + /api
const baseURL =
  (import.meta.env.VITE_API_URL && import.meta.env.VITE_API_URL.replace(/\/$/, '')) ||
  `${window.location.origin.replace(/\/$/, '')}/api`;

const api = axios.create({
  baseURL, // npr. https://express-web.express/api
  withCredentials: false,
});

// Ako postoji token, šalji ga automatski
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token');
  if (token) config.headers.Authorization = `Bearer ${token}`;
  return config;
});

export default api;
