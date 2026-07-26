<template>
  <div class="bg-white text-gray-800 font-serif px-4 py-6 max-w-4xl mx-auto shadow rounded-lg">
    <!-- Header -->
    <header class="flex items-center justify-between mb-8 border-b border-slate-200 pb-4">
      <div class="flex items-center space-x-2">
        <img
          v-if="data.logo_path"
          :src="getFileUrl(data.logo_path)"
          :alt="data.name ? `Logo ${data.name}` : 'Logo'"
          class="h-12 w-12 object-contain rounded-full hover:scale-105 transition-transform duration-300"
          loading="lazy"
        />
        <h1 v-else class="text-xl font-bold">{{ data.name || 'Vaša firma' }}</h1>
      </div>

      <div class="text-sm text-gray-600 text-center" v-if="isNonEmpty(data.email)">{{ data.email }}</div>
      <div class="text-sm text-gray-600 text-right"  v-if="isNonEmpty(data.phone)">{{ data.phone }}</div>
    </header>

    <!-- Hero -->
    <section class="mb-10" v-if="isNonEmpty(data.hero_title) || isNonEmpty(data.hero_subtitle) || data.hero_image">
      <h2 class="text-2xl font-bold mb-2" v-if="isNonEmpty(data.hero_title)">{{ data.hero_title }}</h2>
      <p class="text-gray-600 mb-4 italic break-words whitespace-pre-line" v-if="isNonEmpty(data.hero_subtitle)">
        {{ data.hero_subtitle }}
      </p>
      <img
        v-if="data.hero_image"
        :src="getFileUrl(data.hero_image)"
        :alt="data.hero_title ? `Hero: ${data.hero_title}` : 'Hero slika'"
        class="w-full h-64 object-cover rounded-lg hover:scale-105 transition duration-300"
        loading="lazy"
      />
    </section>

    <hr class="my-10 border-t border-dashed opacity-40" v-if="isNonEmpty(data.description)" />

    <!-- Opis delatnosti -->
    <section v-if="isNonEmpty(data.description)" class="mb-10">
      <h2 class="text-xl font-semibold mb-2 text-purple-700">📋 {{ $t('classicPreview.activityTitle') }}</h2>
      <p class="text-gray-700 text-sm whitespace-pre-line break-words">
        {{ data.description }}
      </p>
    </section>

    <hr class="my-10 border-t border-dashed border-gray-300" v-if="isNonEmpty(data.about_title) || isNonEmpty(data.about_text) || data.about_image" />

    <!-- O nama -->
    <section class="mb-10" v-if="isNonEmpty(data.about_title) || isNonEmpty(data.about_text) || data.about_image">
      <h2 class="text-xl font-semibold mb-4 text-purple-700" v-if="isNonEmpty(data.about_title)">{{ data.about_title }}</h2>
      <div class="flex flex-col md:flex-row gap-6 items-center">
        <img
          v-if="data.about_image"
          :src="getFileUrl(data.about_image)"
          :alt="data.about_title ? `O nama: ${data.about_title}` : 'O nama slika'"
          class="w-60 h-60 object-cover rounded shadow hover:scale-105 transition duration-300"
          loading="lazy"
        />
        <p class="text-sm leading-relaxed whitespace-pre-line break-words w-full text-justify" v-if="isNonEmpty(data.about_text)">
          {{ data.about_text }}
        </p>
      </div>
    </section>

    <hr class="my-10 border-t border-dashed opacity-40" v-if="normalizedOfferItems.length" />

    <!-- Naša ponuda -->
    <section v-if="normalizedOfferItems.length || isNonEmpty(data.offer_title)">
      <h2 class="text-xl font-semibold mb-4 text-purple-700">
        {{ data.offer_title || $t('classicPreview.offerTitle') }}
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div
          v-for="(item, index) in normalizedOfferItems"
          :key="index"
          class="flex flex-col items-center text-center"
        >
          <img
            v-if="item.image"
            :src="getFileUrl(item.image)"
            :alt="item.title ? `Ponuda: ${item.title}` : 'Ponuda slika'"
            class="w-full h-48 object-cover rounded shadow hover:scale-105 transition duration-300"
            loading="lazy"
          />
          <p class="mt-2 text-sm font-medium break-words" v-if="isNonEmpty(item.title)">{{ item.title }}</p>
        </div>
      </div>
    </section>

    <hr class="my-10 border-t border-slate-200" />

    <!-- Društvene mreže -->
    <section class="mb-6 text-center">
      <p class="text-sm mb-2 text-gray-700">{{ $t('classicPreview.followUs') }}</p>
      <div class="flex justify-center gap-6 text-2xl text-gray-600">
        <a
          :href="isValidUrl(data.facebook) ? data.facebook : fallbackFacebook"
          target="_blank"
          rel="noopener noreferrer"
          class="hover:text-blue-600 transition"
          aria-label="Facebook"
        >
          <i class="fab fa-facebook-square"></i>
        </a>
        <a
          :href="isValidUrl(data.instagram) ? data.instagram : fallbackInstagram"
          target="_blank"
          rel="noopener noreferrer"
          class="hover:text-pink-600 transition"
          aria-label="Instagram"
        >
          <i class="fab fa-instagram"></i>
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500 pt-4 border-t border-slate-200">
      © {{ currentYear }} {{ data.name || 'Vaša firma' }} —
      {{ $t('classicPreview.footerText') }}
      <a
        href="https://express-web.express"
        target="_blank"
        rel="noopener noreferrer"
        class="text-purple-600 hover:underline"
      >
        {{ $t('classicPreview.footerLink') }}
      </a>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'ClassicPreview',
  props: {
    data: { type: Object, required: true }
  },
  data() {
    const base =
      import.meta.env.VITE_FILES_BASE_URL ||
      (typeof window !== 'undefined' ? window.location.origin : '')
    return { filesBaseUrl: base }
  },
  computed: {
    currentYear() {
      return new Date().getFullYear()
    },
    fallbackFacebook() {
      return 'https://facebook.com/gbsplatform'
    },
    fallbackInstagram() {
      return 'https://instagram.com/gbsplatform'
    },
    normalizedOfferItems() {
      const arr = Array.isArray(this.data?.offer_items) ? this.data.offer_items : []
      return arr
        .filter(it => it && (it.title || it.image || it.image_path))
        .map(it => ({
          title: String(it.title || '').trim(),
          image: it.image || it.image_path || null
        }))
    }
  },
  methods: {
    isNonEmpty(val) {
      return typeof val === 'string' ? val.trim().length > 0 : !!val
    },
    isValidUrl(url) {
      try {
        if (!url) return false
        new URL(url)
        return true
      } catch {
        return false
      }
    },
    getFileUrl(path) {
      if (!path) return ''
      if (/^https?:\/\//i.test(path)) return path
      const clean = String(path).replace(/^\/+/, '')
      const rel = clean.startsWith('storage/') ? clean : `storage/${clean}`
      const base = this.filesBaseUrl.replace(/\/+$/, '')
      return `${base}/${rel}`
    }
  }
}
</script>
