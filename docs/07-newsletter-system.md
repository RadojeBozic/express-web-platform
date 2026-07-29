# Express Web Platform — Newsletter System

**Status:** Requirements baseline. Legal/privacy wording requires review for the actual operating entity and jurisdictions.

## Purpose
Build a permission-based audience and notify subscribers about approved new content and selected useful offers. Do not automatically email every registered user without explicit newsletter consent.

## Lifecycle
```text
Submit email/consent -> pending -> confirmation -> active -> campaigns -> unsubscribe/suppression
```
Double opt-in is preferred unless an approved decision states otherwise.

## Data baseline
Normalised email, status, locale, source, consent text/version/timestamp, hashed confirmation token, confirmation/unsubscribe timestamps, provider ID and delivery status. Never store raw tokens.

## Public endpoint
Validate and normalise, rate-limit, prevent enumeration, handle duplicates, dispatch mail asynchronously and log failures safely.

## Sending workflow
A published post does not automatically send. Review content, segment/language, test email, approve campaign, queue delivery, monitor failures and record results.

## Templates
Confirmation, welcome, article notification, general newsletter and unsubscribe confirmation where useful. Include accessible HTML, plain text, sender identity, legal details and unsubscribe.

## Reliability
Queued and idempotent jobs, duplicate-send protection, visible failures, rate-limit compliance and pause capability.

## Unsubscribe/suppression
Simple, immediate and login-free. Campaigns must exclude unsubscribed, bounced and complained addresses. Verify provider webhook signatures.

## Metrics
Requests, confirmation rate, active subscribers, delivery, bounce/complaint, clicks, unsubscribe and website conversions. Use consistent UTM parameters.

## Provider ADR criteria
Deliverability, API/webhooks, operational suitability, price, suppression, analytics, privacy terms, exportability, Laravel integration and sandbox support.

## First-version acceptance
Secure multilingual subscription lifecycle, consent evidence, duplicate handling, reliable unsubscribe, idempotent queued delivery, observable failures, suppression enforcement and automated tests.
