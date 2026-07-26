<template>
  <div id="page-top" class="bg-slate-900 text-white font-sans px-6 py-8 max-w-5xl mx-auto rounded shadow scroll-smooth">

    <!-- Header -->
    <header class="flex items-center justify-between mb-8 border-b border-slate-700 pb-4">
      <div class="flex items-center space-x-2">
        <img
          v-if="data.logo_path"
          :src="getFileUrl(data.logo_path)"
          :alt="data.name ? `Logo ${data.name}` : 'Logo'"
          class="h-12 w-12 object-contain rounded-full hover:scale-105 transition duration-300"
          loading="lazy" decoding="async"
        />
        <h1 v-else class="text-xl font-bold">{{ data.name || 'Vaša firma' }}</h1>
      </div>
      <nav class="space-x-4 text-sm">
        <a href="#about"   class="hover:underline text-slate-300">{{ $t('darkPreviewPro.nav.about') }}</a>
        <a href="#ponuda"  class="hover:underline text-slate-300">{{ $t('darkPreviewPro.nav.offer') }}</a>
        <a href="#kontakt" class="hover:underline text-slate-300">{{ $t('darkPreviewPro.nav.contact') }}</a>
      </nav>
    </header>

    <!-- Hero -->
    <section class="mb-10 min-h-[60vh]" id="hero" v-if="isNonEmpty(data.hero_title) || isNonEmpty(data.hero_subtitle) || data.hero_image">
      <img
        v-if="data.hero_image"
        :src="getFileUrl(data.hero_image)"
        :alt="data.hero_title ? `Hero: ${data.hero_title}` : 'Hero slika'"
        class="w-full object-cover h-64 rounded mb-6 hover:scale-105 transition"
        loading="lazy" decoding="async" fetchpriority="high"
      />
      <h1 v-if="isNonEmpty(data.hero_title)" class="text-3xl font-bold mb-2 text-center">{{ data.hero_title }}</h1>
      <p v-if="isNonEmpty(data.hero_subtitle)" class="text-center text-slate-400 mb-4 whitespace-pre-line break-words">{{ data.hero_subtitle }}</p>
    </section>

    <!-- Opis delatnosti -->
    <section v-if="isNonEmpty(data.description)" class="mb-10">
      <h2 class="text-xl font-semibold mb-2 text-purple-300">{{ $t('darkPreviewPro.activity') }}</h2>
      <p class="text-slate-300 text-sm whitespace-pre-line break-words">
        {{ data.description }}
      </p>
    </section>

    <!-- O nama -->
    <section class="mb-10" id="about" v-if="isNonEmpty(data.about_title) || isNonEmpty(data.about_text) || data.about_image">
      <h2 v-if="isNonEmpty(data.about_title)" class="text-2xl font-semibold text-purple-400 mb-4">{{ data.about_title }}</h2>
      <div class="flex flex-col md:flex-row gap-6 items-center">
        <img
          v-if="data.about_image"
          :src="getFileUrl(data.about_image)"
          :alt="data.about_title ? `O nama: ${data.about_title}` : 'O nama slika'"
          class="w-60 h-60 object-cover rounded shadow hover:scale-105 transition"
          loading="lazy" decoding="async"
        />
        <p v-if="isNonEmpty(data.about_text)" class="text-sm leading-relaxed break-words whitespace-pre-line w-full">
          {{ data.about_text }}
        </p>
      </div>
    </section>

    <!-- Ponuda -->
    <section id="ponuda" class="mb-10" v-if="normalizedOfferItems.length">
      <h2 class="text-2xl font-semibold text-purple-400 mb-4">
        {{ data.offer_title || $t('darkPreviewPro.offerTitle') }}
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div v-for="(item, index) in normalizedOfferItems" :key="index" class="text-center">
          <img
            v-if="item.image"
            :src="getFileUrl(item.image)"
            :alt="item.title ? `Ponuda: ${item.title}` : 'Ponuda slika'"
            class="w-full h-48 object-cover rounded shadow hover:scale-105 transition"
            loading="lazy" decoding="async"
          />
          <p v-if="isNonEmpty(item.title)" class="mt-2 text-sm font-medium break-words whitespace-pre-line">{{ item.title }}</p>
        </div>
      </div>
    </section>

    <!-- Video -->
    <section v-if="embedVideoUrl" class="my-10">
      <h2 class="text-2xl font-semibold mb-4 text-purple-300">{{ $t('darkPreviewPro.video') }}</h2>
      <div class="aspect-w-16 aspect-h-9">
        <iframe
          :src="embedVideoUrl"
          frameborder="0"
          allowfullscreen
          class="w-full h-80 rounded"
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="YouTube video"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        ></iframe>
      </div>
    </section>

    <!-- PDF -->
    <section v-if="data.pdf_file" class="my-10">
      <h2 class="text-2xl font-semibold mb-4 text-purple-300">{{ $t('darkPreviewPro.pdf') }}</h2>
      <iframe
        :src="getFileUrl(data.pdf_file)"
        width="100%"
        height="600"
        style="border: 1px solid #666;"
        class="rounded shadow"
        loading="lazy"
        title="PDF dokument"
      ></iframe>
      <div class="mt-2 text-sm">
        <a :href="getFileUrl(data.pdf_file)" target="_blank" rel="noopener noreferrer" class="text-blue-400 hover:underline">
          {{ $t('darkPreviewPro.openPdfInNewTab') || 'Otvori PDF u novom tabu' }}
        </a>
        <span class="mx-1 text-slate-500">|</span>
        <a :href="getFileUrl(data.pdf_file)" download class="text-blue-400 hover:underline">
          {{ $t('darkPreviewPro.downloadPdf') || 'Preuzmi PDF' }}
        </a>
      </div>
    </section>

    <!-- Kontakt -->
    <section id="kontakt" class="my-10">
      <h2 class="text-2xl font-semibold mb-4 text-purple-300">{{ $t('darkPreviewPro.contact') }}</h2>
      <div class="text-sm space-y-2 text-slate-300">
        <p v-if="isNonEmpty(data.address)"><strong>Adresa:</strong> {{ data.address }}</p>
        <p v-if="isNonEmpty(data.phone)"><strong>Telefon:</strong> {{ data.phone }}</p>
        <p v-if="isNonEmpty(data.phone2)"><strong>Telefon 2:</strong> {{ data.phone2 }}</p>
        <p v-if="isNonEmpty(data.phone3)"><strong>Telefon 3:</strong> {{ data.phone3 }}</p>
        <p v-if="isNonEmpty(data.email)"><strong>Email:</strong> {{ data.email }}</p>
        <p v-if="isNonEmpty(data.email2)"><strong>Email 2:</strong> {{ data.email2 }}</p>
        <p v-if="isNonEmpty(data.email3)"><strong>Email 3:</strong> {{ data.email3 }}</p>
      </div>
     <!--  <div v-if="mapEmbedUrl" class="mt-4 w-full h-64 rounded overflow-hidden shadow">
        <iframe
          :src="mapEmbedUrl"
          width="100%" height="100%"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Mapa lokacije"
        ></iframe>
      </div> -->
      <div v-if="data.address || data.google_map_link" class="mt-4 w-full h-64 rounded overflow-hidden shadow">
        <iframe :src="googleMapUrl" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
      </div>
    </section>

    <!-- Društvene mreže -->
    <section class="mb-6 text-center">
      <p class="text-sm mb-2 text-slate-400">{{ $t('darkPreviewPro.social') }}</p>
      <div class="flex justify-center gap-6 text-2xl text-slate-400">
        <a
          :href="isValidUrl(data.facebook) ? data.facebook : fallbackFacebook"
          target="_blank" rel="noopener noreferrer"
          class="hover:text-blue-500 transition"
        ><i class="fab fa-facebook-square"></i></a>
        <a
          :href="isValidUrl(data.instagram) ? data.instagram : fallbackInstagram"
          target="_blank" rel="noopener noreferrer"
          class="hover:text-pink-500 transition"
        ><i class="fab fa-instagram"></i></a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm text-slate-500 pt-4 border-t border-slate-700 mt-10">
      © {{ currentYear }} {{ data.name || 'Vaša firma' }} —
      <a href="#page-top" class="text-purple-400 hover:underline">{{ $t('darkPreviewPro.backToTop') }}</a>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'DarkPreviewPro',
  props: { data: { type: Object, required: true } },
  data() {
    return {
      filesBaseUrl: import.meta.env.VITE_FILES_BASE_URL || (typeof window !== 'undefined' ? window.location.origin : '')
    }
  },
  computed: {
    currentYear() { return new Date().getFullYear() },
    fallbackFacebook() { return 'https://facebook.com/gbsplatform' },
    fallbackInstagram() { return 'https://instagram.com/gbsplatform' },
    normalizedOfferItems() {
      const arr = Array.isArray(this.data?.offer_items) ? this.data.offer_items : []
      return arr
        .filter(it => it && (it.title || it.image || it.image_path))
        .map(it => ({ title: (it.title || '').toString().trim(), image: it.image || it.image_path || null }))
    },
    embedVideoUrl() {
      const src = this.data?.video_url
      if (!src) return null
      try {
        const url = new URL(src)
        const host = url.hostname.replace(/^www\./, '')
        let id = null
        if (host === 'youtu.be') {
          id = url.pathname.replace('/', '')
        } else if (host === 'youtube.com' || host === 'm.youtube.com') {
          if (url.pathname.startsWith('/watch')) id = url.searchParams.get('v')
          else if (url.pathname.startsWith('/embed/')) id = url.pathname.split('/').pop()
          else if (url.pathname.startsWith('/shorts/')) id = url.pathname.split('/').pop()
        }
        return id ? `https://www.youtube.com/embed/${id}` : null
      } catch { return null }
    },
    googleMapUrl() {
  // Ako je eksplicitno zadat link za embed – koristi njega
      if (this.data.google_map_link && typeof this.data.google_map_link === 'string') {
        return this.data.google_map_link
      }
      // Inače konstruiši iz adrese
      const addr = (this.data.address || '').trim()
      if (!addr) return ''
      const q = encodeURIComponent(addr)
      return `https://maps.google.com/maps?q=${q}&output=embed`
    }
  },
  methods: {
    isNonEmpty(val) { return typeof val === 'string' ? val.trim().length > 0 : !!val },
    isValidUrl(url) { try { if (!url) return false; new URL(url); return true } catch { return false } },
    getFileUrl(path) {
      if (!path) return ''
      if (/^https?:\/\//i.test(path)) return path
      const clean = String(path).replace(/^\/+/, '')
      const rel = clean.startsWith('storage/') ? clean : `storage/${clean}`
      const base = (this.filesBaseUrl || '').replace(/\/+$/, '')
      return base ? `${base}/${rel}` : `/${rel}`
    }
  }
}
</script>
