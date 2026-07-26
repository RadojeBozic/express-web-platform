<template>
  <section class="relative">

    <!-- Particles animation -->
    <div class="absolute left-1/2 -translate-x-1/2 top-0 -z-10 w-64 h-64 -mt-24">
      <Particles class="absolute inset-0 -z-10" :quantity="6" :staticity="30" />
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="pb-12 md:pb-20">

        <!-- Section header -->
        <div class="max-w-3xl mx-auto text-center pb-12">
          <h2 class="h2 bg-clip-text text-transparent bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-4">{{ $t('features05.title') }}</h2>
          <p class="text-lg text-slate-400">{{ $t('features05.description') }}</p>
        </div>

        <!-- Rings illustration -->
        <div class="text-center pb-8">
          <div class="inline-flex items-center justify-center relative">
            <!-- Particles animation -->
            <Particles class="absolute inset-0 -z-10" :quantity="10" />
            <div class="inline-flex">
              <img src="../images/pricing-illustration.svg" width="334" height="334" alt="Features illustration" />
            </div>
            <img class="absolute -mt-[40%]" src="../images/pricing-illustration-top.svg" width="396" height="328" alt="Features illustration top" aria-hidden="true" />
            <div class="absolute w-[200%] flex items-center justify-center space-x-5">
              <div class="-rotate-[4deg]">
                <img class="w-11 h-11 drop-shadow-lg animate-[float_2.6s_ease-in-out_infinite] opacity-10" src="../images/pricing-icon-01.svg" width="80" height="80" alt="Pricing icon 01" />
              </div>
              <div class="rotate-[4deg]">
                <img class="w-14 h-14 drop-shadow-lg animate-[float_2.4s_ease-in-out_infinite] opacity-25" src="../images/pricing-icon-02.svg" width="80" height="80" alt="Pricing icon 02" />
              </div>
              <div class="-rotate-[4deg]">
                <img class="w-16 h-16 drop-shadow-lg animate-[float_2.2s_ease-in-out_infinite] opacity-60" src="../images/pricing-icon-03.svg" width="80" height="80" alt="Pricing icon 03" />
              </div>
              <img class="drop-shadow-lg animate-float" src="../images/pricing-icon-04.svg" width="80" height="80" alt="Pricing icon 04" />
              <div class="rotate-[4deg]">
                <img class="w-16 h-16 drop-shadow-lg animate-[float_2.2s_ease-in-out_infinite] opacity-60" src="../images/pricing-icon-05.svg" width="80" height="80" alt="Pricing icon 05" />
              </div>
              <div class="-rotate-[4deg]">
                <img class="w-14 h-14 drop-shadow-lg animate-[float_2.4s_ease-in-out_infinite] opacity-25" src="../images/pricing-icon-06.svg" width="80" height="80" alt="Pricing icon 06" />
              </div>
              <div class="rotate-[4deg]">
                <img class="w-11 h-11 drop-shadow-lg animate-[float_2.6ås_ease-in-out_infinite] opacity-10" src="../images/pricing-icon-07.svg" width="80" height="80" alt="Pricing icon 07" />
              </div>
            </div>
          </div>
        </div>

        <!-- Features list -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <!-- Card #1 -->
          <div class="bg-linear-to-tr from-slate-800/50 to-slate-800/10 rounded-3xl border border-slate-800">
            <div class="flex items-center space-x-4 p-4 h-full">
              <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                <path class="fill-purple-500" fill-opacity=".24" d="M10 0C4.5 0 0 4.5 0 10s4.5 10 10 10 10-4.5 10-10S15.5 0 10 0Z" />
                <path class="fill-purple-400" fill-rule="nonzero" d="M13 6.586 14.414 8l-5.747 5.748-3.081-3.081L7 9.252l1.667 1.667z" />
              </svg>
              <p class="text-sm text-slate-400">
                {{ $t('features05.description01') }}
              </p>
            </div>
          </div>
          <!-- Card #2 -->
          <div class="bg-linear-to-tr from-slate-800/50 to-slate-800/10 rounded-3xl border border-slate-800">
            <div class="flex items-center space-x-4 p-4 h-full">
              <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                <path class="fill-purple-500" fill-opacity=".24" d="M10 0C4.5 0 0 4.5 0 10s4.5 10 10 10 10-4.5 10-10S15.5 0 10 0Z" />
                <path class="fill-purple-400" fill-rule="nonzero" d="M13 6.586 14.414 8l-5.747 5.748-3.081-3.081L7 9.252l1.667 1.667z" />
              </svg>
              <p class="text-sm text-slate-400">
                {{ $t('features05.description02') }}
              </p>
            </div>
          </div>
          <!-- Card #3 -->
          <div class="bg-linear-to-tr from-slate-800/50 to-slate-800/10 rounded-3xl border border-slate-800">
            <div class="flex items-center space-x-4 p-4 h-full">
              <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                <path class="fill-purple-500" fill-opacity=".24" d="M10 0C4.5 0 0 4.5 0 10s4.5 10 10 10 10-4.5 10-10S15.5 0 10 0Z" />
                <path class="fill-purple-400" fill-rule="nonzero" d="M13 6.586 14.414 8l-5.747 5.748-3.081-3.081L7 9.252l1.667 1.667z" />
              </svg>
              <p class="text-sm text-slate-400">
                {{ $t('features05.description03') }}
              </p>
            </div>
          </div>
          <!-- Card #4 -->
          <div class="bg-linear-to-tr from-slate-800/50 to-slate-800/10 rounded-3xl border border-slate-800">
            <div class="flex items-center space-x-4 p-4 h-full">
              <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                <path class="fill-purple-500" fill-opacity=".24" d="M10 0C4.5 0 0 4.5 0 10s4.5 10 10 10 10-4.5 10-10S15.5 0 10 0Z" />
                <path class="fill-purple-400" fill-rule="nonzero" d="M13 6.586 14.414 8l-5.747 5.748-3.081-3.081L7 9.252l1.667 1.667z" />
              </svg>
              <p class="text-sm text-slate-400">
                {{ $t('features05.description04') }}
              </p>
            </div>
          </div>
          <!-- Card #5 -->
          <div class="bg-linear-to-tr from-slate-800/50 to-slate-800/10 rounded-3xl border border-slate-800">
            <div class="flex items-center space-x-4 p-4 h-full">
              <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                <path class="fill-purple-500" fill-opacity=".24" d="M10 0C4.5 0 0 4.5 0 10s4.5 10 10 10 10-4.5 10-10S15.5 0 10 0Z" />
                <path class="fill-purple-400" fill-rule="nonzero" d="M13 6.586 14.414 8l-5.747 5.748-3.081-3.081L7 9.252l1.667 1.667z" />
              </svg>
              <p class="text-sm text-slate-400">
                {{ $t('features05.description05') }}
              </p>
            </div>
          </div>
          <!-- Card #6 -->
          <div class="bg-linear-to-tr from-slate-800/50 to-slate-800/10 rounded-3xl border border-slate-800">
            <div class="flex items-center space-x-4 p-4 h-full">
              <svg class="shrink-0" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                <path class="fill-purple-500" fill-opacity=".24" d="M10 0C4.5 0 0 4.5 0 10s4.5 10 10 10 10-4.5 10-10S15.5 0 10 0Z" />
                <path class="fill-purple-400" fill-rule="nonzero" d="M13 6.586 14.414 8l-5.747 5.748-3.081-3.081L7 9.252l1.667 1.667z" />
              </svg>
              <p class="text-sm text-slate-400">
                {{ $t('features05.description06') }}
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script>
import Particles from './Particles.vue'

export default {
  name: 'Features05',
  components: {
    Particles,
  },
}
</script>