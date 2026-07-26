<template>
  <header class="absolute inset-x-0 top-0 z-30 w-full">
    <div class="mx-auto max-w-6xl px-4 sm:px-6">
      <div
        class="flex h-16 items-center justify-between gap-4 md:h-20"
      >
        <!-- ================================================= -->
        <!-- LOGO                                              -->
        <!-- ================================================= -->

        <router-link
          to="/"
          class="inline-flex shrink-0 items-center"
          :aria-label="$t('header.logoAria')"
        >
          <img
            src="../images/logo_express02.png"
            width="138"
            height="138"
            alt="Express Web"
            class="h-auto w-[110px] md:w-[138px]"
          />
        </router-link>

        <!-- ================================================= -->
        <!-- DESKTOP NAVIGACIJA                                -->
        <!-- ================================================= -->

        <nav
          class="hidden grow justify-center md:flex"
          :aria-label="$t('header.navigationAria')"
        >
          <ul class="flex items-center gap-1 lg:gap-2">
            <li
              v-for="link in navLinks"
              :key="link.to"
            >
              <router-link
                :to="link.to"
                class="rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition hover:bg-white/5 hover:text-white"
                active-class="bg-white/5 text-white"
                :exact-active-class="
                  link.to === '/'
                    ? 'bg-white/5 text-white'
                    : ''
                "
              >
                {{ $t(link.label) }}
              </router-link>
            </li>
          </ul>
        </nav>

        <!-- ================================================= -->
        <!-- DESNI MENI                                        -->
        <!-- ================================================= -->

        <div class="flex shrink-0 items-center gap-2 lg:gap-3">
          <!-- Korpa -->

          <router-link
            to="/checkout"
            class="relative hidden items-center gap-1 rounded-lg px-2 py-2 text-sm text-white transition hover:bg-white/5 hover:text-purple-300 sm:inline-flex"
            :aria-label="$t('header.menu.cart')"
          >
            <span aria-hidden="true">🛒</span>

            <span class="hidden lg:inline">
              {{ $t('header.menu.cart') }}
            </span>

            <span
              v-if="cartCount"
              class="absolute -right-1 -top-1 flex min-h-5 min-w-5 items-center justify-center rounded-full bg-purple-600 px-1.5 text-xs font-bold text-white"
            >
              {{ cartCount }}
            </span>
          </router-link>

          <!-- Neprijavljen korisnik -->

          <template v-if="!user">
            <router-link
              to="/signin"
              class="hidden rounded-lg px-2 py-2 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white lg:inline-flex"
            >
              {{ $t('header.menu.signin') }}
            </router-link>

            <router-link
              to="/signup"
              class="hidden rounded-lg bg-purple-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-purple-500 lg:inline-flex"
            >
              {{ $t('header.menu.signup') }}
            </router-link>
          </template>

          <!-- Prijavljen korisnik -->

          <template v-else>
            <span
              class="hidden max-w-36 truncate rounded-lg bg-slate-700 px-2 py-1 text-sm font-medium text-white xl:inline"
            >
              <span aria-hidden="true">👋</span>
              {{ user.name }}
            </span>

            <router-link
              to="/dashboard"
              class="hidden rounded-lg px-2 py-2 text-sm text-slate-300 transition hover:bg-white/5 hover:text-white lg:inline-flex"
            >
              {{ $t('header.menu.account') }}
              <span class="ml-1" aria-hidden="true">→</span>
            </router-link>

            <button
              type="button"
              class="hidden rounded-lg bg-slate-700 px-3 py-2 text-sm text-white transition hover:bg-slate-600 xl:inline-flex"
              @click="logout"
            >
              {{ $t('header.menu.logout') }}
            </button>
          </template>

          <!-- Admin -->

          <router-link
            v-if="isAdmin"
            to="/admin/dashboard"
            class="hidden rounded-lg border border-purple-400 px-3 py-2 text-sm text-purple-300 transition hover:bg-purple-800/50 hover:text-white xl:inline-flex"
          >
            {{ $t('header.menu.admin') }}
            <span class="ml-1" aria-hidden="true">→</span>
          </router-link>

          <!-- ================================================= -->
          <!-- IZBOR JEZIKA                                      -->
          <!-- ================================================= -->

          <div class="relative">
            <button
              type="button"
              class="flex items-center gap-1.5 rounded-lg border border-slate-600 px-2 py-1.5 text-sm text-slate-300 transition hover:border-slate-500 hover:bg-white/5 hover:text-white"
              :aria-expanded="showLang"
              aria-haspopup="true"
              :aria-label="$t('header.languageAria')"
              @click.stop="toggleLangDropdown"
            >
              <img
                :src="currentFlag"
                :alt="currentLabel"
                class="h-4 w-4 rounded-sm object-cover"
              />

              <span>
                {{ currentLabel }}
              </span>

              <svg
                class="h-3 w-3 transition"
                :class="{ 'rotate-180': showLang }"
                fill="currentColor"
                viewBox="0 0 20 20"
                aria-hidden="true"
              >
                <path
                  d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.585l3.71-4.355a.75.75 0 1 1 1.14.976l-4.25 5a.75.75 0 0 1-1.14 0l-4.25-5a.75.75 0 0 1 .02-1.06Z"
                />
              </svg>
            </button>

            <div
              v-if="showLang"
              class="absolute right-0 z-50 mt-2 w-32 overflow-hidden rounded-lg border border-slate-700 bg-slate-900 shadow-xl"
            >
              <button
                type="button"
                class="flex w-full items-center px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
                @click="setLanguage('sr')"
              >
                <img
                  src="../images/flag-rs.png"
                  alt="Srpski"
                  class="mr-2 h-4 w-4 rounded-sm object-cover"
                />

                SR
              </button>

              <button
                type="button"
                class="flex w-full items-center px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
                @click="setLanguage('en')"
              >
                <img
                  src="../images/flag-uk.png"
                  alt="English"
                  class="mr-2 h-4 w-4 rounded-sm object-cover"
                />

                EN
              </button>

              <button
                type="button"
                class="flex w-full items-center px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
                @click="setLanguage('de')"
              >
                <img
                  src="../images/flag-de.png"
                  alt="Deutsch"
                  class="mr-2 h-4 w-4 rounded-sm object-cover"
                />

                DE
              </button>
            </div>
          </div>

          <!-- ================================================= -->
          <!-- MOBILE MENU DUGME                                 -->
          <!-- ================================================= -->

          <button
            type="button"
            class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-300 transition hover:bg-white/5 hover:text-white md:hidden"
            :aria-expanded="mobileNavOpen"
            aria-controls="mobile-navigation"
            :aria-label="
              mobileNavOpen
                ? $t('header.closeMenuAria')
                : $t('header.openMenuAria')
            "
            @click="toggleMobile"
          >
            <!-- Close ikonica -->

            <svg
              v-if="mobileNavOpen"
              class="h-6 w-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              aria-hidden="true"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18 18 6M6 6l12 12"
              />
            </svg>

            <!-- Hamburger ikonica -->

            <svg
              v-else
              class="h-6 w-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              aria-hidden="true"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
          </button>
        </div>
      </div>

      <!-- ================================================= -->
      <!-- MOBILE NAVIGACIJA                                 -->
      <!-- ================================================= -->

      <nav
        v-if="mobileNavOpen"
        id="mobile-navigation"
        class="mt-2 overflow-hidden rounded-xl border border-slate-700 bg-slate-950/95 px-4 py-4 shadow-2xl backdrop-blur md:hidden"
        :aria-label="$t('header.mobileNavigationAria')"
      >
        <ul class="space-y-1">
          <li
            v-for="link in navLinks"
            :key="link.to"
          >
            <router-link
              :to="link.to"
              class="block rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 transition hover:bg-slate-800 hover:text-white"
              active-class="bg-slate-800 text-white"
              @click="mobileNavOpen = false"
            >
              {{ $t(link.label) }}
            </router-link>
          </li>
        </ul>

        <!-- Mobile korisničke akcije -->

        <div
          class="mt-4 border-t border-slate-800 pt-4"
        >
          <router-link
            to="/checkout"
            class="flex items-center justify-between rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
            @click="mobileNavOpen = false"
          >
            <span>
              <span aria-hidden="true">🛒</span>
              {{ $t('header.menu.cart') }}
            </span>

            <span
              v-if="cartCount"
              class="rounded-full bg-purple-600 px-2 py-0.5 text-xs font-bold text-white"
            >
              {{ cartCount }}
            </span>
          </router-link>

          <template v-if="!user">
            <router-link
              to="/signin"
              class="mt-1 block rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
              @click="mobileNavOpen = false"
            >
              {{ $t('header.menu.signin') }}
            </router-link>

            <router-link
              to="/signup"
              class="mt-2 block rounded-lg bg-purple-600 px-3 py-2.5 text-center text-sm font-medium text-white transition hover:bg-purple-500"
              @click="mobileNavOpen = false"
            >
              {{ $t('header.menu.signup') }}
            </router-link>
          </template>

          <template v-else>
            <div
              class="mt-2 rounded-lg bg-slate-800 px-3 py-2.5 text-sm text-white"
            >
              <span aria-hidden="true">👋</span>
              {{ user.name }}
            </div>

            <router-link
              to="/dashboard"
              class="mt-1 block rounded-lg px-3 py-2.5 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
              @click="mobileNavOpen = false"
            >
              {{ $t('header.menu.account') }}
              <span aria-hidden="true">→</span>
            </router-link>

            <router-link
              v-if="isAdmin"
              to="/admin/dashboard"
              class="mt-1 block rounded-lg px-3 py-2.5 text-sm text-purple-300 transition hover:bg-slate-800 hover:text-white"
              @click="mobileNavOpen = false"
            >
              {{ $t('header.menu.admin') }}
              <span aria-hidden="true">→</span>
            </router-link>

            <button
              type="button"
              class="mt-2 w-full rounded-lg bg-slate-800 px-3 py-2.5 text-left text-sm text-white transition hover:bg-slate-700"
              @click="logout"
            >
              {{ $t('header.menu.logout') }}
            </button>
          </template>
        </div>

        <!-- Mobile izbor jezika -->

        <div
          class="mt-4 flex items-center gap-2 border-t border-slate-800 pt-4"
        >
          <button
            type="button"
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
            @click="setLanguage('sr')"
          >
            <img
              src="../images/flag-rs.png"
              alt="Srpski"
              class="h-4 w-4 rounded-sm object-cover"
            />

            SR
          </button>

          <button
            type="button"
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
            @click="setLanguage('en')"
          >
            <img
              src="../images/flag-uk.png"
              alt="English"
              class="h-4 w-4 rounded-sm object-cover"
            />

            EN
          </button>

          <button
            type="button"
            class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white"
            @click="setLanguage('de')"
          >
            <img
              src="../images/flag-de.png"
              alt="Deutsch"
              class="h-4 w-4 rounded-sm object-cover"
            />

            DE
          </button>
        </div>
      </nav>
    </div>
  </header>
