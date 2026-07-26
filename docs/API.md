# Deployment Guide

Express Web Platform

Version: 2.0

Last updated: 26 July 2026

---

## Deployment Status

Current strategy:

✅ Manual deployment

Current environment:

✅ Local development

Production:

✅ Cloudways

Automation:

⏳ Planned

GitHub Actions:

⏳ Planned

---

# Deployment Philosophy

Express Web Platform follows a simple principle:

> **Development happens locally. Production only receives deployments.**

Production servers are never used as development environments.

Git is the single source of truth.

---

# Development Workflow

```
VS Code
        ↓
Git
        ↓
GitHub
        ↓
Cloudways
```

Every change follows this workflow.

---

# Local Development

## Backend

```bash
php -S 127.0.0.1:8000 -t public
```

## Frontend

```bash
cd frontend

npm run dev
```

Backend

```
http://127.0.0.1:8000
```

Frontend

```
http://localhost:8080
```

---

# Git Workflow

Main branches

```
main
develop
```

Feature branches

```
feature/*
```

Bug fixes

```
fix/*
```

Release branches

```
release/*
```

---

# Commit Policy

Every commit should be small and focused.

Examples

```
feat: add newsletter subscribers

fix: prevent role escalation

refactor: unify authentication

docs: update architecture
```

Avoid large commits mixing unrelated changes.

---

# Deployment Process

## Step 1

Complete development locally.

## Step 2

Run tests.

## Step 3

Commit changes.

## Step 4

Push to GitHub.

## Step 5

Deploy to Cloudways.

---

# Production Checklist

Before deployment verify:

- Application builds successfully
- Database migrations reviewed
- No debug code
- No temporary files
- No .env changes committed
- Documentation updated
- Changelog updated

---

# Database Changes

Every schema change must use Laravel migrations.

Never modify production tables manually.

Preferred workflow:

```
Create migration

↓

Test locally

↓

Commit

↓

Deploy

↓

Run migration
```

---

# Environment Configuration

The following files must never be committed:

```
.env
.env.local
.env.production
```

Environment-specific configuration remains outside Git.

---

# Production Server

Current platform

Cloudways

PHP 8.4

Laravel 10

MariaDB

---

# Deployment Commands

Composer

```bash
composer install --no-dev --optimize-autoloader
```

Migrations

```bash
php artisan migrate --force
```

Optimization

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Frontend

```bash
cd frontend

npm install

npm run build
```

---

# Rollback Strategy

Always create:

- source code backup
- database backup

before production deployment.

If deployment fails:

1. Restore database.
2. Restore application.
3. Verify health endpoint.

---

# Health Check

Verify

```
/api/health
```

Expected response:

```json
{
    "status": "ok"
}
```

---

# Security

Never deploy:

- debug mode enabled
- development credentials
- local configuration
- test scripts
- temporary files

---

# Deployment History

26 July 2026

Initial deployment workflow documented.

Git became the official source of truth.

Local development environment established.

Cloudways became deployment target only.

---

# Future Improvements

Planned

- GitHub Actions
- Automatic deployment
- Zero-downtime deployment
- Automatic rollback
- Deployment notifications
