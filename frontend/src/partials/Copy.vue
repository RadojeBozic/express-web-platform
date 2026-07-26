<template>
  <section>
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="pt-12 md:pt-20">

        <!-- Section header -->
        <div class="max-w-3xl mx-auto text-center pb-12 md:pb-20">
          <div>
            <div class="inline-flex font-medium bg-clip-text text-transparent bg-linear-to-r from-purple-500 to-purple-200 pb-3">
              {{ $t('gbs_services.section_label') }}
            </div>
          </div>
          <h2 class="h2 bg-clip-text text-transparent bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-4">
            {{ $t('gbs_services.section_title') }}
          </h2>
          <p class="text-lg text-slate-400">
            {{ $t('gbs_services.section_description') }}
          </p>
        </div>

        <!-- Carousel -->
        <div class="relative before:absolute before:inset-0 before:-translate-x-full before:z-20 before:bg-linear-to-l before:from-transparent before:to-slate-900 before:to-20% after:absolute after:inset-0 after:translate-x-full after:z-20 after:bg-linear-to-r after:from-transparent after:to-slate-900 after:to-20%">
          <div class="stellar-carousel swiper-container group">
            <Highlighter class="swiper-wrapper w-fit" :refresh="swiperInitialized">
              <HighlighterItem
                v-for="(service, index) in $t('gbs_services.items')"
                :key="index"
                class="swiper-slide h-auto group/slide"
              >
                <div class="relative h-full bg-slate-900 rounded-[inherit] z-20 overflow-hidden">
                  <Particles
                    class="absolute inset-0 -z-10 opacity-0 group-[.swiper-slide-active]/slide:opacity-100 group-hover/slide:opacity-100 transition-opacity duration-500 ease-in-out"
                    :quantity="3"
                    :refresh="swiperInitialized"
                  />
                  <div class="absolute bottom-0 translate-y-1/2 left-1/2 -translate-x-1/2 pointer-events-none -z-10 w-1/3 aspect-square" aria-hidden="true">
                    <div class="absolute inset-0 translate-z-0 rounded-full bg-slate-800 group-[.swiper-slide-active]/slide:bg-purple-500 transition-colors duration-500 ease-in-out blur-[60px]"></div>
                  </div>
                  <div class="flex flex-col p-6 h-full">
                    <img
                      class="mb-3"
                      :src="`/images/carousel-icon-0${(index % 5) + 1}.svg`"
                      width="56"
                      height="56"
                      :alt="service.title"
                    />
                    <div class="grow">
                      <div class="font-bold text-lg mb-1">{{ service.title }}</div>
                      <div class="text-slate-400 mb-3">{{ service.description }}</div>
                    </div>
                    <div class="text-right">
                      <a href="#0" class="text-sm font-medium text-slate-300 hover:text-white inline-flex items-center transition duration-150 ease-in-out group">
                        {{ $t('global.learn_more') }}
                        <span class="tracking-normal text-purple-500 group-hover:translate-x-0.5 transition-transform duration-150 ease-in-out ml-1">-&gt;</span>
                      </a>
                    </div>
                  </div>
                </div>
              </HighlighterItem>
            </Highlighter>
          </div>
        </div>

        <!-- Arrows -->
        <div class="flex mt-8 justify-end">
          <button class="carousel-prev relative z-20 w-12 h-12 flex items-center justify-center group">
            <span class="sr-only">Previous</span>
            <svg class="w-4 h-4 fill-slate-500 group-hover:fill-purple-500 transition duration-150 ease-in-out" viewBox="0 0 16 16">
              <path d="M6.7 14.7l1.4-1.4L3.8 9H16V7H3.8l4.3-4.3-1.4-1.4L0 8z" />
            </svg>
          </button>
          <button class="carousel-next relative z-20 w-12 h-12 flex items-center justify-center group">
            <span class="sr-only">Next</span>
            <svg class="w-4 h-4 fill-slate-500 group-hover:fill-purple-500 transition duration-150 ease-in-out" viewBox="0 0 16 16">
              <path d="M9.3 14.7l-1.4-1.4L12.2 9H0V7h12.2L7.9 2.7l1.4-1.4L16 8z" />
            </svg>
          </button>
        </div>

      </div>
    </div>
  </section>
</template>

<script>
import { onMounted, ref } from 'vue'
import Particles from './Particles.vue'
import Highlighter from './Highlighter.vue'
import HighlighterItem from './HighlighterItem.vue'
import Swiper, { Navigation } from 'swiper'
import 'swiper/css'

Swiper.use([Navigation])

