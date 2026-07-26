# Database Documentation

Express Web Platform

Version: 2.0

Last updated: 26 July 2026

---

# Purpose

This document describes the database structure of the Express Web Platform.

It serves as the primary reference for:

- entity relationships
- business data
- future migrations
- architectural decisions

---

# Database Engine

Production

- MariaDB 10.6

Development

- MySQL / MariaDB

ORM

- Laravel Eloquent

---

# Current Tables

## users

Purpose

Registered platform users.

Current fields

```
id
name
email
email_verified_at
password
remember_token
message
referrer
role
created_at
updated_at
```

Relationships

```
User

↓

Messages

↓

FreeSiteRequests
```

Future

- profile photo
- company
- language
- notification settings
- newsletter preferences

---

## messages

Purpose

Stores messages submitted through the contact form and user communication.

Current fields

```
id
user_id
name
email
message
newsletter
created_at
updated_at
```

Relationships

```
User

↓

Messages
```

Notes

Current implementation also stores newsletter consent.

Future

Newsletter subscribers will be moved into a dedicated module.

---

## contact_messages

Status

Legacy

Purpose

Originally used for contact form storage.

Current status

Deprecated.

Should be evaluated during platform refactoring.

---

## free_site_requests

Purpose

Stores website requests created through the Website Builder.

Contains

- customer information
- selected template
- hero section
- about section
- offers
- gallery
- Google Maps
- presentation status

Future

Will become part of Website Builder module.

---

## invoice_requests

Purpose

Stores invoice requests.

Current fields include

- customer
- amount
- currency
- description
- items
- status

Future

Will become Billing module.

---

## payments

Purpose

Stores payment information.

Current implementation

Stripe integration.

Future

Payment history

Refunds

Subscriptions

---

## vulnerability_reports

Purpose

Stores responsible disclosure reports.

Future

Security dashboard integration.

---

## personal_access_tokens

Purpose

Laravel Sanctum authentication tokens.

Current authentication

Bearer Token.

Future evaluation

Session authentication.

---

## password_reset_tokens

Laravel default table.

---

## failed_jobs

Laravel queue support.

Currently unused because queue driver is synchronous.

Future

Queue workers.

Newsletter.

Emails.

Background jobs.

---

## migrations

Laravel migration history.

Never modify manually.

---

# Entity Relationships

```
Users
 │
 ├───────────────┐
 │               │
 ▼               ▼
Messages   FreeSiteRequests
 │
 ▼
Newsletter (future)

Users
 │
 ▼
InvoiceRequests
 │
 ▼
Payments
```

---

# Current Architecture

```
Users

↓

Messages

↓

CRM
```

```
Users

↓

Free Site Requests

↓

Website Builder
```

```
Invoice Requests

↓

Payments

↓

Billing
```

---

# Planned Tables

## newsletter_subscribers

Status

Planned

```
id
email
name
status
verification_token
unsubscribe_token
locale
source
verified_at
created_at
updated_at
```

---

## newsletter_campaigns

Status

Planned

```
id
subject
title
content
status
scheduled_at
sent_at
created_at
updated_at
```

---

## newsletter_deliveries

Status

Planned

Stores delivery history.

---

## companies

Future ERP.

---

## clients

Future ERP.

---

## products

Future ERP.

---

## orders

Future ERP.

---

## inventory

Future ERP.

---

# Migration Rules

Every database change must use Laravel migrations.

Never modify production schema manually.

Preferred workflow

```
Create migration

↓

Local testing

↓

Git commit

↓

Deploy

↓

Run migration
```

---

# Naming Convention

Tables

Plural

Examples

```
users

messages

payments
```

Primary keys

```
id
```

Foreign keys

```
user_id

invoice_request_id

company_id
```

Timestamps

```
created_at

updated_at
```

---

# Future Architecture

Database will gradually evolve into separate logical domains.

```
Core

Users

Authentication

Settings
```

```
CRM

Messages

Newsletter

Customers
```

```
Website Builder

Templates

Presentations

Sites
```

```
Billing

Invoices

Payments

Subscriptions
```

```
ERP

Companies

Products

Inventory

Orders
```

```
Marketplace

Vendors

Agents

Customers
```

---

# Database Philosophy

The database should remain:

- normalized
- modular
- extensible
- migration-driven
- well documented

Business logic belongs to the application layer.

The database stores business data—not business rules.

# Current Technical Debt

Identified during initial audit (26 July 2026).

## Messages

Current table stores newsletter consent.

Planned

Separate Newsletter module.

Status

Open

---

## contact_messages

Legacy table.

Needs evaluation.

Status

Open

---

## users

Contains message and referrer fields.

Evaluate whether these belong in the user entity.

Status

Open