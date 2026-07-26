<template>
  <div>
    <h2 class="text-xl font-bold mb-4">🧾 Profakture</h2>

    <table class="w-full text-sm text-left border border-slate-700">
      <thead class="bg-slate-800 text-white">
        <tr>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Kupac</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Valuta</th>
          <th class="px-4 py-2">Iznos</th>
          <th class="px-4 py-2">Status</th>
          <th class="px-4 py-2">Akcije</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="invoice in invoices" :key="invoice.id" class="border-t border-slate-700">
          <td class="px-4 py-2">{{ invoice.id }}</td>
          <td class="px-4 py-2">{{ invoice.name }}</td>
          <td class="px-4 py-2">{{ invoice.email }}</td>
          <td class="px-4 py-2">{{ invoice.currency }}</td>
          <td class="px-4 py-2">{{ formatPrice((invoice.total_cents ?? invoice.amount), invoice.currency) }}</td>
          <td class="px-4 py-2">
            <select v-model="invoice.status" class="bg-slate-700 text-white rounded px-2 py-1 text-sm">
              <option value="pending">⏳ Na čekanju</option>
              <option value="approved">✅ Odobreno</option>
              <option value="paid">💵 Plaćeno</option>
              <option value="cancelled">❌ Otkazano</option>
            </select>
            <button
              @click="updateStatus(invoice)"
              class="ml-2 text-xs bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded"
            >
              💾 Sačuvaj
            </button>
          </td>
          <td class="px-4 py-2 space-x-2">
            <a
              :href="`/api/invoice-request/${invoice.id}/pdf`"
              class="text-purple-400 hover:underline"
              target="_blank"
            >📄 PDF</a>
            <button @click="deleteInvoice(invoice.id)" class="text-red-400 hover:text-red-200">🗑️ Obriši</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '@/api/http'

const invoices = ref([])

onMounted(loadInvoices)

async function loadInvoices() {
  try {
    const { data } = await api.get('/admin/invoices')
    invoices.value = Array.isArray(data) ? data : (data?.data ?? [])
  } catch (err) {
    console.error('❌ Greška pri učitavanju faktura:', err)
  }
}

async function updateStatus(invoice) {
  try {
    await api.put(`/invoice-request/${invoice.id}/status`, { status: invoice.status })
    alert('✅ Status uspešno ažuriran.')
  } catch (err) {
    console.error('❌ Greška pri ažuriranju statusa:', err)
  }
}

async function deleteInvoice(id) {
  if (!confirm('Obrisati profakturu?')) return
  try {
    await api.delete(`/invoice-request/${id}`)
    invoices.value = invoices.value.filter(i => i.id !== id)
  } catch (err) {
    console.error('❌ Greška pri brisanju profakture:', err)
  }
}

function formatPrice(value, currency) {
  const val = currency?.toLowerCase() === 'rsd' ? value * 117.5 : value
  return new Intl.NumberFormat('sr-RS', {
    style: 'currency',
    currency: currency?.toLowerCase() === 'rsd' ? 'RSD' : 'EUR'
  }).format((val || 0) / 100)
}
</script>