export default {
  name: 'TestimonialsCarousel',
  components: {
    Particles,
    Highlighter,
    HighlighterItem,
  },
  setup() {
    const swiperInitialized = ref(false)

    onMounted(() => {
      new Swiper('.stellar-carousel', {
        breakpoints: {
          320: { slidesPerView: 1 },
          640: { slidesPerView: 2 },
          1024: { slidesPerView: 3 }
        },
        grabCursor: true,
        loop: false,
        centeredSlides: false,
        spaceBetween: 24,
        navigation: {
          nextEl: '.carousel-next',
          prevEl: '.carousel-prev',
        }
      })
      swiperInitialized.value = true
    })

    return { swiperInitialized }
  }
}
</script>






"items": 
    {
      "title1": "Jednim klikom do sajta",
      "description1": "Brzo kreiranje poslovnih sajtova koristeći šablone (Laravel + Livewire + Bootstrap). Uključuje kontakt forme, galerije, mape i često postavljana pitanja (FAQ).",
    
      "title2": "ERP moduli i poslovne aplikacije",
      "description2": "Upravljanje firmama, klijentima, fakturama i proizvodima uz personalizovan dashboard. Moguća integracija sa fiskalnim sistemima i eksternim API-jevima.",
    
      "title3": "Online prodavnice & Multi-vendor platforme",
      "description3": "Funkcionalni e-commerce sistemi sa modulima za dobavljače, proizvođače i partnere. SEO optimizacija, podrška za Stripe, PayPal i plaćanje pouzećem.",
  
      "title4": "CMS i blog rešenja",
      "description4": "Napredni CMS za objave, kategorije i komentare. Integracija sa Mailchimp-om i mogućnost prikaza najnovijih tema i tagova.",

      "title5": "AI kao servis",
      "description5": "Automatizovano kreiranje sadržaja, slika i email kampanja pomoću veštačke inteligencije. Uključuje i chatbotove, SEO analize i prevod sadržaja.",
   
      "title6": "Edukacija i podrška",
      "description6": "Obuka korisnika kroz video tutorijale i PDF uputstva. Tehnička podrška i pomoć pri hostovanju i podešavanjima.",

      "learn_more": "Saznaj više"
    }
  
{{ $t('gbs_services.items.description1') }}

<template>
  <section class="relative">
    <!-- Blurred shape -->
    <div class="absolute top-0 -translate-y-1/3 left-1/2 -translate-x-1/2 ml-24 blur-2xl opacity-50 pointer-events-none -z-10" aria-hidden="true">
      <svg xmlns="http://www.w3.org/2000/svg" width="434" height="427">
        <defs>
          <linearGradient id="bs3-a" x1="19.609%" x2="50%" y1="14.544%" y2="100%">
            <stop offset="0%" stop-color="#6366F1" />
            <stop offset="100%" stop-color="#6366F1" stop-opacity="0" />
          </linearGradient>
        </defs>
        <path fill="url(#bs3-a)" fill-rule="evenodd" d="m410 0 461 369-284 58z" transform="matrix(1 0 0 -1 -410 427)" />
      </svg>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <div class="py-12 md:py-20 border-t [border-image:linear-gradient(to_right,transparent,var(--color-slate-800),transparent)1]">

        <!-- Section header -->
        <div class="max-w-3xl mx-auto text-center pb-12 md:pb-20">
          <div>
            <div class="inline-flex font-medium bg-clip-text text-transparent bg-linear-to-r from-purple-500 to-purple-200 pb-3">
              {{ $t('faqs.label') }}
            </div>
          </div>
          <h2 class="h2 bg-clip-text text-transparent bg-linear-to-r from-slate-200/60 via-slate-200 to-slate-200/60 pb-4">
            {{ $t('faqs.title') }}
          </h2>
        </div>

        <!-- Columns -->
        <div class="md:flex md:space-x-12 space-y-8 md:space-y-0">
          <!-- Column 1 -->
          <div class="w-full md:w-1/2 space-y-8">
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q1.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q1.text') }}</p>
            </div>
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q2.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q2.text') }}</p>
            </div>
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q3.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q3.text') }}</p>
            </div>
          </div>

          <!-- Column 2 -->
          <div class="w-full md:w-1/2 space-y-8">
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q4.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q4.text') }}</p>
            </div>
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q5.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q5.text') }}</p>
            </div>
            <div class="space-y-2">
              <h4 class="font-semibold">{{ $t('faqs.questions.q6.title') }}</h4>
              <p class="text-slate-400">{{ $t('faqs.questions.q6.text') }}</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Faqs',
}
</script>


