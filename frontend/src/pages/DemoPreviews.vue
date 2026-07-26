<script>
import DemoBox from '../components/DemoBox.vue'
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'

export default {
  name: 'DemoPreviews',
  components: { DemoBox, Header, Footer },
  computed: {
    demos() {
      return [
        {
          name: 'TRUBAČI - Beograd, Mihajlo Spasić',
          free: '/prezentacije/mihajlo-spasic-trubaci-bg-68b4c5a665b0e',
          pro:  '/prezentacije/mihajlo-spasic-trubaci-bg-68b4c5a665b0e',
        },
         {
          name: 'Pet shop Dona',
          free: '/prezentacije/dona-pet-shop-68a5a1d4436b4',
          pro:  '/prezentacije/dona-pet-shop-68a5a1c12675e',
        },
        {
          name: 'Pekara Maja',
          free: '/prezentacije/pekaraposlasticarnica-maja-689f14fe2a983',
          pro:  '/prezentacije/pekaraposlasticarnica-maja-689f152ff16f5',
        },
        {
          name: 'Cvećara Flover',
          free: '/prezentacije/cvecara-flower-689eccc2cc5fd',
          pro:  '/prezentacije/cvecara-flower-689ecb686a6dc',
        },
        {
          name: 'Frizer Neša',
          free: '/prezentacije/frizer-nesa-689dbf092251a',
          pro:  '/prezentacije/frizer-nesa-689db59a24081',
        },
        {
          name: 'HIT Auto',
          free: '/prezentacije/hit-auto-sabac-689ddd8396c41',
          pro:  '/prezentacije/hit-auto-sabac-689ddf3418f94',
        },
      ]
    },
  },
  methods: {
    tFree(name) {
      return `🏡 ${name} / ${this.$t('demoPreviews.title_free')}`
    },
    tPro(name) {
      return `🏡 ${name} / ${this.$t('demoPreviews.title_pro')}`
    },
  },
}
</script>

<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <Header />

    <section class="min-h-screen bg-slate-900 text-white py-16 px-4 sm:px-6">
      <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-center mb-6 mt-[100px]">
          {{ $t('demoPreviews.title') }}
        </h1>

        <p class="text-slate-400 text-center mb-12 max-w-2xl mx-auto">
          {{ $t('demoPreviews.subtitle') }}
        </p>

        <div class="grid md:grid-cols-2 gap-6">
          <template v-for="d in demos" :key="d.name">
            <DemoBox :title="tFree(d.name)" :description="$t('demoPreviews.description_free')" :link="d.free" />
            <DemoBox :title="tPro(d.name)"  :description="$t('demoPreviews.description_pro')"  :link="d.pro"  />
          </template>
        </div>

        <div class="text-center mt-12 space-y-4">
          <div class="flex flex-col sm:flex-row gap-4 justify-center mt-2">
            <router-link
              to="/free-site-form"
              class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded font-medium text-sm shadow transition"
            >
              {{ $t('demoPreviews.freeSiteButton') }}
            </router-link>

            <router-link
              to="/pro-site-form"
              class="bg-yellow-500 hover:bg-yellow-600 text-slate-900 px-5 py-3 rounded font-medium text-sm shadow transition"
            >
              {{ $t('demoPreviews.proSiteButton') }}
            </router-link>
          </div>
        </div>
      </div>
    </section>

    <Footer />
  </div>
</template>
