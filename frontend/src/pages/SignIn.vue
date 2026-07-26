<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">
    <!-- Gornja navigacija (header sajta) -->
    <Header />

    <main class="grow">
      <section class="relative">
        <!-- Illustration -->
        <div
          class="md:block absolute left-1/2 -translate-x-1/2 -mt-36 blur-2xl opacity-70 pointer-events-none -z-10"
          aria-hidden="true"
        >
          <img src="../images/auth-illustration.svg" class="max-w-none" width="1440" height="450" alt="Page Illustration" />
        </div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6">
          <div class="pt-32 pb-12 md:pt-40 md:pb-20">
            <!-- Page header -->
            <div class="max-w-3xl mx-auto text-center pb-12">
              <!-- Logo -->
              <div class="mb-5">
                <router-link class="inline-flex" to="/">
                  <div
                    class="relative flex items-center justify-center w-16 h-16 border border-transparent rounded-2xl shadow-2xl
                    [background:linear-gradient(var(--color-slate-900),var(--color-slate-900))_padding-box,conic-gradient(var(--color-slate-400),var(--color-slate-700)_25%,var(--color-slate-700)_75%,var(--color-slate-400)_100%)_border-box]
                    before:absolute before:inset-0 before:bg-slate-800/30 before:rounded-2xl"
                  >
                    <img class="relative" src="../images/logo_express01.png" width="42" height="42" alt="Stellar" />
                  </div>
                </router-link>
              </div>

              <!-- Page title -->
              <h1 class="h2 bg-clip-text text-transparent bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60">
                {{ $t('auth.sign_in_title') }}
              </h1>
            </div>

            <!-- Form -->
            <div class="max-w-sm mx-auto">
              <form @submit.prevent="submitForm" autocomplete="on" novalidate>
                <div class="space-y-4">
                  <div>
                    <label class="block text-sm text-slate-300 font-medium mb-1" for="email">
                      {{ $t('auth.email') }}
                    </label>
                    <input
                      id="email"
                      v-model.trim="email"
                      class="form-input w-full"
                      type="email"
                      inputmode="email"
                      autocomplete="email"
                      required
                    />
                  </div>

                  <div>
                    <div class="flex justify-between">
                      <label class="block text-sm text-slate-300 font-medium mb-1" for="password">
                        {{ $t('auth.password') }}
                      </label>
                      <router-link
                        class="text-sm font-medium text-purple-500 hover:text-purple-400 transition duration-150 ease-in-out ml-2"
                        to="/reset-password"
                      >
                        {{ $t('auth.forgot') }}
                      </router-link>
                    </div>
                    <input
                      id="password"
                      v-model="password"
                      class="form-input w-full"
                      type="password"
                      autocomplete="current-password"
                      required
                    />
                  </div>
                </div>

                <div class="mt-6">
                  <button
                    type="submit"
                    class="btn text-sm text-white bg-purple-500 hover:bg-purple-600 w-full shadow-xs group disabled:opacity-60"
                    :disabled="loading"
                    :aria-busy="loading ? 'true' : 'false'"
                  >
                    <span v-if="!loading">
                      {{ $t('auth.sign_in_button') }}
                      <span class="tracking-normal text-purple-300 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-1">-&gt;</span>
                    </span>
                    <span v-else>{{ $t('auth.signing_in') || 'Prijavljivanje…' }}</span>
                  </button>
                </div>
              </form>

              <!-- Success/Error messages -->
              <div v-if="success" class="text-green-500 text-sm mt-4 text-center">{{ success }}</div>
              <div v-if="error" class="text-red-500 text-sm mt-4 text-center">{{ error }}</div>

              <div class="text-center mt-4">
                <div class="text-sm text-slate-400">
                  {{ $t('auth.no_account') }}
                  <router-link
                    class="font-medium text-purple-500 hover:text-purple-400 transition duration-150 ease-in-out"
                    to="/signup"
                  >
                    {{ $t('auth.sign_up') }}
                  </router-link>
                </div>
              </div>

              <!-- Divider -->
              <div class="flex items-center my-6">
                <div class="border-t border-slate-800 grow mr-3" aria-hidden="true"></div>
                <div class="text-sm text-slate-500 italic">{{ $t('auth.or') }}</div>
                <div class="border-t border-slate-800 grow ml-3" aria-hidden="true"></div>
              </div>

              <!-- Social login (trenutno dekorativno) -->
              <div class="flex space-x-3">
                <button
                  type="button"
                  class="btn text-slate-300 hover:text-white transition duration-150 ease-in-out w-full group
                  [background:linear-gradient(var(--color-slate-900),var(--color-slate-900))_padding-box,conic-gradient(var(--color-slate-400),var(--color-slate-700)_25%,var(--color-slate-700)_75%,var(--color-slate-400)_100%)_border-box]
                  relative before:absolute before:inset-0 before:bg-slate-800/30 before:rounded-full before:pointer-events-none h-9"
                >
                  <span class="relative">
                    <span class="sr-only">{{ $t('auth.continue_twitter') }}</span>
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="14" height="12">
                      <path
                        d="m4.34 0 2.995 3.836L10.801 0h2.103L8.311 5.084 13.714 12H9.482L6.169 7.806 2.375 12H.271l4.915-5.436L0 0h4.34Zm-.635 1.155H2.457l7.607 9.627h1.165L3.705 1.155Z"
                      />
                    </svg>
                  </span>
                </button>

                <button
                  type="button"
                  class="btn text-slate-300 hover:text-white transition duration-150 ease-in-out w-full group
                  [background:linear-gradient(var(--color-slate-900),var(--color-slate-900))_padding-box,conic-gradient(var(--color-slate-400),var(--color-slate-700)_25%,var(--color-slate-700)_75%,var(--color-slate-400)_100%)_border-box]
                  relative before:absolute before:inset-0 before:bg-slate-800/30 before:rounded-full before:pointer-events-none h-9"
                >
                  <span class="relative">
                    <span class="sr-only">{{ $t('auth.continue_github') }}</span>
                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="16" height="15">
                      <path
                        d="M7.488 0C3.37 0 0 3.37 0 7.488c0 3.276 2.153 6.084 5.148 7.113.374.094.468-.187.468-.374v-1.31c-2.06.467-2.527-.936-2.527-.936-.375-.843-.843-1.124-.843-1.124-.655-.468.094-.468.094-.468.749.094 1.123.75 1.123.75.655 1.216 1.778.842 2.153.654.093-.468.28-.842.468-1.03-1.685-.186-3.37-.842-3.37-3.743 0-.843.281-1.498.75-1.966-.094-.187-.375-.936.093-1.965 0 0 .655-.187 2.059.749a6.035 6.035 0 0 1 1.872-.281c.655 0 1.31.093 1.872.28 1.404-.935 2.059-.748 2.059-.748.374 1.03.187 1.778.094 1.965.468.562.748 1.217.748 1.966 0 2.901-1.778 3.463-3.463 3.65.281.375.562.843.562 1.498v2.059c0 .187.093.468.561.374 2.996-1.03 5.148-3.837 5.148-7.113C14.976 3.37 11.606 0 7.488 0Z"
                      />
                    </svg>
                  </span>
                </button>
              </div>
            </div>
            <!-- /Form -->
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import { web, api, getCsrfCookie } from '../api/http'
import { saveLoginPayload } from '../utils/auth'

