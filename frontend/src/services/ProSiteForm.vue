<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <div class="min-h-screen bg-slate-900 text-white py-10 px-4 flex flex-col items-center">

         

      <h1 class="text-3xl font-bold mb-6 text-center mt-8">🚀 {{ $t('proform.title') }}</h1>
      <p class="text-slate-400 mb-8 text-center max-w-2xl text-sm">
        {{ $t('proform.note') }} <span class="text-red-400">*</span>
      </p>

      <form @submit.prevent="submitForm" class="bg-slate-800 p-6 rounded-lg shadow max-w-3xl w-full space-y-6">

         <!-- 📘 Tooltip dugme i sekcija pomoći -->
<div class=" bg-purple-600 hover:bg-purple-700 py-3 px-4 rounded text-white font-semibold items-center ">
  <button 
    @click="showHelp = !showHelp"
    class="mb-4 text-blue-400 hover:text-blue-200 underline-none font-medium transition cursor-pointer"
  >
    ❓ {{ $t('proform.help.toggle') }}
  </button>

  <div
    v-if="showHelp"
    class="bg-blue-100 text-blue-800 p-4 rounded-md shadow-md border border-blue-300 relative max-w-2xl mb-6"
  >
    <div class="absolute -top-2 left-4 w-4 h-4 bg-blue-100 border-l border-t border-blue-300 rotate-45"></div>
    <p class="text-sm whitespace-pre-line">
      {{ $t('proform.help.text') }}
    </p>
  </div>
