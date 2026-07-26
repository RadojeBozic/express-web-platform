# Express Web Platform

Express Web Platform je centralna aplikacija koja predstavlja osnovu svih Express Web proizvoda i usluga.

Platforma objedinjuje:

- korisničke naloge
- administraciju
- CRM
- Website Builder
- prezentacije
- profakture
- Stripe naplatu
- AI module
- analitiku
- newsletter
- buduće ERP module

---

# Tehnologije

Backend

- Laravel 10
- PHP 8.4
- MySQL / MariaDB
- Laravel Sanctum

Frontend

- Vue 3
- Vite
- Axios
- Tailwind CSS

---

# Struktura

```
app/
bootstrap/
config/
database/
frontend/
public/
resources/
routes/
storage/
```

---

# Lokalna instalacija

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
php artisan migrate
```

```bash
php artisan storage:link
```

Frontend

```bash
cd frontend
npm install
npm run dev
```

Backend

```bash
php artisan serve --port=8080
```

Kreiranje lokalnog `.env` fajla:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

---

# Dokumentacija

Kompletna arhitektura projekta nalazi se u:

```
docs/ARCHITECTURE.md
```

---

# Git Workflow

```
main
develop
feature/*
fix/*
```

---

# Deployment

Production deploy se radi isključivo iz Git repozitorijuma.

Server nije razvojno okruženje.

---

# Licenca

Ovaj repozitorijum je deo vlasničkog projekta Agencija Express web.
Slobodno koristiš kao inspiraciju za edukaciju, ali za produkcijsku upotrebu obavezna je dozvola vlasnika.

# Kontakt

**Express Web**  
Email: office@express-web.express  
Web: https://express-web.express 