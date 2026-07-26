<template>
  <section class="relative overflow-hidden" aria-labelledby="home-hero-title">
    <div class="relative mx-auto max-w-6xl px-4 sm:px-6">
      <Particles class="absolute inset-0 -z-10" aria-hidden="true" />

      <div
        class="pointer-events-none absolute inset-0 -z-10 -mx-28 overflow-hidden rounded-b-[3rem]"
        aria-hidden="true"
      >
        <div class="absolute bottom-0 left-1/2 -z-10 -translate-x-1/2">
          <img
            src="../images/glow-bottom.svg"
            class="max-w-none"
             width="600"
             height="130"
            alt=""
          />
        </div>
      </div>

      <div class="pb-16 pt-32 md:pb-28 md:pt-48">
        <div class="mx-auto max-w-4xl text-center">
          <div class="mb-6" data-aos="fade-down">
            <span
              class="relative inline-flex rounded-full border border-purple-400/20 bg-slate-900/60 px-4 py-1.5 text-sm font-medium text-slate-200 shadow-sm backdrop-blur-sm before:absolute before:inset-0 before:-z-10 before:rounded-full before:bg-purple-500/20 before:blur-md"
            >
              {{ t('hero.label') }}
            </span>
          </div>

          <h1
            id="home-hero-title"
            class="h1 bg-linear-to-r from-slate-200/60 via-slate-100 to-slate-200/60 bg-clip-text pb-5 text-transparent"
            data-aos="fade-down"
            data-aos-delay="100"
          >
            {{ t('hero.title') }}
          </h1>

          <p
            class="mx-auto mb-8 max-w-3xl text-lg leading-relaxed text-slate-300 md:text-xl"
            data-aos="fade-down"
            data-aos-delay="200"
          >
            {{ t('hero.description') }}
          </p>

          <div
            class="mx-auto flex max-w-md flex-col justify-center gap-4 sm:max-w-none sm:flex-row"
            data-aos="fade-down"
            data-aos-delay="300"
          >
            <RouterLink
              to="/contact"
              class="btn group w-full bg-linear-to-r from-white/80 via-white to-white/80 text-slate-900 transition duration-150 ease-in-out hover:bg-white sm:w-auto"
            >
              {{ t('hero.primary_button') }}
              <span
                class="ml-1 text-purple-500 transition-transform duration-150 ease-in-out group-hover:translate-x-0.5"
                aria-hidden="true"
              >
                -&gt;
              </span>
            </RouterLink>

            <RouterLink
              to="/projects"
              class="btn group w-full border border-slate-700/70 bg-slate-900/30 text-slate-200 transition duration-150 ease-in-out hover:border-slate-600 hover:bg-slate-900/50 hover:text-white sm:w-auto"
            >
              {{ t('hero.secondary_button') }}
              <span
                class="ml-1 text-purple-400 transition-transform duration-150 ease-in-out group-hover:translate-x-0.5"
                aria-hidden="true"
              >
                -&gt;
              </span>
            </RouterLink>
          </div>

          <ul
            class="mx-auto mt-9 flex max-w-3xl flex-wrap justify-center gap-x-6 gap-y-3 text-sm text-slate-400"
            data-aos="fade-down"
            data-aos-delay="400"
          >
            <li v-for="benefit in benefits" :key="benefit" class="inline-flex items-center gap-2">
              <svg
                class="shrink-0 fill-purple-400"
                xmlns="http://www.w3.org/2000/svg"
                width="12"
                height="9"
                viewBox="0 0 12 9"
                aria-hidden="true"
              >
                <path d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z" />
              </svg>
              <span>{{ benefit }}</span>
            </li>
          </ul>

          <p class="mt-6 text-sm text-slate-500" data-aos="fade-down" data-aos-delay="500">
            {{ t('hero.note') }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { computed } from 'vue'
import { useI18n } from 'vue-i18n'
import Particles from './Particles.vue'

export default {
  name: 'Hero',
  components: {
    Particles,
  },
  setup() {
    const { t, tm } = useI18n()

    const benefits = computed(() => {
      const items = tm('hero.benefits')
      return Array.isArray(items) ? items.map((item) => String(item)) : []
    })

    return {
      t,
      benefits,
    }
  },
}
</script>
