<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <div v-if="siteData">
      <!-- INFO o paketu -->
<div class="text-center mb-6 mt-36">
  <h2 class="text-lg text-white font-semibold mb-1 flex items-center justify-center gap-2">
    📢 {{ $t('siteview.previewOf') }}
    <span
      class="text-xs font-bold px-2 py-1 rounded uppercase"
      :class="siteData.type === 'pro' ? 'bg-yellow-500 text-slate-900' : 'bg-green-500 text-white'"
    >
      {{ siteData.type === 'pro' ? 'PRO' : 'FREE' }}
    </span>
  </h2>

  <!-- Obaveštenje o paketu -->
  <div
    :class="siteData.type === 'pro'
      ? 'bg-yellow-100 text-yellow-800 border-yellow-300'
      : 'bg-green-100 text-green-900 border-green-300'"
    class="text-sm p-4 rounded mb-4 max-w-xl mx-auto border"
  >
    <template v-if="siteData.type === 'pro'">
      <strong>⚠️ {{ $t('siteview.pro.title') }}</strong><br />
      {{ $t('siteview.pro.editBlocked') }}<br />
      <router-link to="/contact" class="text-blue-600 underline hover:text-blue-800">
        {{ $t('siteview.contactSupport') }}
      </router-link>
    </template>

    <template v-else>
      <strong>🎉 {{ $t('siteview.free.title') }}</strong><br />
      {{ $t('siteview.free.linkMessage') }}
      <div class="mt-2 flex items-center justify-center gap-2">
        <input
          type="text"
          :value="fullLink"
          readonly
          class="w-full max-w-md px-3 py-1 rounded border border-slate-300 bg-white text-black text-sm"
        />
        <button
          @click="copyLink"
          class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1 rounded shadow"
        >
          📋 {{ $t('siteview.copy') }}
        </button>
      </div>
      <p v-if="copySuccess" class="text-green-600 text-xs mt-1">
        {{ $t('siteview.copied') }}
      </p>

      <div class="mt-3 text-sm">
        {{ $t('siteview.notSatisfied') }}
        <router-link to="/free-site-form" class="text-blue-600 underline hover:text-blue-800">
          {{ $t('siteview.fillAgain') }}
        </router-link>.
      </div>
    </template>

    <!-- Dugme za preview -->
    <div class="mt-4 text-center">
      <router-link
        :to="`/preview/${slug}`"
        target="_blank"
        class="bg-slate-500 hover:bg-slate-600 text-white px-4 py-1 rounded text-sm"
      >
        🌐 {{ $t('siteview.openPreview') }}
      </router-link>
      <p class="text-xs text-slate-400 mt-2">
        {{ $t('siteview.pdfHint') }}
      </p>
    </div>
  </div>
</div>


      <!-- 🔧 Akcije -->
      <div v-if="isOwnerOrAdmin" class="flex justify-center gap-4 mb-6">
        <router-link
          :to="`/edit-site/${slug}`"
          class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded shadow"
        >
          ✏️ {{ $t('siteview.edit') }}
        </router-link>
        <button
          @click="confirmDelete"
          class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded shadow"
        >
          🗑 {{ $t('siteview.delete') }}
        </button>
      </div>

      <!-- 👁 Komponenta -->
      <div ref="printArea">
        <component :is="templateComponent" :data="siteData" />
      </div>
    </div>

    <div v-else class="text-white text-center py-20">{{ $t('siteview.loading') }}</div>

    <Footer />
  </div>
</template>

<script>
import html2pdf from 'html2pdf.js'
import { getCurrentUser } from '../utils/auth'
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import api from '../api/http' // ✅ centralna axios instanca

// Šabloni
import ClassicPreview from '../templates/ClassicPreview.vue'
import ClassicPreviewPro from '../templates/ClassicPreviewPro.vue'
import ModernPreview from '../templates/ModernPreview.vue'
import ModernPreviewPro from '../templates/ModernPreviewPro.vue'
import GalleryPreview from '../templates/GalleryPreview.vue'
import GalleryPreviewPro from '../templates/GalleryPreviewPro.vue'
import BusinessPreview from '../templates/BusinessPreview.vue'
import BusinessPreviewPro from '../templates/BusinessPreviewPro.vue'
import DarkPreview from '../templates/DarkPreview.vue'
import DarkPreviewPro from '../templates/DarkPreviewPro.vue'

export default {
  name: 'PresentationView',
  props: ['slug'],
  components: {
    ClassicPreview,
    ClassicPreviewPro,
    ModernPreview,
    ModernPreviewPro,
    GalleryPreview,
    GalleryPreviewPro,
    BusinessPreview,
    BusinessPreviewPro,
    DarkPreview,
    DarkPreviewPro,
    Header,
    Footer
  },
  data() {
    return {
      siteData: null,
      user: getCurrentUser(),
      copySuccess: false,
      loading: false
    }
  },
  computed: {
    isOwnerOrAdmin() {
      return (
        this.user &&
        (this.user.id === this.siteData?.user_id || ['admin', 'superadmin'].includes(this.user.role))
      )
    },
    templateComponent() {
      const map = {
        'klasicni': 'ClassicPreview',
        'moderni': 'ModernPreview',
        'galerija': 'GalleryPreview',
        'biznis': 'BusinessPreview',
        'dark': 'DarkPreview',
        'klasicni-pro': 'ClassicPreviewPro',
        'moderni-pro': 'ModernPreviewPro',
        'galerija-pro': 'GalleryPreviewPro',
        'biznis-pro': 'BusinessPreviewPro',
        'dark-pro': 'DarkPreviewPro'
      }
      return map[this.siteData?.template] || 'ClassicPreview'
    },
    fullLink() {
      return `${window.location.origin}/prezentacije/${this.slug}`
    }
  },
  methods: {
    async fetchSite() {
      this.loading = true
      try {
        const { data } = await api.get(`/site-request/${this.slug}`) // → /api/site-request/:slug
        this.siteData = data
      } catch (err) {
        console.error('❌ Fetch error:', err)
        alert(this.$t?.('siteview.errors.fetch') || 'Greška pri učitavanju prezentacije.')
      } finally {
        this.loading = false
      }
    },
    async confirmDelete() {
      const confirmMsg = this.$t?.('siteview.confirmDelete') || 'Da li sigurno želite da obrišete prezentaciju?'
      if (!confirm(confirmMsg)) return

      try {
        await api.delete(`/site-request/${this.slug}`) // → /api/site-request/:slug
        alert(this.$t?.('siteview.deleted') || 'Prezentacija je obrisana.')

        const destination =
          this.user?.role === 'admin' || this.user?.role === 'superadmin'
            ? '/admin/dashboard'
            : '/dashboard'

        this.$router.push(destination)
      } catch (err) {
        console.error('❌ Delete error:', err)
        alert(this.$t?.('siteview.errors.delete') || 'Greška pri brisanju prezentacije.')
      }
    },
    copyLink() {
      navigator.clipboard.writeText(this.fullLink).then(() => {
        this.copySuccess = true
        setTimeout(() => (this.copySuccess = false), 3000)
      })
    },
    downloadPDF() {
      const element = this.$refs.printArea
      const opt = {
        margin: 0.5,
        filename: `${this.slug}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
      }
      html2pdf().set(opt).from(element).save()
    }
  },
  created() {
    this.fetchSite()
  }
}
</script>
