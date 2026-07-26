# Express Web Platform Architecture

Version: 2.0

---

# Platform Status

> Statusi predstavljaju početne procene na dan 26.07.2026. i ažuriraju se nakon audita svakog modula.

| Oblast | Status |
|---|---:|
| Backend | Procena: 85% |
| Frontend | Procena: 80% |
| Authentication | Procena: 70% |
| Newsletter | Nije implementiran |
| CRM | Rana faza |
| ERP | Planiran |

---

# Vision

Express Web Platform predstavlja jedinstvenu osnovu za sve Express Web proizvode.

Glavni cilj nije izrada pojedinačnih web sajtova.

Glavni cilj je razvoj modularne platforme za digitalizaciju poslovanja.

---

# Core Principles

- Git is the single source of truth
- Local development first
- Production is deployment only
- Modular architecture
- API First
- Security by default

---

# Current Sprint

## Authentication & Security

Ciljevi:

- sprečiti eskalaciju privilegija pri registraciji
- uvesti administratorski middleware
- zaštititi admin API rute
- objediniti frontend API klijent
- ukloniti zastarele auth tokove nakon testiranja

---

# Current Technical Baseline

- Laravel 10.48
- PHP 8.4
- Vue 3
- Vite
- Laravel Sanctum Bearer token authentication
- MariaDB 10.6 in production
- Cloudways production hosting
- Local development in VS Code
- GitHub is the single source of truth

---

# Target Backend Structure

As the platform is refactored, business logic should gradually be organized into:

- Controllers
- Form Requests
- Services
- Policies
- Middleware
- Actions where appropriate

---

# Modules

Authentication

Users

Roles

Admin

CRM

Messages

Newsletter

Website Builder

Presentations

Invoices

Payments

Analytics

AI

Settings

---

# Directory Structure

```
app/
    Models
    Http
    Services
    Policies
    Actions
```

---

# Backend

Laravel

Services

Repositories

Controllers

Requests

Policies

Middleware

---

# Frontend

Vue

Pages

Components

Layouts

Services

API

Router

i18n

---

# API

REST API

Authentication

Authorization

Validation

Error handling

---

# Database

Users

Messages

Newsletter

FreeSiteRequests

Invoices

Payments

...

---

# Security

Authentication

Authorization

Rate limiting

Validation

File uploads

---

# Deployment

VS Code

↓

Git

↓

GitHub

↓

Cloudways

---

# Future modules

CRM

ERP

Marketplace

Vendor Portal

Agent Portal

Analytics

AI Assistant

Knowledge Base