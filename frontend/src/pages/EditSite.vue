<template>
  <div class="min-h-screen bg-slate-900 text-white p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">✏️ {{ $t('edit.title') }}</h1>
    <div class="text-center text-sm mb-6">
      <span class="inline-block px-3 py-1 rounded-full bg-purple-700">{{ $t('edit.version') }}</span>
    </div>

    <form @submit.prevent="submitForm" class="max-w-3xl mx-auto space-y-8" novalidate>
      <!-- 📇 OPŠTI PODACI -->
      <fieldset class="space-y-4">
        <legend class="text-xl font-semibold text-purple-400 mb-2">📇 {{ $t('edit.sections.general') }}</legend>
        <input v-model.trim="form.name" :placeholder="$t('edit.fields.name')" required class="input" />
        <textarea v-model.trim="form.description" rows="3" :placeholder="$t('edit.fields.description')" required class="input" />
        <input v-model.trim="form.email" type="email" :placeholder="$t('edit.fields.email')" required class="input" />
        <input v-model.trim="form.phone" :placeholder="$t('edit.fields.phone')" required class="input" />

        <input
          v-model.trim="form.facebook"
          :placeholder="$t('edit.fields.facebook')"
          class="input"
          @blur="form.facebook = normalizeUrl(form.facebook)"
        />
        <input
          v-model.trim="form.instagram"
          :placeholder="$t('edit.fields.instagram')"
          class="input"
          @blur="form.instagram = normalizeUrl(form.instagram)"
        />

        <label class="block text-sm mt-2">{{ $t('edit.fields.logo') }}</label>
        <input type="file" accept="image/*" @change="e => handleImageFile(e, 'logo')" class="block text-sm" />
      </fieldset>

      <!-- 🎯 HERO -->
      <fieldset class="space-y-4">
        <legend class="text-xl font-semibold text-purple-400 mb-2">🎯 {{ $t('edit.sections.hero') }}</legend>
        <input v-model.trim="form.heroTitle" :placeholder="$t('edit.fields.heroTitle')" required class="input" />
        <textarea v-model.trim="form.heroSubtitle" rows="2" :placeholder="$t('edit.fields.heroSubtitle')" required class="input" />
        <input type="file" accept="image/*" @change="e => handleImageFile(e, 'heroImage')" class="block mt-2 text-sm" />
      </fieldset>

      <!-- 👥 O NAMA -->
      <fieldset class="space-y-4">
        <legend class="text-xl font-semibold text-purple-400 mb-2">👥 {{ $t('edit.sections.about') }}</legend>
        <input v-model.trim="form.aboutTitle" :placeholder="$t('edit.fields.aboutTitle')" required class="input" />
        <textarea v-model.trim="form.aboutText" rows="3" :placeholder="$t('edit.fields.aboutText')" required class="input" />
        <input type="file" accept="image/*" @change="e => handleImageFile(e, 'aboutImage')" class="block mt-2 text-sm" />
      </fieldset>

      <!-- 🛍️ PONUDA -->
      <fieldset class="space-y-4">
        <legend class="text-xl font-semibold text-purple-400 mb-2">🛍️ {{ $t('edit.sections.offer') }}</legend>
        <input v-model.trim="form.offerTitle" :placeholder="$t('edit.fields.offerTitle')" class="input" />
        <div class="space-y-4">
          <div
            v-for="(item, index) in form.offerItems"
            :key="index"
            class="border border-slate-600 p-3 rounded-md space-y-2"
          >
            <input v-model.trim="item.title" :placeholder="$t('edit.fields.offerItemTitle')" class="input bg-slate-700" />
            <input type="file" accept="image/*" @change="e => handleOfferImageUpload(e, index)" class="block text-sm" />
            <button
              type="button"
              @click="removeItem(index)"
              v-if="form.offerItems.length > 1"
              class="text-red-400 hover:text-red-600 text-sm"
            >
              {{ $t('edit.fields.remove') }}
            </button>
          </div>
          <button type="button" @click="addItem" class="text-sm text-purple-300 hover:text-purple-500">
            {{ $t('edit.fields.addOffer') }}
          </button>
        </div>
      </fieldset>

      <!-- 🎨 ŠABLON -->
      <fieldset class="space-y-4">
        <legend class="text-xl font-semibold text-purple-400 mb-2">🎨 {{ $t('edit.sections.template') }}</legend>
        <select v-model="form.template" required class="input">
          <option disabled value="">-- {{ $t('edit.fields.chooseTemplate') }} --</option>
          <option value="klasicni">🧾 {{ $t('edit.templates.classic') }}</option>
          <option value="moderni">✨ {{ $t('edit.templates.modern') }}</option>
          <option value="galerija">🖼️ {{ $t('edit.templates.gallery') }}</option>
          <option value="biznis">🏢 {{ $t('edit.templates.biznis') }}</option>
          <option value="dark">🌙 {{ $t('edit.templates.dark') }}</option>
        </select>
      </fieldset>

      <!-- CTA -->
      <button
        type="submit"
        :disabled="loading"
        class="w-full bg-purple-600 hover:bg-purple-700 py-3 px-4 rounded text-white font-semibold"
        :aria-busy="loading ? 'true' : 'false'"
      >
        {{ loading ? $t('edit.loading') : $t('edit.submit') }}
      </button>

      <p v-if="success" class="text-green-400 text-sm">{{ success }}</p>
      <p v-if="error" class="text-red-400 text-sm">{{ error }}</p>
    </form>
  </div>
</template>

<script>
import api, { getCsrfCookie } from '../api/http'
import { getCurrentUser } from '../utils/auth'

