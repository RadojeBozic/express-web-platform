<template>
  <section id="faq" class="relative">

    <!-- Blurred shape -->
    <div class="absolute top-0 -translate-y-1/3 left-1/2 -translate-x-1/2 ml-24 blur-2xl opacity-50 pointer-events-none -z-10" aria-hidden="true">
      <svg xmlns="http://www.w3.org/2000/svg" width="434" height="427">
        <defs>
          <linearGradient id="bs3-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
            <stop offset="0%" stop-color="#6366F1" />
            <stop offset="100%" stop-color="#6366F1" stop-opacity="0" />
          </linearGradient>
        </defs>
        <path fill="url(#bs3-a)" fill-rule="evenodd" d="m410 0 461 369-284 58z" transform="matrix(1 0 0 -1 -410 427)" />
      </svg>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="py-12 md:py-20 border-t [border-image:linear-gradient(to_right,transparent,var(--color-slate-800),transparent)1]">

        <!-- Section header -->
        <div class="max-w-3xl mx-auto text-center pb-12 md:pb-20">
          <div>
            <div class="inline-flex font-medium bg-clip-text text-transparent bg-linear-to-r from-purple-500 to-purple-200 pb-3">{{ $t('faqs.label') }}
            </div>
          </div>
          <h2 class="h2 bg-clip-text text-transparent bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-4">{{ $t('faqs.title') }}</h2>
        </div>

        <!-- Columns -->
        <div class="md:flex md:space-x-12 space-y-8 md:space-y-0">

          <!-- Column -->
          <div class="w-full md:w-1/2 space-y-8">

            <!-- Item -->
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q1.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q1.text') }}</p>
            </div>

            <!-- Item -->
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q2.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q2.text') }}</p>
            </div>

            <!-- Item -->
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q3.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q3.text') }}</p>
            </div>
          </div>

          <!-- Column -->
          <div class="w-full md:w-1/2 space-y-8">

            <!-- Item -->
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q4.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q4.text') }}</p>
            </div>

            <!-- Item -->
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q5.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q5.text') }}</p>
            </div>

            <!-- Item -->
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q6.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q6.text') }}</p>
            </div>

          </div>

        </div>

      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Faqs',
}
</script>

             
