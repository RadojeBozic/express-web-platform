<template>
  <div class="relative flex min-h-screen flex-col overflow-hidden bg-slate-900 text-white">
    <!-- Background -->
    <div class="absolute inset-0 -z-10" aria-hidden="true">
      <Particles class="absolute inset-0" />

      <div class="absolute bottom-[-180px] left-1/2 -translate-x-1/2 opacity-20">
        <img
          src="../images/glow-bottom.svg"
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
        aria-labelledby="projects-title"
      >
        <!-- Hero -->
        <header class="mx-auto mb-14 max-w-3xl text-center">
          <div
            class="mb-4 inline-flex rounded-full border border-purple-500/30 bg-purple-500/10 px-4 py-1.5 text-sm font-medium text-purple-300"
          >
            {{ $t('portfolio.label') }}
          </div>

          <h1
            id="projects-title"
            class="h1 bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60 bg-clip-text pb-4 text-transparent"
          >
            {{ $t('portfolio.title') }}
          </h1>

          <p class="text-lg leading-relaxed text-slate-400">
            {{ $t('portfolio.intro') }}
          </p>
        </header>

        <!-- Projects -->
        <div class="space-y-10">
          <article
            v-for="(project, index) in projects"
            :key="project.id"
            class="grid items-center gap-8 overflow-hidden rounded-3xl border border-slate-700/80 bg-slate-800/60 p-5 shadow-xl backdrop-blur-sm md:grid-cols-2 md:p-8"
          >
            <!-- Visual -->
            <div
              class="overflow-hidden rounded-2xl border border-slate-700 bg-slate-950"
              :class="{ 'md:order-2': index % 2 !== 0 }"
            >
              <img
                v-if="project.image"
                :src="project.image"
                :alt="$t(`portfolio.items.${project.id}.image_alt`)"
                class="aspect-video h-full w-full object-cover transition duration-500 hover:scale-[1.02]"
                loading="lazy"
              />

              <div
                v-else
                class="flex aspect-video items-center justify-center bg-linear-to-br from-slate-800 to-slate-950"
              >
                <span class="text-5xl">{{ project.icon }}</span>
              </div>
            </div>

            <!-- Content -->
            <div :class="{ 'md:order-1': index % 2 !== 0 }">
              <div class="mb-3 text-sm font-medium text-purple-300">
                {{ $t(`portfolio.items.${project.id}.category`) }}
              </div>

              <h2 class="mb-4 text-2xl font-bold text-slate-100 md:text-3xl">
                {{ $t(`portfolio.items.${project.id}.title`) }}
              </h2>

              <p class="mb-5 leading-relaxed text-slate-400">
                {{ $t(`portfolio.items.${project.id}.description`) }}
              </p>

              <ul class="mb-6 space-y-2">
                <li
                  v-for="featureIndex in project.featureCount"
                  :key="featureIndex"
                  class="flex items-start text-sm text-slate-300"
                >
                  <svg
                    class="mr-3 mt-1 shrink-0 fill-purple-400"
                    width="12"
                    height="9"
                    viewBox="0 0 12 9"
                    aria-hidden="true"
                  >
                    <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
                  </svg>

                  {{ $t(`portfolio.items.${project.id}.features.${featureIndex}`) }}
                </li>
              </ul>

              <div class="flex flex-wrap gap-3">
                <a
                  v-if="project.url"
                  :href="project.url"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="btn-sm bg-purple-600 text-white transition hover:bg-purple-500"
                >
                  {{ $t('portfolio.visit_project') }}
                  <span class="ml-1">↗</span>
                </a>

                <RouterLink
                  to="/contact"
                  class="btn-sm border border-slate-600 bg-slate-900/50 text-slate-200 transition hover:border-slate-500 hover:text-white"
                >
                  {{ $t('portfolio.similar_project') }}
                  <span class="ml-1">→</span>
                </RouterLink>
              </div>
            </div>
          </article>
        </div>

        <!-- CTA -->
        <section
          class="mt-16 rounded-3xl border border-purple-500/20 bg-purple-500/10 px-6 py-10 text-center md:px-12"
        >
          <h2 class="mb-3 text-2xl font-bold text-slate-100 md:text-3xl">
            {{ $t('portfolio.cta.title') }}
          </h2>

          <p class="mx-auto mb-6 max-w-2xl text-slate-400">
            {{ $t('portfolio.cta.description') }}
          </p>

          <RouterLink
            to="/contact"
            class="btn bg-linear-to-r from-white/80 via-white to-white/80 text-slate-900 transition hover:bg-white"
          >
            {{ $t('portfolio.cta.button') }}
            <span class="ml-1 text-purple-500">→</span>
          </RouterLink>
        </section>
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
  name: 'Projects',

  components: {
    Header,
    Footer,
    Particles,
  },

  data() {
    return {
      projects: [
        {
          id: 1,
          icon: '🏢',
          image: new URL('../images/projects/gvp_src.png', import.meta.url).href,
          url: 'https://gvpconsult.rs',
          featureCount: 5,
        },
        {
          id: 2,
          icon: '🛒',
          image: new URL('../images/projects/agro_bim_shop_src.png', import.meta.url).href,
          url: 'https://agro-bim.shop',
          featureCount: 5,
        },
        {
          id: 3,
          icon: '🌐',
          image: new URL('../images/projects/agrobim_src.png', import.meta.url).href,
          url: 'https://agro-bim.com',
          featureCount: 5,
        },
        {
          id: 4,
          icon: '📰',
          image: new URL('../images/projects/agro_bim_media_src.png', import.meta.url).href,
          url: 'https://agro-bim.media',
          featureCount: 5,
        },
      ],
    }
  },
}
</script>