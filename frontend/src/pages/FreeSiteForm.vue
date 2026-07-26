<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <div class="min-h-screen bg-slate-900 text-white py-10 px-4 flex flex-col items-center">
      <h1 class="text-3xl font-bold mb-6 text-center mt-8">🖥️ {{ $t('freesite.title') }}</h1>
      <p class="text-slate-400 mb-8 text-center max-w-2xl text-sm">
        {{ $t('freesite.note') }}
      </p>

      <form @submit.prevent="submitForm" class="bg-slate-800 p-6 rounded-lg shadow max-w-3xl w-full space-y-6">
        <!-- 📇 Opšti podaci -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">📇 {{ $t('freesite.sections.general') }}</legend>
          <div class="space-y-4">
            <input v-model="form.name" required maxlength="255" :placeholder="$t('freesite.fields.name')" class="input" />
            <textarea v-model="form.description" required maxlength="1000" :placeholder="$t('freesite.fields.description')" class="input" rows="3" />
            <input v-model="form.email" required type="email" :placeholder="$t('freesite.fields.email')" class="input" />
            <input v-model="form.phone" required pattern=".{5,50}" :placeholder="$t('freesite.fields.phone')" class="input" />
            <input v-model="form.facebook" required :placeholder="$t('freesite.fields.facebook')" class="input" />
            <input v-model="form.instagram" required :placeholder="$t('freesite.fields.instagram')" class="input" />
            <label class="block text-sm mb-1">{{ $t('freesite.fields.logo') }}</label>
            <input type="file" accept="image/*" @change="e => handleImageFile(e, 'logo')" class="block" />
          </div>
        </fieldset>

        <!-- 🎯 Hero -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">🎯 {{ $t('freesite.sections.hero') }}</legend>
          <div class="space-y-4">
            <label>{{ $t('freesite.fields.heroImage') }}</label>
            <input type="file" required accept="image/*" @change="e => handleImageFile(e, 'heroImage')" />
            <input v-model="form.heroTitle" required maxlength="255" :placeholder="$t('freesite.fields.heroTitle')" class="input" />
            <textarea v-model="form.heroSubtitle" required maxlength="250" :placeholder="$t('freesite.fields.heroSubtitle')" class="input" rows="3" />
          </div>
        </fieldset>

        <!-- 👥 O nama -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4 mt-6">👥 {{ $t('freesite.sections.about') }}</legend>
          <div class="space-y-4">
            <label>{{ $t('freesite.fields.aboutImage') }}</label>
            <input type="file" required accept="image/*" @change="e => handleImageFile(e, 'aboutImage')" />
            <input v-model="form.aboutTitle" required maxlength="255" :placeholder="$t('freesite.fields.aboutTitle')" class="input" />
            <textarea v-model="form.aboutText" required maxlength="1000" :placeholder="$t('freesite.fields.aboutText')" rows="5" class="input" />
          </div>
        </fieldset>

        <!-- 🛍️ Naša ponuda -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4 mt-6">🛍️ {{ $t('freesite.sections.offer') }}</legend>
          <div class="space-y-4">
            <input v-model="form.offerTitle" required maxlength="255" :placeholder="$t('freesite.fields.offerTitle')" class="input" />
            <div class="space-y-2">
              <div v-for="(item, index) in form.offerItems" :key="index" class="space-y-2 border border-slate-600 p-3 rounded">
                <input v-model="item.title" required maxlength="255" :placeholder="$t('freesite.fields.offerItemTitle')" class="input" />
                <input type="file" required accept="image/*" @change="e => handleOfferImageUpload(e, index)" />
                <button v-if="form.offerItems.length > 1" type="button" @click="removeItem(index)" class="text-red-400 hover:text-red-600 text-sm">
                  {{ $t('freesite.fields.remove') }}
                </button>
              </div>
              <button type="button" @click="addItem" class="mt-2 text-sm text-purple-300 hover:text-purple-500">
                {{ $t('freesite.fields.addOffer') }}
              </button>
            </div>
          </div>
        </fieldset>

        <!-- Šablon -->
        <div>
          <label class="block mb-1">{{ $t('freesite.sections.template') }}</label>
          <select v-model="form.template" required class="input">
            <option value="klasicni">🧾 {{ $t('freesite.templates.classic') }}</option>
            <option value="moderni">✨ {{ $t('freesite.templates.modern') }}</option>
            <option value="galerija">🖼️ {{ $t('freesite.templates.gallery') }}</option>
            <option value="biznis">🏢 {{ $t('freesite.templates.biznis') }}</option>
            <option value="dark">🌙 {{ $t('freesite.templates.dark') }}</option>
          </select>
        </div>

        <!-- CTA -->
        <button
          type="submit"
          :disabled="loading"
          class="w-full bg-purple-600 hover:bg-purple-700 py-3 px-4 rounded text-white font-semibold"
        >
          {{ loading ? $t('freesite.loading') : $t('freesite.submit') }}
        </button>
        <p class="text-slate-400 text-xs mt-2 text-center">
          ℹ️{{ $t('freesite.noticeAfterSubmit') }}
        </p>

        <p v-if="successMessage" class="text-green-400 text-sm mt-4">{{ $t('freesite.success') }}</p>
        <p v-if="errorMessage" class="text-red-400 text-sm mt-4">{{ errorMessage }}</p>
      </form>
    </div>

    <Footer />
  </div>
