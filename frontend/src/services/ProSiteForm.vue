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
        <div class="bg-purple-600/20 py-3 px-4 rounded text-white font-semibold items-center">
          <button
            type="button"
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

        <!-- ŠABLON + demo/pre-fill kontrole -->
        <div class="space-y-3">
          <label class="block mb-1">{{ $t('proform.sections.template') }} *</label>
          <div class="flex gap-2 items-center flex-wrap">
            <select v-model="form.template" required class="input cursor-pointer">
              <option value="klasicni-pro">{{ $t('proform.templates.classic') }}</option>
              <option value="moderni-pro">{{ $t('proform.templates.modern') }}</option>
              <option value="galerija-pro">{{ $t('proform.templates.gallery') }}</option>
              <option value="biznis-pro">{{ $t('proform.templates.biznis') }}</option>
              <option value="dark-pro">{{ $t('proform.templates.dark') }}</option>
            </select>

            <!-- (Re)popuni polja iz šablona (ne dira polja koja već imaju vrednost) -->
            <button
              type="button"
              @click="applyTemplateDefaults()"
              class="text-sm bg-slate-700 hover:bg-slate-600 px-3 py-2 rounded cursor-pointer"
              title="Popuni prazna polja primerima za izabrani šablon"
            >
              ⚡ Popuni primerima
            </button>

            <!-- Demo mod (slike nisu obavezne) -->
            <label class="text-sm flex items-center gap-2 cursor-pointer">
              <input type="checkbox" v-model="isSample" />
              Probni projekat (demo)
            </label>
          </div>

          <p v-if="isSample" class="text-xs text-slate-400">
            ℹ️ U demo modu slike <strong>nisu obavezne</strong>. Možeš poslati formu da vidiš ceo tok izrade.
          </p>
        </div>

        <!-- PLAN USLUGE -->
        <div class="space-y-2">
          <label class="block mb-1">{{ $t('proform.sections.plan') }} *</label>
          <select v-model="form.plan" required class="input cursor-pointer">
            <option value="starter">{{ $t('proform.plans.starter') }}</option>
            <option value="basic">{{ $t('proform.plans.basic') }}</option>
            <option value="pro">{{ $t('proform.plans.pro') }}</option>
            <option value="premium">{{ $t('proform.plans.premium') }}</option>
            <option value="business">{{ $t('proform.plans.business') }}</option>
          </select>

          <div class="text-xs text-slate-400">
            <span class="block">🎛️ AI dostupnost: Hero → <strong>{{ allowAiHero ? 'DA' : 'NE' }}</strong>,
              O nama → <strong>{{ allowAiAbout ? 'DA' : 'NE' }}</strong>,
              PDF predlog → <strong>{{ allowAiPdf ? 'DA' : 'NE' }}</strong>
            </span>
            <span v-if="isPrivileged" class="block text-emerald-300">
              🛡️ Admin/Superadmin: AI ograničenja su ignorisana (bypass).
            </span>
          </div>
        </div>

        <!-- 📇 OPŠTI PODACI -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">📇 {{ $t('proform.sections.general') }}</legend>
          <div class="space-y-4">
            <input v-model="form.name" required maxlength="255" :placeholder="$t('proform.fields.name')" class="input cursor-pointer" />
            <textarea v-model="form.description" required maxlength="1000" :placeholder="$t('proform.fields.description')" rows="3" class="input cursor-pointer" />
            <div class="flex gap-2 items-start">
              <input v-model="form.email" required type="email" :placeholder="$t('proform.fields.email')" class="input cursor-pointer" />
              <!-- Ostavili smo generičan AiHelper ovde; prompt malo pojačan -->
              <AiHelper :prompt="promptGeneral()" />
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
            <input type="file" :required="!isSample" accept="image/*" @change="e => handleFile(e, 'heroImage')" class="cursor-pointer"/>
            <input v-model="form.heroTitle" required maxlength="255" :placeholder="$t('proform.fields.heroTitle')" class="input cursor-pointer" />
            <textarea v-model="form.heroSubtitle" required maxlength="250" :placeholder="$t('proform.fields.heroSubtitle')" rows="3" class="input cursor-pointer" />
            <AiHelper v-if="allowAiHero" :prompt="promptHero()" />
          </div>
        </fieldset>

        <!-- 👥 O NAMA -->
        <fieldset>
          <legend class="text-xl font-semibold text-purple-400 mb-4">👥 {{ $t('proform.sections.about') }}</legend>
          <div class="space-y-4">
            <label>{{ $t('proform.fields.aboutImage') }} <span class="text-red-400 cursor-pointer">*</span></label>
            <input type="file" :required="!isSample" accept="image/*" @change="e => handleFile(e, 'aboutImage')" class="cursor-pointer" />
            <input v-model="form.aboutTitle" required maxlength="255" :placeholder="$t('proform.fields.aboutTitle')" class="input cursor-pointer" />
            <textarea v-model="form.aboutText" required maxlength="1000" :placeholder="$t('proform.fields.aboutText')" rows="4" class="input cursor-pointer"/>
            <AiHelper v-if="allowAiAbout" :prompt="promptAbout()" />
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
                <input type="file" :required="!isSample" accept="image/*" @change="e => handleOfferImageUpload(e, index)" class="cursor-pointer" />
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
              <AiHelper :prompt="promptPdf()" />
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
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import AiHelper from '../partials/AiHelper.vue'
import api from '@/api/http'