</div>
        <!-- ŠABLON -->
        <div>
          <label class="block mb-1">{{ $t('proform.sections.template') }} *</label>
          <select v-model="form.template" required class="input cursor-pointer">
            <option value="klasicni-pro">{{ $t('proform.templates.classic') }}</option>
            <option value="moderni-pro">{{ $t('proform.templates.modern') }}</option>
            <option value="galerija-pro">{{ $t('proform.templates.gallery') }}</option>
            <option value="biznis-pro">{{ $t('proform.templates.biznis') }}</option>
            <option value="dark-pro">{{ $t('proform.templates.dark') }}</option>
          </select>
        </div>

        <!-- PLAN USLUGE -->
        <div>
          <label class="block mb-1">{{ $t('proform.sections.plan') }} *</label>
          <select v-model="form.plan" required class="input cursor-pointer">
            <option value="starter">{{ $t('proform.plans.starter') }}</option>
            <option value="basic">{{ $t('proform.plans.basic') }}</option>
            <option value="pro">{{ $t('proform.plans.pro') }}</option>
            <option value="premium">{{ $t('proform.plans.premium') }}</option>
            <option value="business">{{ $t('proform.plans.business') }}</option>
          </select>
        </div>

        <!-- 📇 OPŠTI PODACI -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">📇 {{ $t('proform.sections.general') }}</legend>
          <div class="space-y-4">
            <input v-model="form.name" required maxlength="255" :placeholder="$t('proform.fields.name')" class="input cursor-pointer" />
            <textarea v-model="form.description" required maxlength="1000" :placeholder="$t('proform.fields.description')" rows="3" class="input cursor-pointer" />
            <div class="flex gap-2 items-start">
              <input v-model="form.email" required type="email" :placeholder="$t('proform.fields.email')" class="input cursor-pointer" />
              <AiHelper :prompt="form.description + ' — ' + form.name" />
            </div>
            <input v-model="form.phone" required maxlength="50" :placeholder="$t('proform.fields.phone')" class="input cursor-pointer" />
            <input v-model="form.facebook" maxlength="255" :placeholder="$t('proform.fields.facebook')" class="input cursor-pointer" />
            <input v-model="form.instagram" maxlength="255" :placeholder="$t('proform.fields.instagram')" class="input cursor-pointer" />
            <label class="block text-sm mb-1 cursor-pointer">{{ $t('proform.fields.logo') }}</label>
            <input type="file" accept="image/*" @change="e => handleFile(e, 'logo')" class="cursor-pointer" />
          </div>
        </fieldset>
        <!-- 🎯 HERO -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">🎯 {{ $t('proform.sections.hero') }}</legend>
          <div class="space-y-4">
            <label>{{ $t('proform.fields.heroImage') }} <span class="text-red-400 cursor-pointer">*</span></label>
            <input type="file" required accept="image/*" @change="e => handleFile(e, 'heroImage')" class="cursor-pointer"/>
            <input v-model="form.heroTitle" required maxlength="255" :placeholder="$t('proform.fields.heroTitle')" class="input cursor-pointer" />
            <textarea v-model="form.heroSubtitle" required maxlength="250" :placeholder="$t('proform.fields.heroSubtitle')" rows="3" class="input cursor-pointer" />
            <!--<input v-model="form.heroTitle" required maxlength="255" :placeholder="$t('proform.fields.heroTitle')" class="input cursor-pointer" />
            <textarea v-model="form.heroSubtitle" required maxlength="250" :placeholder="$t('proform.fields.heroSubtitle')" rows="3" class="input cursor-pointer" />-->
            <AiHelper v-if="allowAiHero" :prompt="form.heroTitle + ' — ' + form.heroSubtitle" />

          </div>
        </fieldset>

        <!-- 👥 O NAMA -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">👥 {{ $t('proform.sections.about') }}</legend>
          <div class="space-y-4">
            <label>{{ $t('proform.fields.aboutImage') }} <span class="text-red-400 cursor-pointer">*</span></label>
            <input type="file" required accept="image/*" @change="e => handleFile(e, 'aboutImage')" class="cursor-pointer" />
            <input v-model="form.aboutTitle" required maxlength="255" :placeholder="$t('proform.fields.aboutTitle')" class="input cursor-pointer" />
            <textarea v-model="form.aboutText" required maxlength="1000" :placeholder="$t('proform.fields.aboutText')" rows="4" class="input cursor-pointer"/>
            <!-- <input v-model="form.aboutTitle" required maxlength="255" :placeholder="$t('proform.fields.aboutTitle')" class="input cursor-pointer" />
            <textarea v-model="form.aboutText" required maxlength="1000" :placeholder="$t('proform.fields.aboutText')" rows="4" class="input cursor-pointer" /> -->
            <AiHelper v-if="allowAiAbout" :prompt="form.aboutTitle + ' — ' + form.aboutText" />

          </div>
        </fieldset>

        <!-- 🛍️ NAŠA PONUDA -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">🛍️ {{ $t('proform.sections.offer') }}</legend>
          <div class="space-y-4">
            <input v-model="form.offerTitle" required maxlength="255" :placeholder="$t('proform.fields.offerTitle')" class="input cursor-pointer" />
            <div class="space-y-2">
              <div v-for="(item, index) in form.offerItems" :key="index" class="space-y-2 border border-slate-600 p-3 rounded cursor-pointer">
                <input v-model="item.title" required maxlength="255" :placeholder="$t('proform.fields.offerItemTitle')" class="input cursor-pointer" />
                <input type="file" required accept="image/*" @change="e => handleOfferImageUpload(e, index)" class="cursor-pointer" />
                <button v-if="form.offerItems.length > 1" type="button" @click="removeItem(index)" class="text-red-400 text-sm hover:text-red-600 cursor-pointer">
                  {{ $t('proform.fields.remove') }}
                </button>
              </div>
              <button type="button" @click="addItem" class="text-sm text-purple-300 hover:text-purple-500 cursor-pointer">
                {{ $t('proform.fields.addOffer') }}
              </button>
            </div>
          </div>
        </fieldset>

        <!-- 📎 DODATNI SADRŽAJ -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">📎 {{ $t('proform.sections.extra') }}</legend>
          <div class="space-y-4">
            <label>{{ $t('proform.fields.pdfDocument') }}</label>
            <input type="file" accept="application/pdf" @change="e => handleFile(e, 'pdfDocument')" />
            <input v-model="form.youtubeLink" maxlength="255" :placeholder="$t('proform.fields.youtube')" class="input cursor-pointer" />

            <div v-if="allowAiPdf">
              <h3 class="text-sm font-semibold text-purple-400">📄 {{ $t('aihelper.pdfSuggestion') }}</h3>
              <AiHelper :prompt="'Generiši primer cenovnika za firmu ' + form.name + ' u oblasti ' + form.description" />
            </div>

          </div>
        </fieldset>

        <!-- 📬 KONTAKT PODACI -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">📬 {{ $t('proform.sections.contact') }}</legend>
          <div class="space-y-4">
            <input v-model="form.address_city" required maxlength="255" :placeholder="$t('proform.fields.city')" class="input cursor-pointer" />
            <input v-model="form.address_street" required maxlength="255" :placeholder="$t('proform.fields.street')" class="input cursor-pointer" />
            <input v-model="form.google_map_link" maxlength="255" :placeholder="$t('proform.fields.map')" class="input cursor-pointer" />
            <input v-model="form.phone2" maxlength="50" :placeholder="$t('proform.fields.phone2')" class="input cursor-pointer" />
            <input v-model="form.phone3" maxlength="50" :placeholder="$t('proform.fields.phone3')" class="input cursor-pointer" />
            <input v-model="form.email2" maxlength="255" :placeholder="$t('proform.fields.email2')" class="input cursor-pointer" />
            <input v-model="form.email3" maxlength="255" :placeholder="$t('proform.fields.email3')" class="input cursor-pointer" />
          </div>
        </fieldset>

        

        <!-- CTA -->
        <button type="submit" :disabled="loading" class="w-full bg-purple-600 hover:bg-purple-700 py-3 px-4 rounded text-white font-semibold">
          {{ loading ? $t('proform.loading') : $t('proform.submit') }}
        </button>

        <p class="text-slate-400 text-xs mt-2 text-center">
         ℹ️ {{ $t('proform.noticeAfterSubmit') }}
        </p>

        <p v-if="successMessage" class="text-green-400 text-sm mt-4">{{ $t('proform.success') }}</p>
        <p v-if="errorMessage" class="text-red-400 text-sm mt-4">{{ $t('proform.error') }}</p>

        <p v-if="resData?.slug" class="text-blue-400 text-sm mt-2">
          {{ $t('proform.preview') }}
          <a :href="`/prezentacije/${resData.slug}`" class="underline cursor-pointer" target="_blank">{{ resData.slug }}</a>
        </p>
      </form>
    </div>

    <Footer />
  </div>
