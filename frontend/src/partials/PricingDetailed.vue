<template>
  <section class="max-w-4xl mx-auto py-12 px-4 text-white relative">
    <!-- Radial gradient -->
    <div class="absolute flex items-center justify-center top-0 -translate-y-1/2 left-1/2 -translate-x-1/2 pointer-events-none -z-10 w-[800px] aspect-square" aria-hidden="true">
      <div class="absolute inset-0 bg-purple-500 rounded-full blur-[120px] opacity-30"></div>
      <div class="absolute w-64 h-64 bg-purple-400 rounded-full blur-[80px] opacity-70"></div>
    </div>

    <Particles class="absolute inset-0 h-96 -z-11" />

    <!-- Illustration -->
    <div class="md:block absolute left-1/2 -translate-x-1/2 -mt-16 blur-2xl opacity-90 pointer-events-none -z-10" aria-hidden="true">
      <img src="../images/page-illustration.svg" class="max-w-none" width="1440" height="427" alt="Page Illustration">
    </div>

    <!-- Section header -->
    <div class="text-center pb-12 md:pb-20">
      <div class="inline-flex font-medium bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-200 pb-3">
        <p>{{ $t('pricing_global.intro') }}</p>
      </div>
      <h1 class="h1 bg-clip-text text-transparent bg-gradient-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-4">
        {{ $t('pricing_global.title') }}
      </h1>
      <div class="max-w-3xl mx-auto">
        <p class="text-lg text-slate-400">
          {{ $t('pricing_global.note') }}
        </p>
      </div>
    </div>

    <!-- Pricing list -->
    <ul class="space-y-4">
      <li v-for="(item, index) in services" :key="index"
          class="border border-slate-700 rounded p-4 bg-slate-800 shadow hover:border-purple-500 transition">
        <button @click="toggle(index)" class="w-full text-left flex justify-between items-center">
          <div>
            <span class="font-semibold text-white">{{ item.title }}</span>
            <span class="ml-2 text-xs text-purple-400 hover:underline">[{{ $t('pricing_global.more') }}]</span>
          </div>
          <span class="text-sm text-slate-400">{{ item.price }}</span>
        </button>
        <transition name="fade">
          <div v-if="item.open" class="mt-3 text-sm text-slate-300 border-t border-slate-600 pt-3">
            <p class="mb-2">{{ item.description }}</p>
            <button
              @click="openRequestForm(item)"
              class="inline-block px-3 py-1 text-sm bg-purple-600 hover:bg-purple-700 text-white rounded"
            >
              📩 {{ $t('pricing_global.request') }}
            </button>

            <!-- <StripeCheckout /> -->
            <button
              @click="addProductToCart(item, index)"
              class="inline-block px-3 py-1 text-sm bg-purple-600 hover:bg-purple-700 text-white rounded"
            >
              🛒 Dodaj u korpu
            </button>
           <!--  <button
            @click="handleStripePayment"
            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded font-semibold text-sm mt-4"
          >
            💳 Testiraj Stripe naplatu
          </button> -->
          </div>
        </transition>
      </li>
    </ul>

    <RequestOfferModal
      :visible="showModal"
      :selectedService="selectedService"
      @close="showModal = false"
    />
  </section>
</template>

<script>
import axios from 'axios'
import Particles from './Particles.vue'
import RequestOfferModal from './RequestOfferModal.vue'
import StripeCheckout from './StripeCheckout.vue'
import { addToCart } from '../utils/CartService'

export default {
  name: 'PricingDetailed',
  components: {
    Particles,
    RequestOfferModal,
    StripeCheckout

  },
  data() {
    return {
      showModal: false,
      selectedService: '',
      services: Array.from({ length: 23 }, (_, i) => {
        const id = i + 1
        return {
          title: this.$t(`pricing_global.services.${id}.title`),
          price: this.$t(`pricing_global.services.${id}.price`),
          description: this.$t(`pricing_global.services.${id}.description`),
          open: false
        }
      })
    }
  },
  methods: {
    toggle(index) {
      this.services[index].open = !this.services[index].open
    },
    openRequestForm(service) {
      this.selectedService = service.title
      this.showModal = true
    },
    addProductToCart(item, index) {
      addToCart({
        id: index + 1, // ili pravi ID ako postoji
        name: item.title,
        price: this.getPriceNumber(item.price),
        quantity: 1
      })
      alert(`Dodato u korpu: ${item.title}`)
    },
    getPriceNumber(priceString) {
      // Pretvara "od 20 € godišnje" u broj (npr. 20 * 100 = 2000 centi)
      const match = priceString.match(/\d+/)
      return match ? parseInt(match[0], 10) * 100 : 0
    },
    async handleStripePayment() {
      try {
        const token = 'tok_visa'

        const res = await axios.post('http://localhost:8080/api/stripe/checkout', {
          amount: 3000,
          currency: 'eur',
          description: 'Premium plan test',
          plan: 'premium',
          token
        }, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`
          }
        })

        alert('✅ Plaćanje uspešno: ' + res.data.charge.id)
      } catch (err) {
        console.error('❌ Stripe greška:', err)
        alert('❌ Plaćanje nije uspelo.')
      }
    }
  }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: all 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
  transform: translateY(-5px);
}
</style>