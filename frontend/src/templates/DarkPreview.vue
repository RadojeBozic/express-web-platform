<template>
  <div class="bg-slate-900 text-white font-['Segoe UI'] px-6 py-8 max-w-5xl mx-auto rounded shadow">
    <!-- Header -->
    <header class="flex items-center justify-between mb-8 border-b border-slate-700 pb-4">
      <div class="flex items-center space-x-2">
        <img
          v-if="data.logo_path"
          :src="getFileUrl(data.logo_path)"
          :alt="data.name ? `Logo ${data.name}` : 'Logo'"
          class="h-12 w-12 object-contain rounded-full hover:scale-105 transition duration-300"
          loading="lazy"
        />
        <h1 v-else class="text-xl font-bold">{{ data.name || 'Vaša firma' }}</h1>
      </div>
      <div class="text-sm text-slate-400 text-center" v-if="isNonEmpty(data.email)">{{ data.email }}</div>
      <div class="text-sm text-slate-400 text-right"  v-if="isNonEmpty(data.phone)">{{ data.phone }}</div>
    </header>

    <!-- Hero -->
    <section class="mb-10" v-if="data.hero_image || isNonEmpty(data.hero_title) || isNonEmpty(data.hero_subtitle)">
      <img
        v-if="data.hero_image"
        :src="getFileUrl(data.hero_image)"
        :alt="data.hero_title ? `Hero: ${data.hero_title}` : 'Hero slika'"
        class="w-full object-cover h-64 rounded mb-6 hover:scale-105 transition"
        loading="lazy"
      />
      <h1 class="text-3xl font-bold mb-2 text-center" v-if="isNonEmpty(data.hero_title)">{{ data.hero_title }}</h1>
      <p class="text-center text-slate-400 mb-4 whitespace-pre-line break-words" v-if="isNonEmpty(data.hero_subtitle)">
        {{ data.hero_subtitle }}
      </p>
    </section>

    <hr class="my-10 border-dashed border-slate-700" v-if="isNonEmpty(data.description)" />

    <!-- Opis delatnosti -->
    <section v-if="isNonEmpty(data.description)" class="mb-10">
      <h2 class="text-xl font-semibold mb-2 text-purple-300">📋 {{ $t('darkPreview.activityTitle') }}</h2>
      <p class="text-slate-300 text-sm whitespace-pre-line break-words">
        {{ data.description }}
      </p>
    </section>

    <hr class="my-10 border-t border-dashed border-gray-700" v-if="isNonEmpty(data.about_title) || isNonEmpty(data.about_text) || data.about_image" />

    <!-- O nama -->
    <section class="mb-10" v-if="isNonEmpty(data.about_title) || isNonEmpty(data.about_text) || data.about_image">
      <h2 class="text-xl font-semibold text-purple-400 mb-4" v-if="isNonEmpty(data.about_title)">{{ data.about_title }}</h2>
      <div class="flex flex-col md:flex-row gap-6 items-center">
        <img
          v-if="data.about_image"
          :src="getFileUrl(data.about_image)"
          :alt="data.about_title ? `O nama: ${data.about_title}` : 'O nama slika'"
          class="w-60 h-60 object-cover rounded shadow hover:scale-105 transition"
          loading="lazy"
        />
        <p class="text-sm leading-relaxed break-words whitespace-pre-line w-full text-justify" v-if="isNonEmpty(data.about_text)">
          {{ data.about_text }}
        </p>
      </div>
    </section>

    <hr class="my-10 border-dashed border-slate-700" v-if="normalizedOfferItems.length || isNonEmpty(data.offer_title)" />

    <!-- Naša ponuda -->
    <section v-if="normalizedOfferItems.length || isNonEmpty(data.offer_title)">
      <h2 class="text-xl font-semibold text-purple-400 mb-4">
        {{ data.offer_title || $t('darkPreview.offerTitle') }}
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
            class="w-full h-48 object-cover rounded shadow hover:scale-105 transition"
            loading="lazy"
          />
          <p class="mt-2 text-sm font-medium break-words whitespace-pre-line" v-if="isNonEmpty(item.title)">
            {{ item.title }}
          </p>
        </div>
      </div>
    </section>

    <hr class="my-10 border-slate-700" />

    <!-- Društvene mreže -->
    <section class="mb-6 text-center">
      <p class="text-sm mb-2 text-slate-400">{{ $t('darkPreview.social') }}</p>
      <div class="flex justify-center gap-6 text-2xl text-slate-400">
        <a
          :href="isValidUrl(data.facebook) ? data.facebook : fallbackFacebook"
          target="_blank"
          rel="noopener"
          class="hover:text-blue-500 transition"
          aria-label="Facebook"
        >
          <i class="fab fa-facebook-square"></i>
        </a>
        <a
          :href="isValidUrl(data.instagram) ? data.instagram : fallbackInstagram"
          target="_blank"
          rel="noopener"
          class="hover:text-pink-500 transition"
          aria-label="Instagram"
        >
          <i class="fab fa-instagram"></i>
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-400 pt-4 border-t border-slate-700">
      © {{ currentYear }} {{ data.name || 'Vaša firma' }} —
      {{ $t('darkPreview.footerText') }}
      <a
        href="https://express-web.express"
        target="_blank"
        rel="noopener"
        class="text-blue-400 hover:underline"
      >{{ $t('darkPreview.footerLink') }}</a>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'DarkPreview',
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
