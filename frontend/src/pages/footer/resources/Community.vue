<template>
  <section>
    <!-- ✨ Pozadinska animacija -->
    <div class="absolute inset-0 -z-10">
      <Particles class="absolute inset-0" />
      <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
        <img src="../../../images/glow-top.svg" class="max-w-none" width="2146" height="774" alt="Glow background" />
      </div>
    </div>

    <div class="relative max-w-6xl mx-auto">
      <Header />

      <div class="pt-32 pb-16 md:pt-52 md:pb-32">
        <div class="max-w-4xl mx-auto">
          <h1 class="text-3xl font-bold mb-6 text-center">🌐 {{ $t('community.title') }}</h1>
          <p class="text-slate-400 text-center mb-12">
            {{ $t('community.intro') }}
          </p>

          <div class="space-y-8">
            <!-- Social Media -->
            <div class="bg-slate-800 border border-slate-700 rounded p-6 shadow">
              <h2 class="text-xl font-semibold text-purple-400 mb-2">📣 {{ $t('community.social.title') }}</h2>
              <p class="text-slate-300 text-sm">{{ $t('community.social.desc') }}</p>

              <ul class="flex space-x-4 mt-4">
                <li>
                  <a href="https://facebook.com/gbsplatform" target="_blank" aria-label="Facebook"
                    class="text-purple-500 hover:text-purple-400">
                    <i class="fab fa-facebook-square text-2xl"></i>
                  </a>
                </li>
                <li>
                  <a href="https://instagram.com/gbsplatform" target="_blank" aria-label="Instagram"
                    class="text-purple-500 hover:text-purple-400">
                    <i class="fab fa-instagram text-2xl"></i>
                  </a>
                </li>
              </ul>
            </div>

            <!-- GitHub -->
            <div class="bg-slate-800 border border-slate-700 rounded p-6 shadow">
              <h2 class="text-xl font-semibold text-purple-400 mb-2">💻 {{ $t('community.github.title') }}</h2>
              <p class="text-slate-300 text-sm">
                {{ $t('community.github.desc') }}
              </p>
              <a href="https://github.com/RadojeBozic/expressajt" target="_blank" aria-label="GitHub"
                class="text-purple-500 hover:text-purple-400 mt-3 inline-block">
                <i class="fab fa-github text-2xl"></i>
              </a>
            </div>

            <!-- Forums -->
            <div class="bg-slate-800 border border-slate-700 rounded p-6 shadow">
              <h2 class="text-xl font-semibold text-purple-400 mb-2">🧠 {{ $t('community.forums.title') }}</h2>
              <p class="text-slate-300 text-sm mb-3">
                {{ $t('community.forums.desc') }}
              </p>
              <ul class="list-disc list-inside text-sm text-slate-400">
                <li><a href="https://dev.to" target="_blank" class="hover:text-white">dev.to – Developer Community</a></li>
                <li><a href="https://stackoverflow.com" target="_blank" class="hover:text-white">Stack Overflow</a></li>
                <li><a href="https://www.reddit.com/r/laravel/" target="_blank" class="hover:text-white">Reddit – Laravel Community</a></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- ✨ Donja pozadina -->
        <div class="absolute inset-0 -z-10">
          <Particles class="absolute inset-0" />
          <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
<!--             <img src="../../../images/glow-bottom.svg" class="max-w-none" width="546" height="274" alt="Pozadina" />
 -->          </div>
        </div>
      </div>

      <Footer />
    </div>
  </section>
</template>

<script>
import Header from '../../../partials/Header.vue'
import Footer from '../../../partials/Footer.vue'
import Particles from '../../../partials/Particles.vue'

export default {
  name: 'CommunityPage',
  components: {
    Header,
    Footer,
    Particles
  }
}
</script>