export default {
  name: 'EditSite',
  props: ['slug'],
  data() {
    return {
      user: getCurrentUser(),
      loading: false,
      success: '',
      error: '',
      form: {
        siteType: 'free', // 'free' | 'pro' (menjaj samo ako backend dozvoljava)
        name: '',
        description: '',
        email: '',
        phone: '',
        facebook: '',
        instagram: '',
        logo: null,
        heroTitle: '',
        heroSubtitle: '',
        heroImage: null,
        aboutTitle: '',
        aboutText: '',
        aboutImage: null,
        offerTitle: '',
        offerItems: [{ title: '', image: null }],
        template: 'klasicni',
      },
    }
  },
  async created() {
    try {
      const { data: site } = await api.get(`/free-site-request/${this.slug}`)

      // zaštita: vlasnik ili admin/superadmin
      if (!this.user || (this.user.id !== site.user_id && !['admin', 'superadmin'].includes(this.user.role))) {
        return this.$router.push('/dashboard')
      }

      this.form = {
        ...this.form,
        siteType: site.type || 'free',
        name: site.name ?? '',
        description: site.description ?? '',
        email: site.email ?? '',
        phone: site.phone ?? '',
        facebook: site.facebook ?? '',
        instagram: site.instagram ?? '',
        heroTitle: site.hero_title ?? '',
        heroSubtitle: site.hero_subtitle ?? '',
        aboutTitle: site.about_title ?? '',
        aboutText: site.about_text ?? '',
        offerTitle: site.offer_title ?? '',
        template: site.template ?? 'klasicni',
        offerItems: Array.isArray(site.offer_items)
          ? site.offer_items.map(item => ({ title: item?.title ?? '', image: null }))
          : [{ title: '', image: null }],
      }
    } catch (err) {
      console.error('❌ Load error:', err)
      this.error = this.$t?.('edit.errors.load') || 'Greška pri učitavanju podataka.'
    }
  },
  methods: {
    normalizeUrl(val) {
      const v = (val || '').trim()
      if (!v) return ''
      if (/^https?:\/\//i.test(v)) return v
      return `https://${v}`
    },
    handleImageFile(e, field) {
      const file = e.target.files?.[0]
      if (file && (!file.type?.startsWith('image/') || file.size > 4 * 1024 * 1024)) {
        this.error = this.$t?.('edit.errors.image') || 'Pogrešan format ili prevelika slika.'
        this.form[field] = null
        return
      }
      this.form[field] = file || null
    },
    handleOfferImageUpload(e, index) {
      const file = e.target.files?.[0]
      if (file && (!file.type?.startsWith('image/') || file.size > 4 * 1024 * 1024)) {
        this.error = this.$t?.('edit.errors.image', { index: index + 1 }) || 'Pogrešan format ili prevelika slika.'
        this.form.offerItems[index].image = null
        return
      }
      this.form.offerItems[index].image = file || null
    },
    addItem() {
      if (this.form.offerItems.length < 10) {
        this.form.offerItems.push({ title: '', image: null })
      }
    },
    removeItem(index) {
      this.form.offerItems.splice(index, 1)
    },
    async submitForm() {
      this.success = ''
      this.error = ''
      this.loading = true

      try {
        // 1) CSRF cookie (ako koristiš Sanctum)
        await getCsrfCookie().catch(() => {})

        // 2) FormData — snake_case za backend
        const fd = new FormData()

        // ako backend dozvoljava izmenu tipa:
        if (this.form.siteType) fd.append('type', this.form.siteType)

        const textFields = [
          'name', 'description', 'email', 'phone',
          'facebook', 'instagram',
          'heroTitle', 'heroSubtitle',
          'aboutTitle', 'aboutText',
          'offerTitle',
          'template',
        ]
        const mapKey = (k) => ({
          heroTitle: 'hero_title',
          heroSubtitle: 'hero_subtitle',
          aboutTitle: 'about_title',
          aboutText: 'about_text',
          offerTitle: 'offer_title',
        }[k] || k)

        textFields.forEach((k) => {
          const v = (this.form[k] ?? '').toString()
          fd.append(mapKey(k), v)
        })

        // fajlovi (samo ako su promenjeni)
        if (this.form.logo instanceof File)       fd.append('logo', this.form.logo)
        if (this.form.heroImage instanceof File)  fd.append('hero_image', this.form.heroImage)
        if (this.form.aboutImage instanceof File) fd.append('about_image', this.form.aboutImage)

        // offer_items[*]
        this.form.offerItems.forEach((item, i) => {
          fd.append(`offer_items[${i}][title]`, (item?.title ?? '').toString())
          if (item?.image instanceof File) {
            fd.append(`offer_items[${i}][image]`, item.image)
          }
        })

        // 3) Laravel PUT preko multipart-a: _method=PUT
        const { data } = await api.post(`/free-site-request/${this.slug}?_method=PUT`, fd)

        this.success = this.$t?.('edit.success') || 'Uspešno sačuvano.'
        const targetSlug = data?.slug || this.slug
        setTimeout(() => {
          this.$router.push(`/prezentacije/${targetSlug}`)
        }, 800)
      } catch (err) {
        console.error('❌ Save error:', err?.response || err)
        const res = err?.response
        if (res?.status === 422 && res.data?.errors) {
          const first = Object.values(res.data.errors).flat()?.[0]
          this.error = first || (this.$t?.('edit.errors.save') || 'Greška pri čuvanju podataka.')
        } else {
          this.error = res?.data?.message || this.$t?.('edit.errors.save') || 'Greška pri čuvanju podataka.'
        }
      } finally {
        this.loading = false
      }
    },
  },
}
</script>
