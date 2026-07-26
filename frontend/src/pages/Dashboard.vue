<template>
  <Header />
  <main class="grow p-8 min-h-[60vh]">
    <!-- Dobrodošlica -->
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-slate-300 dark:text-white pt-8 mt-4">
        {{ $t('dashboard.welcome') }}, {{ user?.name || $t('dashboard.user') }}!
      </h1>
      <p class="text-slate-400">{{ $t('dashboard.registered') }}</p>
    </div>

    <!-- Profil -->
    <div class="bg-slate-800 p-6 rounded-lg max-w-5xl w-full mx-auto text-white mb-8 shadow-lg">
      <h2 class="text-xl font-semibold mb-4">🧑‍💼 {{ $t('dashboard.profile.title') }}</h2>
      <p><strong>{{ $t('dashboard.profile.name') }}</strong> {{ user?.name }}</p>
      <p><strong>{{ $t('dashboard.profile.email') }}</strong> {{ user?.email }}</p>

      <button
        @click="confirmDeleteAccount"
        class="mt-6 bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded shadow"
      >
        🗑 {{ $t('dashboard.profile.delete') }}
      </button>
    </div>

    <!-- Poruke korisnika -->
  <div class="bg-slate-800 p-6 rounded-lg max-w-5xl w-full mx-auto text-white mb-8 shadow-lg">
    <h2 class="text-xl font-semibold mb-4">📩 {{ $t('dashboard.messages.title') }}</h2>

    <ul v-if="messages.length">
      <li
        v-for="(msg, index) in messages"
        :key="index"
        class="border-b border-slate-700 pb-3 mb-3"
      >
        <div class="text-sm text-slate-300">
          <strong>{{ msg.name || user?.name || 'Korisnik' }}</strong>
          <span v-if="msg.email" class="text-slate-400"> — {{ msg.email }}</span>
          <span v-if="msg.created_at" class="text-slate-500"> • {{ new Date(msg.created_at).toLocaleString('sr-RS') }}</span>
        </div>
        <div class="mt-1 text-slate-100 whitespace-pre-line">{{ msg.message }}</div>
      </li>
    </ul>

    <div v-else class="text-slate-400">{{ $t('dashboard.messages.empty') }}</div>
  </div>

    
    <!-- Profakture korisnika -->
    <div class="bg-slate-800 p-6 rounded-lg max-w-5xl w-full mx-auto text-white mb-8 shadow-lg">
      <h2 class="text-xl font-semibold mb-4">🧾 Vaše profakture</h2>
      <ul>
        <li v-for="invoice in invoices" :key="invoice.id" class="border-b border-slate-700 pb-2 mb-2">
          {{ invoice.name }} – {{ invoice.currency.toUpperCase() }} – 
          {{ formatPrice((invoice.total_cents ?? invoice.amount), invoice.currency) }} – 
          Status: {{ invoice.status }}
          <br />
          <a
            :href="`/api/invoice-request/${invoice.id}/pdf`"
            target="_blank"
            class="text-sm text-purple-400 hover:underline"
          >
            📄 Preuzmi PDF
          </a>
          <button
          @click="deleteInvoice(invoice.id)"
          class="text-xs text-red-400 hover:text-red-200 mt-1"
        >
          🗑️ Obriši
        </button>
        </li>
        <li v-if="invoices.length === 0">📭 Nemate aktivnih profaktura.</li>
      </ul>
    </div>



    <!-- Usluge -->
    <div class="bg-slate-800 p-6 rounded-lg max-w-7xl w-full mx-auto text-white mb-12 shadow-lg">
      <h2 class="text-xl font-semibold mb-6 text-center">🎯 {{ $t('dashboard.services.title') }}</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="(item, index) in services"
          :key="index"
          class="bg-slate-900 p-4 rounded-lg border border-slate-700 flex flex-col justify-between"
        >
          <div>
            <h3 class="text-lg font-bold mb-2">{{ $t(`dashboard.services.list.${item.key}.title`) }}</h3>
            <p class="text-sm text-slate-300">{{ $t(`dashboard.services.list.${item.key}.desc`) }}</p>
          </div>
          <router-link
            :to="item.route"
            class="mt-4 px-3 py-1 bg-purple-600 hover:bg-purple-700 rounded text-sm text-white self-start text-center"
          >
            {{ $t('dashboard.services.interest') }}
          </router-link>
        </div>
      </div>
    </div>
  </main>
  <Footer />
</template>


<script>
import api from '../api/http';
import { getCurrentUser, clearAuth } from '../utils/auth';
import Header from '../partials/Header.vue';
import Footer from '../partials/Footer.vue';

export default {
  name: 'Dashboard',
  components: { Header, Footer },
  data() {
    const user = getCurrentUser();
    return {
      user,
      messages: [],
      invoices: [],
      services: [
        { key: 'free', route: '/services/freesite' },
        { key: 'pro', route: '/services/prosite' },
        { key: 'w3', route: '/services/w3site' },
        { key: 'cruip', route: '/services/cruipsite' },
        { key: 'original', route: '/services/originalsite' },
        { key: 'basicshop', route: '/services/basicshop' },
        { key: 'unishop', route: '/services/unishop' },
        { key: 'domain', route: '/services/domain-hosting' },
        { key: 'maintenance', route: '/services/maintenance' },
        { key: 'design', route: '/services/design' },
        { key: 'seo', route: '/services/seo' },
        { key: 'marketing', route: '/services/marketing' },
        { key: 'translation', route: '/services/translation' },
      ],
    };
  },
  mounted() {
    if (!this.user) {
      this.$router.replace('/signin');
      return;
    }
    this.fetchMessages();
    this.fetchInvoices();
  },
  methods: {
    async fetchMessages() {
      try {
        const { data } = await api.get('/my-messages');
        this.messages = Array.isArray(data) ? data : (data?.data ?? []);
      } catch (error) {
        console.error('❌ Greška pri preuzimanju poruka:', error);
        // ako dobiješ 401, interceptor će te već izlogovati (ako je uključen)
      }
    },

    async fetchInvoices() {
      try {
        const { data } = await api.get('/my-invoices');
        this.invoices = Array.isArray(data) ? data : (data?.data ?? []);
      } catch (err) {
        console.error('❌ Greška pri učitavanju profaktura:', err);
      }
    },

    formatPrice(value, currency) {
      const val = currency === 'rsd' ? value * 117.5 : value;
      return new Intl.NumberFormat('sr-RS', {
        style: 'currency',
        currency: currency === 'rsd' ? 'RSD' : 'EUR',
      }).format(val / 100);
    },

    async deleteInvoice(id) {
      if (!confirm('Da li ste sigurni da želite da obrišete profakturu?')) return;
      try {
        await api.delete(`/invoice-request/${id}`);
        this.invoices = this.invoices.filter((i) => i.id !== id);
        alert('✅ Profaktura obrisana.');
      } catch (err) {
        console.error('❌ Greška pri brisanju:', err);
      }
    },

    async confirmDeleteAccount() {
      if (!confirm('Da li ste sigurni da želite da obrišete svoj nalog? Ova akcija je nepovratna.')) return;

      try {
        await api.delete('/user');
        clearAuth();
        alert('Vaš nalog je uspešno obrisan.');
        this.$router.push('/');
      } catch (error) {
        console.error('❌ Greška pri brisanju naloga:', error);
        alert('Greška pri brisanju naloga. Pokušajte ponovo.');
      }
    },
  },
};
</script>