<!-- Novi linkovi -->
<li>
  <router-link class="font-medium text-sm text-slate-300 hover:text-white mx-4 lg:mx-5 transition duration-150 ease-in-out" to="/contact">{{ $t('header.menu.contact') }}</router-link>
</li>
<li>
  <router-link class="font-medium text-sm text-slate-300 hover:text-white mx-4 lg:mx-5 transition duration-150 ease-in-out" to="/about#faq">{{ $t('header.menu.faq') }}</router-link>
</li>
<li>
  <router-link class="font-medium text-sm text-slate-300 hover:text-white mx-4 lg:mx-5 transition duration-150 ease-in-out" to="/projects">{{ $t('header.menu.projects') }}</router-link>
</li>

<!-- Privremeno zakomentarisani -->
<!--
<li>
  <router-link class="font-medium text-sm text-slate-300 hover:text-white mx-4 lg:mx-5" to="/integrations">{{ $t('header.menu.integrations') }}</router-link>
</li>
<li>
  <router-link class="font-medium text-sm text-slate-300 hover:text-white mx-4 lg:mx-5" to="/customers">{{ $t('header.menu.customers') }}</router-link>
</li>
<li>
  <router-link class="font-medium text-sm text-slate-300 hover:text-white mx-4 lg:mx-5" to="/changelog">{{ $t('header.menu.changelog') }}</router-link>
</li>
-->



<!-- Social login -->
            <div class="flex space-x-3">
              <button class="btn text-slate-300 hover:text-white transition duration-150 ease-in-out w-full group [background:linear-gradient(var(--color-slate-900),var(--color-slate-900))_padding-box,conic-gradient(var(--color-slate-400),var(--color-slate-700)_25%,var(--color-slate-700)_75%,var(--color-slate-400)_100%)_border-box] relative before:absolute before:inset-0 before:bg-slate-800/30 before:rounded-full before:pointer-events-none h-9">
                <span class="relative">
                  <span class="sr-only">{{ $t('register.continue_twitter') }}</span>
                  <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="14" height="12">
                    <path d="m4.34 0 2.995 3.836L10.801 0h2.103L8.311 5.084 13.714 12H9.482L6.169 7.806 2.375 12H.271l4.915-5.436L0 0h4.34Zm-.635 1.155H2.457l7.607 9.627h1.165L3.705 1.155Z" />
                  </svg>
                </span>
              </button>
              <button class="btn text-slate-300 hover:text-white transition duration-150 ease-in-out w-full group [background:linear-gradient(var(--color-slate-900),var(--color-slate-900))_padding-box,conic-gradient(var(--color-slate-400),var(--color-slate-700)_25%,var(--color-slate-700)_75%,var(--color-slate-400)_100%)_border-box] relative before:absolute before:inset-0 before:bg-slate-800/30 before:rounded-full before:pointer-events-none h-9">
                <span class="relative">
                  <span class="sr-only">{{ $t('register.continue_github') }}</span>
                  <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="16" height="15">
                    <path d="M7.488 0C3.37 0 0 3.37 0 7.488c0 3.276 2.153 6.084 5.148 7.113.374.094.468-.187.468-.374v-1.31c-2.06.467-2.527-.936-2.527-.936-.375-.843-.843-1.124-.843-1.124-.655-.468.094-.468.094-.468.749.094 1.123.75 1.123.75.655 1.216 1.778.842 2.153.654.093-.468.28-.842.468-1.03-1.685-.186-3.37-.842-3.37-3.743 0-.843.281-1.498.75-1.966-.094-.187-.375-.936.093-1.965 0 0 .655-.187 2.059.749a6.035 6.035 0 0 1 1.872-.281c.655 0 1.31.093 1.872.28 1.404-.935 2.059-.748 2.059-.748.374 1.03.187 1.778.094 1.965.468.562.748 1.217.748 1.966 0 2.901-1.778 3.463-3.463 3.65.281.375.562.843.562 1.498v2.059c0 .187.093.468.561.374 2.996-1.03 5.148-3.837 5.148-7.113C14.976 3.37 11.606 0 7.488 0Z" />
                  </svg>
                </span>
              </button>
            </div>




interested(serviceTitle) {
     if (serviceTitle.includes('Express FREE sajt')) {
      this.$router.push('/services/freesite')
    } else if (serviceTitle.includes('Express PRO sajt')) {
      this.$router.push('/services/prosite')
    } else if (serviceTitle.includes('Express Basic Shop')) {
      this.$router.push('/services/onlineshop')
    } else {
      alert(`Zabeleženo interesovanje za: ${serviceTitle}`)
    }
  }

