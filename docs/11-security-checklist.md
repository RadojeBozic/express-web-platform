# Express Web Platform — Security Checklist

## Principles
Least privilege, secure defaults, validation, minimal data, protected secrets, safe logging, supported dependencies, verified backups and human review of AI-generated code.

## Secrets/configuration
No secrets in Git; `.env` ignored; safe `.env.example`; separate environment credentials; restricted API keys; frontend variables treated as public; production debug disabled.

## Authentication/authorisation
Server-side permission checks, least-privilege roles, secure sessions/cookies, MFA for privileged external services where available and admin activity logging where appropriate.

## Input/output
Server validation, length/type limits, safe uploads, output escaping, parameterised queries/ORM, mass-assignment protection, safe redirects and protection from header/email injection.

## Public forms/APIs
CSRF where applicable, rate limits, proportional spam controls, generic anti-enumeration responses, duplicate handling, request-size limits and safe logs.

## Headers
Tested CSP, HSTS after stable HTTPS, X-Content-Type-Options, Referrer-Policy, `frame-ancestors`, Permissions-Policy and secure cookies.

## Dependencies/data
Committed lockfiles, audits, supported versions, least-privilege DB, protected backups, controlled exports and no unsanitised production data in tests.

## Newsletter/webhooks
Signature verification, replay protection where supported, hashed/expiring tokens, suppression of complaints/bounces and sending-volume monitoring.

## Deployment/backups
Reviewed commit, protected production branch, documented manual changes, migrations/rollback, automated backups and periodic restore tests.

## AI security
No secrets in prompts, model output treated as untrusted, bounded tools, filtered retrieval, prompt-injection defence, server validation and cost/rate limits.

## Incident response
Preserve evidence, contain, rotate credentials, assess systems/data, restore safely, notify owners, evaluate obligations, document timeline/root cause and verify corrective tasks.
