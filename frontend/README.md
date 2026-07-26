# Agencija Express web – Frontend (Vue 3 + Tailwind + Vite)

Dobrodošli u frontend repozitorijum projekta **Agencija Express web**, moderne platforme za brzu izradu poslovnih sajtova i online prodavnica.

Ovaj repozitorijum sadrži sve UI/UX komponente, Vue stranice, integracije i logiku za korisničku interakciju. Backend je dostupan u posebnom repozitorijumu [`express-web-backend`](https://github.com/RadojeBozic/expressajt-backend) koji koristi Laravel.

---

## 🎯 Šta je Express web?

**Express web** je agencijska usluga koja nudi klijentima brzu i povoljnu izradu prezentacionih sajtova i online prodavnica, po sistemu:

- **Jednim klikom do sajta** – besplatan sajt u 5 minuta
- **Express Pro** – napredni sajt sa dodatnim sekcijama
- **Online Shop** – e-commerce rešenja
- **Custom sajtovi** – unikatni dizajni, brzo izrađeni

---

## 📦 Tehnologije

- **Vue 3**
- **Vite**
- **TailwindCSS**
- **Vue Router**
- **i18n** (višejezičnost)
- **Axios** (za povezivanje sa Laravel backendom)

---

## 🚀 Kako pokrenuti

> Pre pokretanja, proveri da backend (`expressajt-backend`) radi na http://localhost:8080

npm install
npm run dev
Frontend će biti dostupan na: http://localhost:5173

📁 Struktura projekta
├── public/              # Staticki fajlovi (favicon, slike, itd.)
├── index.html           # Glavni HTML fajl
├── src/
│   ├── assets/            # Slike, ikone, ilustracije
│   ├── components/        # Reusable Vue komponente
│   ├── pages/             # Vue stranice (Home, Dashboard, Login, itd.)
│   ├── partials/          # Header, Footer, Particles itd.
│   ├── services/          # Sve usluge (ServiceFreeSite, ServiceProSite itd.)
│   ├── templates/         # Prikazi sajtova po šablonu
│   ├── utils/             # Autentikacija, helperi
│   └── router.js          # Vue Router konfiguracija
├── i18n.js              # Konfiguracija višejezičnosti
🧩 Aktivne funkcionalnosti
✅ Registracija i prijava korisnika

✅ Popunjavanje forme za besplatan sajt

✅ Prikaz sajta po šablonu

✅ Admin panel za upravljanje korisnicima i prezentacijama

✅ Sistem poruka i prijava ranjivosti

📅 Planirane funkcionalnosti
 Sistem za Pro šablone sa aktivacijom

 Integracija sa domen/hosting providerom

 Online plaćanje i izdavanje faktura

 Napredni dashboard za korisnike

 Mobilna verzija i PWA podrška

🧠 Vizija
Naša agencija želi da omogući svakom korisniku da brzo, povoljno i jednostavno dođe do profesionalnog web sajta – bez potrebe za programerom, kao i uz podršku profesionalaca u izradi i održavanju naprednijih i složenijih rešenja.

📌 Kontakt
Agencija Express web
📧 info@express-web.express
🌐 https://express-web.express (u pripremi)

🤝 Licence
Ovaj projekat je vlasništvo tima Express web. Slobodno koristite ideje za edukaciju, ali distribucija bez dozvole nije dozvoljena.