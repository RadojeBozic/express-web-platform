<template>
  <router-view />
</template>

<script setup>
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import AOS from 'aos'
import 'aos/dist/aos.css' // ✅ samo ako ga ne vučeš već u main.js ili global CSS

const router = useRouter()

onMounted(() => {
  AOS.init({
    once: true,
    disable: 'phone',
    duration: 500,
    easing: 'ease-out-cubic',
  })

  // ✅ opcionalno: ponovo pokreni AOS nakon promene rute
  router.afterEach(() => {
    setTimeout(() => AOS.refresh(), 100)
  })
})
</script>
