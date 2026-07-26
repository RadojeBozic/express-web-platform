<template>
  <footer>
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

      <!-- Blocks -->
      <div class="grid sm:grid-cols-12 gap-8 py-8 md:py-12">

        <!-- 1st block -->
        <div class="sm:col-span-12 lg:col-span-4 order-1 lg:order-none">
          <div class="h-full flex flex-col sm:flex-row lg:flex-col justify-between">
            <div class="mb-4 sm:mb-0">
              <div class="mb-4">
                <!-- Logo -->
                <router-link class="inline-flex" to="/" aria-label="Cruip">
                  <img src="../images/logo_express02.png" width="138" height="138" alt="Logo Express" class="max-w-none" />
                </router-link>
              </div>
              <div class="text-sm text-slate-300">&copy;Express web<span class="text-slate-500">-</span>{{ $t('footer.copyright') }}</div>
            </div>
            <!-- Social links -->
            <ul class="flex">
              <!-- Facebook -->
              <li>
                <a href="https://facebook.com/gbsplatform" target="_blank" aria-label="Facebook"
                  class="flex justify-center items-center text-purple-500 hover:text-purple-400 transition duration-150 ease-in-out">
                  <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22 12.07C22 6.49 17.52 2 12 2S2 6.49 2 12.07c0 4.88 3.66 8.93 8.44 9.83v-6.96H8.08v-2.87h2.36V9.41c0-2.33 1.38-3.62 3.5-3.62.7 0 1.42.12 1.42.12v2.6h-1.03c-1.01 0-1.32.63-1.32 1.28v1.53h2.25l-.36 2.87h-1.89v6.96C18.34 21 22 16.95 22 12.07z"/>
                  </svg>
                </a>
              </li>

              <!-- Instagram -->
              <li class="ml-2">
                <a href="https://instagram.com/gbsplatform" target="_blank" aria-label="Instagram"
                  class="flex justify-center items-center text-purple-500 hover:text-purple-400 transition duration-150 ease-in-out">
                  <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5A4.25 4.25 0 0020.5 16.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zm8.75 2.25a.75.75 0 11.001 1.501A.75.75 0 0116.5 5.75zM12 7.25a4.75 4.75 0 110 9.5 4.75 4.75 0 010-9.5zm0 1.5a3.25 3.25 0 100 6.5 3.25 3.25 0 000-6.5z"/>
                  </svg>
                </a>
              </li>

              <!-- GitHub -->
              <li class="ml-2">
                <a href="https://github.com/RadojeBozic/expressajt" target="_blank" aria-label="GitHub"
                  class="flex justify-center items-center text-purple-500 hover:text-purple-400 transition duration-150 ease-in-out">
                  <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                    <path d="M12 .5C5.8.5.5 5.8.5 12c0 5.1 3.3 9.4 7.9 10.9.6.1.8-.3.8-.6v-2.2c-3.2.7-3.9-1.4-3.9-1.4-.5-1.2-1.2-1.5-1.2-1.5-1-.7.1-.7.1-.7 1.1.1 1.6 1.2 1.6 1.2 1 .1 2.3-.7 2.3-.7.2-.8.5-1.3.9-1.6-2.6-.3-5.3-1.3-5.3-5.8 0-1.3.5-2.3 1.2-3.2 0-.3-.5-1.4.1-3 0 0 1-.3 3.3 1.3a11.2 11.2 0 016 0C17 5.1 18 5.4 18 5.4c.6 1.6.1 2.7.1 3 .7.8 1.2 1.9 1.2 3.2 0 4.5-2.8 5.5-5.5 5.8.4.3.8 1 .8 2v2.9c0 .3.2.7.8.6 4.6-1.5 7.9-5.8 7.9-10.9C23.5 5.8 18.2.5 12 .5z"/>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!-- 2nd block -->
        <div class="sm:col-span-6 md:col-span-3 lg:col-span-2">
          <h6 class="text-sm text-slate-50 font-medium mb-2">{{ $t('footer.products') }}</h6>
          <ul class="text-sm space-y-2">
            <li>
              <router-link
                to="/footer/products/features"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.features') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/products/integrations"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.integrations') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/pricing"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.pricing') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/products/changelog"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.changelog') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/products/method"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.method') }}
              </router-link>
            </li>
          </ul>
        </div>

        <!-- 3rd block -->
        <div class="sm:col-span-6 md:col-span-3 lg:col-span-2">
          <h6 class="text-sm text-slate-50 font-medium mb-2">{{ $t('footer.company') }}</h6>
          <ul class="text-sm space-y-2">
            <li>
              <router-link
                to="/footer/company/about"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.about') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/company/diversity"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.diversity') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/company/blog"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.blog') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/company/careers"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.careers') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/company/financials"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.finance') }}
              </router-link>
            </li>
          </ul>
        </div>

        <!-- 4th block -->
        <div class="sm:col-span-6 md:col-span-3 lg:col-span-2">
          <h6 class="text-sm text-slate-50 font-medium mb-2">{{ $t('footer.resources') }}</h6>
          <ul class="text-sm space-y-2">
            <li>
              <router-link
                to="/footer/resources/community"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.community') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/resources/terms"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.terms') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/resources/vulnerability"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.vulnerability') }}
              </router-link>
            </li>
          </ul>
        </div>

        <!-- 5th block -->
        <div class="sm:col-span-6 md:col-span-3 lg:col-span-2">
          <h6 class="text-sm text-slate-50 font-medium mb-2">{{ $t('footer.legals') }}</h6>
          <ul class="text-sm space-y-2">
            <li>
              <router-link
                to="/footer/legals/refund"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.refund') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/legals/terms_conditions"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.terms_conditions') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/legals/privacy"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.privacy') }}
              </router-link>
            </li>
            <li>
              <router-link
                to="/footer/legals/brandkit"
                class="text-slate-400 hover:text-slate-200 transition duration-150 ease-in-out"
              >
                {{ $t('footer.links.brandkit') }}
              </router-link>
            </li>
            <li>
              <router-link to="/cookie-policy" class="text-slate-400 hover:text-slate-200">
                🍪 {{ $t('footer.cookiePolicy') }}
              </router-link>
            </li>
          </ul>
        </div>

      </div>
       
    </div>
    <div class="border-t border-slate-700 py-4 text-center text-xs text-slate-500">
    {{ $t('footer.legal.name') }} —
    {{ $t('footer.legal.mb') }} | {{ $t('footer.legal.pib') }} |
    {{ $t('footer.legal.account') }} <span class="text-slate-400">160-xxx-xxxxx-xx (RSD)</span> |
    <router-link to="/footer/company/financials" class="hover:underline text-purple-400">
      {{ $t('footer.legal.reports') }}
    </router-link>
  </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer',
}
</script>