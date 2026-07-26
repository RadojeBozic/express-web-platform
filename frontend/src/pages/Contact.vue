<template>
  <div class="flex flex-col min-h-screen overflow-hidden supports-[overflow:clip]:overflow-clip">

    <!-- Header -->
    <Header />
   

    <!-- Main content -->
    <main class="grow">
      <!-- <Hero /> -->
      <ContactHero />
      <ContactForm />
      <ContactInfo />
      <!-- <ContactLinks /> -->
    </main>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script>
import Header from '../partials/Header.vue'
//import Hero from '../partials/Hero.vue'
import Footer from '../partials/Footer.vue'

// 🆕 Kontakt sekcije
import ContactHero from '../partials/ContactHero.vue'         // Uvod sa naslovom i opisom
import ContactForm from '../partials/ContactForm.vue'         // Kontakt forma sa newsletter checkboxom
import ContactInfo from '../partials/ContactInfo.vue'         // Prikaz fizičke adrese i društvenih mreža
//import ContactLinks from '../partials/ContactLinks.vue'       // Korisni linkovi i regulativa

export default {
  name: 'Contact',
  components: {
    Header,
    Footer,
    //Hero,
    ContactHero,
    ContactForm,
    ContactInfo,
    /* ContactLinks, */
  }
}
</script>
