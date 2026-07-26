import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'), // možeš koristiti @ za import fajlova
    },
  },
  server: {
    host: 'localhost',
    port: 5173
    // 🚫 proxy nije potreban ako koristiš punu adresu npr. axios.post('http://localhost:8000/contact')
  },
  define: {
    'process.env': process.env
  },
  build: { sourcemap: true }
})
