<template>
  <div>
    <h2 class="text-2xl font-bold mb-4">🛡️ Prijavljene ranjivosti</h2>

    <table class="table-auto w-full border border-slate-700 text-sm">
      <thead class="bg-slate-800">
        <tr>
          <th class="border px-3 py-2">Ime</th>
          <th class="border px-3 py-2">Email</th>
          <th class="border px-3 py-2">Opis</th>
          <th class="border px-3 py-2">Link (opciono)</th>
          <th class="border px-3 py-2">Datum</th>
          <th class="border px-3 py-2">Akcija</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="v in reports" :key="v.id" class="hover:bg-slate-700">
          <td class="border px-3 py-2">{{ v.name }}</td>
          <td class="border px-3 py-2">{{ v.email }}</td>
          <td class="border px-3 py-2">{{ v.description }}</td>
          <td class="border px-3 py-2">
            <a :href="v.url" v-if="v.url" target="_blank" class="text-blue-400 underline">{{ v.url }}</a>
            <span v-else class="text-slate-400">—</span>
          </td>
          <td class="border px-3 py-2">{{ formatDate(v.created_at) }}</td>
          <td class="border px-3 py-2">
            <button @click="deleteReport(v.id)" class="bg-red-600 px-2 py-1 rounded text-xs hover:bg-red-700">Obriši</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'AdminVulnerabilities',
  data() {
    return {
      reports: []
    }
  },
  async mounted() {
    const token = localStorage.getItem('token')
    try {
      const res = await axios.get('http://localhost:8080/api/vulnerabilities', {
        headers: { Authorization: `Bearer ${token}` }
      })
      this.reports = res.data
    } catch (err) {
      console.error('❌ Greška pri učitavanju ranjivosti:', err)
    }
  },
  methods: {
    formatDate(dateStr) {
      return new Date(dateStr).toLocaleString()
    },
    async deleteReport(id) {
      const token = localStorage.getItem('token')
      if (!confirm('Obrisati ovu prijavu?')) return

      try {
        await axios.delete(`http://localhost:8080/api/vulnerabilities/${id}`, {
          headers: { Authorization: `Bearer ${token}` }
        })
        this.reports = this.reports.filter(r => r.id !== id)
      } catch (err) {
        console.error('❌ Greška pri brisanju prijave:', err)
      }
    }
  }
}
</script>