</template>

<script>
import { api, web } from '@/api/http'
import { useCart } from '@/utils/CartService'
import { clearAuth as clearAuthLocal } from '@/utils/auth'
import { resetAuthCache } from '@/router' // statički import, bez TLA

export default {
  name: 'SiteHeader',

  data() {
    return {
      mobileNavOpen: false,
      showLang: false,
      user: null,

      // store (composable instanca)
      cartStore: useCart(),

      navLinks: [
        { to: '/', label: 'header.menu.home' },
        { to: '/services', label: 'header.menu.services' },
        { to: '/projects', label: 'header.menu.projects' },
        { to: '/blog', label: 'header.menu.blog' },
        { to: '/about', label: 'header.menu.about' },
        { to: '/contact', label: 'header.menu.contact' },
      ],
    }
  },

  computed: {
    currentFlag() {
  const locale = this.$i18n?.locale || 'sr'
  const map = {
    sr: '../images/flag-rs.png',
    en: '../images/flag-uk.png',
    de: '../images/flag-de.png',
  }
  return new URL(map[locale] || map.sr, import.meta.url).href
  },
  currentLabel() {
    const locale = this.$i18n?.locale || 'sr'
    const map = { sr: 'SR', en: 'EN', de: 'DE' }
    return map[locale] || 'SR'
  },


    // Korpa (wrappuje ref-ove iz store-a)
    cart()       { return this.cartStore.cart?.value || [] },
    cartCount()  { return this.cartStore.totalItems?.value || 0 },
    cartTotal()  { return this.cartStore.totalPrice?.value || 0 },
    hasItems()   { return this.cartCount > 0 },

    // Auth helpers
    isLoggedIn() { return !!this.user },
    isAdmin() {
      if (!this.user) return false
      return ['admin', 'superadmin'].includes(this.user.role) ||
             ['admin@example.com', 'radoje@example.com'].includes(this.user.email)
    },
  },

  methods: {
    // Jezici
    toggleLangDropdown() { this.showLang = !this.showLang },
    setLanguage(lang) {
      if (this.$i18n) this.$i18n.locale = lang
      try { localStorage.setItem('locale', lang) } catch {}
      this.showLang = false
    },

    // Mobile nav
    toggleMobile() { this.mobileNavOpen = !this.mobileNavOpen },
    clickHandler(e) {
      if (!this.mobileNavOpen) return
      const t = e.target
      if (!t.closest('nav') && !t.closest('button')) this.mobileNavOpen = false
    },
    keyHandler(e) { if (e.key === 'Escape') this.mobileNavOpen = false },

    // Korpa (mapiranje na CartService API)
    addToCart(item)            { this.cartStore.addToCart?.(item) },
    updateQuantity(id, v, qty) { this.cartStore.updateQuantity?.(id, v, qty) },
    removeFromCart(id, v='')   { this.cartStore.removeFromCart?.(id, v) },
    clearCart()                { this.cartStore.clearCart?.() },

    // Auth (server autoritet)
    async refreshUser() {
      try {
        const { data } = await api.get('/user')
        this.user = data
      } catch {
        this.user = null
      }
    },
    async goToAccount() {
      try {
        await api.get('/user')
        this.$router.push('/dashboard')
      } catch {
        this.$router.push({ path: '/signin', query: { redirect: '/dashboard' } })
      }
    },
    async goToAdmin() {
      try {
        const { data } = await api.get('/user')
        if (['admin', 'superadmin'].includes(data.role)) this.$router.push('/admin/dashboard')
        else this.$router.push('/dashboard')
      } catch {
        this.$router.push({ path: '/signin', query: { redirect: '/admin/dashboard' } })
      }
    },

    // LOGOUT – backend + local clear + cart clear + resetAuthCache + na /signin
    async logout() {
      try { await web.post('/logout') } catch {}
      try { clearAuthLocal() } catch {}
      try { this.clearCart() } catch {}
      this.user = null
      try { resetAuthCache() } catch {}
      // hard reload da ne ostane stari state
      window.location.assign('/signin')
      // ili SPA varijanta: this.$router.replace('/signin')
    },
  },

  async mounted() {
    document.addEventListener('click', this.clickHandler)
    document.addEventListener('keydown', this.keyHandler)
    await this.refreshUser()
  },

  beforeUnmount() {
    document.removeEventListener('click', this.clickHandler)
    document.removeEventListener('keydown', this.keyHandler)
  },
}
</script>
