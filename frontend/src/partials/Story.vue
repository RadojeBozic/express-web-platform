<template>
  <section class="relative">

    <!-- Blurred shape -->
    <div class="absolute top-0 -mt-32 left-1/2 -translate-x-1/2 ml-10 blur-2xl opacity-70 pointer-events-none -z-10" aria-hidden="true">
      <svg xmlns="http://www.w3.org/2000/svg" width="434" height="427">
        <defs>
          <linearGradient id="bs4-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
            <stop offset="0%" stop-color="#A855F7"></stop>
            <stop offset="100%" stop-color="#6366F1" stop-opacity="0"></stop>
          </linearGradient>
        </defs>
        <path fill="url(#bs4-a)" fill-rule="evenodd" d="m0 0 461 369-284 58z" transform="matrix(1 0 0 -1 0 427)"></path>
      </svg>
    </div>

    <div class="px-4 sm:px-6">
      <div class="max-w-5xl mx-auto">
        <div class="pb-12 md:pb-20">

          <!-- Section header -->
          <div class="max-w-3xl mx-auto text-center pb-12 md:pb-20">
            <h2 class="h2 bg-clip-text text-transparent bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60">{{ $t('story.title') }}</h2>
          </div>

          <div class="md:flex justify-between space-x-6 md:space-x-8 lg:space-x-14">
            <figure class="min-w-[240px]">
              <img class="sticky top-8 mx-auto mb-12 md:mb-0 rounded-lg -rotate-[4deg]" src="../images/team.jpg" width="420" height="280" alt="Team" />
            </figure>
            <div class="max-w-[548px] mx-auto">
              <div class="text-slate-400 space-y-6">
                <p>
                  {{ $t('story.paragraph1') }}                </p>
                <p>
                  {{ $t('story.paragraph2') }}                </p>
                <p>
                  {{ $t('story.paragraph3') }}                </p>
                <p>
                  {{ $t('story.paragraph4') }}                </p>
                <p>
                  {{ $t('story.paragraph5') }}
                </p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Story',
}
</script>