export default {
  data() {
    return {
      email: '',
      password: '',
      error: '',
      success: '',
      loading: false,
    }
  },
  methods: {
    async submitForm() {
      console.log('[submitForm] fired', { email: this.email })
      this.error = ''
      this.success = ''

      const email = (this.email || '').trim().toLowerCase()
      const password = this.password || ''
      if (!email || !password) {
        this.error = 'Email i lozinka su obavezni.'
        return
      }

      this.loading = true
      try {
        console.log('1) calling getCsrfCookie')
        await getCsrfCookie()
        console.log('1) OK')

        console.log('2) POST /login')
        await web.post('/login', { email, password })
        console.log('2) OK')

        console.log('3) GET /api/user')
        const { data: user } = await api.get('/user')
        console.log('3) OK', user)

        saveLoginPayload({ user }, email)

        // --- DEBUG: pauza da ostanu Network logovi vidljivi ---
        await new Promise((r) => setTimeout(r, 1200))
        // debugger
        // --- /DEBUG ---

        const redirect = this.$route?.query?.redirect
        const target = typeof redirect === 'string' && redirect.startsWith('/') ? redirect : '/dashboard'
        this.$router.replace(target)
      } catch (e) {
        console.error('❌ Auth greška:', e?.response?.status, e?.response?.data || e)
        const s = e?.response?.status
        if (s === 419) this.error = 'CSRF greška. Očisti kolačiće i probaj ponovo.'
        else if (s === 401) this.error = 'Email ili lozinka nisu ispravni.'
        else this.error = e?.response?.data?.message || 'Greška na serveru.'
      } finally {
        this.loading = false
      }
    },
  },
}
</script>