// Minimalni “preseti” sadržaja po šablonu (slobodno menjaš tekstove)
const TEMPLATE_PRESETS = {
  'klasicni-pro': {
    heroTitle: 'Vaš partner za kvalitetne usluge',
    heroSubtitle: 'Godine iskustva, pažnja za detalje i jasna vrednost za klijente.',
    aboutTitle: 'Ko smo mi',
    aboutText:
      'Mi smo tim posvećenih profesionalaca. Naša misija je da pojednostavimo složene stvari i isporučimo odlične rezultate.',
    offerTitle: 'Naša ponuda',
    offerItems: ['Konsalting', 'Implementacija', 'Podrška']
  },
  'moderni-pro': {
    heroTitle: 'Moderni brend. Jasna poruka.',
    heroSubtitle: 'Digital-first pristup i fokus na iskustvo korisnika.',
    aboutTitle: 'Zašto nas biraju',
    aboutText:
      'Radimo brzo i u korak s trendovima. Verujemo u transparentnost, merenje učinka i stalno poboljšanje.',
    offerTitle: 'Šta radimo',
    offerItems: ['UI/UX dizajn', 'Web razvoj', 'Optimizacija performansi']
  },
  'galerija-pro': {
    heroTitle: 'Portfolio koji govori umesto nas',
    heroSubtitle: 'Izdvajamo projekte na koje smo najponosniji.',
    aboutTitle: 'Naš pristup',
    aboutText:
      'Svaki projekat posmatramo kao priliku da pokažemo kreativnost i tehničku izvrsnost.',
    offerTitle: 'Projekti',
    offerItems: ['Projekat A', 'Projekat B', 'Projekat C']
  },
  'biznis-pro': {
    heroTitle: 'Rast kroz rezultat',
    heroSubtitle: 'Strateška rešenja koja utiču na vaš bilans.',
    aboutTitle: 'O nama',
    aboutText:
      'Spajamo analitiku i kreaciju. Naš tim planira, sprovodi i meri da biste vi rasli sigurnije.',
    offerTitle: 'Usluge',
    offerItems: ['Strategija', 'Kampanje', 'CRM integracije']
  },
  'dark-pro': {
    heroTitle: 'Snažan utisak, minimalistički pristup',
    heroSubtitle: 'Tamna paleta, jasan kontrast i fokus na sadržaj.',
    aboutTitle: 'Filozofija',
    aboutText:
      'Manje je više. Jasna struktura i konzistentan vizuelni jezik daju najbolji rezultat.',
    offerTitle: 'Specijalnosti',
    offerItems: ['Brendiranje', 'Art direkcija', 'Motion grafika']
  }
}

