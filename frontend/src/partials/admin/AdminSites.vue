<template>
  <div class="p-8 max-w-6xl mx-auto text-white">
    <h1 class="text-3xl font-bold mb-6">{{ $t('adminSites.title') }}</h1>

    <table class="table-auto w-full border border-slate-700 text-sm rounded-lg overflow-hidden shadow-md">
      <thead class="bg-slate-800 text-left">
        <tr>
          <th class="px-4 py-2 border border-slate-700">{{ $t('adminSites.columns.name') }}</th>
          <th class="px-4 py-2 border border-slate-700">{{ $t('adminSites.columns.user') }}</th>
          <th class="px-4 py-2 border border-slate-700">{{ $t('adminSites.columns.type') }}</th>
          <th class="px-4 py-2 border border-slate-700">{{ $t('adminSites.columns.date') }}</th>
          <th class="px-4 py-2 border border-slate-700">{{ $t('adminSites.columns.plan') }}</th>
          <th class="px-4 py-2 border border-slate-700">{{ $t('adminSites.columns.status') }}</th>
          <th class="px-4 py-2 border border-slate-700">{{ $t('adminSites.columns.actions') }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="site in sites" :key="site.id" class="hover:bg-slate-700 transition duration-100">
          <td class="px-4 py-2 border border-slate-700">{{ site.name }}</td>
          <td class="px-4 py-2 border border-slate-700">{{ site.email || $t('adminSites.unknown') }}</td>
          <td class="px-4 py-2 border border-slate-700">
            <span :class="site.type === 'pro' ? 'text-yellow-400' : 'text-green-400'">{{ site.type.toUpperCase() }}</span>
          </td>
          <td class="px-4 py-2 border border-slate-700">{{ formatDate(site.created_at) }}</td>
          <td class="px-4 py-2 border border-slate-700">
            <span :class="{
              'text-green-400': site.plan === 'starter',
              'text-blue-400': site.plan === 'pro',
              'text-yellow-400': site.plan === 'premium',
              'text-purple-400': site.plan === 'business'
            }">
              {{ $t('adminSites.plans.' + site.plan) }}
            </span>
          </td>
          <td class="px-4 py-2 border border-slate-700">
            <span
              :class="{
                'text-yellow-400': site.status === 'pending',
                'text-green-400': site.status === 'active',
                'text-red-400': site.status === 'rejected'
              }">
              {{ $t('adminSites.statuses.' + site.status) }}
            </span>
          </td>
          <td class="px-4 py-2 border border-slate-700 space-x-2">
            <router-link :to="`/prezentacije/${site.slug}`" class="text-sm bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white">
              {{ $t('adminSites.buttons.view') }}
            </router-link>

            <router-link :to="`/edit-site/${site.slug}`" class="text-sm bg-purple-600 hover:bg-purple-700 px-3 py-1 rounded text-white">
              {{ $t('adminSites.buttons.edit') }}
            </router-link>

            <button
              v-if="site.status === 'pending'"
              @click="approveSite(site.slug)"
              class="text-sm bg-green-600 hover:bg-green-700 px-3 py-1 rounded text-white">
              {{ $t('adminSites.buttons.approve') }}
            </button>

            <button
              @click="deleteSite(site.slug)"
              class="text-sm bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white">
              {{ $t('adminSites.buttons.delete') }}
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <p v-if="sites.length === 0" class="text-slate-400 mt-6 text-center">{{ $t('adminSites.noSites') }}</p>
  </div>
</template>

<script>
import api, { getCsrfCookie } from '@/api/http'

export default {
  name: 'AdminSites',
  data() {
    return {
      sites: [],
      loading: false,
      error: null,
    }
  },
  mounted() {
    this.fetchSites()
  },
  methods: {
    async fetchSites() {
      this.loading = true
      this.error = null
      try {
        const { data } = await api.get('/free-site-request/all-site-requests')
        // ako backend vraća {data: []} ili direktno []
        this.sites = Array.isArray(data) ? data : (data?.data ?? [])
        // (opciono) sort najnovije prvo
        this.sites.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
      } catch (error) {
        console.error('❌ Greška pri učitavanju sajtova:', error?.response?.data || error)
        this.error = this.$t?.('adminSites.errorLoading') || 'Greška pri učitavanju sajtova.'
        if (error?.response?.status === 401) this.$router.push('/login')
      } finally {
        this.loading = false
      }
    },

    async approveSite(slug) {
      try {
        // ✅ Sanctum CSRF pre PATCH
        await getCsrfCookie().catch(() => {})
        await api.patch(`/free-site-request/${slug}/status`, { status: 'active' })

        const site = this.sites.find(s => s.slug === slug)
        if (site) site.status = 'active'
        alert(`✅ ${this.$t?.('adminSites.approved') || 'Odobreno.'}`)
      } catch (err) {
        console.error('❌ Greška pri odobravanju:', err?.response?.data || err)
        if (err?.response?.status === 401) this.$router.push('/login')
        else alert(this.$t?.('adminSites.errorApprove') || 'Greška pri odobravanju.')
      }
    },

    async deleteSite(slug) {
      if (!confirm(this.$t?.('adminSites.confirmDelete') || 'Obrisati sajt?')) return
      try {
        // ✅ Sanctum CSRF pre DELETE
        await getCsrfCookie().catch(() => {})
        await api.delete(`/free-site-request/${slug}`)
        this.sites = this.sites.filter(s => s.slug !== slug)
        alert(`🗑 ${this.$t?.('adminSites.deleted') || 'Sajt obrisan.'}`)
      } catch (error) {
        console.error('❌ Greška pri brisanju:', error?.response?.data || error)
        if (error?.response?.status === 401) this.$router.push('/login')
        else alert(this.$t?.('adminSites.errorDelete') || 'Greška pri brisanju.')
      }
    },

    formatDate(date) {
      return new Date(date).toLocaleString('sr-RS')
    },
  },
}
</script>
