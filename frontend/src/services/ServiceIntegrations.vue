<template>
  <div
    class="relative flex min-h-screen flex-col overflow-hidden bg-slate-900 text-white"
  >
    <!-- Background -->
    <div
      class="absolute inset-0 -z-10 overflow-hidden"
      aria-hidden="true"
    >
      <Particles class="absolute inset-0" />

      <div
        class="absolute left-1/2 top-0 h-[520px] w-[900px] -translate-x-1/2 rounded-full bg-purple-600/15 blur-[140px]"
      ></div>

      <div
        class="absolute bottom-[-220px] left-1/2 -translate-x-1/2 opacity-20"
      >
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
      <!-- Hero -->
      <section
        class="mx-auto max-w-6xl px-4 pb-16 pt-32 sm:px-6 md:pb-20 md:pt-44"
        aria-labelledby="integrations-title"
      >
        <div class="mx-auto max-w-4xl text-center">
          <div
            class="mb-5 inline-flex rounded-full border border-purple-500/30 bg-purple-500/10 px-4 py-1.5 text-sm font-medium text-purple-300"
          >
            {{ $t('service_integrations.label') }}
          </div>

          <h1
            id="integrations-title"
            class="h1 bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60 bg-clip-text pb-5 text-transparent"
          >
            {{ $t('service_integrations.title') }}
          </h1>

          <p
            class="mx-auto max-w-3xl text-lg leading-relaxed text-slate-300 md:text-xl"
          >
            {{ $t('service_integrations.description') }}
          </p>

          <div
            class="mx-auto mt-8 flex max-w-xl flex-col justify-center gap-4 sm:flex-row"
          >
            <RouterLink
              to="/contact"
              class="btn bg-linear-to-r from-white/80 via-white to-white/80 text-slate-900 transition hover:bg-white"
            >
              {{ $t('service_integrations.primary_button') }}
              <span class="ml-1 text-purple-500">→</span>
            </RouterLink>

            <a
              href="#integrations-list"
              class="btn border border-slate-700 bg-slate-900/40 text-slate-200 transition hover:border-slate-500 hover:text-white"
            >
              {{ $t('service_integrations.secondary_button') }}
              <span class="ml-1 text-purple-300">↓</span>
            </a>
          </div>
        </div>
      </section>

      <!-- Value proposition -->
      <section class="mx-auto max-w-6xl px-4 pb-16 sm:px-6 md:pb-24">
        <div
          class="grid gap-5 rounded-3xl border border-slate-700/70 bg-slate-800/50 p-5 backdrop-blur-sm md:grid-cols-3 md:p-8"
        >
          <article
            v-for="benefit in benefits"
            :key="benefit.id"
            class="rounded-2xl border border-slate-700/60 bg-slate-900/40 p-5"
          >
            <div
              class="mb-4 flex h-11 w-11 items-center justify-center rounded-xl bg-purple-500/10 text-xl"
              aria-hidden="true"
            >
              {{ benefit.icon }}
            </div>

            <h2 class="mb-2 text-lg font-semibold text-slate-100">
              {{ $t(`service_integrations.benefits.${benefit.id}.title`) }}
            </h2>

            <p class="text-sm leading-relaxed text-slate-400">
              {{ $t(`service_integrations.benefits.${benefit.id}.description`) }}
            </p>
          </article>
        </div>
      </section>

      <!-- Integrations -->
      <section
        id="integrations-list"
        class="mx-auto max-w-6xl scroll-mt-24 px-4 pb-20 sm:px-6 md:pb-28"
        aria-labelledby="integrations-list-title"
      >
        <header class="mx-auto mb-12 max-w-3xl text-center">
          <div
            class="mb-3 text-sm font-medium uppercase tracking-[0.18em] text-purple-300"
          >
            {{ $t('service_integrations.catalog.label') }}
          </div>

          <h2
            id="integrations-list-title"
            class="mb-4 text-3xl font-bold text-slate-100 md:text-4xl"
          >
            {{ $t('service_integrations.catalog.title') }}
          </h2>

          <p class="text-lg leading-relaxed text-slate-400">
            {{ $t('service_integrations.catalog.description') }}
          </p>
        </header>

        <!-- Category filters -->
        <div
          class="mb-10 flex flex-wrap justify-center gap-2"
          aria-label="Integration categories"
        >
          <button
            v-for="category in categories"
            :key="category.id"
            type="button"
            class="rounded-full border px-4 py-2 text-sm font-medium transition"
            :class="
              activeCategory === category.id
                ? 'border-purple-500 bg-purple-500/15 text-purple-200'
                : 'border-slate-700 bg-slate-900/30 text-slate-400 hover:border-slate-600 hover:text-slate-200'
            "
            @click="activeCategory = category.id"
          >
            {{ $t(`service_integrations.categories.${category.id}`) }}
          </button>
        </div>

        <!-- Integration cards -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <article
            v-for="integration in filteredIntegrations"
            :key="integration.id"
            class="group flex flex-col rounded-2xl border border-slate-700/70 bg-slate-800/60 p-6 shadow-lg backdrop-blur-sm transition duration-200 hover:-translate-y-1 hover:border-purple-500/50 hover:shadow-purple-950/30"
          >
            <div class="mb-5 flex items-start justify-between gap-3">
              <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-900/70 text-2xl"
                aria-hidden="true"
              >
                {{ integration.icon }}
              </div>

              <span
                class="rounded-full border px-2.5 py-1 text-xs font-medium"
                :class="statusClass(integration.status)"
              >
                {{
                  $t(
                    `service_integrations.statuses.${integration.status}`
                  )
                }}
              </span>
            </div>

            <h3 class="mb-2 text-xl font-semibold text-slate-100">
              {{
                $t(
                  `service_integrations.integrations.${integration.id}.title`
                )
              }}
            </h3>

            <p class="mb-5 grow text-sm leading-relaxed text-slate-400">
              {{
                $t(
                  `service_integrations.integrations.${integration.id}.description`
                )
              }}
            </p>

            <div
              class="border-t border-slate-700/70 pt-4 text-sm text-slate-300"
            >
              <span class="font-medium text-purple-300">
                {{ $t('service_integrations.purpose_label') }}
              </span>

              {{
                $t(
                  `service_integrations.integrations.${integration.id}.purpose`
                )
              }}
            </div>
          </article>
        </div>
      </section>

      <!-- Process -->
      <section class="border-y border-slate-800/80 bg-slate-950/30">
        <div class="mx-auto max-w-6xl px-4 py-20 sm:px-6 md:py-24">
          <header class="mx-auto mb-12 max-w-3xl text-center">
            <div
              class="mb-3 text-sm font-medium uppercase tracking-[0.18em] text-purple-300"
            >
              {{ $t('service_integrations.process.label') }}
            </div>

            <h2 class="mb-4 text-3xl font-bold text-slate-100 md:text-4xl">
              {{ $t('service_integrations.process.title') }}
            </h2>

            <p class="text-lg text-slate-400">
              {{ $t('service_integrations.process.description') }}
            </p>
          </header>

          <ol class="grid gap-6 md:grid-cols-4">
            <li
              v-for="step in processSteps"
              :key="step"
              class="relative rounded-2xl border border-slate-700/70 bg-slate-800/50 p-6"
            >
              <div
                class="mb-4 flex h-9 w-9 items-center justify-center rounded-full bg-purple-600 text-sm font-bold text-white"
              >
                {{ step }}
              </div>

              <h3 class="mb-2 font-semibold text-slate-100">
                {{ $t(`service_integrations.process.steps.${step}.title`) }}
              </h3>

              <p class="text-sm leading-relaxed text-slate-400">
                {{
                  $t(
                    `service_integrations.process.steps.${step}.description`
                  )
                }}
              </p>
            </li>
          </ol>
        </div>
      </section>

      <!-- Security -->
      <section class="mx-auto max-w-6xl px-4 py-20 sm:px-6 md:py-24">
        <div
          class="grid items-center gap-10 rounded-3xl border border-slate-700/70 bg-slate-800/50 p-6 backdrop-blur-sm md:grid-cols-[0.9fr_1.1fr] md:p-10"
        >
          <div
            class="flex min-h-64 items-center justify-center rounded-2xl border border-purple-500/20 bg-purple-500/10"
            aria-hidden="true"
          >
            <div class="text-center">
              <div class="mb-4 text-6xl">🔐</div>
              <div class="font-medium text-purple-200">
                API · OAuth · SSL · Webhooks
              </div>
            </div>
          </div>

          <div>
            <div
              class="mb-3 text-sm font-medium uppercase tracking-[0.18em] text-purple-300"
            >
              {{ $t('service_integrations.security.label') }}
            </div>

            <h2 class="mb-4 text-3xl font-bold text-slate-100">
              {{ $t('service_integrations.security.title') }}
            </h2>

            <p class="mb-6 leading-relaxed text-slate-400">
              {{ $t('service_integrations.security.description') }}
            </p>

            <ul class="space-y-3">
              <li
                v-for="item in securityItems"
                :key="item"
                class="flex items-start text-sm text-slate-300"
              >
                <svg
                  class="mr-3 mt-1 shrink-0 fill-purple-400"
                  width="12"
                  height="9"
                  viewBox="0 0 12 9"
                  aria-hidden="true"
                >
                  <path
                    d="M10.28.28 3.989 6.575 1.695 4.28A1 1 0 0 0 .28 5.695l3 3a1 1 0 0 0 1.414 0l7-7A1 1 0 0 0 10.28.28Z"
                  />
                </svg>

                {{ $t(`service_integrations.security.items.${item}`) }}
              </li>
            </ul>
          </div>
        </div>
      </section>

      <!-- Final CTA -->
      <section class="mx-auto max-w-6xl px-4 pb-20 sm:px-6 md:pb-28">
        <div
          class="rounded-3xl border border-purple-500/20 bg-purple-500/10 px-6 py-12 text-center md:px-12"
        >
          <h2 class="mb-4 text-3xl font-bold text-slate-100">
            {{ $t('service_integrations.cta.title') }}
          </h2>

          <p class="mx-auto mb-7 max-w-2xl text-lg text-slate-400">
            {{ $t('service_integrations.cta.description') }}
          </p>

          <RouterLink
            to="/contact"
            class="btn bg-linear-to-r from-white/80 via-white to-white/80 text-slate-900 transition hover:bg-white"
          >
            {{ $t('service_integrations.cta.button') }}
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
  name: 'ServiceIntegrations',

  components: {
    Header,
    Footer,
    Particles,
  },

  data() {
    return {
      activeCategory: 'all',

      categories: [
        { id: 'all' },
        { id: 'analytics' },
        { id: 'marketing' },
        { id: 'communication' },
        { id: 'payments' },
        { id: 'automation' },
        { id: 'security' },
      ],

      benefits: [
        { id: 1, icon: '⚡' },
        { id: 2, icon: '📊' },
        { id: 3, icon: '🔄' },
      ],

      integrations: [
        {
          id: 1,
          icon: '📈',
          category: 'analytics',
          status: 'standard',
        },
        {
          id: 2,
          icon: '🏷️',
          category: 'analytics',
          status: 'standard',
        },
        {
          id: 3,
          icon: '🔎',
          category: 'analytics',
          status: 'standard',
        },
        {
          id: 4,
          icon: '🔥',
          category: 'analytics',
          status: 'optional',
        },
        {
          id: 5,
          icon: '📘',
          category: 'marketing',
          status: 'optional',
        },
        {
          id: 6,
          icon: '✉️',
          category: 'marketing',
          status: 'optional',
        },
        {
          id: 7,
          icon: '💬',
          category: 'communication',
          status: 'optional',
        },
        {
          id: 8,
          icon: '📱',
          category: 'communication',
          status: 'optional',
        },
        {
          id: 9,
          icon: '💳',
          category: 'payments',
          status: 'custom',
        },
        {
          id: 10,
          icon: '🏦',
          category: 'payments',
          status: 'custom',
        },
        {
          id: 11,
          icon: '🤖',
          category: 'automation',
          status: 'custom',
        },
        {
          id: 12,
          icon: '⚙️',
          category: 'automation',
          status: 'optional',
        },
        {
          id: 13,
          icon: '🗺️',
          category: 'communication',
          status: 'standard',
        },
        {
          id: 14,
          icon: '🛡️',
          category: 'security',
          status: 'standard',
        },
        {
          id: 15,
          icon: '☁️',
          category: 'security',
          status: 'optional',
        },
      ],

      processSteps: [1, 2, 3, 4],
      securityItems: [1, 2, 3, 4],
    }
  },

  computed: {
    filteredIntegrations() {
      if (this.activeCategory === 'all') {
        return this.integrations
      }

      return this.integrations.filter(
        integration => integration.category === this.activeCategory
      )
    },
  },

  methods: {
    statusClass(status) {
      const classes = {
        standard:
          'border-emerald-500/30 bg-emerald-500/10 text-emerald-300',
        optional:
          'border-sky-500/30 bg-sky-500/10 text-sky-300',
        custom:
          'border-purple-500/30 bg-purple-500/10 text-purple-300',
      }

      return classes[status] || classes.optional
    },
  },
}
</script>