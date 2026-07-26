# Security Policy

Express Web Platform

Version: 2.0

Last updated: 26 July 2026

---

# Purpose

This document defines the security principles of the Express Web Platform.

Security is considered a core architectural requirement rather than an optional feature.

Every new module must follow the rules described in this document.

---

# Security Principles

The platform follows these principles:

- Security by default
- Least privilege
- Defense in depth
- Secure development lifecycle
- Continuous review

---

# Authentication

Current authentication:

- Laravel Sanctum
- Bearer Token Authentication
- Local token storage

Future improvements:

- Session authentication (optional)
- Two-Factor Authentication (2FA)
- Email verification
- Password reset improvements

---

# Authorization

Every protected action must verify permissions.

Authentication alone is never sufficient.

Authorization should be implemented using:

- Middleware
- Policies
- Gates

---

# Roles

Current roles

```
superadmin
admin
user
```

Future roles

```
manager
editor
customer
vendor
agent
supervisor
support
```

Roles must never be assigned directly from public requests.

---

# Password Policy

Minimum requirements:

- Minimum 8 characters
- Secure hashing (Laravel Hash)
- Never stored in plain text

Future improvements:

- Password strength validation
- Password history
- Forced password reset

---

# Environment Variables

Never commit:

```
.env
.env.local
.env.production
```

Never expose:

- API keys
- Database credentials
- Mail credentials
- Stripe secrets
- AI API keys

---

# API Security

Every protected endpoint must require authentication.

Administrative endpoints must require authorization.

Rate limiting should be applied where appropriate.

Input validation is mandatory.

---

# Input Validation

All user input must be validated.

Preferred approach:

- Form Requests
- Validation Rules
- Sanitization

Never trust client-side validation.

---

# Database Security

Rules:

- Never modify production schema manually.
- Use Laravel migrations.
- Use foreign keys where appropriate.
- Avoid duplicated data.
- Validate ownership before updates.

---

# File Upload Security

Allowed file types only.

Validate:

- MIME type
- Extension
- Size

Never trust the filename provided by the client.

Store uploaded files outside the public root whenever possible.

---

# Authentication Tokens

Bearer tokens:

- Stored in localStorage (current implementation)
- Sent via Authorization header

Future evaluation:

- HttpOnly Cookies
- Session-based authentication

---

# HTTPS

Production requirements:

- HTTPS only
- Valid SSL certificate
- Secure cookies
- HSTS enabled

---

# Production Environment

Production must always use:

```
APP_ENV=production

APP_DEBUG=false
```

Never expose debug information.

---

# Logging

Log:

- Authentication failures
- Authorization failures
- Validation errors
- Critical exceptions

Never log:

- Passwords
- Tokens
- API secrets
- Sensitive personal data

---

# Backup Policy

Before every production deployment:

- Source code backup
- Database backup
- Environment backup

Verify backup integrity.

---

# Dependency Management

Dependencies should be updated regularly.

Security updates take priority over feature development.

Recommended commands:

```bash
composer audit

npm audit
```

---

# Security Review Checklist

Before deployment verify:

- [ ] APP_DEBUG disabled
- [ ] HTTPS enabled
- [ ] Environment variables protected
- [ ] Authorization tested
- [ ] Authentication tested
- [ ] No debug routes
- [ ] No temporary scripts
- [ ] No production secrets committed

---

# Incident Response

If a security issue is detected:

1. Assess the impact.
2. Isolate the affected component.
3. Create a backup.
4. Fix the issue.
5. Test locally.
6. Deploy the fix.
7. Document the incident.

---

# Security Roadmap

Short-term

- Secure registration
- Admin middleware
- Role-based authorization
- Authentication cleanup

Medium-term

- Email verification
- Password reset improvements
- Audit logging
- API monitoring

Long-term

- Two-Factor Authentication
- Security dashboard
- Automated security scanning
- Security alerts

---

# Security Philosophy

Express Web Platform should remain secure by design.

Every new module should improve the overall security posture of the platform rather than introducing additional risk.

# Security Technical Debt

The following issues were identified during the initial platform audit (26 July 2026).

## High Priority

- Public registration must never allow role assignment.
- Administrative API routes must require role-based authorization.
- Remove deprecated authentication flow after migration.
- Centralize frontend authentication.
- Remove obsolete debug routes from production.

Status:

Open