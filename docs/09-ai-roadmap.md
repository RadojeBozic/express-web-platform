# Express Web Platform — AI Roadmap

## Principle
AI must solve a real user or operational problem and remain reviewable.

## Governance
Human review for consequential outputs, approved data only, no secrets/private client data in unapproved services, clear AI disclosure, bounded tools, cost limits, evaluation and provider exit strategy.

## Stage 0 — AI-assisted development
Codex for audits, scoped implementation, tests, documentation and review support. Use branches, diffs, tests and no production credentials/direct deployment.

## Stage 1 — Curated chatbot
FAQ, navigation, service explanation, lead qualification and human handoff after knowledge/evaluation/privacy preparation.

## Stage 2 — Internal content assistant
Create reviewed drafts for channel repurposing, CTAs, FAQ, newsletter and internal links.

## Stage 3 — Project brief assistant
Clarify business goal, essential functionality and suitable solution; never issue a binding quote automatically.

## Stage 4 — Website/SEO analysis
Public-URL and user-context analysis with prioritised findings, transparent limitations and passive authorised checks.

## Stage 5 — Proposal support
Draft problem, scope, phases, assumptions, exclusions and risks; humans approve price and commitments.

## Stage 6 — Client/business agents
Maintenance, analytics summaries, support triage and vertical assistants requiring stronger identity, authorisation and audit.

## Architecture options
Laravel orchestration, approved model provider, jobs, prompt/version registry, evaluation datasets, usage/cost logging and optional Python services where they provide concrete advantage.

## Security risks
Prompt injection, data exfiltration, untrusted retrieval, excessive tools, hallucinated commitments, cost abuse and future cross-tenant leakage.

## Near-term tasks
Codex workflow/template, chatbot inventory/evaluation, one internal content workflow, provider/data boundaries and an AI ADR before production API integration.
