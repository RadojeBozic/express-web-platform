# Contributing Guide

Express Web Platform

Version: 2.0

Last updated: 26 July 2026

---

# Purpose

This document defines the development standards for the Express Web Platform.

Its goal is to keep the project consistent, maintainable and scalable.

These rules apply to every new module and every future contributor.

---

# Development Principles

The platform follows these core principles:

- Git is the single source of truth.
- Development happens locally.
- Production is deployment only.
- Small commits.
- Modular architecture.
- Security first.
- Documentation is part of the source code.

---

# Project Workflow

Development flow:

```
VS Code

↓

Feature Branch

↓

Testing

↓

Commit

↓

Develop

↓

Main

↓

Production
```

---

# Branch Strategy

## Main

Stable production code.

No direct development.

---

## Develop

Integration branch.

Completed features are merged here first.

---

## Feature Branches

```
feature/newsletter

feature/auth-security

feature/crm

feature/analytics
```

One feature per branch.

---

## Fix Branches

```
fix/login

fix/api

fix/stripe

fix/dashboard
```

---

## Release Branches

```
release/2.1.0
```

Used only for production preparation.

---

# Commit Convention

Use Conventional Commits.

Examples:

```
feat: add newsletter subscribers

fix: prevent role escalation

refactor: unify authentication

docs: update architecture

style: improve dashboard layout

test: add authentication tests

chore: update dependencies
```

---

# Code Standards

## PHP

- Follow PSR-12.
- Use Laravel conventions.
- Keep controllers small.
- Business logic belongs in Services.
- Validation belongs in Form Requests.
- Authorization belongs in Policies or Middleware.

---

## Vue

- One responsibility per component.
- Reusable UI belongs in components.
- Pages should remain lightweight.
- API access goes through a centralized client.

---

## JavaScript

- Prefer modern ES modules.
- Avoid duplicated code.
- Use descriptive names.

---

# Database Rules

Never modify production tables manually.

Always create migrations.

Preferred workflow:

```
Migration

↓

Local testing

↓

Commit

↓

Deploy

↓

Production migration
```

---

# Security Rules

Never commit:

```
.env

API keys

Passwords

Database dumps

Production backups
```

Never expose secrets in frontend code.

---

# Documentation Rules

Every architectural change must be documented.

Update when necessary:

- README.md
- ARCHITECTURE.md
- ROADMAP.md
- CHANGELOG.md
- DEPLOYMENT.md

Documentation evolves together with the code.

---

# Testing

Before merging verify:

- Application builds.
- Backend starts.
- Frontend starts.
- Authentication works.
- API endpoints respond.
- Database migrations succeed.

---

# Pull Requests

Each Pull Request should:

- solve one problem
- contain a clear description
- include documentation updates if needed

Avoid mixing unrelated changes.

---

# Project Philosophy

Express Web Platform is not a collection of independent projects.

It is a single modular platform that powers:

- business websites
- CRM systems
- newsletter platform
- business applications
- ERP modules
- AI assistants
- e-commerce solutions
- future SaaS products

Every new module should extend the platform instead of creating a separate application.

---

# Long-Term Goal

The objective is to build a stable, modular and well-documented platform that can evolve over many years while remaining understandable, secure and easy to maintain.

---

# Definition of Done

A task is considered complete only if:

- [ ] Code implemented
- [ ] Local testing completed
- [ ] Documentation updated
- [ ] No debug code remains
- [ ] No temporary files remain
- [ ] Git history is clean
- [ ] Ready for deployment