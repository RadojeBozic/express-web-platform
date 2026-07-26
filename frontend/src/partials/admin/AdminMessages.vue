<template>
  <div>
    <h2 class="text-2xl font-bold mb-6">📩 {{ $t('adminMessages.title') }}</h2>

    <!-- ✅ Kontakt poruke -->
    <div class="mb-10">
      <h3 class="text-xl font-semibold mb-2 text-green-400">{{ $t('adminMessages.contactForm') }}</h3>
      <table class="table-auto w-full border border-slate-700 text-sm">
        <thead class="bg-slate-800">
          <tr>
            <th class="border px-3 py-2">{{ $t('adminMessages.name') }}</th>
            <th class="border px-3 py-2">{{ $t('adminMessages.email') }}</th>
            <th class="border px-3 py-2">{{ $t('adminMessages.message') }}</th>
            <th class="border px-3 py-2">{{ $t('adminMessages.newsletter') }}</th>
            <th class="border px-3 py-2">{{ $t('adminMessages.date') }}</th>
            <th class="border px-3 py-2">{{ $t('adminMessages.action') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="msg in messages" :key="msg.id" class="hover:bg-slate-700">
            <td class="border px-3 py-2">{{ msg.name }}</td>
            <td class="border px-3 py-2">{{ msg.email }}</td>
            <td class="border px-3 py-2">{{ msg.message }}</td>
            <td class="border px-3 py-2">
              <span v-if="msg.newsletter" class="text-green-400">✅</span>
              <span v-else class="text-red-400">❌</span>
            </td>
            <td class="border px-3 py-2">{{ formatDate(msg.created_at) }}</td>
            <td class="border px-3 py-2">
              <button @click="deleteMessage(msg.id, 'messages')" class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">{{ $t('adminMessages.delete') }}</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- 🚨 Prijavljene ranjivosti -->
    <div>
      <h3 class="text-xl font-semibold mb-2 text-yellow-400">🛡 {{ $t('adminMessages.vulnerabilities') }}</h3>
      <table class="table-auto w-full border border-slate-700 text-sm">
        <thead class="bg-slate-800">
          <tr>
            <th class="border px-3 py-2">{{ $t('adminMessages.name') }}</th>
            <th class="border px-3 py-2">{{ $t('adminMessages.email') }}</th>
            <th class="border px-3 py-2">{{ $t('adminMessages.message') }}</th>
            <th class="border px-3 py-2">{{ $t('adminMessages.date') }}</th>
            <th class="border px-3 py-2">{{ $t('adminMessages.action') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="vuln in vulnerabilities" :key="vuln.id" class="hover:bg-slate-700">
            <td class="border px-3 py-2">{{ vuln.name }}</td>
            <td class="border px-3 py-2">{{ vuln.email }}</td>
            <td class="border px-3 py-2">{{ vuln.message }}</td>
            <td class="border px-3 py-2">{{ formatDate(vuln.created_at) }}</td>
            <td class="border px-3 py-2">
              <button @click="deleteMessage(vuln.id, 'vulnerabilities')" class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">{{ $t('adminMessages.delete') }}</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'AdminMessages',
  data() {
    return {
      messages: [],
      vulnerabilities: []
    }
  },
  async mounted() {
    const token = localStorage.getItem('token')
    try {
      const [msgRes, vulnRes] = await Promise.all([
        axios.get('http://localhost:8080/api/messages', {
          headers: { Authorization: `Bearer ${token}` }
        }),
        axios.get('http://localhost:8080/api/vulnerabilities', {
          headers: { Authorization: `Bearer ${token}` }
        })
      ])
      this.messages = msgRes.data
      this.vulnerabilities = vulnRes.data
    } catch (error) {
      console.error('❌ Greška pri učitavanju poruka:', error)
    }
  },
  methods: {
    formatDate(dateStr) {
      return new Date(dateStr).toLocaleString()
    },
    async deleteMessage(id, type) {
      const token = localStorage.getItem('token')
      const endpoint = type === 'messages' ? 'messages' : 'vulnerabilities'

      if (!confirm('Obrisati ovu poruku?')) return

      try {
        await axios.delete(`http://localhost:8080/api/${endpoint}/${id}`, {
          headers: { Authorization: `Bearer ${token}` }
        })

        if (type === 'messages') {
          this.messages = this.messages.filter(m => m.id !== id)
        } else {
          this.vulnerabilities = this.vulnerabilities.filter(v => v.id !== id)
        }
      } catch (error) {
        console.error(`❌ Greška pri brisanju (${type}):`, error)
      }
    }
  }
}
</script>
