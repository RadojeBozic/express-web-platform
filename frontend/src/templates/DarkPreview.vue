<template>
  <div class="bg-slate-900 text-white font-['Segoe UI'] px-6 py-8 max-w-5xl mx-auto rounded shadow">

    <!-- Header -->
    <header class="flex items-center justify-between mb-8 border-b border-slate-700 pb-4">
      <div class="flex items-center space-x-2">
        <img
          v-if="data.logo_path"
          :src="getImageUrl(data.logo_path)"
          alt="Logo"
          class="h-12 w-12 object-contain rounded-full hover:scale-105 transition duration-300"
        />
        <h1 v-else class="text-xl font-bold">{{ data.name }}</h1>
      </div>
      <div class="text-sm text-slate-400 text-center">{{ data.email }}</div>
      <div class="text-sm text-slate-400 text-right">{{ data.phone }}</div>
    </header>

    <!-- Hero -->
    <section class="mb-10">
      <img
        v-if="data.hero_image"
        :src="getImageUrl(data.hero_image)"
        class="w-full object-cover h-64 rounded mb-6 hover:scale-105 transition"
      />
      <h1 class="text-3xl font-bold mb-2 text-center">{{ data.hero_title }}</h1>
      <p class="text-center text-slate-400 mb-4 whitespace-pre-line break-words">{{ data.hero_subtitle }}</p>
    </section>

    <hr class="my-10 border-dashed border-slate-700" />

    <!-- Opis delatnosti -->
    <section v-if="data.description" class="mb-10">
      <h2 class="text-xl font-semibold mb-2 text-purple-300">{{ $t('darkPreview.activityTitle') }}</h2>
      <p class="text-slate-300 text-sm whitespace-pre-line break-words">
        {{ data.description }}
      </p>
    </section>

    <hr class="my-10 border-t border-dashed border-gray-300" />

    <!-- O nama -->
    <section class="mb-10">
      <h2 class="text-xl font-semibold text-purple-400 mb-4">{{ data.about_title }}</h2>
      <div class="flex flex-col md:flex-row gap-6 items-center">
        <img
          v-if="data.about_image"
          :src="getImageUrl(data.about_image)"
          class="w-60 h-60 object-cover rounded shadow hover:scale-105 transition"
        />
        <p class="text-sm leading-relaxed break-words whitespace-pre-line w-full">
          {{ data.about_text }}
        </p>
      </div>
    </section>

    <hr class="my-10 border-dashed border-slate-700" />

    <!-- Naša ponuda -->
    <section>
      <h2 class="text-xl font-semibold text-purple-400 mb-4">{{ data.offer_title || $t('darkPreview.offerTitle') }}</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div
          v-for="(item, index) in data.offer_items"
          :key="index"
          class="flex flex-col items-center text-center"
        >
          <img
            v-if="item.image"
            :src="getImageUrl(item.image)"
            class="w-full h-48 object-cover rounded shadow hover:scale-105 transition"
          />
          <p class="mt-2 text-sm font-medium break-words whitespace-pre-line">{{ item.title }}</p>
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
          class="hover:text-blue-500 transition"
        >
          <i class="fab fa-facebook-square"></i>
        </a>
        <a
          :href="isValidUrl(data.instagram) ? data.instagram : fallbackInstagram"
          target="_blank"
          class="hover:text-pink-500 transition"
        >
          <i class="fab fa-instagram"></i>
        </a>
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500 pt-4 border-t border-gray-200">
      © {{ new Date().getFullYear() }} {{ data.name || 'Vaša firma' }} —
      {{ $t('darkPreview.footerText') }}
      <a
        href="https://gbsplatform.com"
        target="_blank"
        class="text-blue-600 hover:underline"
      >{{ $t('darkPreview.footerLink') }}</a>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'DarkPreview',
  props: {
    data: {
      type: Object,
      required: true
    }
  },
  computed: {
    fallbackFacebook() {
      return 'https://facebook.com/gbsplatform'
    },
    fallbackInstagram() {
      return 'https://instagram.com/gbsplatform'
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