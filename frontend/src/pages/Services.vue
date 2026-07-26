<template>
  <div class="relative flex min-h-screen flex-col overflow-hidden bg-slate-900 text-white">
    <!-- Background -->
    <div class="absolute inset-0 -z-10" aria-hidden="true">
      <Particles class="absolute inset-0" />

      <div class="absolute bottom-0 left-1/2 -translate-x-1/2 opacity-20">
        <img
          src="../images/glow-top.svg"
          class="max-w-none"
          width="1200"
          height="430"
          alt=""
        />
      </div>
    </div>

    <Header />

    <main class="grow">
      <section
        class="mx-auto max-w-6xl px-4 pb-20 pt-32 sm:px-6 md:pt-40"
        aria-labelledby="services-title"
      >
        <header class="mx-auto mb-12 max-w-3xl text-center">
          <div
            class="mb-4 inline-flex rounded-full border border-purple-500/30 bg-purple-500/10 px-4 py-1.5 text-sm font-medium text-purple-300"
          >
            {{ $t('services_page.label') }}
          </div>

          <h1
            id="services-title"
            class="h1 bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60 bg-clip-text pb-4 text-transparent"
          >
            {{ $t('services_page.title') }}
          </h1>

          <p class="text-lg leading-relaxed text-slate-400">
            {{ $t('services_page.intro') }}
          </p>
        </header>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <article
            v-for="service in services"
            :key="service.id"
            class="group flex flex-col rounded-2xl border border-slate-700/80 bg-slate-800/70 p-6 shadow-lg backdrop-blur-sm transition duration-200 hover:-translate-y-1 hover:border-purple-500/50 hover:shadow-purple-950/30"
          >
            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-purple-500/10 text-xl">
              {{ service.icon }}
            </div>

            <h2 class="mb-2 text-xl font-semibold text-slate-100">
              {{ $t(`services_page.items.${service.id}.title`) }}
            </h2>

            <p class="mb-5 grow text-sm leading-relaxed text-slate-400">
              {{ $t(`services_page.items.${service.id}.description`) }}
            </p>

            <RouterLink
              :to="service.to"
              class="inline-flex items-center text-sm font-medium text-purple-300 transition hover:text-purple-200"
            >
              {{ $t('services_page.more') }}
              <span class="ml-1 transition-transform group-hover:translate-x-1">→</span>
            </RouterLink>
          </article>
        </div>

        <div class="mt-16 text-center">
          <p class="mb-5 text-slate-400">
            {{ $t('services_page.cta_text') }}
          </p>

          <RouterLink
            to="/contact"
            class="btn bg-linear-to-r from-white/80 via-white to-white/80 text-slate-900 transition hover:bg-white"
          >
            {{ $t('services_page.cta_button') }}
            <span class="ml-1 text-purple-500">→</span>
          </RouterLink>
        </div>
      </section>
    </main>

    <Footer />
  </div>
</template>

<script>
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import Particles from '../partials/Particles.vue'

export default {
  name: 'Services',

  components: {
    Header,
    Footer,
    Particles,
  },

  data() {
    return {
      services: [
        { id: 1, icon: '🌐', to: '/services/freesite' },
        { id: 2, icon: '🏢', to: '/services/originalsite' },
        { id: 3, icon: '🛒', to: '/services/basicshop' },
        { id: 4, icon: '🏬', to: '/services/unishop' },
        { id: 5, icon: '☁️', to: '/services/domain-hosting' },
        { id: 6, icon: '🛠️', to: '/services/maintenance' },
        { id: 7, icon: '🎨', to: '/services/design' },
        { id: 8, icon: '🔎', to: '/services/seo' },
        { id: 9, icon: '📣', to: '/services/marketing' },
        { id: 10, icon: '🔗', to: '/services/integrations' },
        { id: 11, icon: '🌍', to: '/services/translation' },
        { id: 12, icon: '🤖', to: '/services/ai-automation' },
      ],
    }
  },
}
</script>