</template>


<script>
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import api from '../api/http' // ✅ centralna axios instanca (baseURL=/api + interceptor)

export default {
  name: 'FreeSiteForm',
  components: { Header, Footer },
  data() {
    return {
      loading: false,
      form: {
        name: '',
        description: '',
        email: '',
        phone: '',
        facebook: '',
        instagram: '',
        logo: null,
        heroImage: null,
        heroTitle: '',
        heroSubtitle: '',
        aboutImage: null,
        aboutTitle: '',
        aboutText: '',
        offerTitle: '',
        offerItems: [{ title: '', image: null }],
        template: localStorage.getItem('selectedTemplate') || 'klasicni',
      },
      successMessage: '',
      errorMessage: '',
    }
  },
  async mounted() {
    // ✅ U Options API koristi this.$route (ne useRoute())
    const slug = this.$route?.query?.fromSlug
    if (slug) await this.fetchFromSlug(slug)
  },
  methods: {
    addItem() {
      if (this.form.offerItems.length < 10) {
        this.form.offerItems.push({ title: '', image: null })
      }
    },
    removeItem(index) {
      this.form.offerItems.splice(index, 1)
    },
    handleImageFile(e, field) {
      const file = e.target.files?.[0]
      if (file && (!file.type?.startsWith('image/') || file.size > 4 * 1024 * 1024)) {
        this.errorMessage = this.$t?.('freesite.errors.image') || 'Slika je pogrešnog formata ili prevelika.'
        this.form[field] = null
        return
      }
      this.form[field] = file
      this.errorMessage = ''
    },
    handleOfferImageUpload(e, index) {
      const file = e.target.files?.[0]
      if (file && (!file.type?.startsWith('image/') || file.size > 4 * 1024 * 1024)) {
        this.errorMessage = this.$t?.('freesite.errors.offerImage', { index: index + 1 }) || 'Pogrešna slika u ponudi.'
        this.form.offerItems[index].image = null
        return
      }
      this.form.offerItems[index].image = file
      this.errorMessage = ''
    },
    async submitForm() {
      this.successMessage = ''
      this.errorMessage = ''
      this.loading = true

      try {
        const formData = new FormData()

        // Dinamički polja
        for (const key in this.form) {
          if (key === 'offerItems') {
            this.form.offerItems.forEach((item, i) => {
              formData.append(`offerItems[${i}][title]`, item.title ?? '')
              if (item.image instanceof File) {
                formData.append(`offerItems[${i}][image]`, item.image)
              }
            })
          } else if (this.form[key] instanceof File) {
            formData.append(key, this.form[key])
          } else if (this.form[key] !== null && typeof this.form[key] !== 'undefined') {
            formData.append(key, this.form[key])
          }
        }

        // ✅ preko api -> POST /api/free-site-request
        const { data } = await api.post('/free-site-request', formData /*, { headers: { 'Content-Type': 'multipart/form-data' } }*/)

        this.successMessage = this.$t?.('freesite.success') || 'Zahtev uspešno poslat.'
        this.$router.push(`/prezentacije/${data?.slug}`)
      } catch (err) {
        console.error('❌', err?.response || err)
        if (err.response?.data?.errors) {
          const errors = Object.values(err.response.data.errors).flat()
          this.errorMessage = errors?.[0] || this.$t?.('freesite.errors.general') || 'Došlo je do greške.'
        } else {
          this.errorMessage = this.$t?.('freesite.errors.general') || 'Došlo je do greške.'
        }
      } finally {
        this.loading = false
      }
    },
    async fetchFromSlug(slug) {
      try {
        // ✅ preko api -> GET /api/free-site-request/:slug
        const { data: source } = await api.get(`/free-site-request/${slug}`)

        this.form.name = (source?.name || '') + ' (kopija)'
        this.form.description = source?.description ?? ''
        this.form.email = source?.email ?? ''
        this.form.phone = source?.phone ?? ''
        this.form.facebook = source?.facebook ?? ''
        this.form.instagram = source?.instagram ?? ''
        this.form.heroTitle = source?.hero_title ?? ''
        this.form.heroSubtitle = source?.hero_subtitle ?? ''
        this.form.aboutTitle = source?.about_title ?? ''
        this.form.aboutText = source?.about_text ?? ''
        this.form.offerTitle = source?.offer_title ?? ''
        this.form.offerItems = Array.isArray(source?.offer_items)
          ? source.offer_items.map(item => ({ title: item?.title ?? '', image: null }))
          : [{ title: '', image: null }]
        this.form.template = source?.template ?? this.form.template
      } catch (err) {
        console.error('❌', err)
        this.errorMessage = this.$t?.('freesite.errors.general') || 'Greška pri učitavanju.'
      }
    },
  },
}
</script>
