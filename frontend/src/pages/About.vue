<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">

    <!-- ✅ Gornja navigacija (header sajta) -->
    <Header />

    <!-- ✅ Glavni sadržaj stranice -->
    <main class="grow">
      <Hero />        <!-- Hero sekcija za About stranicu -->
      <Story />       <!-- Priča o timu, firmi itd. -->

      <!-- 🔽 Sledeće sekcije su planirane, ali privremeno isključene -->
      <!-- <Team /> -->          <!-- Sekcija o članovima tima -->
      <!-- <Recruitment /> -->   <!-- Sekcija za zapošljavanje -->
      <!-- <Testimonials /> -->  <!-- Sekcija sa izjavama korisnika -->
      <!-- <Cta /> -->           <!-- Poziv na akciju -->

      <!-- ✅ Dodato: Support centar -->

      <SupportHero />       <!-- 🆕 Uvodna sekcija za centar podrške -->
      <Faqs />          <!-- 🆕 Često postavljana pitanja (FAQ) -->
      <!-- <SupportAccordion /> -->  <!-- 🆕 Često postavljana pitanja (FAQ) -->
      <SupportCTA />        <!-- 🆕 Poziv korisnicima da kontaktiraju ili pretraže bazu pomoći -->
    </main>

    <!-- ✅ Donji deo sajta (footer) -->
    <Footer />

  </div>
</template>

<script>
import Header from '../partials/Header.vue'
import Hero from '../partials/HeroAbout.vue'
import Story from '../partials/Story.vue'
import Team from '../partials/Team.vue'
import Recruitment from '../partials/Recruitment.vue'
import Testimonials from '../partials/Testimonials02.vue'
import Cta from '../partials/Cta02.vue'
import Footer from '../partials/Footer.vue'


// 🆕 Dodato: Komponente za podršku (Support center)
import SupportHero from '../partials/SupportHero.vue'         // Hero sekcija: naslov, ilustracija
import SupportAccordion from '../partials/SupportAccordion.vue' // Accordion sa FAQ pitanjima
import SupportCTA from '../partials/SupportCTA.vue'           // Call to action dugme za kontakt
import Faqs from '../partials/Faqs.vue'

export default {
  name: 'About',
  components: {
    Header,
    Hero,
    Story,
    // Sledeće komponente su zakomentarisane dok ne budu potrebne
    Team,
    Recruitment,
    Testimonials,
    Cta,
    Footer,

    // ✅ Aktivirane nove komponente centra za podršku
    SupportHero,
    Faqs,
    SupportAccordion,
    SupportCTA,
  }
}
</script>
