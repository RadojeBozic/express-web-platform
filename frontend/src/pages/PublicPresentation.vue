<template>
  <div v-if="siteData" ref="printOnly">
    <component :is="templateComponent" :data="siteData" />
  </div>
  <div v-else class="text-center text-white py-20">
    ⚠️ Nije moguće prikazati ovu prezentaciju.<br />
    Molimo kontaktirajte administraciju ako smatrate da je došlo do greške.
  </div>
</template>


<script>
import api from '../api/http'

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
  name: 'PublicPresentation',
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
    DarkPreviewPro
  },
  data() {
    return {
      siteData: null,
      loading: false,
      error: null,
    }
  },
  computed: {
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
    }
  },
  methods: {
    async fetchSite() {
      this.loading = true
      this.error = null
      try {
        const { data } = await api.get(`/site-request/${this.slug}`) // → /api/site-request/:slug
        this.siteData = data
      } catch (err) {
        console.error('❌ Greška pri učitavanju sajta:', err)
        this.error = 'Greška pri učitavanju sajta.'
        this.siteData = null
      } finally {
        this.loading = false
      }
    }
  },
  created() {
    this.fetchSite()
  }
}
</script>

<style>
/* (Opc.) ukloni marginu tela za “čist” print/PDF render */
body { margin: 0; }
</style>
