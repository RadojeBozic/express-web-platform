<template>
  <div id="hero" class="bg-slate-900 text-white font-sans px-6 py-8 max-w-5xl mx-auto rounded shadow scroll-smooth">

    <!-- Header -->
    <header class="flex items-center justify-between mb-8 border-b border-slate-700 pb-4">
      <div class="flex items-center space-x-2">
        <img v-if="data.logo_path" :src="getImageUrl(data.logo_path)" alt="Logo"
             class="h-12 w-12 object-contain rounded-full hover:scale-105 transition duration-300" />
        <h1 v-else class="text-xl font-bold">{{ data.name }}</h1>
      </div>
      <nav class="space-x-4 text-sm">
        <a href="#about" class="hover:underline text-slate-300">{{ $t('darkPreviewPro.nav.about') }}</a>
        <a href="#ponuda" class="hover:underline text-slate-300">{{ $t('darkPreviewPro.nav.offer') }}</a>
        <a href="#kontakt" class="hover:underline text-slate-300">{{ $t('darkPreviewPro.nav.contact') }}</a>
      </nav>
    </header>

    <!-- Hero -->
    <section class="mb-10 min-h-[70vh]" id="hero">
      <img v-if="data.hero_image" :src="getImageUrl(data.hero_image)"
           class="w-full object-cover h-64 rounded mb-6 hover:scale-105 transition" />
      <h1 class="text-3xl font-bold mb-2 text-center">{{ data.hero_title }}</h1>
      <p class="text-center text-slate-400 mb-4 whitespace-pre-line break-words">{{ data.hero_subtitle }}</p>
    </section>

    <!-- Opis delatnosti -->
    <section v-if="data.description" class="mb-10">
      <h2 class="text-xl font-semibold mb-2 text-purple-300">{{ $t('darkPreviewPro.activity') }}</h2>
      <p class="text-slate-300 text-sm whitespace-pre-line break-words">
        {{ data.description }}
      </p>
    </section>

    <!-- Napomena notifikacija za naplatu-->
    <!-- <div class="bg-purple-100 border border-purple-300 rounded p-4 text-sm text-purple-800 mb-10">
      * {{ $t('darkPreviewPro.note') }}
    </div> -->

    <!-- O nama -->
    <section class="mb-10" id="about">
      <h2 class="text-2xl font-semibold text-purple-400 mb-4">{{ data.about_title }}</h2>
      <div class="flex flex-col md:flex-row gap-6 items-center">
        <img v-if="data.about_image" :src="getImageUrl(data.about_image)"
             class="w-60 h-60 object-cover rounded shadow hover:scale-105 transition" />
        <p class="text-sm leading-relaxed break-words whitespace-pre-line w-full">
          {{ data.about_text }}
        </p>
      </div>
    </section>

    <!-- Ponuda -->
    <section id="ponuda" class="mb-10">
      <h2 class="text-2xl font-semibold text-purple-400 mb-4">{{ data.offer_title }}</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div v-for="(item, index) in data.offer_items" :key="index" class="text-center">
          <img v-if="item.image" :src="getImageUrl(item.image)"
               class="w-full h-48 object-cover rounded shadow hover:scale-105 transition" />
          <p class="mt-2 text-sm font-medium break-words whitespace-pre-line">{{ item.title }}</p>
        </div>
      </div>
    </section>

    <!-- Video -->
    <section v-if="embedVideoUrl" class="my-10">
      <h2 class="text-2xl font-semibold mb-4 text-purple-300">{{ $t('darkPreviewPro.video') }}</h2>
      <div class="aspect-w-16 aspect-h-9">
        <iframe :src="embedVideoUrl" frameborder="0" allowfullscreen class="w-full h-80 rounded"></iframe>
      </div>
    </section>

    <!-- PDF -->
    <section v-if="data.pdf_file" class="my-10">
      <h2 class="text-2xl font-semibold mb-4 text-purple-300">{{ $t('darkPreviewPro.pdf') }}</h2>
      <iframe
        :src="getImageUrl(data.pdf_file)"
        width="100%"
        height="600"
        style="border: 1px solid #666;"
        class="rounded shadow"
      ></iframe>
    </section>

    <!-- Kontakt -->
    <section id="kontakt" class="my-10">
      <h2 class="text-2xl font-semibold mb-4 text-purple-300">{{ $t('darkPreviewPro.contact') }}</h2>
      <div class="text-sm space-y-2 text-slate-300">
        <p><strong>Adresa:</strong> {{ data.address || 'Nije uneta' }}</p>
        <p><strong>Telefon:</strong> {{ data.phone }}</p>
        <p v-if="data.phone2"><strong>Telefon 2:</strong> {{ data.phone2 }}</p>
        <p v-if="data.phone3"><strong>Telefon 3:</strong> {{ data.phone3 }}</p>
        <p><strong>Email:</strong> {{ data.email }}</p>
        <p v-if="data.email2"><strong>Email 2:</strong> {{ data.email2 }}</p>
        <p v-if="data.email3"><strong>Email 3:</strong> {{ data.email3 }}</p>
      </div>
      <div v-if="data.address" class="mt-4 w-full h-64 rounded overflow-hidden shadow">
        <iframe :src="googleMapUrl" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
      </div>
    </section>

    <!-- Društvene mreže -->
    <section class="mb-6 text-center">
      <p class="text-sm mb-2 text-slate-400">{{ $t('darkPreviewPro.social') }}</p>
      <div class="flex justify-center gap-6 text-2xl text-slate-400">
        <a :href="isValidUrl(data.facebook) ? data.facebook : fallbackFacebook" target="_blank"
           class="hover:text-blue-500 transition"><i class="fab fa-facebook-square"></i></a>
        <a :href="isValidUrl(data.instagram) ? data.instagram : fallbackInstagram" target="_blank"
           class="hover:text-pink-500 transition"><i class="fab fa-instagram"></i></a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm text-slate-500 pt-4 border-t border-slate-700 mt-10">
      © {{ new Date().getFullYear() }} {{ data.name || 'Vaša firma' }} — 
      <a href="#hero" class="text-purple-400 hover:underline">{{ $t('darkPreviewPro.backToTop') }}</a>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'DarkPreviewPro',
  props: {
    data: { type: Object, required: true }
  },
  computed: {
    fallbackFacebook() {
      return 'https://facebook.com/gbsplatform'
    },
    fallbackInstagram() {
      return 'https://instagram.com/gbsplatform'
    },
    googleMapUrl() {
      const query = encodeURIComponent(this.data.address || '')
      return `https://maps.google.com/maps?q=${query}&output=embed`
    },
    embedVideoUrl() {
      if (!this.data.video_url) return null
      try {
        const url = new URL(this.data.video_url)
        const videoId = url.searchParams.get("v")
        return `https://www.youtube.com/embed/${videoId}`
      } catch {
        return null
      }
    }
  },
  methods: {
    getImageUrl(path) {
      return path ? `http://localhost:8080/storage/${path}` : ''
    },
    isValidUrl(url) {
      try {
        new URL(url)
        return true
      } catch (_) {
        return false
      }
    }
  }
}
</script>
