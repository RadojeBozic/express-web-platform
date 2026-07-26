import { defineConfig, loadEnv } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd(), '')
  // Backend origin u dev-u (Laravel na :8000 po difoltu)
  const backend = env.VITE_BACKEND_ORIGIN || 'http://localhost:8000'
  const devPort = Number(env.VITE_DEV_PORT || 8080)
  const previewPort = Number(env.VITE_PREVIEW_PORT || 4173)

  return {
    plugins: [vue()],
    resolve: {
      alias: { '@': path.resolve(__dirname, './src') },
    },
    server: {
      port: devPort,
      proxy: {
        '/api':      { target: backend, changeOrigin: true, secure: false },
        '/storage':  { target: backend, changeOrigin: true, secure: false },
        '/sanctum':  { target: backend, changeOrigin: true, secure: false },
        '/login':    { target: backend, changeOrigin: true, secure: false },
        '/logout':   { target: backend, changeOrigin: true, secure: false },
        '/register': { target: backend, changeOrigin: true, secure: false },
        '/password': { target: backend, changeOrigin: true, secure: false },
      },
    },
    preview: {
      port: previewPort,
      proxy: {
        '/api':      { target: backend, changeOrigin: true, secure: false },
        '/storage':  { target: backend, changeOrigin: true, secure: false },
        '/sanctum':  { target: backend, changeOrigin: true, secure: false },
        '/login':    { target: backend, changeOrigin: true, secure: false },
        '/logout':   { target: backend, changeOrigin: true, secure: false },
        '/register': { target: backend, changeOrigin: true, secure: false },
        '/password': { target: backend, changeOrigin: true, secure: false },
      },
    },
    build: {
      sourcemap: mode !== 'production',
      outDir: 'dist',
      emptyOutDir: true,
    },
  }
})
