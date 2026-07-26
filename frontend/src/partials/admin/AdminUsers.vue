<template>
  <div class="p-8 max-w-5xl mx-auto text-white">
    <h1 class="text-3xl font-bold mb-6">📋 Lista korisnika</h1>

    <table class="table-auto w-full border-collapse border border-slate-700 rounded-lg overflow-hidden shadow-lg">
      <thead class="bg-slate-800 text-left">
        <tr>
          <th class="border border-slate-700 px-4 py-2">Ime</th>
          <th class="border border-slate-700 px-4 py-2">Email</th>
          <th class="border border-slate-700 px-4 py-2">Uloga</th>
          <th class="border border-slate-700 px-4 py-2">Registrovan</th>
          <th class="border border-slate-700 px-4 py-2">Akcije</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="user in users"
          :key="user.id"
          class="hover:bg-slate-700 transition duration-150"
        >
          <td class="border border-slate-700 px-4 py-2">{{ user.name }}</td>
          <td class="border border-slate-700 px-4 py-2">{{ user.email }}</td>
          <td class="border border-slate-700 px-4 py-2">
            <span
              v-if="user.role === 'superadmin'"
              class="text-yellow-400 font-bold"
            >
              ⭐ superadmin
            </span>
            <span v-else>{{ user.role }}</span>
          </td>
          <td class="border border-slate-700 px-4 py-2">{{ formatDate(user.created_at) }}</td>
          <td class="border border-slate-700 px-4 py-2 space-x-2">
            <button
              v-if="user.role !== 'superadmin'"
              @click="changeRole(user)"
              class="px-2 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700"
            >
              Promeni ulogu
            </button>
            <button
              v-if="user.role !== 'superadmin'"
              @click="deleteUser(user.id)"
              class="px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700"
            >
              Obriši
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'AdminUsers',
  data() {
    return {
      users: []
    }
  },
  async mounted() {
    const token = localStorage.getItem('token')
    try {
      const response = await axios.get('http://localhost:8080/api/users', {
        headers: {
          Authorization: `Bearer ${token}`
        }
      })
      this.users = response.data
    } catch (error) {
      console.error('❌ Greška pri učitavanju korisnika:', error)
    }
  },
  methods: {
    formatDate(dateStr) {
      return new Date(dateStr).toLocaleString()
    },
    async changeRole(user) {
      const token = localStorage.getItem('token')
      const novaUloga = user.role === 'user' ? 'admin' : 'user'
      if (!confirm(`Promeniti ulogu korisniku ${user.email} na "${novaUloga}"?`)) return

      try {
        await axios.patch(`http://localhost:8080/api/users/${user.id}/role`, {
          role: novaUloga
        }, {
          headers: { Authorization: `Bearer ${token}` }
        })

        user.role = novaUloga
        alert('✅ Uloga uspešno promenjena.')
      } catch (error) {
        console.error('❌ Greška pri promeni uloge:', error)
      }
    },
    async deleteUser(id) {
      const token = localStorage.getItem('token')
      if (!confirm('Da li ste sigurni da želite da obrišete korisnika?')) return

      try {
        await axios.delete(`http://localhost:8080/api/users/${id}`, {
          headers: { Authorization: `Bearer ${token}` }
        })
        this.users = this.users.filter(u => u.id !== id)
        alert('🗑 Korisnik je obrisan.')
      } catch (error) {
        console.error('❌ Greška pri brisanju korisnika:', error)
      }
    }
  }
}
</script>