</template>


<script>
import axios from 'axios'
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import AiHelper from '../partials/AiHelper.vue'
import { useRoute } from 'vue-router'

export default {
  name: 'ProSiteForm',
  components: { Header, Footer, AiHelper},
  data() {
    return {
      loading: false,
      resData: null,
      route: useRoute(),
      showHelp: false,
      form: {
        name: '', description: '', email: '', phone: '',
        facebook: '', instagram: '', logo: null,
        heroTitle: '', heroSubtitle: '', heroImage: null,
        aboutTitle: '', aboutText: '', aboutImage: null,
        offerTitle: '', offerItems: [{ title: '', image: null }],
        pdfDocument: null, youtubeLink: '',
        address_city: '', address_street: '', google_map_link: '',
        phone2: '', phone3: '', email2: '', email3: '',
        template: localStorage.getItem('selectedTemplate') || 'klasicni-pro',
        plan: 'starter', // default
      },
      successMessage: '', errorMessage: ''
    }
  },
  mounted() {
    const slug = this.route.query.fromSlug
    if (slug) this.fetchFromSlug(slug)
  },
  methods: {
    
    addItem() {
      if (this.form.offerItems.length < 12)
        this.form.offerItems.push({ title: '', image: null })
    },
    removeItem(i) {
      this.form.offerItems.splice(i, 1)
    },
    handleFile(e, field) {
      const file = e.target.files[0]
      if (!file) return

      if (field !== 'pdfDocument' && (!file.type.startsWith('image/') || file.size > 4 * 1024 * 1024)) {
        this.errorMessage = this.$t('proform.errors.image')
        this.form[field] = null
        return
      }

      if (field === 'pdfDocument' && file.type !== 'application/pdf') {
        this.errorMessage = this.$t('proform.errors.pdf')
        this.form[field] = null
        return
      }

      this.form[field] = file
      this.errorMessage = ''
    },
    handleOfferImageUpload(e, i) {
      const file = e.target.files[0]
      if (!file || !file.type.startsWith('image/') || file.size > 4 * 1024 * 1024) {
        this.errorMessage = this.$t('proform.errors.offerImage', { index: i + 1 })
        this.form.offerItems[i].image = null
        return
      }
      this.form.offerItems[i].image = file
      this.errorMessage = ''
    },
    async submitForm() {
      this.successMessage = ''
      this.errorMessage = ''
      this.loading = true
      this.resData = null

      try {
        const fd = new FormData()
        fd.append('type', 'pro')

        const textFields = [
          'name', 'description', 'email', 'phone', 'facebook', 'instagram',
          'heroTitle', 'heroSubtitle', 'aboutTitle', 'aboutText', 'offerTitle',
          'youtubeLink', 'google_map_link', 'address_city', 'address_street',
          'phone2', 'phone3', 'email2', 'email3', 'template', 'plan'
        ]

        textFields.forEach(field => {
          const key = field === 'youtubeLink' ? 'video_url' : field
          fd.append(key, this.form[field] || '')
        })

        if (this.form.logo) fd.append('logo', this.form.logo)
        if (this.form.heroImage) fd.append('heroImage', this.form.heroImage)
        if (this.form.aboutImage) fd.append('aboutImage', this.form.aboutImage)
        if (this.form.pdfDocument) fd.append('pdf_file', this.form.pdfDocument)

        this.form.offerItems.forEach((item, i) => {
          fd.append(`offerItems[${i}][title]`, item.title)
          fd.append(`offerItems[${i}][image]`, item.image)
        })

        const res = await axios.post('http://localhost:8080/api/free-site-request', fd, {
          headers: { 'Content-Type': 'multipart/form-data' }
        })

        
        this.errorMessage = this.$t('proform.errors.general')

        this.successMessage = this.$t('proform.success')
        this.resData = res.data

      } catch (err) {
        console.error('❌', err.response || err)
        this.errorMessage = err.response?.data?.message || this.$t('proform.errors.general')
      } finally {
        this.loading = false
      }
    },
    async fetchFromSlug(slug) {
      try {
        const res = await axios.get(`http://localhost:8080/api/free-site-request/${slug}`)
        const source = res.data

        this.form.name = source.name + ' (kopija)'
        this.form.description = source.description
        this.form.email = source.email
        this.form.phone = source.phone
        this.form.facebook = source.facebook
        this.form.instagram = source.instagram
        this.form.heroTitle = source.hero_title
        this.form.heroSubtitle = source.hero_subtitle
        this.form.aboutTitle = source.about_title
        this.form.aboutText = source.about_text
        this.form.offerTitle = source.offer_title
        this.form.offerItems = source.offer_items.map(item => ({
          title: item.title,
          image: null
        }))
        this.form.youtubeLink = source.video_url || ''
        this.form.address_city = (source.address || '').split(',')[1]?.trim() || ''
        this.form.address_street = (source.address || '').split(',')[0]?.trim() || ''
        this.form.google_map_link = source.google_map_link || ''
        this.form.phone2 = source.phone2 || ''
        this.form.phone3 = source.phone3 || ''
        this.form.email2 = source.email2 || ''
        this.form.email3 = source.email3 || ''
        this.form.template = source.template

      } catch (err) {
        console.error('❌', err)
        this.errorMessage = this.$t('proform.errors.fetch')
      }
    }
  },
  computed: {
  allowAiHero() {
    return ['pro', 'premium', 'business'].includes(this.form.plan)
  },
  allowAiAbout() {
    return ['premium', 'business'].includes(this.form.plan)
  },
  allowAiPdf() {
    return this.form.plan === 'business'
  }
}
}
</script>