export default {
  name: 'ProSiteForm',
  components: { Header, Footer, AiHelper },
  data() {
    return {
      loading: false,
      resData: null,
      showHelp: false,
      isSample: false, // ✅ demo/probni mod: slike nisu obavezne
      autoFillOnTemplateChange: false, // ako želiš auto-popunu pri promeni šablona → true
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
        plan: 'starter',
      },
      successMessage: '',
      errorMessage: '',
    }
  },
  mounted() {
    const slug = this.$route?.query?.fromSlug
    if (slug) this.fetchFromSlug(slug)

    // Opcionalno: auto-popuni prazna polja na prvom mount-u prema izabranom šablonu
    this.applyTemplateDefaults()
  },
  watch: {
    'form.template'(val) {
      if (this.autoFillOnTemplateChange) this.applyTemplateDefaults()
    }
  },
  computed: {
    // ✅ Bypass za admin/superadmin — radi i ako store ne postoji (siguran fallback)
    isPrivileged() {
      const role =
        this.$store?.state?.auth?.user?.role ||
        this.$root?.$auth?.user?.role ||
        window?.__AUTH__?.user?.role ||
        null
      return role === 'admin' || role === 'superadmin'
    },
    allowAiHero() {
      return this.isPrivileged || ['pro', 'premium', 'business'].includes(this.form.plan)
    },
    allowAiAbout() {
      return this.isPrivileged || ['premium', 'business'].includes(this.form.plan)
    },
    allowAiPdf() {
      return this.isPrivileged || this.form.plan === 'business'
    },
  },
  methods: {
    // ---------- TEMPLATE / DEMO ----------
    applyTemplateDefaults() {
      const t = TEMPLATE_PRESETS[this.form.template]
      if (!t) return

      const applyIfEmpty = (key, val) => {
        if (!this.form[key] || String(this.form[key]).trim() === '') {
          this.form[key] = val
        }
      }

      applyIfEmpty('heroTitle', t.heroTitle)
      applyIfEmpty('heroSubtitle', t.heroSubtitle)
      applyIfEmpty('aboutTitle', t.aboutTitle)
      applyIfEmpty('aboutText', t.aboutText)
      applyIfEmpty('offerTitle', t.offerTitle)

      // Ponuda: dopuni naslove koji fale; ne dira postojeće unose
      const existing = this.form.offerItems?.length ? this.form.offerItems : []
      const need = Math.max(0, t.offerItems.length - existing.length)
      for (let i = 0; i < need; i++) {
        existing.push({ title: '', image: null })
      }
      this.form.offerItems = existing.map((it, idx) => ({
        title: it.title && it.title.trim() !== '' ? it.title : (t.offerItems[idx] || ''),
        image: it.image || null
      }))
    },

    addItem() {
      if (this.form.offerItems.length < 12)
        this.form.offerItems.push({ title: '', image: null })
    },
    removeItem(i) {
      this.form.offerItems.splice(i, 1)
    },

    // ---------- FILE VALIDACIJE ----------
    handleFile(e, field) {
      const file = e.target.files?.[0]
      if (!file) return

      if (field !== 'pdfDocument') {
        if (!file.type?.startsWith('image/') || file.size > 4 * 1024 * 1024) {
          this.errorMessage = this.$t?.('proform.errors.image') || 'Pogrešna slika ili prevelika.'
          this.form[field] = null
          return
        }
      } else {
        if (file.type !== 'application/pdf') {
          this.errorMessage = this.$t?.('proform.errors.pdf') || 'PDF nije ispravan.'
          this.form[field] = null
          return
        }
      }

      this.form[field] = file
      this.errorMessage = ''
    },
    handleOfferImageUpload(e, i) {
      const file = e.target.files?.[0]
      if (!file) {
        this.form.offerItems[i].image = null
        return
      }
      if (!file.type?.startsWith('image/') || file.size > 4 * 1024 * 1024) {
        this.errorMessage = this.$t?.('proform.errors.offerImage', { index: i + 1 }) || 'Neispravna slika u ponudi.'
        this.form.offerItems[i].image = null
        return
      }
      this.form.offerItems[i].image = file
      this.errorMessage = ''
    },

    // ---------- AI PROMPTOVI ----------
    promptGeneral() {
      // Mali helper dok korisnik popunjava opšte podatke — daje ideje za naming/tagline
      const name = this.form.name || 'firma'
      const desc = this.form.description || 'opis delatnosti'
      return `Na osnovu naziva "${name}" i opisa "${desc}", predloži 3 kratke varijante opisa/claim-a (jedna rečenica), i 3 ideje za email inbox poruku dobrodošlice. Odgovori sa kratkim nabrajanjima.`
    },
    promptHero() {
      const name = this.form.name || 'naša firma'
      const desc = this.form.description || 'naša delatnost'
      return `Napiši 3 kratka hero naslova i 3 podnaslova za sajt firme "${name}" (delatnost: ${desc}). Stil: koncizno, jasno, bez preteranog marketinga.`
    },
    promptAbout() {
      const name = this.form.name || 'naša firma'
      return `Napiši kratak tekst "O nama" (4–6 rečenica) za firmu "${name}". Ton: profesionalan, konkretan, bez fraza. Na kraju dodaj 3 kratke bullet tačke vrednosti koje nudimo.`
    },
    promptPdf() {
      const name = this.form.name || 'firma'
      const desc = this.form.description || 'delatnost'
      return `Generiši primer sadržaja cenovnika (naslov + sekcije + 5–7 stavki) za "${name}" (delatnost: ${desc}). Ubaci primere opisa i cena (valuta RSD). Kratko i pregledno.`
    },

    // ---------- SUBMIT ----------
   async submitForm() {
  this.successMessage = ''
  this.errorMessage = ''
  this.loading = true
  this.resData = null

  try {
    const fd = new FormData()
    fd.append('type', 'pro')
    fd.append('plan', this.form.plan || '')

    // tekst polja (snake_case)
    fd.append('name', this.form.name || '')
    fd.append('description', this.form.description || '')
    fd.append('email', this.form.email || '')
    fd.append('phone', this.form.phone || '')
    fd.append('facebook', this.form.facebook || '')
    fd.append('instagram', this.form.instagram || '')
    fd.append('hero_title', this.form.heroTitle || '')
    fd.append('hero_subtitle', this.form.heroSubtitle || '')
    fd.append('about_title', this.form.aboutTitle || '')
    fd.append('about_text', this.form.aboutText || '')
    fd.append('offer_title', this.form.offerTitle || '')
    fd.append('template', this.form.template || '')
    fd.append('video_url', this.form.youtubeLink || '')
    fd.append('google_map_link', this.form.google_map_link || '')

    // ✅ OVO JE NEDOSTAJALO
    fd.append('phone2', this.form.phone2 || '')
    fd.append('phone3', this.form.phone3 || '')
    fd.append('email2', this.form.email2 || '')
    fd.append('email3', this.form.email3 || '')

    // adresu spoji (backend čuva u jednom polju)
    const address = [this.form.address_street, this.form.address_city]
      .map(s => (s || '').trim())
      .filter(Boolean)
      .join(', ')
    fd.append('address', address)

    // fajlovi
    if (this.form.logo)        fd.append('logo', this.form.logo)
    if (this.form.heroImage)   fd.append('hero_image', this.form.heroImage)
    if (this.form.aboutImage)  fd.append('about_image', this.form.aboutImage)
    if (this.form.pdfDocument) fd.append('pdf_file', this.form.pdfDocument)

    // ponuda
    this.form.offerItems.forEach((item, i) => {
      fd.append(`offer_items[${i}][title]`, item?.title || '')
      if (item?.image instanceof File) {
        fd.append(`offer_items[${i}][image]`, item.image)
      }
    })

    const { data } = await api.post('/free-site-request', fd)
    this.successMessage = this.$t?.('proform.success') || 'Zahtev uspešno poslat.'
    this.resData = data
  } catch (err) {
    console.error('❌', err?.response || err)
    const status = err?.response?.status
    if (status === 422 && err?.response?.data?.errors) {
      const first = Object.values(err.response.data.errors).flat()?.[0]
      this.errorMessage = first || this.$t?.('proform.errors.general') || 'Došlo je do greške.'
    } else {
      this.errorMessage = err?.response?.data?.message || this.$t?.('proform.errors.general') || 'Došlo je do greške.'
    }
  } finally {
    this.loading = false
  }
},

    async fetchFromSlug(slug) {
      try {
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
        this.form.youtubeLink = source?.video_url ?? ''
        const address = source?.address || ''
        this.form.address_city = address.split(',')[1]?.trim() || ''
        this.form.address_street = address.split(',')[0]?.trim() || ''
        this.form.google_map_link = source?.google_map_link ?? ''
        this.form.phone2 = source?.phone2 ?? ''
        this.form.phone3 = source?.phone3 ?? ''
        this.form.email2 = source?.email2 ?? ''
        this.form.email3 = source?.email3 ?? ''
        this.form.template = source?.template ?? this.form.template

        // Ako korisnik učitava iz postojećeg sluga, dopuni prazna polja šablonskim primerima:
        this.applyTemplateDefaults()
      } catch (err) {
        console.error('❌', err)
        this.errorMessage = this.$t?.('proform.errors.fetch') || 'Greška pri učitavanju.'
      }
    },
  },
}
</script>
