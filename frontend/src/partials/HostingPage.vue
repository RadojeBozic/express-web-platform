<template>
  <section class="relative pt-32 pb-20 overflow-hidden">
    <!-- Particles animation -->
    <Particles class="absolute inset-0 -z-10" />

    <div class="max-w-6xl mx-auto px-4 sm:px-6">

      <!-- Hero -->
      <div class="max-w-3xl mx-auto text-center mb-14">
        <div class="inline-flex mb-5 px-4 py-1 rounded-full bg-purple-500/20 text-purple-300 text-sm">
          🌐 Express Web Hosting
        </div>

        <h1 class="h1 bg-clip-text text-transparent bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-4">
          {{ t('hosting.title') }}
        </h1>

        <p class="text-lg text-slate-300">
          {{ t('hosting.subtitle') }}
        </p>
      </div>

      <!-- Packages -->
      <div class="grid md:grid-cols-3 gap-6 mb-16">
        <div
          v-for="plan in plans"
          :key="plan.key"
          class="bg-slate-800/60 border border-slate-700 rounded-2xl p-6"
        >
          <h2 class="text-xl font-bold text-white mb-2">
            {{ t(`hosting.plans.${plan.key}.title`) }}
          </h2>

          <p class="text-purple-300 font-semibold mb-4">
            {{ t(`hosting.plans.${plan.key}.price`) }}
          </p>

          <p class="text-slate-300 mb-5">
            {{ t(`hosting.plans.${plan.key}.description`) }}
          </p>

          <ul class="space-y-2 text-sm text-slate-300">
            <li v-for="i in 5" :key="i">
              ✔ {{ t(`hosting.plans.${plan.key}.features.${i}`) }}
            </li>
          </ul>
        </div>

        
      </div>
      

      <!-- Starter package -->
      <div class="bg-gradient-to-r from-purple-600/20 to-slate-800/50 border border-purple-500/40 rounded-3xl p-8 mb-16">
        <div class="text-center mb-6">
          <h2 class="text-3xl font-bold text-white">
            🚀 {{ t('hosting.starter.title') }}
          </h2>

          <p class="text-slate-300 mt-3">
            {{ t('hosting.starter.subtitle') }}
          </p>
        </div>

        <div class="max-w-2xl mx-auto">
          <ul class="space-y-4 text-lg text-slate-200">
            <li>✔ {{ t('hosting.starter.feature1') }}</li>
            <li>✔ {{ t('hosting.starter.feature2') }}</li>
            <li>✔ {{ t('hosting.starter.feature3') }}</li>
          </ul>

          <div class="mt-8 text-center">
            <p class="text-purple-300 font-semibold text-lg">
              {{ t('hosting.starter.note') }}
            </p>
          </div>
        </div>
      </div>

      <!-- CTA -->
      <div class="bg-purple-600/20 border border-purple-500/40 rounded-3xl p-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-3">
          {{ t('hosting.cta.title') }}
        </h2>

        <p class="text-slate-300 mb-6">
          {{ t('hosting.cta.text') }}
        </p>

        <router-link to="/contact" class="btn bg-purple-600 hover:bg-purple-700 text-white">
          {{ t('hosting.cta.button') }} →
        </router-link>
      </div>
      <div class="absolute left-1/2 -translate-x-1/2 bottom-0 -z-10">
          <img
            src="../images/glow-bottom.svg"
            class="max-w-none"
            width="346"
            height="174"
            alt="Hero Illustration"
          />
        </div>

    </div>
  </section>
</template>

<script setup>
import { useI18n } from 'vue-i18n'
import Particles from './Particles.vue'

const { t } = useI18n()

const plans = [
  { key: 'basic' },
  { key: 'business' },
  { key: 'premium' }
]
</script>