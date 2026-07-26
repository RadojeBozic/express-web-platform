<template>
  <!-- ✨ Pozadinska animacija -->
  <div class="absolute inset-0 -z-10">
    <Particles class="absolute inset-0" />
    <div class="absolute left-1/2 -translate-x-1/2 bottom-0">
      <img src="../images/glow-top.svg" class="max-w-none" width="2146" height="774" alt="Pozadinska animacija" />
    </div>
  </div>

  <div class="flex flex-col min-h-screen bg-slate-900 text-white">
    <Header />

    <main class="grow pt-32 pb-20 px-4 sm:px-6 max-w-6xl mx-auto relative">
      <div class="text-center mb-12">
        <h1 class="text-3xl font-bold">📁 {{ $t('projects.title') }}</h1>
        <p class="text-slate-400 max-w-2xl mx-auto mt-4">
          {{ $t('projects.intro') }}
        </p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="id in 18"
          :key="id"
          class="bg-slate-800 border border-slate-700 rounded-lg p-6 shadow-lg hover:shadow-purple-700 transition"
        >
          <h2 class="text-xl font-semibold text-purple-400 mb-1">
            {{ $t(`projects.items.${id}.title`) }}
          </h2>
          <p class="text-slate-300 text-sm italic mb-2">
            {{ $t(`projects.items.${id}.subtitle`) }}
          </p>
          <details class="text-slate-400 mt-2 text-sm">
            <summary class="cursor-pointer hover:underline">📖 {{ $t('projects.more') }}</summary>
            <div class="mt-3 whitespace-pre-line leading-relaxed">
              {{ $t(`projects.items.${id}.description`) }}
            </div>
          </details>
        </div>
      </div>
    </main>

    <Footer />
  </div>
</template>


<script>
import Header from '../partials/Header.vue'
import Footer from '../partials/Footer.vue'
import Particles from '../partials/Particles.vue'

export default {
  name: 'Projects',
  components: {
    Header,
    Footer,
    Particles
  },
  data() {
    return {
      projects: [
        {
          id: 1,
          title: 'Express FREE sajt',
          subtitle: 'Sajt za 5 minuta – besplatno i bez kodiranja.',
          description: 'Korisnik popunjava formular, bira šablon, sistem generiše prezentaciju. Namenjeno malim firmama i pojedincima.'
        },
        {
          id: 2,
          title: 'Express PRO sajt',
          subtitle: 'Napredna online prezentacija za ozbiljan nastup.',
          description: 'Dodaj PDF, video, dodatne sekcije, kontakt i više – uz SEO i podršku.'
        },
        {
          id: 3,
          title: 'Express W3 sajt',
          subtitle: 'Unikatna poslovna prezentacija za 1 dan.',
          description: 'Brza izrada preko W3Schools šablona — jednostavno, pregledno, mobilno.'
        },
        {
          id: 4,
          title: 'Express CRUIP sajt',
          subtitle: 'Moderne i animirane prezentacije.',
          description: 'Na bazi Cruip dizajna – za tehnološke, startup i SaaS klijente.'
        },
        {
          id: 5,
          title: 'Express Original sajt',
          subtitle: 'Sajt po meri – dizajn i funkcije od nule.',
          description: 'Prilagođena rešenja za zahtevne klijente i specifične industrije.'
        },
        {
          id: 6,
          title: 'Express Basic Shop',
          subtitle: 'Online prodavnica sa osnovnim funkcijama.',
          description: 'Korpa, checkout, admin panel, SEO – sve što treba za start.'
        },
        {
          id: 7,
          title: 'Express UNI Shop',
          subtitle: 'Napredni multi-vendor ili B2B sistem.',
          description: 'Marketplace, dashboard za prodavce, filteri, Stripe i više jezika.'
        },
        {
          id: 8,
          title: 'Domen & hosting usluga',
          subtitle: 'Pomoć pri kupovini i povezivanju domena.',
          description: 'Nabavka i povezivanje domena, hostinga, SSL sertifikata i emaila.'
        },
        {
          id: 9,
          title: 'Održavanje sajta',
          subtitle: 'Tehnička podrška, SEO, backup i izmene.',
          description: 'Mesečne ili jednokratne usluge održavanja, sigurnosti i ažuriranja.'
        },
        {
          id: 10,
          title: 'Express Dizajn',
          subtitle: 'Logo, baneri, društvene mreže – AI + Canva Pro dizajn.',
          description: 'Brzo i kreativno rešenje za brendiranje uz podršku veštačke inteligencije.'
        },
        {
          id: 11,
          title: 'Express SEO',
          subtitle: 'Optimizacija sajta za bolje rangiranje na Google-u.',
          description: 'Analiza, ključne reči, sadržaj i tehnička optimizacija za bolju vidljivost.'
        },
        {
          id: 12,
          title: 'Express AI Chatbot',
          subtitle: 'Automatizujte korisničku podršku uz AI chatbota.',
          description: 'Brza integracija chatbota za FAQ, podršku i interakciju sa posetiocima.'
        },
        {
          id: 13,
          title: 'Express Newsletter',
          subtitle: 'Email marketing rešenje za vašu publiku.',
          description: 'Kreirajte i šaljite newslettere, pratite analitiku i angažujte korisnike.'
        },
        {
          id: 14,
          title: 'Express Analytics',
          subtitle: 'Praćenje poseta i analitika sajta.',
          description: 'Integracija sa Google Analytics i izveštavanje o performansama sajta.'
        },
        {
          id: 15,
          title: 'Express Social Media',
          subtitle: 'Upravljanje društvenim mrežama i kampanjama.',
          description: 'Planiranje, kreiranje sadržaja i analitika za društvene mreže.'
        },
        {
          id: 16,
          title: 'Express Marketing',
          subtitle: 'Sveobuhvatna marketinška strategija za vaš biznis.',
          description: 'Kreiranje i implementacija marketinških kampanja, SEO, PPC i društvene mreže.'
        },
        {
          id: 17,
          title: 'Express Prevodi',
          subtitle: 'Profesionalni prevodi za vašu publiku.',
          description: 'Kvalitetni prevodi sadržaja, lokalizacija i prilagođavanje za različite jezike.'
        },
        {
          id: 18,
          title: 'Express Integracije',
          subtitle: 'Povezivanje sa Stripe, Mailchimp, Google Maps i drugim servisima.',
          description: 'Automatizujte procese i poboljšajte funkcionalnost sajta kroz integracije.'
        }

      ]
    }
  }
}
</script>
